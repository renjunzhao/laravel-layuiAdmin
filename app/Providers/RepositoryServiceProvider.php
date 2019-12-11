<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\Interfaces\User\UserRepository::class, \App\Repositories\User\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\User\AdminUserRepository::class, \App\Repositories\User\AdminUserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\Article\ArticleRepository::class, \App\Repositories\Article\ArticleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\Article\CategoryRepository::class, \App\Repositories\Article\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\Article\LanguageRepository::class, \App\Repositories\Article\LanguageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\System\SystemRepository::class, \App\Repositories\System\SystemRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\System\MenuRepository::class, \App\Repositories\System\MenuRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\System\SmsRepository::class, \App\Repositories\System\SmsRepositoryEloquent::class);

        //:end-bindings:
    }
}
