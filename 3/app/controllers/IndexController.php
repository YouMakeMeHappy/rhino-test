<?php

namespace app\controllers;

use app\lib\abs\Controller;

/**
 * Class IndexController
 * @package app\controllers
 *
 * @author Victor Shirokiy
 */
class IndexController extends Controller {

    /**
     * @return void
     */
    public function actionIndex()
    {
        echo $this->getView()->render(
            'index/index'
        );
    }
}