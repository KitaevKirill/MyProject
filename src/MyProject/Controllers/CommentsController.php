<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 21.10.2018
 * Time: 21:52
 */

namespace MyProject\Controllers;

use MyProject\Models\Comments\Comments;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users;
use MyProject\Exceptions\NotFoundException;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\Forbidden;
use MyProject\Exceptions\UnauthorizedException;
use MyProject\Exceptions\DbException;

class CommentsController extends AbstractController
{

    /** @var Article|null */
    protected $article;

    public function addComments(int $articleId)
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {


                $this->article = Article::getById($articleId);
                Comments::addComments($_POST['text'],
                    $this->user->getId(),
                    $this->article->getId());
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/addComments.php', ['error' => $e->getMessage(), 'article'=>$this->article]);
                return;
            }

            header('Location: /articles/' . $this->article->getId() . '#comment' . Comments::getLastId(), true, 302);
            exit();
        }

    }

    public function edit(int $commentId)
    {
        $comment = Comments::getById($commentId);

        if ($comment === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!$this->user->isAdmin() && $this->user->getId() !== $comment->getUserId()) {
            throw new Forbidden('Для редактирования статьи нужно обладать правами администратора либо быть создателем статьи');
        }

        if (!empty($_POST)) {
            try {
                $comment->updateFromArray($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('articles/editComment.php', ['error' => $e->getMessage(), 'comment' => $comment]);
                return;
            }

            header('Location: /articles/' . $comment->getArticleId() . '#comment' . $commentId, true, 302);
            exit();
        }


        $this->view->renderHtml('articles/editComment.php', ['comment' => $comment]);
    }
}