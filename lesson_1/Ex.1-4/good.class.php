<?
	class Good{
		private $type;
		private $name;
		private $price;
		private $number;
		private $goodQuantity;
		
		function __construct($type, $name, $price, $number, $goodQuantity){
			$this->setType($type);
			$this->setName($name);
			$this->setPrice($price);
			$this->setNumber($number);
			$this->setGoodQuantity($goodQuantity);
		}
		function setType($type){
			$this->type = $type;	
		}
		function setName($name){
			$this->name = $name;	
		}
		function setPrice($price){
			$this->price = $price;	
		}
		function setNumber($number){
			$this->number = $number;	
		}
		protected function getType(){
			return $this->type;
		}
		protected function getName(){
			return $this->name;
		}
		protected function getPrice(){
			return $this->price;
		}
		protected function getNumber(){
			return $this->number;
		}
		protected function setGoodQuantity(){
        	if ($this->number >= 10) {
           	 $goodQuantity = 'Много';
        	} elseif ($this->number > 1 && $this->number < 10) {
           	 $goodQuantity = 'Мало';
        	} elseif ($this->number == 1) {
           	 $goodQuantity = 'Осталась 1 шт.';
        	} else {
        		$goodQuantity = 'Нет в наличии';
        	}
        	$this->goodQuantity = $goodQuantity;
   		}
   		protected function getGoodQuantity(){
			return $this->goodQuantity;
		} 
		function goodCart(){
		echo "<p>".$this->type."</p><br>
			  <h3>".$this->name."</h3><br>
			  <p><b>Цена:</b> ".$this->price." руб.</p>
			  <p>Количество: ".$this->goodQuantity."</p>";
		} 
	}
