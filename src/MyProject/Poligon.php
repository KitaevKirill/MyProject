<?php

namespace MyProject;

use MyProject\Services\Db;

class Poligon
{

    Public function poligon()
    {
        $db = Db::getInstance();
        var_dump($db);
    }


}

?>

<html>
<head>
    <title>
        полигон
    </title>

</head>
<body>
<?= var_dump($db) ?>
</body>
</html>