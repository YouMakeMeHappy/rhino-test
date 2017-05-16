<?php
namespace app\controllers;

use app\lib\abs\Controller;
use app\models\Book;

/**
 * Class CoAuthorsController
 * @package app\controllers
 *
 * @author Victor Shirokiy
 */
class CoAuthorsController extends Controller {

    const DEFAULT_COAUTHORS_COUNT = 3;

    /**
     * @return void
     */
    public function actionIndex()
    {
        echo $this->getView()->render(
            'coauthors/index',
            [
                'books' => Book::findByCountCoAuthors(
                    self::DEFAULT_COAUTHORS_COUNT
                ),
            ]
        );
    }
}