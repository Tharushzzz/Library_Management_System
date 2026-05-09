<?php

    include 'db_config.php';
    session_start();
    // Handle update user profile
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
      $userId = $conn->real_escape_string($_POST['user_id']);
      $firstName = $conn->real_escape_string($_POST['first_name']);
      $lastName = $conn->real_escape_string($_POST['last_name']);
      $username = $conn->real_escape_string($_POST['username']);
      $email = $conn->real_escape_string($_POST['email']);
      $password = $conn->real_escape_string($_POST['password']);

      $updateSql = "UPDATE user SET first_name = '$firstName', last_name = '$lastName', username = '$username', email = '$email', password = 'md5($password)' WHERE user_id = '$userId'";
      if ($conn->query($updateSql) === TRUE) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
      } else {
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_message'] = 'Error updating profile: ' . $conn->error;
        header("Location: index.php");
        exit();
      }
?>