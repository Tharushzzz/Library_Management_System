<?php
        session_start();
        include 'db_config.php';

        $Uid = $_POST['uid'];
        $UName = $_POST['uname'];
        $FName = $_POST['fname'];
        $LName = $_POST['lname'];
        $Email = $_POST['email'];
        $Password = md5($_POST['new_password']);

        $UidFristChar = $Uid[0];


        // Check user ID starts with 'U'
        if ($UidFristChar !== 'U') {
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_message'] = 'Registration failed! User ID must start with "U".';
        } else {
            $sql = "INSERT INTO user (user_id, username, first_name, last_name, email, password) VALUES ('$Uid', '$UName', '$FName', '$LName', '$Email', '$Password')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['alert_type'] = 'success';
                $_SESSION['alert_message'] = 'Registration successful! Please login to continue.';
            } else {
                $_SESSION['alert_type'] = 'danger';
                $_SESSION['alert_message'] = 'Error: ' . $conn->error;
            }
        }
        header("Location: login.php");
        exit();
?>
