<?php
namespace app\models;

/**
 * Class Author
 * @package app\models
 *
 * @author Victor Shirokiy
 */
class Author extends \app\lib\abs\Model {

    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * Attributes.
     *
     * @return array Attributes list
     */
    public function attributes()
    {
        return [
            'name',
        ];
    }

    /**
     * Find authors by book title.
     *
     * @param string $bookTitle Book title
     *
     * @return self[]
     */
    public static function findByBookTitle($bookTitle)
    {
        $sql = 'SELECT a.id, name FROM ' . self::tableName() . ' a LEFT JOIN ' . AuthorsBooks::tableName() . ' ab';
        $sql .= ' ON a.id = ab.author_id LEFT JOIN ' . Book::tableName() . ' b';
        $sql .= " ON b.id = ab.book_id WHERE LOWER(b.title) = LOWER(:title)";

        return self::findAllSql($sql, ['title' => strtolower($bookTitle)]);
    }

    /**
     * Check if author has book.
     *
     * @return boolean
     */
    public function hasBook()
    {
        return !empty(AuthorsBooks::findAll(['author_id' => $this->id]));
    }
}


