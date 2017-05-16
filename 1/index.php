<?php
$array = [
    'h',
    'e',
    'l',
    'l',
    'o'
];


function var1(array $array)
{
    return str_split(strrev(implode('', $array)));
}

function var2(array $array)
{
    $c = count($array);

    for($i = $c; $i > 0; $i--) {
        array_push($array, $array[$i-1]);
    }

    array_splice($array, 0, $c);

    return $array;
}

function var3(array $array)
{
    $c = count($array);

    for($i = $c; $i > 0; $i--) {
        array_push($array, $array[$i-1]);
        unset($array[$i-1]);
    }

    return $array;
}

function var4(array $array)
{
    $arr = [];
    $stack = new SplStack();

    $c = count($array);

    for ($i = 0; $i < $c; $i++) {
        $stack->add($i, $array[$i]);
    }

    while(!$stack->isEmpty()) {
        $arr[] = $stack->pop();
    }

    return $arr;
}

$variants[] = var1($array);
$variants[] = var2($array);
$variants[] = var3($array);
$variants[] = var4($array);

foreach ($variants as $variant) {
    echo "<pre>";
    print_r($variant);
    echo "</pre>";
}