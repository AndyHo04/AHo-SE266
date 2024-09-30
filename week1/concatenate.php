<?php
    $word1 = "Hello";
    $word2 = "World";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Doug's Site</title>
    </head>
    <body>

    <h1>String Concat</h1>

    <p><?php $word1 . ' ' . $word2; ?></p>

    <p><?php echo $word1 . $word2; ?></p>

    <p><?php echo "$word1 $word2"; ?></p>

    </body>
</html>