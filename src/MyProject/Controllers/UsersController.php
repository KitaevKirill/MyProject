<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 05.10.2018
 * Time: 20:00
 */

namespace MyProject\Controllers;

use MyProject\Models\Users\User;
use MyProject\Models\Users\UserActivationService;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Services\EmailSender;
use MyProject\Exceptions\ActivateException;
use MyProject\Services\UsersAuthService;

class UsersController extends AbstractController

{
    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);

                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);

                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
        }
        $this->view->renderHtml('users/signUp.php');
    }

    public function activate(int $userId, string $activationCode)
    {

        $user = User::getById($userId);

        try {
            if ($user === null) {
                throw new ActivateException('Нет такого пользователя');
            }
            if ($user->getIsConfirmed() == 1) {
                throw new ActivateException('Пользователь уже активирован');
            }

            if (!UserActivationService::existCode($userId)) {
                throw new ActivateException('Не создан код активации');
            }
            $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);
            if ($isCodeValid) {
                $user->activate();
                UserActivationService::deleteActivationCode($userId);
                echo 'OK!';
            } else {
                echo 'Код активации не верен';
            }
        } catch (ActivateException $e) {
            $this->view->renderHtml('errors/noId.php', ['error' => $e->getMessage()]);
            return;
        }

    }


    public function login()
    {
        if (!empty($_POST)) {
            try {
                $user = User::login($_POST);
                UsersAuthService::createToken($user);
                header('Location: /');
                exit();
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
                return;
            }
        }
        $this->view->renderHtml('users/login.php');
    }

    public function logOut()
    {
        setcookie('token', '', -1, '/', '', false, true);
        header('Location: /');
    }
}

