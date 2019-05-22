<?php
class DBConnection extends \PDO
{
    const SQL_STATE_SUCCESS = '00000';
    const SQL_STATE_CONSTRAINT_VIOLATION = '23000';

    public function __construct($dsn, $username, $password, array $config = array())
    {
        $options = array();

        if (isset($config['options']) && is_array($config['options'])) {
            $options = $config['options'];
        }

        $options[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_SILENT;

        parent::__construct($dsn, $username, $password, $options);

        if (isset($config['init-sql'])) {

            $sqls = (array)$config['init-sql'];

            foreach ($sqls as $sql) {
                $this->exec($sql);
            }
        }
    }

    public function query($sql /* , ... */)
    {
        $binds = self::flattenArrayData(func_get_args(), 1);

        if ($binds) {
            $stmt = $this->prepare($sql);
            $stmt->execute($binds);

            if ($stmt->errorCode() != self::SQL_STATE_SUCCESS) {
                $this->throwException($stmt->errorInfo(), $sql, $binds);
            }

        } else {
            $stmt = parent::query($sql);
        }

        if ($this->errorCode() != self::SQL_STATE_SUCCESS) {
            $this->throwException($this->errorInfo(), $sql, $binds);
        }


        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        return $stmt;
    }

    public function queryAll($sql /* , ... */)
    {
        $stmt = call_user_func_array(array($this, 'query'), func_get_args());

        return $stmt->fetchAll();
    }

    public function queryOne($sql /* , ... */)
    {
        $stmt = call_user_func_array(array($this, 'query'), func_get_args());
        $data = $stmt->fetchAll();

        return isset($data[0]) ? $data[0] : null;
    }

    public function exec($sql /* , ... */)
    {
        $binds = self::flattenArrayData(func_get_args(), 1);

        if ($binds) {
            $stmt = $this->prepare($sql);
            $stmt->execute($binds);

            if ($stmt->errorCode() != self::SQL_STATE_SUCCESS) {
                $this->throwException($stmt->errorInfo(), $sql, $binds);
            }

            $res = $stmt->rowCount();
        } else {
            $res = parent::exec($sql);
        }

        if ($this->errorCode() != self::SQL_STATE_SUCCESS) {
            $this->throwException($this->errorInfo(), $sql, $binds);
        }

        return $res;
    }

    public function prepare($sql, $options = array())
    {
        $sth = parent::prepare($sql, $options);

        if ($this->errorCode() != self::SQL_STATE_SUCCESS) {
            $this->throwException($this->errorInfo(), $sql, null);
        }

        return $sth;
    }

    protected function throwException($errorInfo, $query, $binds)
    {
        if ($errorInfo[0] == self::SQL_STATE_CONSTRAINT_VIOLATION) {
            throw new ConstraintViolationDbException($errorInfo, $query, $binds);
        }

        throw new DbException($errorInfo, $query, $binds);
    }

    /**
     * Executes a function in a transaction.
     *
     * The function gets passed this Connection instance as an (optional) parameter.
     *
     * If an exception occurs during execution of the function or transaction commit,
     * the transaction is rolled back and the exception re-thrown.
     *
     * @param \Closure $func  The function to execute transactionally.
     * @throws \Exception
     */
    public function transactional(\Closure $func)
    {
        $this->beginTransaction();
        try {
            $func($this);
            $this->commit();
        } catch (\Exception $e) {
            $this->rollback();
            throw $e;
        }
    }

    public function execBatch($strSql)
    {
        $parts = preg_split(
            '/("(?:\\\\.|[^"])*"|\'(?:\\\\.|[^\'])*\'|`(?:\\\\.|[^`])*`|\/\*(?:.*?)\*\/|#[^\n]*$|--[^\n]*$|;)/sm',
            $strSql,
            0,
            PREG_SPLIT_DELIM_CAPTURE
        );
        $sql = '';
        foreach ($parts as $p) {
            if ((strlen($p) > 0 && $p{0} == '#') or substr($p, 0, 2) == '--' or substr($p, 0, 2) == '/*') {
                continue;
            }

            if ($p != ';') {
                $sql .= $p;
                continue;
            }

            if (strlen(trim($sql))) {
                $this->exec($sql);
                $sql = '';
            }
        }

        if (strlen(trim($sql))) {
            $this->exec($sql);
        }

        return true;
    }

    static public function flattenArrayData($binds, $skip = 0, array &$res = array())
    {
        foreach ($binds as $a) {
            if ($skip > 0) {
                $skip--;
                continue;
            }

            if (is_array($a)) {
                $res = array_merge($res, $a);
                continue;
            }

            $res[] = $a;
        }

        return $res;
    }

}

class DbException extends \Exception
{
    private $errorInfo;
    private $query;
    private $binds;

    public function __construct($errorInfo, $query, $binds)
    {
        $this->errorInfo = $errorInfo;
        $this->query = $query;
        $this->binds = (array)$binds;

        $message = sprintf(
            'DB: %s/%s. Query: %s. Binds: %s. %s',
            $errorInfo[2],
            $errorInfo[0],
            $query,
            self::dataToString($binds),
            $errorInfo[1]
        );

        parent::__construct($message, $errorInfo[1]);
    }

    public function getBinds()
    {
        return $this->getBinds();
    }

    public function getQuery()
    {
        return $this->getQuery();
    }

    public static function dataToString($data)
    {
        if (null === $data || is_scalar($data)) {
            return $data;
        }

        if (is_array($data) || $data instanceof \Traversable) {
            $normalized = array();

            foreach ($data as $key => $value) {
                $normalized[$key] = self::dataToString($value);
            }

            return self::toJson($normalized);
        }

        if ($data instanceof \Exception) {
            return sprintf("[exception] (%s: %s)", get_class($data), $data->getMessage());
        }

        if (is_object($data)) {
            return sprintf("[object] (%s: %s)", get_class($data), self::toJson($data));
        }

        if (is_resource($data)) {
            return '[resource]';
        }

        return '[unknown(' . gettype($data) . ')]';
    }

    private static function toJson($data)
    {
        if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
            return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        return json_encode($data);
    }

}

class ConstraintViolationDbException extends DbException
{

}