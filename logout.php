    <form method="post">
    <button type="submit" name="012">Logout</button>
    <?php if (isset($_POST['012'])) {
    setcookie ("token", "", time() - 3600);
    unset($_COOKIE['token']);
    $page = $_SERVER['PHP_SELF'];
    echo '<meta http-equiv="Refresh" content="0;' . $page . '">';
}
?>
