<?php
    include '../include/header.php';
    include 'functions_patients.php';

    $patients = getAllPatients();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container"> 
                <div class="col-sm-12">
                    <h1>Patients List</h1>
            
                    <a href="managePatients.php">Add New Patient</a>
            
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Marriage Status</th>
                                <th>Date of Birth</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        <?php foreach ($patients as $patients):                 
                        ?>
                            <tr>
                                <td><?= $patients['id']; ?></td>
                                <td><?= $patients['patientFirstName']; ?></td>
                                <td><?= $patients['patientLastName']; ?></td>
                                <td><?= $patients['patientMarried']; ?></td> 
                                <td><?= $patients['patientBirthDate']; ?></td>       
                            </tr>
                           
                        <?php endforeach; ?>
                        </tbody>
                    </table>
            
                    <a href="managePatients.php">Add New Patient</a>
            
                </div>
            </div>
            
            <?php
                include '../include/footer.php';
            ?>
    </div> 
</body>
</html>