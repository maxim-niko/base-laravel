<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function success(string $message = 'Success!', ?array $params = null): array
    {
        return $this->response(0, $message, $params);
    }

    public function error(string $message = 'Error!', ?array $params = null): array
    {
        return $this->response(1, $message, $params);
    }

    private function response(int $error, string $message, ?array $params = null): array
    {
        return [
            'error' => $error,
            'message' => $message,
            'params' => $params
        ];
    }
}
