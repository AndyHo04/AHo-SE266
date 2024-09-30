<?php

$stuff = true;

$stuff = 10;

$stuff = array('bird', 'cat', 'dog', 'fish');

$stuffLength = count($stuff);

$title = "Doug's Awesome PHP Site";

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $title; ?></title>
    </head>
    <body>


    <ul>
        <?php for($i = 0; $i < $stuffLength; $i++){ ?>
            <li><?php echo $stuff[$i]; ?></li>
        <?php } ?>
    </ul>

    <ul>
        <?php foreach($stuff as $s): ?>
            <li><?= $s; ?></li>
        <?php endforeach; ?>
    </ul>


    </body>
</html>    