<?
class Generators extends Good{
	private $series;
	private $mainCapacity;
	private $reserveCapacity;
	
	function __construct($type, $name, $price, $number, $goodQuantity, $series, $mainCapacity, $reserveCapacity){
		parent::__construct($type, $name, $price, $number, $goodQuantity);
		$this->setSeries($series);
		$this->setMainCapacity($mainCapacity);
		$this->setReserveCapacity($reserveCapacity);
	}
	function setSeries($series){
		$this->series = $series;
	}
	function setMainCapacity($mainCapacity){
		$this->mainCapacity = $mainCapacity;
	}
	function setReserveCapacity($reserveCapacity){
		$this->reserveCapacity = $reserveCapacity;
	}
	function goodCart(){
		parent::goodCart();
		echo "<p><i>Серия:</i> ".$this->series."</p><br>
		<p>Основная мощность: ".$this->mainCapacity." кВт</p>
		<p>Резервная мощность: ".$this->reserveCapacity." кВт</p><hr>";
	}
}
$gen1 = new Generators("Дизельный генератор", "TTD 14TS ST-2", 120000, 0, "", "TSS Standart", 12, 13.2);
$gen1->goodCart();
$gen2 = new Generators("Дизельный генератор", "10 КВТ TTD 14TS STA С АВР", 125000, 6, "", "TSS Standart", 10, 12.5);
$gen2->goodCart();
