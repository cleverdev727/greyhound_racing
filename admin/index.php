<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign in</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login_form.css">
    <style>
        p {
            text-align: center
        }
    </style>
</head>

<body>
  <div class="main">
    <p class="sign">Sign in</p>
    <form class="form1" action="auth.php" method="post">
      <input class="un " type="text" name="username" placeholder="Username">
      <input class="pass" type="password" password="password" placeholder="Password">
      <a class="submit" href="bet_panel.php">Sign in</a>
      <p class="forgot"><a href="#">Forgot Password?</p> 
    </div>
     
</body>

</html>