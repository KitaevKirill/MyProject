<?php

namespace MyProject\Services;

use MyProject\Models\Users\User;

class UsersAuthService
{
    public static function createToken(User $user): void
    {
        $token = $user->getId() . ':' . $user->getAuthToken();
        setcookie('token', $token, 0, '/', '', false, true);
    }

    public static function getUserByToken(): ?User
    {
        $token = $_COOKIE['token'] ?? '';
//var_dump($token);
        if (empty($token)) {
            return null;
        }

        [$userId, $authToken] = explode(':', $token, 2);
        //var_dump([$userId, $authToken]);

        $user = User::getById((int)$userId);

        if ($user === null) {
            return null;
        }
        //var_dump($user->getAuthToken());
        //var_dump($authToken);

        if ($user->getAuthToken() !== $authToken) {
            return null;
        }
//var_dump($user);
        return $user;
    }
}