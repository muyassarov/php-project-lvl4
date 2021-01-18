<?php

namespace App\Providers;

use Collective\Html\FormFacade;
use Illuminate\Support\ServiceProvider;

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
        FormFacade::component('bsText', 'components.form.text', ['name', 'value', 'label', 'attributes']);
        FormFacade::component('bsSelect', 'components.form.select', ['name', 'values', 'selectedValue', 'label', 'attributes']);
        FormFacade::component('bsTextarea', 'components.form.textarea', ['name', 'value', 'label', 'attributes']);
        FormFacade::component('bsInlineSelect', 'components.form.inline-select', ['name', 'id', 'values', 'selectedValue', 'attributes']);
    }
}
