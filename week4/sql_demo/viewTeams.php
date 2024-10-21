<?php
    include '../includes/header.php';
    include 'model/model_teams.php';

    $teams = getTeams ();
?>

<div class="container">
                
    <div class="col-sm-12">
        <h1>NHL Teams</h1>

        <a href="manageTeams.php">Add New Team</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Team</th>
                    <th>Conference</th>
                    <th>Division</th>
                    <th>Points</th>
                </tr>
            </thead>
            <tbody>
            
            <?php foreach ($teams as $team):                 
            ?>
                <tr>
                    <td><?= $team['id']; ?></td>
                    <td><?= $team['teamName']; ?></td>
                    <td><?= $team['teamConference']; ?></td> 
                    <td><?= $team['teamDivision']; ?></td> 
                    <td><?= $team['teamPoints']; ?></td>       
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <a href="manageTeams.php">Add New Team</a>

    </div>
</div>

<?php
    include '../includes/footer.php';
?>