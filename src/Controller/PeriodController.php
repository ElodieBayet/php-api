<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Compositor;
use App\Entity\Period;
use App\Repository\CompositorRepository;
use Matrix\Controller\AbstractController;
use Matrix\Foundation\HttpErrorException;
use Matrix\Model\Route;
use Matrix\Http\JSonResponse;
use App\Repository\PeriodRepository;
use Matrix\Http\Request;
use Matrix\Validation\Validator;

class PeriodController extends AbstractController
{
    #[Route(path: '/periods', methods: ['GET'], name: 'period_all')]
    public function read(
        PeriodRepository $periodRepository,
    ): JSonResponse {
        /** @var Period[] $periods */
        $periods = $periodRepository->findAllPeriods();
        
        $serialized = array_map(function($period) {
            return $period->serialize(Period::READ);
        }, $periods);

        return new JSonResponse($this->encoder($serialized));
    }

    #[Route(path: '/periods/{id}', methods: ['GET'], validation: '\d+', name: 'period_view')]
    public function readOne(
        PeriodRepository $periodRepository,
        string $id,
    ): JSonResponse {
        /** @var Period $period */
        $period = $periodRepository->findPeriod((int) $id);
        
        if (null === $period) {
            throw new HttpErrorException("No period found for identifier '$id'", JSonResponse::HTTP_NOT_FOUND);
        }

        $serialized = $period->serialize(Period::READ_ONE);

        return new JSonResponse($this->encoder($serialized));
    }

    #[Route(path: '/periods/{id}', methods: ['PUT'], validation: '\d+', name: 'period_edit')]
    public function update(
        Request $request,
        Validator $validator,
        PeriodRepository $periodRepository,
        string $id,
    ): JSonResponse {
        /** @var Period $period */
        $period = $periodRepository->findPeriod((int) $id);
        
        if (null === $period) {
            throw new HttpErrorException("No period found for identifier '$id'", JSonResponse::HTTP_NOT_FOUND);
        }

        $validator->validateUpdate($request->getContent(), $period);

        if (true === $validator->hasErrors()) {
            $content = [
                'errors' => [
                    'message' => "Some fields don't match requirements and can't be processed",
                    'fields' => $validator->getErrors()
                ]
            ];
            return new JSonResponse($this->encoder($content), JSonResponse::HTTP_BAD_REQUEST);
        }

        /** @var int $updated */
        $updated = $periodRepository->updatePeriod($period);

        if (0 === $updated) {
            throw new HttpErrorException("No period updated due to an unexpected internal error", JSonResponse::HTTP_INTERNAL);
        }

        $serialized = $period->serialize();

        return new JSonResponse($this->encoder($serialized));
    }

    #[Route(path: '/periods/{id}/compositors', methods: ['GET'], validation: '\d+', name: 'period_compositors_view')]
    public function readPeriodAndCompositors(
        PeriodRepository $periodRepository,
        CompositorRepository $compositorRepository,
        string $id,
    ): JSonResponse {
        /** @var Period $period */
        $period = $periodRepository->findPeriod((int) $id);
        
        if (null === $period) {
            throw new HttpErrorException("No period found for identifier '$id'", JSonResponse::HTTP_NOT_FOUND);
        }

        $compositors = $compositorRepository->findCompositorsByPeriod($period);

        $serialized = $period->serialize(Period::READ_ONE);
        $serializedCompositors = array_map(function($compositor) {
            return $compositor->serialize(Compositor::READ_PERIOD);
        }, $compositors);

        $serialized['compositors'] = $serializedCompositors;

        return new JSonResponse($this->encoder($serialized));
    }
}
