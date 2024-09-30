<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mini task D</title>
    <style>
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
    <h1>Mini Task D - Associative Arrays(Tasks)</h1>

    <?php 
    //the task associative array
    $task = [
        "title" => "Finish doing the laundry",
        "due" => "Friday",
        "assigned_to" => "Josh",
        "completed" => "yes"
    ];
    ?>
    <!--display the task on the page-->
    <ul>
        <?php foreach($task as $key => $value): ?>
            <li><strong><?= ucwords($key); ?></strong>: <?= $value; ?></li>
        <?php endforeach; ?>
    </ul>

</body>
</html>