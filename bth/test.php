<?php
$globalVar = 20; // Biến toàn cục

function myFunction() {
    echo $GLOBALS['globalVar']; // Truy cập biến toàn cục qua $GLOBALS
}

var_dump($GLOBALS);
?>
