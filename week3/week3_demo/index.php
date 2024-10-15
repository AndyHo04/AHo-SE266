<?php

include 'student.php';

$person = new Student('Doug', 'Rose', '001195728');
$person2 = new Student('David','Pastrnak', '999999999');

?>

<h1><?= $person->getFirst(); ?></h1>
<h2><?= $person->getFullName(); ?></h2>
<h3><?= $person->getPersonInfo(); ?></h3>

<hr/>

<h1><?= $person2->getFirst(); ?></h1>
<h2><?= $person2->getFullName(); ?></h2>