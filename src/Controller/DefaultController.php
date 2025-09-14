<?php

declare(strict_types=1);

namespace App\Controller;

use Matrix\Controller\AbstractController;
use Matrix\Model\Route;
use Matrix\Http\Response;

class DefaultController extends AbstractController
{
    #[Route(path: '/', methods: ['GET'], name: 'documentation')]
    public function index(): Response
    {
        $content = $this->render('documentation_index.php');

        return new Response($content);
    }
}
