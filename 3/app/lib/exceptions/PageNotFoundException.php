<?php
namespace app\lib\exceptions;

/**
 * Class PageNotFoundException
 * @package app\lib\exceptions
 *
 * @author Victor Shirokiy
 */
class PageNotFoundException extends \Exception {
    public $message = 'Page not found';
}