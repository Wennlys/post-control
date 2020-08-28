<?php

namespace Source\App\Http;

use Source\Models\User;
use Source\Database\Users;
use Source\App\Services\UserService;
use Laminas\Diactoros\Response\JsonResponse;

class UserShowAction
{
    private UserService $service;

    public function __construct()
    {
        $database = new Users();
        $this->service = new UserService($database);
    }

    public function __invoke($r, array $args): JsonResponse
    {
        ['id' => $id] = $args;
        $user = new User();
        $user->setId($id);
        $response = $this->service->show($user);

        return new JsonResponse($response);
    }
}
