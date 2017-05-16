<?php
namespace app\helper;

/**
 * Class ArrayHelper
 * @package app\helper
 *
 * @author Victor Shirokiy
 */
class ArrayHelper {

    /**
     * Analogue of array_column. Can search in array of objects.
     *
     * @param array $array Array.
     *
     * @param string $column Column name.
     *
     * @return array Result
     */
    public static function column(array $array, $column)
    {
        return array_map(function($obj) use($column) {
            return is_object($obj) ? $obj->$column : $obj[$column];
        }, $array);
    }
}