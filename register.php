<?php
  include 'db_config.php';

    $Uid = $_POST['uid'];
    $UName = $_POST['uname'];
    $FName = $_POST['fname'];
    $LName = $_POST['lname'];
    $Email = $_POST['email'];
    $Password = $_POST['new_password'];


    $sql = "INSERT INTO user (user_id, username, first_name, last_name, email, password) VALUES ('$Uid', '$UName', '$FName', '$LName', '$Email', '$Password')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>