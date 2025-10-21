<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

if (isset($_POST['submit'])) {
    $messages = json_decode(file_get_contents('messages.json'), true);
    if ($messages === null) {
        $messages = array();
    }

    $message = $_POST['message'];
    $messages[] = array('email' => $_SESSION['email'], 'message' => $message);
    file_put_contents('messages.json', json_encode($messages));
}

$messages = json_decode(file_get_contents('messages.json'), true);
if ($messages === null) {
    $messages = array();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
</head>
<body>
    <h2>Chat</h2>
    <h2>Messages:</h2>
    <div id="messages">
        <?php foreach ($messages as $msg) { ?>
            <p><?php echo $msg['email'] . ': ' . $msg['message']; ?></p>
        <?php } ?>
    </div>
    <form action="" method="post">
        <input type="text" name="message" required>
        <input type="submit" name="submit" value="Send">
    </form>
    <a href="logout.php">Logout</a>
</body>
</html>
