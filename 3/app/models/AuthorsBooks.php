<?php
namespace app\models;

/**
 * Class AuthorsBooks
 * @package app\models
 *
 * @author Victor Shirokiy
 */
class AuthorsBooks extends \app\lib\abs\Model {

    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $author_id;

    /**
     * @var integer
     */
    public $book_id;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'authors_books';
    }

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'author_id',
            'book_id',
        ];
    }
}