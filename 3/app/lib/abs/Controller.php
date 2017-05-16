<?php

namespace app\lib\abs;

/**
 * Class Controller
 * @package app\lib\abs
 *
 * @author Victor Shirokiy
 */
abstract class Controller extends Component {
    public $defaultAction = 'index';

    /**
     * Get view component.
     *
     * @return \app\lib\components\View
     */
    final public function getView()
    {
        return \App::view();
    }

    /**
     * @param string $path Path to redirect to.
     *
     * return void
     */
    final public function redirect($path)
    {
        header('Location: ' . APP_WEB_PATH . $path);
    }
}