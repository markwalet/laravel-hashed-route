<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Concerns;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Route;
use MarkWalet\LaravelHashedRoute\CodecFactory;
use MarkWalet\LaravelHashedRoute\Codecs\Codec;
use MarkWalet\LaravelHashedRoute\Exceptions\MissingDriverException;
use MarkWalet\LaravelHashedRoute\HashedRouteManager;
use MarkWalet\LaravelHashedRoute\Tests\LaravelTestCase;
use MarkWalet\LaravelHashedRoute\Tests\TestModel;

class HasHashedRouteKeyTest extends LaravelTestCase
{
    /** @test */
    public function it_has_a_route_key_attribute()
    {
        $codec = $this->createMock(Codec::class);
        $this->app->bind(Codec::class, $codec);
        $model = TestModel::make(112);

        $routeKey = $model->getRouteKey();

        $this->assertNotNull($routeKey);
    }

    /** @test */
    public function it_can_specify_the_codec_for_a_model()
    {
        $hashidsModel = TestModel::make(230)->setCodec('hashids');
        $nullModel = TestModel::make(230)->setCodec('optimus');

        $this->assertEquals('hashids', $hashidsModel->getCodecName());
        $this->assertEquals('optimus', $nullModel->getCodecName());
        $this->assertNotEquals($nullModel->getRouteKey(), $hashidsModel->getRouteKey());
    }

    /** @test */
    public function it_has_a_default_codec_when_the_codec_is_not_specified_in_model()
    {
        $this->app['config']['hashed-route.default'] = 'default-option';
        $model = TestModel::make(113);
        $model->setCodec(null);

        $this->assertEquals('default-option', $model->getCodecName());
    }

    /** @test */
    public function it_renders_the_route_with_a_hash_by_default()
    {
        $model = TestModel::make(143);
        $model->setCodec('hashids');
        Route::get('test/{testModel}', function () {
        })->name('test');
        $expectedHash = $this->app->make(HashedRouteManager::class)->codec('hashids')->encode(143);

        $url = route('test', $model);

        $this->assertEquals('http://localhost/test/'.$expectedHash, $url);
    }

    /** @test */
    public function it_decodes_a_hash_automatically_with_route_model_binding()
    {
        $codec = $this->createMock(Codec::class);
        $codec->method('decode')->with('EncodedHash')->willReturn(142);
        $factory = $this->createMock(CodecFactory::class);
        $factory->method('make')->withAnyParameters()->willReturn($codec);
        $this->app->bind(CodecFactory::class, function () use ($factory) {
            return $factory;
        });
        $model = TestModel::make(142);

        try {
            $model->resolveRouteBinding('EncodedHash');
        } catch (QueryException $e) {
            $this->assertContains(142, $e->getBindings());
        } catch (MissingDriverException $e) {
            $this->fail('MissingDriverException was thrown.');
        }
    }

    /** @test */
    public function it_returns_null_when_the_hash_is_invalid()
    {
        $model = TestModel::make(143);
        $model->setCodec('hashids');
        try {
            $result = $model->resolveRouteBinding('invalid-key');
            $this->assertNull($result);
        } catch (MissingDriverException $e) {
            $this->fail('MissingDriverException was thrown.');
        }
    }
}
