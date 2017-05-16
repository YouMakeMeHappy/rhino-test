<?php

namespace app\lib\components;

use app\lib\abs\Component;
use app\lib\exceptions\PageNotFoundException;

/**
 * Class Router
 * @package app\lib\components
 *
 * @author Victor Shirokiy
 */
class Router extends Component {

    public $defaultController = 'index';

    /**
     * @throws PageNotFoundException
     */
    public function init()
    {
        parent::init();

        $this->resolveRoute(
            $this->getRoute()
        );
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        if (($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false) {
            $route = substr($_SERVER['REQUEST_URI'], 0, $pos);
        } else {
            $route = $_SERVER['REQUEST_URI'];
        }

        return str_replace(APP_WEB_PATH, '', $route);
    }

    /**
     * @param $route
     * @return void
     *
     * @throws PageNotFoundException
     */
    public function resolveRoute($route)
    {
        $params = explode('/', $route);
        $action = null;

        if (!empty($params[0])) {
            $controller = $params[0];
        } else {
            $controller = $this->defaultController;
        }

        $className = '\app\controllers\\' . ucwords($controller) . 'Controller';

        try {
            class_exists($className);
        } catch (\LogicException $e) {
            throw new PageNotFoundException();
        }

        \App::initComponents([
            $controller => [
            'class' => $className,
        ]], []);

        $object = \App::$controller();

        if (!empty($params[1])) {
            if (($pos = strpos($params[1], '?')) !== false) {
                $params[1] = substr($params[1], 0, $pos);
            }

            $action = $params[1];
        } else {
            $action = $object->defaultAction;
        }

        $action = 'action' . ucfirst($action);

        if (!method_exists($object, $action)) {
            throw new PageNotFoundException();
        }

        $object->$action();
    }
}