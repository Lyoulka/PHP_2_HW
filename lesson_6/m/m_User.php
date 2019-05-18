<?php
include_once 'config/main.php';
include_once 'config/db.php';

class M_User {

    protected function connect(){
        $db = new DBConnection('mysql:dbname=geekbrains;host=localhost', 'root', '');
        return $db;
    }

function auth($login, $password){
    $db = $this->connect(); 
    $data = $db->queryOne("SELECT `user_id` as id, `user_name` as name, `user_login` as login,  `user_hash_password` as hash, `admin` FROM `users` WHERE `user_login`=?", $login);
        if ($data) {
            if($this->confirmPassword($data['hash'], $password)){
                $user = $data;
                $_SESSION["auth"] = true;
                $_SESSION["user_id"] = $user['id'];
                $_SESSION["user_name"] = $user['name'];
                $_SESSION["user_login"] = $user['login'];
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
	protected function confirmPassword($hash, $password){
    	return crypt($password, $hash) === $hash;
	}
	protected function hashPassword($password){
		$salt = md5(uniqid('some_prefix', true));
    	$salt = substr(strtr(base64_encode($salt), '+', '.'), 0, 22);
    	return crypt($password, '$2a$08$' . $salt);
	}
	function destroy_user(){
		session_destroy();
		$_SESSION = array();
		header( 'location: index.php');
	}

	function registration($username, $login, $password){
		$db = $this->connect(); 
		$users = $db->queryAll("SELECT * FROM `users`");
		if (strtolower($login) == 'admin'){
    		return ($message = "Логин админа нельзя зарегистрировать!");
    	}
    	foreach ($users as $user){
    		if ($login == $user['user_login']){
    			return ($message = "Такой логин уже есть!");
    		}
   		 }
    	$admin = 0;
    	$password = $this->hashPassword($password);
    	$db->exec("INSERT INTO `users` (`user_name`, `user_login`, `user_hash_password`, `admin`) VALUES (?,?,?,?)", $username, $login, $password, $admin);
    	return ($message = "Регистрация прошла успешно!");
	}


}