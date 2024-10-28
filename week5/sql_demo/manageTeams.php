<?php
    include '../includes/header.php';
    include 'model/model_teams.php';

    $error = "";
    $teamName = "";
    $teamConference = "";
    $teamDivision = "";
    $teamPoints = "";

    if (isset($_GET['Action'])) {
        $action = filter_input(INPUT_GET,'Action');
        $id = filter_input(INPUT_GET,'ID');

        $team = getTeam($id);
        
        if($team){
            $teamName = $team['teamName'];
            $teamConference = $team['teamConference'];
            $teamDivision = $team['teamDivision'];
            $teamPoints = $team['teamPoints'];
        }
    }

    if (isset($_POST['name'])) {
        $teamName = filter_input(INPUT_POST, 'name');
        $teamConference = filter_input(INPUT_POST, 'conference');
        $teamDivision = filter_input(INPUT_POST, 'division');
        $teamPoints = filter_input(INPUT_POST, 'points', FILTER_VALIDATE_FLOAT);
        
        if ($teamName == "") $error .= "<li>Please provide team name</li>";
        if ($teamConference == "") $error .= "<li>Please provide team conference</li>";
        if ($teamDivision == "") $error .= "<li>Please provide team division</li>";
        if ($teamPoints == "") $error .= "<li>Please provide team points (#)</li>";
        
        if ($error == ""){

            if(isset($_POST["storeTeam"])){
                addTeam ($teamName, $teamConference, $teamDivision, $teamPoints);
                header('Location: viewTeams.php');
                exit();
            }
            else if(isset($_POST['editTeam'])){
                updateTeam ($id, $teamName, $teamConference, $teamDivision, $teamPoints);
                header('Location: viewTeams.php');
                exit();
            }
            else if(isset($_POST['deleteTeam'])){
                deleteTeam ($id);
                header('Location: viewTeams.php');
                exit();
            }
        }
    }
?>


<div class="container">
    <div class="col-sm-12"> 
        <a class='mar12' href="viewTeams.php">Back to View All Teams</a>
        <h2 class='mar12'><?= $action; ?> NHL Team</h2>
        <form name="teams" method="post">
            <?php
                if ($error != ""):
            ?>      
            <div class="error">
                <p>Please fix the following and resubmit</p>
                <ul style="color: red;">
                    <?php echo $error; ?>
                </ul>
            </div>
            <?php
                endif;
            ?>
            <div class="wrapper">
                <div class="form-group">
                    <div class="label">
                        <label for="teamName" style="color: black;">Team Name:</label>
                    </div>
                    <div>
                        <input type="text" id="teamName" name="name" class="form-control" value="<?= $teamName; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="teamConference" style="color: black;">Conference:</label>
                    </div>
                    <div>
                        <input type="text" id="teamConference" name="conference" class="form-control" value="<?= $teamConference; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="teamDivision" style="color: black;">Division:</label>
                    </div>
                    <div>
                        <input type="text" id="teamDivision" name="division" class="form-control" value="<?= $teamDivision; ?>" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label for="teamPoints" style="color: black;">Points:</label>
                    </div>
                    <div>
                        <input type="text" id="teamPoints" name="points" class="form-control" value="<?= $teamPoints; ?>" />
                    </div>
                </div>
                <div>
                    &nbsp;
                </div>
                <?php if($action == 'Add'): ?>
                <div>
                    <input class="btn btn-success" type="submit" name="storeTeam" value="Add NHL Team Information" />
                </div>  
                <?php else: ?>
                <div>
                    <input class="btn btn-warning" type="submit" name="editTeam" value="Edit NHL Team Information" />
                </div> 
                <br/>
                <div>
                    <input class="btn btn-danger" type="submit" name="deleteTeam" value="Delete NHL Team" />
                </div>   
                <?php endif; ?>

            </div>
        </form>
    </div>
</div>

<?php
    include '../includes/footer.php';
?>