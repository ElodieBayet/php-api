<?php

declare(strict_types=1);

namespace Matrix\Controller;

use Matrix\Controller\AbstractController;
use Matrix\Foundation\HttpErrorException;
use Matrix\Http\JSonResponse;

class HttpErrorController extends AbstractController
{
    public function index(HttpErrorException $httpErrorException): JSonResponse
    {
        $content = [
            'errors' => [
                'message' => $httpErrorException->getMessage(),
            ]
        ];

        return new JSonResponse($this->encoder($content), $httpErrorException->getHttpCode());
    }
}
