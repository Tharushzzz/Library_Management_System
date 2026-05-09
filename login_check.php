<?php
    session_start();
    include 'db_config.php';

    //  Logout function
    if (isset($_GET['Logout'])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }

    //  Login Function
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? md5($_POST['password']) : '';

    if (empty($username) || empty($password)) {
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_message'] = 'Please enter both username and password.';
        header("Location: login.php");
        exit();

    } else {
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $_SESSION['Login'] = True;
            $user = $result->fetch_assoc();
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_message'] = 'Invalid username or password. Please try again.';
            header("Location: login.php");
            exit();
        }
    }
?>