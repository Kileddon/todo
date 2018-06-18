<html>
  <?php include 'sendtoserver.php'?>
  <head>
    <title>Registration</title>
  </head>
  <body>
    <h2>Registration</h2>
    <form action="register.php" method="post">
      <<?php include ('errors.php');?>
      <label>Login:</label>
        <input type="text" name="login" value="<<?php echo $login?>">
        <br>
      <label>Password:</label>
        <input type="text" name="password" value="<?php echo $password?>">
        <br>
      <button type="submit" name="reg_user">Register</button>
    </form>
  </body>
</html>
