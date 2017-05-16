<?php

defined('APP_WEB_PATH') or define('APP_WEB_PATH' , DIRECTORY_SEPARATOR);
defined('APP_PATH') or define('APP_PATH' , __DIR__);
defined('ASSETS_WEB_PATH') or define('ASSETS_WEB_PATH' , DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets');

/**
 * Class App
 *
 * @author Victor Shirokiy
 */

/**
 * @method static \app\lib\components\View view()
 * @method static \app\lib\components\DB db()
 * @method static \app\lib\components\Router router()
 * @method static \app\lib\components\Request request()
 */
class App {

    private static $_container = [];

    public function run($config)
    {
        self::initComponents($config);
    }

    /**
     * @param $component
     *
     * @return \app\lib\abs\Component
     * @throws \Exception
     */
    public static function get($component)
    {
        self::checkAndThrow(
            array_key_exists($component, self::$_container),
            "Component '$component' not initialized"
        );

        return self::$_container[$component];
    }

    public static function initComponents($config)
    {
        foreach ($config as $name => $componentConfig) {
            self::checkAndThrow(
                array_key_exists('class', $componentConfig),
                'Class not set'
            );

            $component = new $componentConfig['class']();
            unset($componentConfig['class']);
            $component = self::configure($component, $componentConfig);
            $component->init();

            self::$_container[$name] = $component;
        }
    }

    public static function configure($object, $config)
    {
        foreach ($config as $name => $value) {
            $object->$name = $value;
        }

        return $object;
    }

    private static function checkAndThrow($exp, $message)
    {
        if (!$exp) {
            throw new \Exception($message);
        }
    }

    public static function __callStatic($component, $properties = [])
    {
        self::checkAndThrow(
            array_key_exists($component, self::$_container),
            "Component '$component' not initialized"
        );

        return self::$_container[$component];
    }
}