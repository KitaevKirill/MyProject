<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 27.11.2018
 * Time: 23:16
 */

namespace MyProject\Controllers\Api;

use MyProject\Controllers\AbstractController;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Exceptions\NotFoundException;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;

class ArticlesApiController extends AbstractController
{
    public function view(int $articleId)
    {
        $article = Article::getById($articleId);

        if ($article === null) {
            throw new NotFoundException('Статья не найдена');
        }

        $this->view->displayJson([
            'articles' => [$article]
        ]);
    }

    public function add()
    {
        try {
            $input = $this->getInputData();
            $articleFromRequest = $input['articles'][0];

            if ($articleFromRequest['text'] == null) {
                throw new InvalidArgumentException('Не передан текст статьи');
            }

        } catch (InvalidArgumentException $e) {
            $this->view->displayJson([
                'error' => [$e->getMessage()]
            ]);
            return;
        }
        
        $authorId = $articleFromRequest['author_id'];
        $author = User::getById($authorId);

        $article = Article::createFromArray($articleFromRequest, $author);
        $article->save();

        header('Location: /api/articles/' . $article->getId(), true, 302);
    }
}