<?php 

include '../includes/header.php'; 
include '../functions.php';

$teamName = '';
$wins = '';
$losses = '';
$ot_losses = '';
$error = '';


if(filter_input(INPUT_POST, 'team_name') != ''){
    $teamName = filter_input(INPUT_POST, 'team_name');
}
else{
    $error .= 'Must enter a valid team name <br/>';
}


if(filter_input(INPUT_POST, 'wins', FILTER_VALIDATE_FLOAT)){
    $wins = filter_input(INPUT_POST, 'wins', FILTER_VALIDATE_FLOAT);
}
else{
    $error .= 'Wins is not a valid number <br/>';
}

if(filter_input(INPUT_POST, 'losses', FILTER_VALIDATE_FLOAT)){
    $losses = filter_input(INPUT_POST, 'losses', FILTER_VALIDATE_FLOAT);
}
else{
    $error .= 'Losses is not a valid number <br/>';
}

if(filter_input(INPUT_POST, 'ot_losses', FILTER_VALIDATE_FLOAT)){
    $ot_losses = filter_input(INPUT_POST, 'ot_losses', FILTER_VALIDATE_FLOAT);
}
else{
    $error .= 'OT Losses is not a valid number <br/>';
}



?>

<h1>NHL Standings App</h1>

<p>In this example, I will be using Hockey standings to calculate a teams total points based on Wins/Losses</p>

<!-- NHL Points Criteria for calculatings NHL Standings -->
<h2>Criteria</h2>
<ul>
    <li>Win = 2 points</li>
    <li>Loss = 0 points</li>
    <li>Overtime Loss = 1 point</li>
</ul>

<hr/>

<!-- NHL Standings Form --> 
<div class="form-wrapper">

    <form name="nhl_standings" method="post">

        <div class="form-control">
            <label for="team_name">Team Name:</label><br/>
            <input type="text" id="team_name" name="team_name" value="<?= $teamName; ?>">
        </div>

        <div class="form-control">
            <label for="wins">Wins:</label><br />
            <input type="text" name="wins" value="<?= $wins; ?>">
        </div>

        <div class="form-control">
            <label for="losses">Losses:</label><br />
            <input type="text" name="losses" value="<?= $losses; ?>">
        </div>

        <div class="form-control">
            <label for="ot_losses">Overtime Losses:</label><br />
            <input type="text" name="ot_losses" value="<?= $ot_losses; ?>">
        </div>

        <div class="form-submit">
            <input type="submit" name="nhl_standings_submit" value="Submit">
        </div>

    </form>

</div>


<div>
<p style="color: red;"><?= $error; ?></p>
<h2>Form Results</h2>
<p>Team Name: <?= $teamName; ?></p>
<p>Wins: <?= $wins; ?></p>
<p>Losses: <?= $losses; ?></p>
<p>OT Losses: <?= $ot_losses; ?></p>
</hr>
<p>Total Points: <?= calcPoints($wins, $ot_losses); ?></p>
</div>

<?php 
function calcPoints($wins, $ot_losses) {
    return ($wins * 2) + $ot_losses;
}

include '../includes/footer.php'; 
?>
