<?php 
include 'includes/header.php'; 

include 'functions.php';
?>

<h2>Heads or Tails</h2>

<?php   
    $headsCount = 0;
    $tailsCount = 0;

    for($i = 0; $i<1000; $i++){
        if(headOrTails() == "heads"){
            $headsCount++;
        }
        else{
            $tailsCount++;
        }
    }

    echo "Heads Count: $headsCount <br/>";
    echo "Tails Count: $tailsCount <br/>";

?>


<?php include 'includes/footer.php'; ?>