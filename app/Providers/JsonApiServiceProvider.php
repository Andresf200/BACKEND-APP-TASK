<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use App\JsonApi\Mixins\JsonApiQueryBuilder;
use App\JsonApi\Mixins\JsonApiRequest;

class JsonApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(
            \App\Exceptions\Handler::class,
        );
    }

    public function boot()
    {
        Builder::mixin(new JsonApiQueryBuilder());
    }
}
