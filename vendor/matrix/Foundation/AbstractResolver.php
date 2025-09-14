<?php

declare(strict_types=1);

namespace Matrix\Foundation;

use Matrix\Controller\AbstractController;
use Matrix\Foundation\HttpErrorException;
use Matrix\Http\Request;
use Matrix\Http\Response;
use Matrix\Model\Route;

abstract class AbstractResolver
{
    public static function controller(Request $request, array $routes): object
    {
        $id = array_find_key($routes, function(string $route) use ($request) {
            return '/'. $request->getPath()[0] === $route;
        });

        if (null === $id) {
            throw new HttpErrorException("Cannot identify destination for '" . $request->getRawPath() . "'", Response::HTTP_NOT_FOUND);
        }

        $name = implode(
            array_map(
                fn(string $word): string => ucfirst($word),
                explode('-', $id)
            )
        );

        $controller = 'App\\Controller\\' . $name . 'Controller';

        return new $controller();
    }

    public static function endpoint(Request $request, AbstractController $controller): \ReflectionMethod
    {
        $reflectionClass = new \ReflectionClass($controller::class);
        $endpoint = null;

        $endpoint = array_find($reflectionClass->getMethods(), function($method) use ($request) {
            return array_find($method->getAttributes(Route::class, \ReflectionAttribute::IS_INSTANCEOF), function($attribute) use ($request) {
                $routeInstance = $attribute->newInstance();
                $slug = str_replace($request->getPrefix(), '', $request->getRawPath());
                $slug = empty($slug) ? '/' . $slug : $slug;
                return $routeInstance->isMethodMatch($request->getMethod()) && $routeInstance->isUrlMatch($slug);
            });
        });

        if (null === $endpoint) {
            throw new HttpErrorException("Cannot resolve destination for '" . $request->getRawPath() . "'", Response::HTTP_NOT_FOUND);
        }

        return $endpoint;
    }

    public static function arguments(Request $request, \ReflectionMethod $method): array
    {
        $arguments = [];

        foreach ($method->getParameters() as $param) {
            if (!$param->getType()->isBuiltin()) {
                $className = $param->getType()->getName();
                $arguments[] = new $className();
            } else {
                $arguments[] = array_key_exists(1, $request->getPath()) ? $request->getPath()[1] : $request->getPath()[0]; 
            };
        }

        return $arguments;
    }

    public static function httpErrorResponse(HttpErrorException $httpErrorException): Response
    {
        /** @var Controller */
        $className = 'Matrix\\Controller\\HttpErrorController';

        /** @var HttpErrorController $controller */
        $controller = new $className();

        $response = $controller->index($httpErrorException);

        return $response;
    }
}
