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
    <h1>Mini Task</h1>

    <?php 
    //the task associative array
    $task = [
        "title" => "Finish doing the laundry",
        "due" => "Friday",
        "assigned_to" => "Josh",
        "mandatory" => true, // newly added value to the array
        "completed" => true //changed to a boolean value
        

    ];
    ?>
    <!--display the tasks on the page-->
    <ul>
      <li>
        <strong>Name: </strong> <?= $task['title']; ?>
      </li>

      <li>
        <strong>Due: </strong> <?= $task['due']; ?>
      </li>

      <li>
         <strong>Assigned to: </strong> <?= $task['assigned_to']; ?>
      </li>

        <li>
            <!--we are checking if the task is mandatory or not-->
            <strong>Mandatory:</strong>
    
            <?php if ($task['mandatory']) : ?>
                <!--if the task is mandatory, we display a checkmark-->
                <span>&#9989;</span>
            <?php else : ?>
                <!--if the task is not mandatory, we display a cross-->
                <span>&#10060;</span>
            <?php endif; ?>

      <li>
          <strong>Status:</strong>
           <!--we are checking if the task is completed or not-->
          <?php if ($task['completed']) : ?>
            <!--if the task is completed, we display a checkmark-->
            <span>&#9989;</span>
          <?php else : ?>
            <!--if the task is not completed, we display a cross-->
            <span>&#10060;</span>
          <?php endif; ?>
      </li>


   

   

    </ul>





</body>
</html>