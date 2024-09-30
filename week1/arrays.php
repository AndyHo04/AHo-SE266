<?php 
include 'includes/header.php'; 


$stuff = array('bird', 'cat', 'dog', 'fish');

$animals = array(
    'bird' => 'A creature that can fly',
    'cat' => 'A creature that can meow',
    'dog' => 'A creature that can bark'
)
?>

<h1>Arrays</h1>
<h2>Indexed Arrays</h2>
<ul>
    <?php foreach($stuff as $s): ?>
        <li><?= $s; ?></li>
    <?php endforeach; ?>
</ul>

<h2>Associative Arrays</h2>
<ul>
    <?php foreach($animals as $animal => $description): ?>
        <li><?= $animal . ': ' . $description; ?></li>
    <?php endforeach; ?>
</ul>

<?php include 'includes/footer.php'; ?>