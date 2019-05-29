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
    public function delete_good($table, $goods_id, $user_login){
        $sql = "DELETE FROM `{$table}` WHERE `goods_id`={$goods_id} AND `user_login`='{$user_login}'";
        $result = $this->exec($sql);
        return $result;
    }
    public function update_good($table, $count, $goods_id, $user_login){
        $sql = "UPDATE `{$table}` SET `numbers`='{$count}' WHERE `goods_id`= {$goods_id} AND `user_login`='{$user_login}'";
        $result = $this->exec($sql);
        return $result;
    }
    public function select_good($table, $goods_id, $user_login){
        $sql = "SELECT * FROM `{$table}` WHERE `goods_id`={$goods_id} AND `user_login`='{$user_login}'";
        $result = $this->queryOne($sql);
        return $result;
    }
    public function select_basket($table, $user_login){
        $sql = "SELECT * FROM `{$table}` WHERE `user_login`='{$user_login}'";
        $result = $this->queryAll($sql);
        return $result;
    }
    public function select_order($table, $user_login){
        $sql = "SELECT * FROM `{$table}` where user_login='{$user_login}' ORDER BY `date` DESC";
        $result = $this->queryAll($sql);
        return $result; 
    }
    public function select_order_admin($table){
        $sql = "SELECT * FROM `{$table}` ORDER BY `date` DESC";
        $result = $this->queryAll($sql);
        return $result; 
    }
    public function new_one_order($goodsTemp, $user_login){
        $user_id = $_SESSION["user_id"];
        $user_name = $_POST["name"];
        $user_surname = $_POST["surname"];
        $user_city = $_POST["city"];
        $user_adress = $_POST["adress"];
        $order_status = "Ожидает подтверждения";
        foreach ($goodsTemp as $good) {
        $sql = "INSERT INTO `orders` (`user_id`, `user_login`, `user_name`, `user_surname`, `user_city`, `user_adress`, `goods_id`, `goods_name`, `numbers`, `goods_price`, `order_status`, `date`) VALUES (\"{$user_id}\",\"{$user_login}\",\"{$user_name}\",\"{$user_surname}\",\"{$user_city}\",\"{$user_adress}\",\"{$good['goods_id']}\",\"{$good['goods_name']}\", {$good['numbers']}, {$good['goods_price']},\"{$order_status}\", NOW())";
        $this->exec($sql);
        }
        unset($_SESSION['basket']);
        $this->delete_all('temp_orders', $user_login);
    }
    public function select_catalogue($startIndex, $countView){
        $sql = "SELECT * FROM `catalogue` LIMIT {$startIndex}, {$countView}";
        $result = $this->queryAll($sql);
        return $result;
    }
    public function add_new_good(){
        $sql = "INSERT INTO `catalogue` (`goods_name`, `goods_price`, `goods_type`, `goods_description`, `goods_img`) VALUES (\"{$_POST['good_name']}\", \"{$_POST['good_price']}\", \"{$_POST['good_type']}\", \"{$_POST['good_description']}\", \"{$_POST['file']}\")";
        $this->exec($sql);
        $sql = "SELECT * FROM `catalogue` order by `goods_id` DESC LIMIT 1"; 
        $result = $this->queryOne($sql);
        return $result;
    }
    public function add_new_good_in_basket($goods_id, $user_login){
        $sql = "SELECT * FROM `catalogue` WHERE `goods_id`={$goods_id}";
        $good = $this->queryOne($sql);
        $sql = "INSERT INTO `temp_orders` (`goods_id`, `goods_img`, `goods_name`, `goods_price`, `numbers`, `user_login`) VALUES (\"{$good['goods_id']}\",\"{$good['goods_img']}\",\"{$good['goods_name']}\",\"{$good['goods_price']}\",\"1\",\"{$user_login}\")";
        $result = $this->exec($sql);
        return $result;
    }
    public function delete_all($table, $user_login){
        $sql =  "DELETE FROM `{$table}` WHERE `user_login`='{$user_login}'";
        $this->exec($sql);
    }
    public function delete_from_catalogue(){
        $sql =  "DELETE FROM `catalogue` WHERE `goods_id`={$_POST['goods_id']}";
        $this->exec($sql);
    }
    public function apdate_catalogue($variable, $goods_id){
        $sql = "UPDATE `catalogue` SET `goods_{$variable}`='{$value}' WHERE `goods_id` = '{$goods_id}'";
        $this->exec($sql);    
    }
    public function order_delete($value){
        $sql="DELETE FROM `orders` WHERE `user_login`='{$value}' AND `date` ='{$_POST['date']}' ";
        $this->exec($sql);
    }
    public function order_transfer(){
        $sql = "UPDATE `orders` SET `order_status`='Выполнен' WHERE `user_login` = '{$_POST['doneOrder']}' and `date` = '{$_POST['date']}'";
        $this->exec($sql);    
        $sql = "INSERT INTO `done_orders` SELECT * FROM `orders` WHERE `user_login` = '{$_POST['doneOrder']}' and `date` = '{$_POST['date']}'";
        $this->exec($sql);
        $this->order_delete($_POST['doneOrder']);
    }
    public function order_status(){
        $user_login = strip_tags(trim($_POST["changeStatus"]));
        $order_status = $_POST["order_status"];
        $order_date = $_POST["date"];
        $data = $this->prepare("UPDATE `orders` SET `order_status`= ? WHERE `user_login`= ? and `date` = ?");
        $data->execute([$order_status, $user_login, $order_date]);
        return $order_status;
    }
    public function authorization(){
        $login = strip_tags(trim($_POST['login']));
        $password = strip_tags(trim($_POST['pass']));
        $data = $this->prepare("SELECT `user_id` as id, `user_name` as name, `user_login` as login,  `user_hash_password` as hash, `admin` FROM `users` WHERE `user_login`= ?");
        $data->execute([$login]);
        $data = $data->fetch(PDO::FETCH_ASSOC); 
        if ($data) {
            if($this->confirmPassword($data['hash'], $password)){
                $user = $data;
                $_SESSION["auth"] = true;
                $_SESSION["user_id"] = $user['id'];
                $_SESSION["user_name"] = $user['name'];
                $_SESSION["user_login"] = strip_tags(trim($user['login']));
                $_SESSION["password"] = true;
                $_SESSION["admin"] = $user['admin'];
                if ( $_SESSION["admin"] == 0){
                header( 'location: index.php?c=page&act=personal');
                } else {
                header( 'location: index.php?c=page&act=administration');
                } ;          
             }
        }

    }
    public function user_registration(){
        $username = strip_tags(trim($_POST['username']));
        $login = strip_tags(trim($_POST['login']));
        $password = $this->hashPassword(strip_tags(trim($_POST['password'])));
        $users = $this->prepare("SELECT * FROM `users` WHERE `user_login`= ?");
        $users->execute([$login]);
        $users = $users->fetch(PDO::FETCH_ASSOC); 
        if (!empty($users)){
            if (strip_tags(trim($users['user_login'])) == 'admin'){
            return ($message = "Логин админа нельзя зарегистрировать!");
            } else {
                return ($message = "Такой логин уже есть!");
                }
        }
        $admin = 0;
        $users = $this->prepare("INSERT INTO `users` SET `user_name` = ?, `user_login` = ? , `user_hash_password` = ?, `admin` =?");
        $users->execute([$username, $login, $password, $admin]); 
        return ($message = "Регистрация прошла успешно!");
    }
    protected function throwException($errorInfo, $query, $binds)
    {
        if ($errorInfo[0] == self::SQL_STATE_CONSTRAINT_VIOLATION) {
            throw new ConstraintViolationDbException($errorInfo, $query, $binds);
        }

        throw new DbException($errorInfo, $query, $binds);
    }
    protected function confirmPassword($hash, $password){
        return crypt($password, $hash) === $hash;
    }
    protected function hashPassword($password){
        $salt = md5(uniqid('some_prefix', true));
        $salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
        return crypt($password, '$2a$08$' . $salt);
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