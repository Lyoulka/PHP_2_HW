<?
namespace components;

class Physical extends AbstractGood{
    public function getPrice($number) {
        $sum = $this->price * $number;
        $this->total += $sum;
        return $sum;
    }
}