<?php

session_start();
include 'functions.php';
if (isset($_SESSION['email_prof']) && isset($_SESSION['code_prof'])) {
    header("Location:indexx.php?page=p_notes");

} else if (isset($_SESSION['email_etudiant'])) {
    header("Location:indexx.php?page=e_notes");
} else if (!empty($_POST['login']) && !empty($_POST['password'])) {
    try
    {
      /*
        $dsn      = getenv('MYSQL_DSN');
        $user     = getenv('MYSQL_USER');
        $password = getenv('MYSQL_PASSWORD');
      */
        //$opppo    = new PDO($dsn, $user, $password);
      $opppo = $conn;
      

    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $email = $_POST['login'];
    $pass  = $_POST['password'];

    $query = $opppo->query("select * from `professeur` where `email_prof` = '$email' ");
    $fetch = $query->fetch();

    $query_etudiant = $opppo->query("select `email_etudiant` from `etudiant` where `email_etudiant` = '$email' ");
    $fetch_etudiant = $query_etudiant->fetch();

    if ($fetch['email_prof']) {
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['email_prof'] = $email;
        $_SESSION['code_prof']  = $fetch['code_prof'];
        $_SESSION['type_user']  = "prof";
        $_SESSION['semestre']   = 'S2';
        $_SESSION['annee']      = '2016';

        header("Location:indexx.php?page=p_notes");
    } else if ($fetch_etudiant['email_etudiant']) {
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['email_etudiant'] = $email;
        $_SESSION['type_user']      = "stud";

        header("Location:indexx.php?page=e_notes");
    } else {
        header('location: index.php');
    }
} else {
    

?>

    <!DOCTYPE html>
    <html>
    <head>
      <link rel="icon" type="image/png" href="app/img/icon.png" />
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Connexion</title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  </head>
  <body class="hold-transition login-page" data-spy="scroll" data-target="#scrollspy">

    <div class="login-box">
      <div class="login-logo">
        <div class="row-fluid user-row">
            <img src="dist/img/logo.png" class="img-responsive" alt="mundiasis"/>
        </div>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session(OK)</p>
        <div id="msg-error">
        </div>
        <form id="form-login" action="index.php" method="POST">
          <div class="form-group has-feedback">
            <input type="text" name="login" class="form-control"  placeholder="Login" required="">
            <span class="fa fa-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password" required="">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
              </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
              <button type="submit" id="btn-login" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
      </div>
  </form>
</div>
<!-- /.login-box-body -->
</div>

</script>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="app/js/functions.js"></script>
</body>
</html>



<?php }?>


