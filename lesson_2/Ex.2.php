<?
trait myClone {
    private function __clone() {
    }
}
trait myWakeup{
    private function __wakeup() {
    }  
}
trait myMessage{
   public function hello() {
        echo 'Hello, world!';
    }
}
 class someClass {
    protected static $_instance; 
    private function __construct() {        
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;   
        }
        return self::$_instance;
    }
    use myClone;
    use myWakeup;
    use myMessage;       
}
someClass::getInstance()->hello();
