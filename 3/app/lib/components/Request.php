<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 5/14/17
 * Time: 00:55
 */

namespace app\lib\components;

use app\lib\abs\Component;

/**
 * Class Request
 * @package app\lib\components
 *
 * @author Victor Shirokiy
 */
class Request extends Component {

    /**
     * @return boolean
     */
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * @return boolean
     */
    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $_GET;
    }

    /**
     * @param string $name Param name.
     * @param mixed $defaultValue
     *
     * @return mixed
     */
    public function getParam($name, $defaultValue = null)
    {
        return !empty($_GET[$name]) ? $_GET[$name] : $defaultValue;
    }

    /**
     * @param string $name Param name.
     * @param mixed $defaultValue
     *
     * @return mixed
     */
    public function post($name, $defaultValue = null)
    {
        return !empty($_POST[$name]) ? $_POST[$name] : $defaultValue;
    }

    /**
     * @return boolean
     */
    public function getIsHomePage()
    {
        return $_SERVER['REQUEST_URI'] === APP_WEB_PATH;
    }

    /**
     * @param boolean $return
     *
     * @return string|void
     */
    public function goBack($return = true)
    {
        $parts = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($parts)) {
            unset($parts[count($parts)-1]);
        }

        $location = implode('/', $parts);

        if ($return) {
            return $location;
        }

        header('Location: ' . $location);
    }
}