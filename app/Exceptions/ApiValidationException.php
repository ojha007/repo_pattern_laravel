<?php


namespace App\Exceptions;

use RuntimeException;

class ApiValidationException extends RuntimeException
{
    protected $message, $errors, $status;
    public $original;

    public function __construct($message, $errors, $status)
    {
        $this->message = $message;
        $this->errors = $errors;
        $this->status = $status;
        $this->original = ['message' => $message, 'errors' => $errors];
    }

    public function report()
    {
        return ['message' => $this->message, 'errors' => $this->errors, 'status' => $this->status];
    }

    public function render()
    {
        return response()->json([
            'message' => $this->message,
            'errors' => $this->errors], $this->status);
    }

    public function getStatusCode()
    {
        return $this->status;
    }

}
