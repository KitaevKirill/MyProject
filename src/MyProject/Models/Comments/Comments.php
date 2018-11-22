<?php
/**
 * Created by PhpStorm.
 * User: User1
 * Date: 21.10.2018
 * Time: 21:56
 */

namespace MyProject\Models\Comments;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\User;

class Comments extends ActiveRecordEntity
{

    /** @var string */
    protected $userId;

    protected $articleId;

    protected $text;

    protected $createdAt;

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    public function setArticleId(int $articleId)
    {
        $this->articleId = $articleId;
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getArticleId(): int
    {
        return $this->articleId;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return User::getById($this->userId);
    }

    protected static function getTableName(): string
    {
        return 'comments';
    }


    public function addComments(string $text, int $userId, int $articleId)
    {
        if (empty($text)) {
            throw new InvalidArgumentException('Не передан текст комментария');
        }

        $comments = new Comments();

        $comments->setUserId($userId);
        $comments->setArticleId($articleId);
        $comments->setText($text);

        $comments->save();


    }

    public function updateFromArray(array $fields): Comments
    {
        if (empty($fields['text'])) {
            throw new InvalidArgumentException('Не передан текст комментария');
        }


        $this->setText($fields['text']);

        $this->save();

        return $this;
    }


}