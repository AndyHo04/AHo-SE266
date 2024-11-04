<?php

    session_start();

    include '../includes/header.php';
    include 'models/model_teams.php';

    $teams = getTeams();

    $teamName = '';
    $teamConference = '';
    $teamDivision = '';

    if(isset($_POST['searchTeams'])){
        $teamName = filter_input(INPUT_POST,'name');
        $teamConference = filter_input(INPUT_POST,'conference');
        $teamDivision = filter_input(INPUT_POST,'division');
        
        $teams = searchTeams($teamName, $teamConference, $teamDivision);
    }

?>

<div class="container">

<div class="wrapper">
    <?php if(isset($_SESSION['isLoggedIn'])): ?>
    <h1>Welcome <?= $_SESSION['username']; ?></h1>
    <a href="logoff.php">Log Out</a>
    <?php else: ?>
    <a href="login.php">Log In</a>
    <?php endif; ?>
</div>
    
    <div class="col-sm-12">
        <h1>NHL Teams</h1>

        <form method="POST" name="searchTeams">
	  <div class="wrapper" style="display: flex; align-items: center;padding: 2rem 0; margin: 2rem 0; justify-content: space-evenly; background-color: aliceblue; border-radius: 2rem;">
          <div class="form-group">
              <div class="label">
                  <label for="teamName" style="color: black;">Team Name:</label>
              </div>
              <div>
                  <input type="text" id="teamName" name="name" class="form-control" />
              </div>
          </div>
          <div class="form-group">
              <div class="label">
                  <label for="teamConference" style="color: black;">Conference:</label>
              </div>
              <div>
                  <input type="text" id="teamConference" name="conference" class="form-control" />
              </div>
          </div>
          <div class="form-group">
              <div class="label">
                  <label for="teamDivision" style="color: black;">Division:</label>
              </div>
              <div>
                  <input type="text" id="teamDivision" name="division" class="form-control" />
              </div>
          </div>
          <div>
              &nbsp;
          </div>
          <div>
              <input class="btn btn-info" type="submit" name="searchTeams" value="Search" style="margin-top: 0.5rem;"/>
          </div>  

      </div>
  </form>

        <a href="manageTeams.php?action=Add">Add New Team</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Team</th>
                    <th>Conference</th>
                    <th>Division</th>
                    <th>Points</th>
                    <th>ADMIN</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $teams as $team ): ?>
                    <tr>
                        <td><?= $team['id']; ?></td>
                        <td><?= $team['teamName']; ?></td>
                        <td><?= $team['teamConference']; ?></td>
                        <td><?= $team['teamDivision']; ?></td>
                        <td><?= $team['teamPoints']; ?></td>
                        <td><a href='manageTeams.php?action=Edit&id=<?= $team['id']; ?>'>Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>







<?php include '../includes/footer.php'; ?>