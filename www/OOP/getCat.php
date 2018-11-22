<?php
if (empty($_GET)) {
    return 'Ничего не передано!';
}

$catName = $_GET['catName'];
$catColor = $_GET['catColor'];

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

$cat1 = new Cat($catName, $catColor);
?>

<html>
    <head>
        <title>Создание кота</title>
    </head>
    <body>

<?php $cat1->sayHello(); ?>
        <br>
        <a href="/OOP/CatCreation.php">Создать нового кота</a>
        <br>
        <a href="/index.php">Назад</a>
    </body>
</html>
