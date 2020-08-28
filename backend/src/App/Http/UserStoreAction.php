<?php

namespace Source\App\Http;

use Source\Models\User;
use Source\Database\Users;
use Source\App\Services\UserService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;

class UserStoreAction
{
    private UserService $service;

    public function __construct()
    {
        $dao = new Users();
        $this->service = new UserService($dao);
    }

    public function __invoke(ServerRequestInterface $request): JsonResponse
    {
        [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ] = (array) json_decode((string) $request->getBody());

        $user = new User();

        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);

        $response = $this->service->store($user);

        return new JsonResponse($response);
    }
}
