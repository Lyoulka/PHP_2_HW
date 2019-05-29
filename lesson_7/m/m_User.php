<?php
class M_User {
    protected function connect(){
        $db = new DBConnection('mysql:dbname=geekbrains;host=localhost', 'root', '');
        return $db;
    }
    function auth(){
        $db = $this->connect(); 
        $data = $db->authorization();
    }
	function destroy_user(){
		session_destroy();
		$_SESSION = array();
		header( 'location: index.php');
	}
	function registration(){
        $db = $this->connect(); 
        $result = $db->user_registration();
        return $result;
	}
}