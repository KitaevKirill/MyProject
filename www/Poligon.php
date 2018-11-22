<?php

 function camelCaseToUnderscore(string $source): string
{
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
}

var_dump(camelCaseToUnderscore(activRecord));

?>

<html>
    <head>
        <title>
            полигон 
        </title>

    </head>
    <body>

    </body>
</html>