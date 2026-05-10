<?php
    include 'db_config.php';
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }


    $fineId = $_POST['fine_id'];
    $bookId = $_POST['book_id'];
    $memberId = $_POST['member_id'];
    $amount = $_POST['amount'];
    $fineDate = $_POST['fine_date'];


    $sql = "INSERT INTO fine (fine_id, book_id, member_id, fine_amount, fine_date_modified) VALUES ('$fineId', '$bookId', '$memberId', '$amount', '$fineDate')";
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
                                title: "Fine added successfully"
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
                                title: "Error adding fine"
                                });
                                </script>';
    }
    header("Location: index.php#v-pills-fine");
    exit();
?>