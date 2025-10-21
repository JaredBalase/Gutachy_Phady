<?php
session_start();

if (isset($_POST['submit'])) {
    $users = json_decode(file_get_contents('users.json'), true);
    if ($users === null) {
        $users = array();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($users[$email]) && password_verify($password, $users[$email]['password'])) {
        $_SESSION['email'] = $email;
        header("Location: chat.php");
    } else {
        echo "Invalid email or password";
    }
} else {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>

<?php
}
?>
