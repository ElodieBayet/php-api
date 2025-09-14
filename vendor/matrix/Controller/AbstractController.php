<?php

declare(strict_types=1);

namespace Matrix\Controller;

use Matrix\Model\Render;

abstract class AbstractController
{
    /**
     * Implements view template for HTML response
     */
    protected function render(string $view, array $arguments = []): string
    {
        $content = new Render(
            ['.', 'templates', $view],
            $arguments
        );

        return $content->__toString();
    }

    /**
     * Encodes serialized entity for JSon response 
     */
    protected function encoder(array $data): string
    {
        $result = true === array_key_exists('errors', $data) ? $data : ['data' => $data];

        if (true === array_is_list($data)) {
            $result['total_items'] = count($data);
        }

        return json_encode($result);
    }

    /**
     * Decodes JSon request content for entity treatment
     */
    protected function decoder(string $content): array
    {
        return json_decode($content, true);
    }
}
