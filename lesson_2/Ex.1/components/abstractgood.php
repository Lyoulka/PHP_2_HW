<?
namespace components;

abstract class AbstractGood{
	public $name;
	public $category;
	public $price;
	public $description;
	public $weight;
    public $total;

	public function __construct($name = null, $category = null, $price = null,  $description = null, $weight = null){
   		$this->name = $name;
        $this->category = $category;
        $this->price = $price;
        $this->description = $description;
        $this->weight = $weight;
    }
 	abstract public function getPrice($number);
    
    public function getTotal(){
        return $this->total;
    }
}