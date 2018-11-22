<?php

abstract class HumanAbstract {

    private $name;
    private $height;
    private $weight;

    public function __construct(string $name, string $height, string $weight) {
        $this->name = $name;
        $this->height = $height;
        $this->weight = $weight;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getHeight(): string {
        return $this->height;
    }

    public function getWeight(): string {
        return $this->weight;
    }

    abstract public function getGreetings(): string;

    abstract public function getMyNameIs(): string;

    public function introduceYourself(): string {
        return $this->getGreetings() . '! ' . $this->getMyNameIs() . ' ' . $this->getName() . '. Мой рост ' . $this->getHeight() . ' см и мой вес ' . $this->getWeight() . 'кг';
        //return 'Привет! Меня зовут ' . $this->getName() . '. Мой рост ' . $this->getHeight() . ' и мой вес ' . $this->getWeight();
    }

}

class RussianHuman extends HumanAbstract {

    public function getGreetings(): string {
        return "Привет";
    }

    public function getMyNameIs(): string {
        return "Меня зовут";
    }

}

class EnglishHuman extends HumanAbstract {

    public function getGreetings(): string {
        return "Hi";
    }

    public function getMyNameIs(): string {
        return "My name is";
    }

}

$file = fopen(__DIR__ . '/list.txt', 'r');
$lines = file(__DIR__ . '/list.txt');

$i1 = 0;
while (isset($lines[$i1])) {
    $i1 += 4;
    $countOfHuman = $i1 / 4;
}
echo 'всего созданно ' . $countOfHuman . ' людей<br>';
//var_dump($lines);
//$man1 = [];
//$man1[name] = fgets($file);

fclose($file);

$i2 = 1;
$n = 0;
$m = 2;
$l = 3;
$k = 1;
while ($i2 <= $countOfHuman) {
    if (strlen($lines[$k]) > 10) {
        $russianMan[$i2] = new RussianHuman("$lines[$n]", "$lines[$m]", "$lines[$l]");
        echo $russianMan[$i2]->introduceYourself();
        echo '<br>';
    } else {
        $englishMan[$i2] = new EnglishHuman("$lines[$n]", "$lines[$m]", "$lines[$l]");
        echo $englishMan[$i2]->introduceYourself();
        echo '<br>';
    }
    $i2 += 1;
    $n += 4;
    $m += 4;
    $l += 4;
    $k += 4;
}
//$russianMan1 = new RussianHuman("$lines[0]");
//$englishMan1 = new EnglishHuman("Jhon");
//echo $russianMan[2]->introduceYourself();
//echo '<br>';
//echo $englishMan1->introduceYourself();
echo '<hr>';
/*
  $lines = file($filename); //file in to an array
  echo $lines[1];           //line 2
 */
?>


