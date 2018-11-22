<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 16.11.2018
 * Time: 1:00
 */

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comments;
use MyProject\Models\Users\User;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Exceptions\DownloadFileException;

class PersonalAreaController extends AbstractController
{
    public function personalArea()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        $this->view->renderHtml('personalArea/personalArea.php', []);
    }

    public function uploadAvatar()
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_FILES['avatar'])) {
            try {
                $file = $_FILES['avatar'];
                $allowedExtensions = ['jpg', 'png', 'gif'];
                $fileSize = $file['size'];
                $limitBytes = 1024 * 1024 * 8;
                $limitWidth = 5000;
                $limitHeight = 4000;
                $image = getimagesize($file['tmp_name']);

                $extension = mb_strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $file['name'] = $this->user->getId() . 'avatar.' . $extension;

                $srcFileName = $file['name'];
                $newFilePath = __DIR__ . '/../../../www/Uploads/' . $srcFileName;

                if (!move_uploaded_file($file['tmp_name'], $newFilePath)) {
                    throw new DownloadFileException('Ошибка при загрузке файла');
                }

                if ($file['error'] !== UPLOAD_ERR_OK) {
                    throw new DownloadFileException('Ошибка при загрузке файла');
                }

                if (!in_array($extension, $allowedExtensions)) {
                    throw new DownloadFileException('Загрузка файлов с таким расширением запрещена');
                }

                if ($fileSize > $limitBytes) {
                    throw new DownloadFileException('Размер файла слишком большой');
                }

                if (($image[1] > $limitHeight || $image[0] > $limitWidth)) {
                    throw new DownloadFileException('Привышенно допустимое разрешение картинки');
                }

            } catch
            (DownloadFileException $e) {
                $this->view->renderHtml('personalArea/personalArea.php', ['error' => $e->getMessage()]);
                return;
            }


            move_uploaded_file($file['tmp_name'], $newFilePath);
            $result = 'http://myproject.loc/www/Uploads/' . $srcFileName;
            $this->view->renderHtml('personalArea/personalArea.php', ['result' => $result]);


        }
    }
}