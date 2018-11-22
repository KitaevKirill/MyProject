<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 07.11.2018
 * Time: 9:12
 */

namespace MyProject\Controllers;

use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comments;
use MyProject\Models\Users\User;
use MyProject\Exceptions\Forbidden;

class AdminPanelController extends AbstractController
{
    public function adminPanel()
    {
        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для доступа в панель администратора нужно обладать правами администратора');
        }

        $NUMBER_OF_ENTRIES = 3;
        $lastArticleId = Article::getLastId();
        $article = [];
        $i = 1;
        $n = 0;


        while ($i <= $NUMBER_OF_ENTRIES) {

            if (Article::getById($lastArticleId - $n) !== null) {
                $article[$i] = Article::getById($lastArticleId - $n);
                $i++;
                $n++;
            } else {
                $n++;
            }

        }

        $lastCommentId = Comments::getLastId();
        $comment = [];
        $j = 1;
        $m = 0;

        while ($j <= $NUMBER_OF_ENTRIES) {

            if (Comments::getById($lastCommentId - $m) !== null) {
                $comment[$j] = Comments::getById($lastCommentId - $m);
                $j++;
                $m++;
            } else {
                $m++;
            }

        }

        $this->view->renderHtml('adminPanel/adminPanel.php', [
            'article' => $article,
            'comment' => $comment
        ]);

    }

    public function changeTitle()
    {
        if (!empty($_POST)) {
            $file = fopen(__DIR__ . '/../../../templates/siteTitle.php', 'w');
            $cleanedStr = preg_replace('/[^a-zA-Zа-яА-Я0-9 ]/ui', '', $_POST['siteTitle'] );
                fputs($file, $cleanedStr);

            fclose($file);
            header('Location: /adminPanel' );
        }
    }

}