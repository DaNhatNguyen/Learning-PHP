<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include("session01_01.php");
        echo("<p>tao la nhat</p>");
        $p = "nguyen da nhat";
        echo("<b>$p</b>");
        $q = &$p;
        $q = "da nhat";
        echo("<br>$p");
        include_once("session01_02.php");
    ?>
</body>
</html>