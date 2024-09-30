<!DOCTYPE html>
<html>
<head>
    <title>Mini Task C</title>
    <style>
       /*puts the content in the center of the page*/
       body {
           font-family: Arial, sans-serif;
           margin: 20px;
           text-align: center;
       }
       ul {
           display: inline-block;
           text-align: left;
       }
    </style>
</head>
<body>
    <h1>Mini Task C - Animal Array</h1>
    <?php
    // the array of animals
    $animals = ['bird', 'cat', 'dog', 'fish', 'Lion'];

    // display the animals on the page
    echo '<ul>';
    foreach($animals as $animal) {
        echo '<li>' . $animal . '</li>';
    }   
    ?>
</body>
</html>