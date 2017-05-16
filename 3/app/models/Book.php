<?php
namespace app\models;

class Book extends \app\lib\abs\Model {

    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var array
     */
    public $authorsIds = [];

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'title',
        ];
    }

    /**
     * @return boolean
     */
    public function update()
    {
        if (parent::update()) {
            $authors = AuthorsBooks::findAll(['book_id' => $this->id]);

            foreach ($authors as $author) {
                $author->delete();
            }

            foreach ($this->authorsIds as $authorId) {
                $ab = new AuthorsBooks();
                $ab->author_id = $authorId;
                $ab->book_id = $this->id;
                $ab->save();
            }

            return true;
        }

        return false;
    }

    /**
     * @return boolean
     */
    public function save()
    {
        if (parent::save()) {

            foreach ($this->authorsIds as $authorId) {
                $ab = new AuthorsBooks();
                $ab->author_id = $authorId;
                $ab->book_id = $this->id;
                $ab->save();
            }

            return true;
        }

        return false;
    }

    /**
     * @return boolean
     */
    public function delete()
    {
        $ab = AuthorsBooks::findAll(['book_id' => $this->id]);

        foreach ($ab as $model) {
            $model->delete();
        }

        return parent::delete();
    }

    /**
     * @return AuthorsBooks[]
     */
    public function getAuthors()
    {
        return AuthorsBooks::findAll(['book_id' => $this->id]);
    }

    /**
     * @param $authorName
     * @return static[]
     */
    public static function findByAuthorName($authorName)
    {
        $sql = 'SELECT b.id, title FROM ' . self::tableName() . ' b LEFT JOIN ' . AuthorsBooks::tableName() . ' ab';
        $sql .= ' ON b.id = ab.book_id LEFT JOIN ' . Author::tableName() . ' a';
        $sql .= ' ON a.id = ab.author_id WHERE LOWER(a.name) = LOWER(:name)';


        return self::findAllSql($sql, ['name' => $authorName]);
    }

    /**
     * @param $num
     * @return array
     */
    public static function findByCountCoAuthors($num)
    {
        $sql = "SELECT b.title, count(ab.author_id) AS num FROM " . self::tableName() . ' b LEFT JOIN ' . AuthorsBooks::tableName() . ' ab ';
        $sql .= ' ON b.id = ab.book_id GROUP BY b.id HAVING num = :num';

        return self::findAllSql($sql, ['num' => $num], true);
    }
}