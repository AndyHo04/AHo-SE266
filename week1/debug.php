

<?php 
include 'includes/header.php'; 
?>

<h2>Debugging</h2>

<?php
    $truth = "PHP is a great programming language"; 
    var_dump($truth);
?>
</br></br>
<?php
    $arrayTruth = explode(" ", $truth);
    var_dump($arrayTruth);
?>

<?php include 'includes/footer.php'; ?>