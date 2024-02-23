<?php
session_start(); // démarrage de la session.
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MINEPAT</title>
  
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body  class="hold-transition login-page">

<?php
 // traite les messages d'inscription...
 if (isset($_SESSION['msg']) && $_SESSION['msg']== "exist") {
  unset($_SESSION['msg']);
  $val="Compte existe déja!";
  $val2= "";
  
  if (isset($_SESSION['msg2']) && $_SESSION['msg2']== "activation") {
   unset($_SESSION['msg2']);
   $val2="Le compte n\'est pas activé! veuillez consulter votre boite mail et cliquer sur le lien qui vous a été envoyé,  ou envoyez un mail à l\'adresse suivante : contact@fuesltd.com pour demande d\'activation. "; 
   
  }

   echo '<div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="Modal-small-demo-label" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      
      <div class="modal-body" style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
      
       <h5> '.$val1."<br/> ".$val2.'  </h5>
       
      </div>
      <div class="modal-footer" style="padding-top: 5px;padding-right: 20px;padding-bottom: 5px;padding-left: 20px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
 </div>';
  
    }
   
 if (isset($_SESSION['msg3']) && $_SESSION['msg3']== "activation") {
  unset($_SESSION['msg3']);
  
  echo '<div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="Modal-small-demo-label" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
     
      <div class="modal-body" style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
      
       <h5> Le compte n\'est pas activé! veuillez consulter votre boite mail et cliquer sur le lien qui vous a été envoyé,  ou envoyez un mail à l\'adresse suivante : contact@fuesltd.com pour demande d\'activation.  </h5>
       
      </div>
      <div class="modal-footer" style="padding-top: 5px;padding-right: 20px;padding-bottom: 5px;padding-left: 20px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
 </div>';
 }
 
 if (isset($_SESSION['msg3']) && $_SESSION['msg3']== "mdp") {
  unset($_SESSION['msg3']);
  
  echo '<div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="Modal-small-demo-label" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
     
      <div class="modal-body" style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
      
       <h5> Mot de passe incorrect ! </h5>
       
      </div>
      <div class="modal-footer" style="padding-top: 5px;padding-right: 20px;padding-bottom: 5px;padding-left: 20px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
 </div>';
 }
 
 if (isset($_SESSION['msg3']) && $_SESSION['msg3']== "mdpc") {
  unset($_SESSION['msg3']);
  
  echo '<div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="Modal-small-demo-label" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
     
      <div class="modal-body" style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
      
       <h5> Mot de passe changé : veuillez vous reconnecter pour confirmer cela ! </h5>
       
      </div>
      <div class="modal-footer" style="padding-top: 5px;padding-right: 20px;padding-bottom: 5px;padding-left: 20px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
 </div>';
 }
 
 
 if (isset($_SESSION['msg3']) && $_SESSION['msg3']== "login") {
  unset($_SESSION['msg3']);
  
  echo '<div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="Modal-small-demo-label" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
     
      <div class="modal-body" style="padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px;">
      
       <h5> Identifiant (Mail) incorrect !</h5>
       
      </div>
      <div class="modal-footer" style="padding-top: 5px;padding-right: 20px;padding-bottom: 5px;padding-left: 20px;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
 </div>';
  
  
  
    

  
 }
 
?>

<div class="login-box">
  <div class="login-logo">
    <a href="index.php">
    <img class="img-header" src="new_assets/assets_dashboard/img/logo.png" alt="logo" />
    <b>SIGAMP -94</b>
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Veuillez vous connecter</p>

     <form  method="post" action="connexion.php">
      <div class="form-group has-feedback">
        <input type="text" name="login" class="form-control" placeholder="Identifiant">
        <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Mot de Passe">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Connexion</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">Mot de passe oublié ?</a><br>
    <a href="register.html" class="text-center">Ajouter un utilisateur</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#myModalMessage").modal('show');
    });
</script>

</body>
</html>