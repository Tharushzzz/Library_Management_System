<?php

    include 'db_config.php';
    
    // Handle update user profile
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
      $userId = $conn->real_escape_string($_POST['user_id']);
      $firstName = $conn->real_escape_string($_POST['first_name']);
      $lastName = $conn->real_escape_string($_POST['last_name']);
      $username = $conn->real_escape_string($_POST['username']);
      $email = $conn->real_escape_string($_POST['email']);
      $password = $conn->real_escape_string($_POST['password']);

      $updateSql = "UPDATE user SET first_name = '$firstName', last_name = '$lastName', username = '$username', email = '$email', password = '$password' WHERE user_id = '$userId'";
      if ($conn->query($updateSql) === TRUE) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        $_SESSION['alert'] = '<script>
                                const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                                });
                                Toast.fire({
                                icon: "success",
                                title: "Profile updated successfully"
                                });
                                </script>';
        exit();
      } else {
        $_SESSION['alert_type'] = 'danger';
        $_SESSION['alert_message'] = 'Error updating profile: ' . $conn->error;
        header("Location: index.php");
        exit();
      }
    }

    // Load logged-in user's profile data for Edit Profile form
    $selectedUser = null;
    if (isset($_SESSION['user_id'])) {
      $currentUserId = $conn->real_escape_string($_SESSION['user_id']);
      $currentUserResult = $conn->query("SELECT user_id, first_name, last_name, username, email, password FROM user WHERE user_id = '$currentUserId' LIMIT 1");
      if ($currentUserResult && $currentUserResult->num_rows === 1) {
        $selectedUser = $currentUserResult->fetch_assoc();
      }
    }

    
    

?>