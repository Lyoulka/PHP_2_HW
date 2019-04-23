<?
class OtherVibro extends Good{
	private $mass;
	private $material;
	function __construct($type, $name, $price, $number, $goodQuantity, $mass, $material){
		parent::__construct($type, $name, $price, $number, $goodQuantity);
		$this->setMass($mass);
		$this->setMaterial($material);
	}
	function setMass($mass){
		$this->mass = $mass;
	}
	function setMaterial($material){
		$this->material = $material;
	}
	function goodCart(){
		parent::goodCart();
		echo "<p>Снаряженная масса виброплиты: ".$this->mass." кг</p><br>
		<p>Уплотняемый материал:</p>".$this->material."<hr>";
	}
}
$vibro1 = new OtherVibro("Виброплита", "VS-134", 15000, 1, "", 74, "<ul><li>асфальт, асфальтобетон</li><li>грунты (смешаный грунт, суглинки)</li></ul>");
$vibro1->goodCart();
$vibro2 = new OtherVibro("Виброплита", "VS-244", 62000, 12, "", 90, "<ul><li>асфальт, асфальтобетон</li><li>дробленые скальные породы</li><li>сыпучие материалы (галька, песок и др.)</li></ul>");
$vibro2->goodCart();
