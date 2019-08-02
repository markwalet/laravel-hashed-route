<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Concerns;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Route;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\CodecFactory;
use MarkWalet\LaravelHashedRoute\HashedRouteManager;
use MarkWalet\LaravelHashedRoute\Tests\TestModel;
use MarkWalet\LaravelHashedRoute\Tests\LaravelTestCase;

class HasHashedRouteKeyTest extends LaravelTestCase
{
    /** @test */
    public function has_route_key_attribute()
    {
        $codec = $this->createMock(Codec::class);
        $this->app->bind(Codec::class, $codec);
        $model = TestModel::make(112);

        $routeKey = $model->getRouteKey();

        $this->assertNotNull($routeKey);
    }

    /** @test */
    public function can_specify_codec_for_a_model()
    {
        $hashidsModel = TestModel::make(230)->setCodec('hashids');
        $nullModel  = TestModel::make(230)->setCodec('optimus');

        $this->assertEquals('hashids', $hashidsModel->getCodecName());
        $this->assertEquals('optimus', $nullModel->getCodecName());
        $this->assertNotEquals($nullModel->getRouteKey(), $hashidsModel->getRouteKey());
    }

    /** @test */
    public function default_codec_is_applied_when_codec_is_not_specified_in_model()
    {
        $this->app['config']['hashed-route.default'] = 'default-option';
        $model = TestModel::make(113);
        $model->setCodec(null);

        $this->assertEquals('default-option', $model->getCodecName());
    }

    /** @test */
    public function rendering_route_will_use_a_hash_as_default()
    {
        $model = TestModel::make(143);
        $model->setCodec('hashids');
        Route::get('test/{testModel}', function() {
        })->name('test');
        $expectedHash = $this->app->make(HashedRouteManager::class)->codec('hashids')->encode(143);

        $url = route('test', $model);

        $this->assertEquals('http://localhost/test/' . $expectedHash, $url);
    }

    /** @test */
    public function automatic_route_model_binding_decodes_hash()
    {
        $codec = $this->createMock(Codec::class);
        $codec->method('decode')->with('EncodedHash')->willReturn(142);
        $factory = $this->createMock(CodecFactory::class);
        $factory->method('make')->withAnyParameters()->willReturn($codec);
        $this->app->bind(CodecFactory::class, function() use($factory) {
            return $factory;
        });
        $model = TestModel::make(142);

        try {
            $model->resolveRouteBinding('EncodedHash');
        } catch(QueryException $e) {
            $this->assertContains(142, $e->getBindings());
        }
    }
}
