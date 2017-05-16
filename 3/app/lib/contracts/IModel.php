<?php
namespace app\lib\contracts;

/**
 * Interface IModel
 * @package app\lib\contracts
 *
 * @author Victor Shirokiy
 */
interface IModel {

    /**
     * @return boolean
     */
    public function update();

    /**
     * @return boolean
     */
    public function save();

    /**
     * @return boolean
     */
    public function delete();

    /**
     * @param integer $id
     * @return static
     */
    public static function find($id);

    /**
     * @param array $attributes
     * @return static[]
     */
    public static function findAll($attributes = []);
}