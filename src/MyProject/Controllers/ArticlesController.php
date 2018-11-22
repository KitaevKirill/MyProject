<?php

namespace MyProject\Controllers;

use MyProject\Exceptions\Forbidden;
use MyProject\Models\Articles\Article;
use MyProject\Models\Comments\Comments;
use MyProject\Models\Users\User;
use MyProject\View\View;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Exceptions\InvalidArgumentException;


class ArticlesController extends AbstractController
{

//    /** @var Comments|null */
//    protected $comments;

    public function view(int $articleId)
    {

        $article = Article::getById($articleId);

        $comments = Comments::getByArticleId($articleId);

        $commentsAuthor = [];

        $getLastId = User::getLastId();

        $i = 0;
        while ($i < $getLastId) {
            $i++;
            If (User::getById($i) !== null) {
                $commentsAuthor[$i] = User::getById($i)->getNickname();
            }
        }

        if (isset($e)) {
            $emptyCommentError = $e->getMessage();
        }

        if ($article === null) {
            throw new NotFoundException();
        }

        $avatar = scandir(__DIR__ . '/../../../www/Uploads');
        unset($avatar[0]); unset($avatar[1]);
        $pattern = '~^([0-9]+)avatar.(jpg|png|gif)~';
        foreach ($avatar as &$avatar1) {
            preg_match($pattern, $avatar1, $matches);
            $extensionAv[$matches[1]] = $matches[2];
        }

        preg_match($pattern, $avatar[3], $matches);

        $this->view->renderHtml('articles/view.php', [
            'article' => $article,
            'comments' => $comments,
            'commentsAuthor' => $commentsAuthor,
            'emptyCommentError' => $emptyCommentError,
            'extensionAv' => $extensionAv
        ]);


    }

    public function edit(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для редактирования статьи нужно обладать правами администратора');
        }

        if (!empty($_POST)) {
            try {
                $article->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage(), 'article' => $article]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/edit.php', ['article' => $article]);
    }

    public function create(): void
    {
        $article = new Article;
        $article->setName('Название новой статьи');
        $article->setText('Текст новой статьи');
        $article->setAuthor(1);

        $article->save();
        //var_dump($article);
    }

    public function add(): void
    {

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin()) {
            throw new Forbidden('Для добавления статьи нужно обладать правами администратора');
        }

        if (!empty($_POST)) {
            try {
                $article = Article::createFromArray($_POST, $this->user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
                return;
            }

            header('Location: /articles/' . $article->getId(), true, 302);
            exit();
        }

        $this->view->renderHtml('articles/add.php');
    }

    public function delete(int $articleId): void
    {
        $article = Article::getById($articleId);

        if ($article !== null) {
            $article->delete();
            echo "Статья удалена";
            // var_dump($article);
        } else {
            echo "Статьи с таким id не существует";
        }
    }


}
