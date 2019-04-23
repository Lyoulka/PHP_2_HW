<?
include "engine/autoloader.class.php";	

spl_autoload_register([new engine\Autoloader(), 'loadClass']);
	/*Товар на вес*/
$productWeight = new \components\Weight( "Рис", "Крупы", 53, "Рис краснодарский отборный", 1);
echo "<p>1. {$productWeight->name} (5 кг): {$productWeight->getPrice(5)} руб.</p>
<p>Доход: {$productWeight->getTotal()} руб.</p><hr>";
/*var_dump($productWeight);*/
/*Штучный товар*/
$productPhysical = new \components\Physical("Алиса в стране чудес", "Книги", 1000, "Детская литература", null);
echo "<p>2. {$productPhysical->name} ({$productPhysical->category}) (3 шт): {$productPhysical->getPrice(3)} руб.</p><p>Доход: {$productPhysical->getTotal()} руб.</p><hr>";
/*var_dump($productPhysical);*/


$productDigital = new \components\Digital("Алиса в стране чудес", "Электронные книги", 1000, "Детская литература", null);
echo "<p>3. {$productDigital->name} ({$productDigital->category}) (1 шт): {$productDigital->getPrice(1)} руб.</p><p>Доход: {$productDigital->getTotal()} руб.</p><hr>";
/*var_dump($productDigital);*/

function sum($products){
    $sum = 0;
    foreach ($products as $product) {
        $sum += $product->getTotal();
    }
    return $sum;
}

echo "<p><b>Общий доход:</b> " . sum([$productWeight, $productPhysical, $productDigital]) . " руб.</p>";