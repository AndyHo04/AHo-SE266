<?php
include 'functions.php'; 
include 'includes/header.php'; 

$orderedDivisions = getNhlTeams();

$playerSpotlight = getPlayerSpotlight();

?>

<h1>NHL Faceoff</h1>
<hr>
<?php
if ($playerSpotlight): ?>
    <div class="player-spotlight-section">
        <h2 class="spotlight-title">Player Spotlight</h2>
        <div class="player-spotlight-cards">
            <?php foreach ($playerSpotlight as $player):

                $fullName = isset($player['name']['default']) ? $player['name']['default'] : $player['name'];

                $nameParts = explode(' ', $fullName);
                $firstName = $nameParts[0];
                $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
                ?>
                <div class="player-spotlight-card">
                    <div class="spotlight-card-header">
                        <div class="player-headshot">
                            <img src="<?= $player['headshot']; ?>" alt="<?= $firstName . ' ' . $lastName; ?>'s Headshot">
                        </div>
                        <div class="player-info">
                            <h3 class="player-name">
                                <?= $firstName; ?> <br> <?= $lastName; ?>
                            </h3>
                            <p class="player-position"><?= $player['position']; ?></p>
                            <div class="team-info">
                                <img src="<?= $player['teamLogo']; ?>" alt="<?= $player['teamTriCode']; ?> Team Logo" class="team-logo">
                                <span class="team-name"><?= $player['teamTriCode']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="spotlight-card-body">
                        <p class="player-number"><strong>Number:</strong> <?= $player['sweaterNumber']; ?></p>
                        <a href="https://www.nhl.com/player/<?= $player['playerSlug']; ?>" target="_blank" class="view-profile-btn">View Profile</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <p>No player spotlight data available.</p>
<?php endif; ?>



<h2 class="spotlight-title">NHL Team Standings</h2>

<div class="grid">
    <?php if ($orderedDivisions): ?>
        <?php foreach ($orderedDivisions as $division => $teams): ?>
            <div class="division">
                <h3><?= strtoupper($division); ?></h3>
                <ul>
                <?php foreach ($teams as $team): ?>
                        <li class="<?php echo (strpos($team['name'], 'Boston Bruins') !== false) ? 'highlight-border' : ''; ?>">
                            <a href="team_details.php?teamAbbrev=<?php echo urlencode($team['abbrev']); ?>&teamName=<?php echo urlencode($team['name']); ?>">
                                <span><?php echo htmlspecialchars($team['name']); ?></span>
                                <span>Points: <?php echo htmlspecialchars($team['points']); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Unable to fetch team standings.</p>
    <?php endif; ?>
</div>


</body>
</html>

<?php include 'includes/footer.php'; ?>