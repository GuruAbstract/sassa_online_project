<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class CustomException extends Exception
{
          protected $code=404;
          protected $line="";
          protected $message="Not allowed";


    public function __construct($message = "You See", $code = 404, Throwable $previous = null)
    {
        $this->message=$message;
        $this->report(new Exception());
        parent::__construct($message, $code, $previous);
    }


    public function report()
    {

    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {


        if($this instanceof CustomException) {
            return response()->view('errors.404');
        }

        return parent::render($request, $this);

    }

}
