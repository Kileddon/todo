<html>
  <?php include 'sendtoserver.php'?>
  <head>
    <title>Login</title>
  </head>
  <body>
    <h2>Login</h2>
    <form action="login.php" method="post">
      <label>Login:</label>
        <input type="text" name="login">
        <br>
      <label>Password:</label>
        <input type="text" name="password">
        <br>
      <button type="submit" name="log_user">Login</button>
    </form>
  </body>
</html>
