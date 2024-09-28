<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            Blade::component('Front.pages.components.question.index', 'question-index');
            Blade::component('Front.pages.components.page-header', 'page-header');
            Blade::component('Front.pages.components.container', 'container');
            Blade::component('Front.pages.components.dropdown', 'dropdown');
            Blade::component('Front.pages.components.dropdown-link', 'dropdown-link');
            Blade::component('Front.pages.components.responsive-nav-link', 'responsive-nav-link');
            Blade::component('Front.pages.components.auth-validation-errors', 'auth-validation-errors');
            Blade::component('Front.pages.components.label', 'label');
            Blade::component('Front.pages.components.input', 'input');
            Blade::component('Front.pages.components.auth-card', 'auth-card');
            Blade::component('Front.pages.components.button', 'button');
            Blade::component('Front.pages.components.auth-session-status', 'auth-session-status');
            Blade::component('Front.pages.components.alert', 'alert');
            Blade::component('Front.pages.components.form.input', 'form.input');
            Blade::component('Front.pages.components.form.button', 'form.button');
            Blade::component('Front.pages.components.question.user', 'question.user');
            Blade::component('Front.pages.components.question.topic-pill', 'question.topic-pill');









    }
}
