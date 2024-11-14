<?php
include 'functions.php'; 
include 'includes/header.php';

if (isset($_GET['teamAbbrev'])) {
    $teamName = htmlspecialchars($_GET['teamName']);
    $teamAbbrev = htmlspecialchars($_GET['teamAbbrev']);
    $roster = getTeamRoster($teamAbbrev);
}
?>

<h1>Roster for <?= $teamName; ?></h1>
<a href="index.php" class="back-link">← Back to Team List</a>

<?php if (!empty($roster)): ?>
    <div class="roster-container">
        <?php

        $playerGroups = [
            'Forwards' => $roster['forwards'],
            'Defensemen' => $roster['defensemen'],
            'Goalies' => $roster['goalies'],
        ];

        foreach ($playerGroups as $position => $players): ?>
            <h2 class="spotlight-title"><?= $position; ?></h2>
            <div class="player-group">
                <?php foreach ($players as $player): ?>
                    <div class="player-card">
                        <img src="<?= $player['headshot']; ?>" alt="<?= $player['firstName']['default'] . ' ' . $player['lastName']['default']; ?>" class="roster-headshot" />
                        <div class="player-info">
                            <h3><?= $player['firstName']['default'] . ' ' . $player['lastName']['default']; ?> (<?= $player['sweaterNumber']; ?>)</h3>
                            <p><strong>Position:</strong> <?= $player['positionCode']; ?></p>
                            <p><strong>Shoots:</strong> <?= $player['shootsCatches']; ?></p>
                            <hr>
                            <p><strong>Height:</strong> <?= $player['heightInInches']; ?> inches</p>
                            <p><strong>Weight:</strong> <?= $player['weightInPounds']; ?> lbs</p>
                            <p><strong>Age:</strong> <?= calculateAge($player['birthDate']); ?></p>
                            <hr>
                            <p><strong>Birth Country:</strong> <?= $player['birthCountry'] ?? 'N/A'; ?></p>
                            <p><strong>Birth State:</strong> <?= $player['birthStateProvince']['default'] ?? 'N/A'; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>No roster data available for this team.</p>
<?php endif; ?>

<?php include 'includes/footer.php';?>
