<?
namespace components;

class Digital extends Physical{
    public function getPrice($number) {
        $sum = parent::getPrice($number)/2;
        $this->total -= $sum;
        return $sum;
    }
}