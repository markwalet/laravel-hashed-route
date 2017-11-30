<?php

namespace MarkWalet\LaravelHashedRoute\Tests\Concerns;

use Illuminate\Support\Facades\Route;
use MarkWalet\LaravelHashedRoute\Exceptions\UnsupportedKeyTypeException;
use MarkWalet\LaravelHashedRoute\HashedRouteManager;
use MarkWalet\LaravelHashedRoute\Tests\TestModel;
use MarkWalet\LaravelHashedRoute\Tests\LaravelTestCase;

class HasHashedRouteKeyTest extends LaravelTestCase
{
    /** @test */
    public function has_hashed_key_attribute()
    {
        $model = TestModel::make(112);

        $this->assertNotNull($model->hashed_key);
    }

    /** @test */
    public function can_specify_transformer_for_a_model()
    {
        $hashidsModel = TestModel::make(230)->setTransformer('hashids');
        $nullModel  = TestModel::make(230)->setTransformer('none');

        $this->assertEquals('hashids', $hashidsModel->getTransformerName());
        $this->assertEquals('none', $nullModel->getTransformerName());
        $this->assertNotEquals($nullModel->hashed_key, $hashidsModel->hashed_key);
    }

    /** @test */
    public function default_transformer_is_applied_when_transformer_is_not_specified_in_model()
    {
        $this->app['config']['hashed-route.default'] = 'default-option';
        $model = TestModel::make(113);
        $model->setTransformer(null);

        $this->assertEquals('default-option', $model->getTransformerName());
    }

    /** @test */
    public function throws_exception_when_key_type_is_not_an_integer()
    {
        $model = TestModel::make(113);
        $model->setKeyType('string');

        $this->expectException(UnsupportedKeyTypeException::class);
        $model->hashed_key;
    }

    /** @test */
    public function rendering_route_will_use_a_hash_as_default()
    {
        $model = TestModel::make(143);
        $model->setTransformer('hashids');
        Route::get('test/{testModel}', function() {
        })->name('test');
        $expectedHash = $this->app->make(HashedRouteManager::class)->transformer('hashids')->encode(143);

        $url = route('test', $model);

        $this->assertEquals('http://localhost/test/' . $expectedHash, $url);
    }
}