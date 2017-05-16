<?php
namespace app\lib\contracts;

/**
 * Interface IComponent
 *
 * @package app\lib\contracts
 *
 * @author Victor Shirokiy
 */
interface IComponent {
    /**
     * Method init. Use it for initialize.
     *
     * @return void
     */
    public function init();
}