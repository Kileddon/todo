<html>
  <?php include 'sendtoserver.php'?>
  <head>
    <title>Registration</title>
  </head>
  <body>
    <h2>Registration</h2>
    <form action="register.php" method="post">
      <label>Login:</label>
        <input type="text" name="login">
        <br>
      <label>Password:</label>
        <input type="password" name="password">
        <br>
      <label>email:</label>
          <input type="text" name="email">
          <br>
      <button type="submit" name="reg_user">Register</button>
    </form>
  </body>
</html>
