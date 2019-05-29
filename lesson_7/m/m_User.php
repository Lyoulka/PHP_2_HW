<?php
class M_User {
    protected function connect(){
        $db = new DBConnection('mysql:dbname=geekbrains;host=localhost', 'root', '');
        return $db;
    }
function auth(){
    $login = strip_tags(trim($_POST['login']));
    $password = strip_tags(trim($_POST['pass']));
    $db = $this->connect(); 
    $data = $db->prepare("SELECT `user_id` as id, `user_name` as name, `user_login` as login,  `user_hash_password` as hash, `admin` FROM `users` WHERE `user_login`= ?");
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
	function registration(){
        $username = strip_tags(trim($_POST['username']));
        $login = strip_tags(trim($_POST['login']));
        $password = $this->hashPassword(strip_tags(trim($_POST['password'])));
        $db = $this->connect(); 
        $users = $db->prepare("SELECT * FROM `users` WHERE `user_login`= ?");
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
        $users = $db->prepare("INSERT INTO `users` SET `user_name` = ?, `user_login` = ? , `user_hash_password` = ?, `admin` =?");
        $users->execute([$username, $login, $password, $admin]); 
    	return ($message = "Регистрация прошла успешно!");
	}
}