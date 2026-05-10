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


    $sql = "INSERT INTO member (member_id, first_name, last_name, birthday, email) VALUES ('$memberId', '$firstName', '$lastName', '$birthday', '$email')";
    if ($conn->query($sql) === TRUE) {
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
                                title: "Member added successfully"
                                });
                                </script>';
    } else {
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
                                icon: "error",
                                title: "Error adding member"
                                });
                                </script>';
    }

    header("Location: index.php#v-pills-members");
    exit();
?>

    