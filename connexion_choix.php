<?php
session_start(); // démarrage de la session

if (
    $_SESSION['droit_pere'] == '' || !$_SESSION['droit_pere']
) {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIGAMP -94</title>
    <link rel="icon" type="image/png" href="logo/logo.png" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <a href="index.php">
                <img class="img-header" src="new_assets/assets_dashboard/img/logo.png" alt="logo" />
                <b>SIGAMP -94</b>
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Veuillez choisir le rôle avec lequel vous voulez poursuivre</p>

            <form method="POST" action="connexion_choix_traitement.php">

                <div class="row" style="margin-right: 10px; margin-left: 10px;">
                    <?php
                    $roles = explode("#", $_SESSION['droit_pere']);
                    $nbrRoles = count($roles);
                    for ($i = 0; $i < $nbrRoles; $i++) {
                    ?>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="roles" id="role_<?php echo $roles[$i]; ?>" value="<?php echo $roles[$i]; ?>" required>
                                <label class="form-check-label" for="role_<?php echo $roles[$i]; ?>">
                                    <?php echo $roles[$i]; ?>
                                </label>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin-top: 10px;">Connexion</button>
        </div>
        </form>
    </div>
    </div>

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
</body>

</html>