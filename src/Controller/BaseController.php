<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private ValidatorInterface $validator,
    ) {}

    protected function getRequestObject(Request $request, string $className)
    {
        $jsonRequestData = json_encode($request->toArray());
        if ($jsonRequestData === false) {
            throw new BadRequestHttpException('Invalid json');
        }

        $requestObject = $this->serializer->deserialize($jsonRequestData, $className, 'json');
        $this->validate($requestObject);

        return $requestObject;
    }

    protected function validate($object)
    {
        $violations = $this->validator->validate($object);
        if ($violations->count() !== 0) {
            $errorMessages = [];
            foreach ($violations as $violation) {
                if (!isset($errorMessages[$violation->getPropertyPath()])) {
                    $errorMessages[$violation->getPropertyPath()] = $violation->getPropertyPath() . ':';
                }
                $errorMessages[$violation->getPropertyPath()] .= ' ' . $violation->getMessage();
            }

            throw new BadRequestHttpException(
                "Некорректные параметры:\n"
                . implode("\n", $errorMessages)
            );
        }
    }
}
