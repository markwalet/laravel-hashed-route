<?php

namespace MarkWalet\LaravelHashedRoute\Tests;

use Illuminate\Database\Eloquent\Model;
use MarkWalet\LaravelHashedRoute\Concerns\HasHashedRouteKey;

class TestModel extends Model
{
    use HasHashedRouteKey;

    /**
     * Indicates if all mass assignment is enabled.
     *
     * @var bool
     */
    protected static $unguarded = true;

    /**
     * Make a new testable model wit.
     *
     * @param int|null $id
     * @return \MarkWalet\LaravelHashedRoute\Tests\TestModel
     */
    public static function make($id = null)
    {
        return new self([
            'id' => $id,
            'name' => 'Test model name',
        ]);
    }
}
