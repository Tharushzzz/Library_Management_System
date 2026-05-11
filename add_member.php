<?php

    include 'db_config.php';
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    $memberId = $_POST['member_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $birthday = $_POST['birth_date'];
    $email = $_POST['email'];

    if (isset($_POST['edit_member'])) {
        // Update existing member
        if ($stmt = $conn->prepare('UPDATE member SET first_name = ?, last_name = ?, birthday = ?, email = ? WHERE member_id = ?')) {
            $stmt->bind_param('sssss', $firstName, $lastName, $birthday, $email, $memberId);
            if ($stmt->execute()) {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "success",title: "Member updated successfully"});</script>';
            } else {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Member update failed"});</script>';
            }
            $stmt->close();
        }
    } else {
        // Insert new member
        if ($stmt = $conn->prepare('INSERT INTO member (member_id, first_name, last_name, birthday, email) VALUES (?, ?, ?, ?, ?)')) {
            $stmt->bind_param('sssss', $memberId, $firstName, $lastName, $birthday, $email);
            if ($stmt->execute()) {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "success",title: "Member added successfully"});</script>';
            } else {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Error adding member"});</script>';
            }
            $stmt->close();
        }
    }

    header("Location: index.php#v-pills-Members");
    exit();
?>