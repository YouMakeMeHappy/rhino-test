<?php
namespace app\lib\abs;

/**
 * Class Model
 * @package app\lib\abs
 *
 * @author Victor Shirokiy
 */
abstract class Model implements \app\lib\contracts\IModel
{
    public $attributes = [];

    /**
     * Attributes.
     *
     * @return array
     */
    public abstract function attributes();

    /**
     * Get table name.
     *
     * @return string Table name
     */
    public static function tableName()
    {
        $a = explode('\\', get_called_class());
        return strtolower(end($a)) . 's';
    }

    /**
     * Update method.
     *
     * @return boolean
     */
    public function update()
    {
        if (empty($this->id)) {
            return $this->save();
        }

        $tableName = static::tableName();
        $attributes = static::attributes();

        $params = [];
        $set = [];

        foreach ($attributes as $name) {
            $params[$name] = $this->$name;
            $set[] = $name . '=:' . $name;
        }

        return \App::db()->execute(
            "UPDATE `{$tableName}` SET " . implode(', ', $set) . " WHERE id = :id",
            $params + ['id' => $this->id]
        );
    }

    /**
     * Save method.
     *
     * @return boolean
     */
    public function save()
    {
        if (!empty($this->id)) {
            return $this->update();
        }

        $tableName = static::tableName();
        $attributes = static::attributes();

        $params = [];

        foreach ($attributes as $name) {
            $params[$name] = $this->$name;
        }

        $response =  \App::db()->execute(
            "INSERT INTO `{$tableName}` (`" . implode('`,`', $attributes) . "`) VALUES(:"
            . implode(',:', $attributes) . ")",
            $params
        );

        if ($response) {
            $this->id = \App::db()->getDb()->lastInsertId();
        }

        return $response;
    }

    /**
     * Delete method.
     *
     * @return boolean
     */
    public function delete()
    {
        $tableName = static::tableName();

        return \App::db()->delete(
            "DELETE FROM `{$tableName}`  WHERE id = ?",
            [$this->id]
        );
    }

    /**
     * Find method.
     *
     * @param integer $id PK.
     *
     * @return static
     */
    public static function find($id)
    {
        $tableName = static::tableName();

        $model = \App::db()->fetch(
            "SELECT * FROM `{$tableName}` WHERE id = ?", [$id]
        );

        return current(self::_populate([$model]));
    }

    /**
     * Find all method.
     *
     * @param array $attributes Attributes for filter search.
     *
     * @return static[]
     */
    public static function findAll($attributes = [])
    {
        $where = [];
        $statement = ' ';

        if (!empty($attributes)) {
            foreach ($attributes as $name => $val) {
                $where[] = $name . '= ?';
            }

            $statement .= 'WHERE ' . implode(' AND ', $where);
        }

        $models = \App::db()->fetchAll(
            "SELECT * FROM " . static::tableName() . $statement,
            array_values($attributes)
        );

        return self::_populate($models);
    }

    /**
     * Find all sql method.
     *
     * @param string $sql   Clear sql query string.
     * @param array $params Parameters for query.
     * @param boolean $asArray Return as array?
     *
     * @return mixed|array|static[]
     */
    public static function findAllSql($sql, $params = [], $asArray = false)
    {
        $models = \App::db()->fetchAll(
            $sql,
            $params
        );

        return !$asArray ? self::_populate($models) : $models;
    }

    /**
     * Internal method for populating data to models
     *
     * @param array $data Data models from DB.
     *
     * @return static[]
     */
    private static function _populate(array $data)
    {
        $populatesModel = [];

        foreach ($data as $modelData) {
            $class = get_called_class();
            $obj = new $class();

            foreach ($modelData as $propName => $propValue) {
                $obj->$propName = $propValue;
            }

            $populatesModel[] = $obj;
        }

        return $populatesModel;
    }
}