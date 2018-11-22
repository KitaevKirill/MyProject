<?php

print_r($_GET); 

if (empty($_GET)) {
    return 'Ничего не передано!';
}

if (empty($_GET['operation'])) {
    return 'Не передана операция';
}

if ($_GET['x1'] === '' || $_GET['x2'] === '') {
    return 'Не переданы аргументы';
}

/*settype($_GET['x1'], "integer");
settype($_GET['x2'], "integer");
*/
if (!is_numeric($_GET['x1']) || !is_numeric($_GET['x2'])) {
    return 'Это не число';
}

$x1 = $_GET['x1'];
$x2 = $_GET['x2'];

$expression = $x1 . ' ' . $_GET['operation'] . ' ' . $x2 . ' = ';

switch ($_GET['operation']) {
    case '+':
        $result = $x1 + $x2;
        break;
    case '-':
        $result = $x1 - $x2;
        break;
    case 'x':
        $result = $x1 * $x2;
        break;
    case '/':
        $result = $x1 / $x2;
        break;
    default:
        return 'Операция не поддерживается';
}

if ($result == INF){
    return 'Делить на ноль нельзя';
}

return $expression . $result;

