<?php

namespace App\Presenters;

use Exception;
use Illuminate\Database\Eloquent\Model;

abstract class Presenter
{
    /**
     * The presentable model.
     *
     * @var \Illuminate\Database\Eloquent\Model $model
     */
    protected $model;

    /**
     * Create a new Presenter instance.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Undocumented function
     *
     * @param  string $property
     * @return mixed
     * @throws \Exception
     */
    public function __get(string $property)
    {
        if (method_exists($this, $property)) {
            return call_user_func([$this, $property]);
        }

        $message = '%s does not respond to the "%s" property or method.';

        throw new Exception(sprintf($message, static::class, $property));
    }
}
