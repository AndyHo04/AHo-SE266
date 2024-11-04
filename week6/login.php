<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week6 Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        h1, h2 {
            margin: 20px;
            padding: 0;
        }
        ul {
            display: inline-block;
            text-align: left;
            margin-top: 0;
        }
    </style>
</head>
<?php

include 'loginPatients.php';

session_start();
$_SESSION['isLoggedIn'] = false;
$_SESSION['username'] = '';
$error = '';

if(isset($_POST['login'])){

    $username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_SPECIAL_CHARS);
    
    if(login($username, $password)){
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['username'] = $username;
        header('Location: Search.php');
        exit();
    }
    else{
        $error = "You did not provide a valid username or password";
    }
}
?>

<body>
    <div class="container">         
        <form method="post">
            
            <div class="rowContainer">
                <h2>Login</h3>
                </div>
                    <div class="rowContainer">
                        <div class="col1">User Name:</div>
                        <div class="col2"><input type="text" name="username" value=""></div> 
                    </div>
                    <div class="rowContainer">
                        <div class="col1">Password:</div>
                        <div class="col2"><input type="password" name="password" value=""></div> 
                    </div>
                        <div class="rowContainer">
                        <div class="col1">&nbsp;</div>
                        <div class="col2"><input type="submit" name="login" value="Login" class="btn btn-warning"></div> 
                    </div>
                    <?php
                        if ($error != "") {
                    ?>
                    <div class="error"><?php echo $error; ?></div>
                    <?php
                        }
                    ?>
                    </form>
            
                </div>    
            </div>
         </form>   
    </div>     
</body>
</html>




