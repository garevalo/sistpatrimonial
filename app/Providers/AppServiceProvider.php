<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('textfield', 'components.form.text', ['name','label', 'value' => null, 'attributes' => []]);
        Form::component('selectfield', 'components.form.select', ['name','label','options' => [],'placeholder','selected' => null, 'attributes' => []]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
