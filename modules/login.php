<?php
$displayLoginScreen = true;
if(isset($_POST['username']) && !empty($_POST['username'])) {
    $Homee = new Homee(HOMEE_HOST,HOMEE_ADMIN,HOMEE_PASSWORD);
    $users = $Homee->getUsers();
    $loginError = false;

    foreach($users['users'] as $user) {
        if($_POST['username'] == $user['username']) {
            if($user['access'] == 1) {
                echo '<div class="alert alert-success">Login erfolgreich</div>';
                $_SESSION['username'] = $_POST['username'];
                echo '<meta http-equiv="refresh" content="1; URL=index.php">';
                $loginError = false;
                $displayLoginScreen = false;
                break;
            } else {
                $loginError = true;
            }
        }
        $loginError = true;
    }
    if($loginError) {
        echo '<div class="alert alert-danger"><strong>Fehler! </strong>Login fehlgeschlagen!</div>';
    }
}

if($displayLoginScreen) {
    ?>
    <form action="index.php?module=login" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><b><?php echo APP_NAME; ?> Login</b></div>
                <div class="panel-body">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Homee Username">
                    <br/>
                    <input type="submit" value="Einloggen" class="form-control btn btn-success">
                </div>
            </div>
        </div>
    </form>
    <?php
}
?>