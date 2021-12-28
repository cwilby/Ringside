<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Validator::replacer('ends_with', function ($message, $attribute, $rule, $parameters) {
            $values = array_pop($parameters);

            if (count($parameters)) {
                $values = implode(', ', $parameters).' or '.$values;
            }

            return str_replace(':values', $values, $message);
        });
    }
}
