<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>TEXTiFY | Login</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>
<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
            <img src="/bulk/img/lgt.jpeg" alt="Smiley face" height="1266px" width="1600px" style="position:absolute; clear:top; left:-600px; top:-550px;">
            <div style="position:absolute; top:300px;">
            <h3>TEXTiFY  </h3>
          
            <form id="loginForm" class="m-t" role="form" name="loginForm" method="post" action="login-exec.php">
                <div class="form-group">
                    <input class="form-control" type="text" name="login" placeholder="Username">
                </div>
                <div class="form-group">
<input name="password" type="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-success block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register-form.php">Create an account</a>
            </form>
            <p class="m-t"> <small>Textify web app sms framework &copy; 2016 - 2017</small> </p>
        </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../admin/js/jquery-2.1.1.js"></script>
    <script src="../admin/js/bootstrap.min.js"></script>

</body>

