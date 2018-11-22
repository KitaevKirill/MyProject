<?php

class Cat {

    private $name;
    private $color;

    public function __construct(string $name, string $color) {
        $this->name = $name;
        $this->color = $color;
    }

    public function sayHello() {
        echo 'Привет! Меня зовут ' . $this->name . ' и мой цвет ' . $this->color . '!';
    }

    public function setName(string $name) {
        $this->name = $name;
    }
    
    public function setColor(string $color) {
        $this->color = $color;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getColor(): string {
        return $this->color;
    }

}

$cat1 = new Cat('Снежок', 'белый');
$cat2 = new Cat('Барсик', 'рыжий');
?>

<html>
    <head>
        <title>Форма авторизации</title>
    </head>
    <body>
        <?php echo $cat1->getName(); ?>
        <br>
        <?php $cat1->sayHello(); ?>
        <br>
        <?php $cat2->sayHello(); ?>
        <br>
        <a href="/index.php">Назад</a>
    </body>
</html>