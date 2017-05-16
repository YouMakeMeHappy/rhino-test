<?php
namespace app\lib\components;

/**
 * Class DB
 * @package app\lib\components
 *
 * @author Victor Shirokiy
 */
class DB extends \app\lib\abs\Component {

    /**
     * @var string
     */
    public $dsn;

    /**
     * @var string
     */
    public $user;

    /**
     * @var string
     */
    public $password;

    /**
     * @var array
     */
    public $options = [];

    /**
     * @var \PDO Pdo entity
     */
    private $_pdo;

    /**
     * @return void
     */
    public function init()
    {
        parent::init();
        $this->_initPDO();
    }

    /**
     * @return \PDO
     */
    public function getDb()
    {
        return $this->_pdo;
    }

    /**
     * @param string $sql Sql query string.
     * @param array $params Params for tokens in statement.
     *
     * @return \PDOStatement
     */
    public function execute($sql, $params = [])
    {
        $statement = $this->_pdo->prepare($sql);
        $statement->execute($params);
        return $statement;
    }

    /**
     * @param string $sql Sql query string.
     * @param array $params Params for tokens in statement.
     *
     * @return boolean
     */
    public function delete($sql, $params = [])
    {
        $statement = $this->_pdo->prepare($sql);
        return $statement->execute($params);
    }

    /**
     * @param string $sql Sql query string.
     * @param array $params Params for tokens in statement.
     *
     * @return array
     */
    public function fetchAll($sql, $params = [])
    {
        return $this->execute($sql, $params)->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $sql Sql query string.
     * @param array $params Params for tokens in statement.
     *
     * @return mixed
     */
    public function fetch($sql, $params = [])
    {
        return $this->execute($sql, $params)->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @throw \PDOException
     *
     * @return void
     */
    private function _initPDO()
    {
        try {
            $this->_pdo = new \PDO($this->dsn, $this->user, $this->password, $this->options);
        } catch(\PDOException $e) {
            /**
             * 1044 - Access denied to database.
             * 1049 - Wrong database name.
             */
            if (in_array($e->getCode(), [1044, 1045, 1049])) {
                echo "Set database name and credentials in 'app/config/config.php'";
                die();
            } else {
                throw $e;
            }
        }
    }
}