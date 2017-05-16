<?php
namespace app\controllers;

use app\lib\abs\Controller;
use app\models\Author;

/**
 * Class AuthorsController
 *
 * @package app\controllers
 *
 * @author Victor Shirokiy
 */
class AuthorsController extends Controller {

    /**
     * @return void
     */
    public function actionIndex()
    {
        if (!empty($bookTitle = \App::request()->getParam('book_title'))) {
            $authors = Author::findByBookTitle($bookTitle);
        } else {
            $authors = Author::findAll();
        }

        echo $this->getView()->render(
            'authors/index', [
                'authors' => $authors,
                'bookTitle' => $bookTitle ?: '',
            ]
        );
    }

    /**
     * @return void
     */
    public function actionCreate()
    {
        $model = new Author();

        if (\App::request()->isPost()) {
            $model->name = \App::request()->post('name');

            if ($model->save()) {
                $this->redirect('authors');
            }
        }

        echo $this->getView()->render(
            'authors/create', [
                'model' => $model,
            ]
        );
    }

    /**
     * @return void
     */
    public function actionUpdate()
    {
        if (empty(\App::request()->getParam('id'))) {
            $this->redirect('authors');
        }

        $model = Author::find(\App::request()->getParam('id'));

        if (\App::request()->isPost()) {
            $model->name = \App::request()->post('name');

            if ($model->update()) {
                $this->redirect('authors');
            }
        }

        echo $this->getView()->render(
            'authors/create', [
                'model' => $model,
            ]
        );
    }

    /**
     * @return void
     */
    public function actionDelete()
    {
        if (empty(\App::request()->getParam('id'))) {
            $this->redirect('authors');
        }

        $model = Author::find(\App::request()->getParam('id'));

        if (!$model->hasBook()) {
            $model->delete();
        }

        $this->redirect('authors');
    }
}