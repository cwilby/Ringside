<?php

namespace App\Exceptions;

use Exception;

class CannotBeReinstatedException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'This entity cannot be reinstated. This entity is currently employed.';

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $this->message], 400);
        }

        return back()->withError($this->message);
    }
}
