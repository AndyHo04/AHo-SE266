<?php
    include '../include/header.php';
    include 'functions_patients.php';

    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
        header('Location: login.php');
        exit();
    }

    $patients = getAllPatients();

    $firstName = "";
    $lastName = "";
    $marriedStatus = "";

    if(isset($_POST['searchPatients'])){
        $firstName = filter_input(INPUT_POST,'fName');
        $lastName = filter_input(INPUT_POST,'lName');
        $marriedStatus = filter_input(INPUT_POST,'mStatus');

        $patients = searchPatient($firstName, $lastName, $marriedStatus);
    }

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
                <div class="wrapper">
                    <?php if(isset($_SESSION['isLoggedIn'])): ?>
                    <h1>Welcome <?= $_SESSION['username']; ?></h1>
                    <a href="logout.php">Log Out</a>
                    <?php endif; ?>
                </div>
                    <h1>Patients List</h1>
                    <form method="POST" name="searchPatients">
                        <div class="wrapper" style="display: flex; align-items: center;padding: 2rem 0; margin: 2rem 0; justify-content: space-evenly; background-color: aliceblue; border-radius: 2rem;">
                            <div class="form-group">
                                <div class="label">
                                    <label for="firstName" style="color: black;">Patient First Name:</label>
                                </div>
                                <div>
                                    <input type="text" id="firstName" name="fName" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="label">
                                    <label for="lastName" style="color: black;">Last Name:</label>
                                </div>
                                <div>
                                    <input type="text" id="lastName" name="lName" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="label">
                                    <label for="marriedStatus" style="color: black;">Married Status:</label>
                                </div>
                                <div>
                                    <input type="text" id="marriedStatus" name="mStatus" class="form-control" />
                                </div>
                            </div>
                            <div>
                                &nbsp;
                            </div>
                            <div>
                                <input class="btn btn-info" type="submit" name="searchPatients" value="Search" style="margin-top: 0.5rem;"/>
                            </div>  

                        </div>
                    </form>

            
                    <a href="managePatients.php?Action=Add">Add New Patient</a>
            
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
                                <td><a href="managePatients.php?Action=Edit&ID=<?= $patients['id']; ?>">Edit</a></td>     
                            </tr>
                           
                        <?php endforeach; ?>
                        </tbody>
                    </table>
            
                    <a href="managePatients.php">Add New Patient</a>
            
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <?php
                include '../include/footer.php';
            ?>
    </div> 
</body>
</html>