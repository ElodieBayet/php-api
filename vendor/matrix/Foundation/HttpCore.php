<?php

declare(strict_types=1);

namespace Matrix\Foundation;

use Matrix\Foundation\AbstractCore;
use Matrix\Foundation\AbstractResolver;
use Matrix\Foundation\HttpErrorException;
use Matrix\Http\Request;
use Matrix\Http\Response;

/**
 * Http Kernel of application
 */
final class HttpCore extends AbstractCore
{
    public function handle(): Response
    {
        $request = new Request();

        if (empty($request->getPath()) || parent::$prefix !== $request->getPrefix()) {
            if ($this->isDebugging()) {
                echo "HttpCore ::\r\n" . $request->getUri() . " doesn't contain exact prefix '" . parent::$prefix . "'";
                exit;
            }
            header('Location: /forbidden.php', true, 307);
            exit;
        }

        if (in_array($request->getMethod(), [Request::METHOD_POST, Request::METHOD_PUT]) && null === $request->getContent()) {
            $response = AbstractResolver::httpErrorResponse(
                new HttpErrorException("Request content is unprocessable or missing despite required", Response::HTTP_UNPROCESSABLE)
            );
            return $response;
        }

        return $this->resolve($request);
    }

    public function resolve(Request $request): Response
    {
        /** @var Controller $controller */
        $controller;

        /** @var Response $response */
        $response;

        try {
            $controller = AbstractResolver::controller($request, parent::$apiRoutes);
            $endpoint = AbstractResolver::endpoint($request, $controller);
            $arguments = AbstractResolver::arguments($request, $endpoint);
            $response = $endpoint->invoke($controller, ...$arguments);
        } catch (HttpErrorException $httpException) {
            // Errors threw from resolver or controllers
            $response = AbstractResolver::httpErrorResponse($httpException);
        } catch (\Exception $exception) {
            // Unexpected errors
            if ($this->isDebugging()) {
                echo "HttpCore ::\r\n" . $exception->getMessage();
                exit;
            }
            header('Location: /unavailable.php', true, 307);
            exit;
        }

        return $response;
    }
}
