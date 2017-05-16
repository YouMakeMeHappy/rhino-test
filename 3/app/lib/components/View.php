<?php

namespace app\lib\components;

use app\lib\abs\Component;

/**
 * Class View
 * @package app\lib\components
 *
 * @author Victor Shirokiy
 */
class View extends Component {

    public $viewPath;
    public $layout = 'layout/main';

    /**
     * @param $path
     * @param array $params
     * @return string View content
     */
    final public function render($path, $params = [])
    {
        return $this->renderLayout(
            $this->_renderView(
                $this->_getViewPath() . $path . '.php',
                $params
            )
        );
    }

    /**
     * @param $content
     * @return string
     */
    protected function renderLayout($content)
    {
        return $this->_renderView(
            $this->_getViewPath() . $this->layout . '.php', ['content' => $content]
        );
    }

    /**
     * @param $viewPath
     * @param array $params
     * @return string
     */
    private function _renderView($viewPath, $params = [])
    {
        ob_start();
        extract($params);

        require_once $viewPath;

        $content = ob_get_contents();
        ob_clean();

        return $content;
    }

    /**
     * @return string
     */
    private function _getViewPath()
    {
        return APP_PATH . DIRECTORY_SEPARATOR
        . 'views' . DIRECTORY_SEPARATOR;
    }
}