<?php 

function dd(mixed $arg)
{
    echo "<pre>";
    var_dump($arg);
    echo "</pre>";
    die();
}


