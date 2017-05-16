<?php
namespace app\controllers;

use app\helper\ArrayHelper;
use app\lib\abs\Controller;
use app\models\Author;
use app\models\Book;

/**
 * Class BooksController
 * @package app\controllers
 *
 * @author Victor Shirokiy
 */
class BooksController extends Controller{

    /**
     * @return void
     */
    public function actionIndex()
    {
        if (!empty($authorName = \App::request()->getParam('author_name'))) {
            $books = Book::findByAuthorName($authorName);
        } else {
            $books = Book::findAll();
        }

        echo $this->getView()->render(
            'books/index', [
                'books' => $books,
                'authorName' => $authorName ?: '',
            ]
        );
    }

    /**
     * @return void
     */
    public function actionCreate()
    {
        $model = new Book();

        if (\App::request()->isPost()) {
            $model->title = \App::request()->post('title');
            $model->authorsIds = \App::request()->post('author');

            if ($model->save()) {
                $this->redirect('books');
            }
        }

        echo $this->getView()->render(
            'books/create', [
                'model'   => $model,
                'authors' => Author::findAll(),
            ]
        );
    }

    /**
     * @return void
     */
    public function actionUpdate()
    {
        if (empty(\App::request()->getParam('id'))) {
            $this->redirect('books');
        }

        $model = Book::find(\App::request()->getParam('id'));

        if (\App::request()->isPost()) {
            $model->title = \App::request()->post('title');
            $model->authorsIds = \App::request()->post('author');

            if ($model->update()) {
                $this->redirect('books');
            }
        } else {
            $model->authorsIds = ArrayHelper::column($model->getAuthors(), 'author_id');
        }

        echo $this->getView()->render(
            'books/create', [
                'model'      => $model,
                'authors'    => Author::findAll(),
            ]
        );
    }

    /**
     * @return void
     */
    public function actionDelete()
    {
        if (empty(\App::request()->getParam('id'))) {
            $this->redirect('books');
        }

        Book::find(\App::request()->getParam('id'))->delete();

        $this->redirect('books');
    }
}