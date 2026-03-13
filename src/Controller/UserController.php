<?php

namespace App\Controller;


use http\Env\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class UserController extends BaseController
{
    #[Route('/api/me', name:"app_user_api_me")]
    #[IsGranted("IS_AUTHENTICATED_REMEMBERED")]
    public function apiMe()
    {
        return $this->json($this->getUser(), 200, [], [
            'groups' => ['user:read']
        ]);
    }

}