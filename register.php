<?php
session_start();

if (isset($_POST['submit'])) {
    $users = json_decode(file_get_contents('users.json'), true);
    if ($users === null) {
        $users = array();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($users[$email])) {
        echo "Email already exists";
    } else {
        $users[$email] = array('password' => password_hash($password, PASSWORD_DEFAULT));
        file_put_contents('users.json', json_encode($users));
        header("Location: login.php");
    }
} else {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="" method="post">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" name="submit" value="Register">
    </form>
</body>
</html>

<?php
}
?>
