<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Compositor;
use App\Repository\CompositorRepository;
use App\Repository\PeriodRepository;
use Matrix\Controller\AbstractController;
use Matrix\Foundation\HttpErrorException;
use Matrix\Model\Route;
use Matrix\Http\Request;
use Matrix\Http\JSonResponse;
use Matrix\Validation\Validator;

class CompositorController extends AbstractController
{
    #[Route(path: '/compositors', methods: ['POST'], name: 'compositor_add')]
    public function create(
        Request $request,
        Validator $validator,
        CompositorRepository $compositorRepository,
        PeriodRepository $periodRepository,
    ): JSonResponse {
        /** @var null|Compositor $compositor */
        $compositor = $validator->validatePost($request->getContent(), Compositor::class);

        if (true === $validator->hasErrors()) {
            $content = [
                'errors' => [
                    'message' => "Some fields don't match requirements and can't be processed",
                    'fields' => $validator->getErrors()
                ]
            ];
            return new JSonResponse($this->encoder($content), JSonResponse::HTTP_BAD_REQUEST);
        }

        $periodIds = $periodRepository->matchPeriods($compositor->getPeriods());

        if (empty($periodIds)) {
            $content = [
                'errors' => [
                    'message' => "Relation with period unprocessable",
                    'fields' => [
                        'periods' => "No period exists for : " . implode(', ', $compositor->getPeriods())
                    ]
                ]
            ];
            return new JSonResponse($this->encoder($content), JSonResponse::HTTP_BAD_REQUEST);
        }

        $compositor->setPeriods($periodIds);
        $id = $compositorRepository->addCompositor($compositor);

        if (0 === $id) {
            throw new HttpErrorException("No compositor saved due to an unexpected internal error", JSonResponse::HTTP_INTERNAL);
        }

        return new JSonResponse($this->encoder(['id' => $id]), JSonResponse::HTTP_CREATED);
    }

    #[Route(path: '/compositors', methods: ['GET'], name: 'compositor_all')]
    public function read(
        Request $request,
        CompositorRepository $compositorRepository,
    ): JSonResponse {
        /** @var Compositor[] $compositors */
        $compositors = $compositorRepository->findAllCompositors($request->getQuery());

        $serialized = array_map(function($compositor) {
            return $compositor->serialize(Compositor::READ);
        }, $compositors);

        return new JSonResponse($this->encoder($serialized));
    }

    #[Route(path: '/compositors/{id}', methods: ['GET'], validation: '\d+', name: 'compositor_view')]
    public function readOne(
        CompositorRepository $compositorRepository,
        string $id
    ): JSonResponse {
        /** @var null|Compositor $compositor */
        $compositor = $compositorRepository->findCompositor((int) $id);

        if (null === $compositor) {
            throw new HttpErrorException("No compositor found for identifier '$id'", JSonResponse::HTTP_NOT_FOUND);
        }

        $serialized = $compositor->serialize(Compositor::READ_ONE);

        return new JSonResponse($this->encoder($serialized));
    }

    #[Route(path: '/compositors/{id}', methods: ['PUT'], validation: '\d+', name: 'compositor_edit')]
    public function update(
        Request $request,
        Validator $validator,
        CompositorRepository $compositorRepository,
        string $id,
    ): JSonResponse {
        /** @var null|Compositor $compositor */
        $compositor = $compositorRepository->findCompositor((int) $id);

        if (null === $compositor) {
            throw new HttpErrorException("No compositor found for identifier '$id'", JSonResponse::HTTP_NOT_FOUND);
        }

        $validator->validateUpdate($request->getContent(), $compositor);

        if (true === $validator->hasErrors()) {
            $content = [
                'errors' => [
                    'message' => '',
                    'fields' => $validator->getErrors()
                ]
            ];
            return new JSonResponse($this->encoder($content), JSonResponse::HTTP_BAD_REQUEST);
        }

        /** @var int $updated */
        $updated = $compositorRepository->updateCompositor($compositor);

        if (0 === $updated) {
            throw new HttpErrorException("No compositor updated due to an unexpected internal error", JSonResponse::HTTP_INTERNAL);
        }

        $serialized = $compositor->serialize(Compositor::READ_ONE);

        return new JSonResponse($this->encoder($serialized), JSonResponse::HTTP_CREATED);
    }

    #[Route(path: '/compositors/{id}', methods: ['DELETE'], validation: '\d+', name: 'compositor_delete')]
    public function delete(
        CompositorRepository $compositorRepository,
        string $id,
    ): JSonResponse {
        /** @var null|Compositor $compositor */
        $compositor = $compositorRepository->findCompositor((int) $id);

        if (null === $compositor) {
            throw new HttpErrorException("No compositor found for identifier '$id'", JSonResponse::HTTP_NOT_FOUND);
        }

        $qty = $compositorRepository->deleteCompositor($compositor);
        if (0 === $qty) {
            throw new HttpErrorException("No compositor deleted due to an unexpected internal error", JSonResponse::HTTP_INTERNAL);
        }

        return new JSonResponse('', JSonResponse::HTTP_NO_CONTENT);
    }
}
