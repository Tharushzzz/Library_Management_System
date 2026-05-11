<?php
    include 'db_config.php';
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    $fineId = isset($_POST['fine_id']) ? trim($_POST['fine_id']) : '';
    $bookId = isset($_POST['book_id']) ? trim($_POST['book_id']) : '';
    $memberId = isset($_POST['member_id']) ? trim($_POST['member_id']) : '';
    $amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
    $fineDate = isset($_POST['fine_date']) ? trim($_POST['fine_date']) : '';

    // Server-side validation: amount must be numeric and between 2 and 500, max 2 decimals
    if (!is_numeric($amount)) {
        $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Invalid amount"});</script>';
        header("Location: index.php#v-pills-fine");
        exit();
    }
    $amountVal = round((float)$amount, 2);
    if ($amountVal < 2 || $amountVal > 500) {
        $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Amount must be between 2 and 500"});</script>';
        header("Location: index.php#v-pills-fine");
        exit();
    }
    // format to 2 decimal places
    $amount = number_format($amountVal, 2, '.', '');

    if (isset($_POST['edit_fine'])) {
        // Update existing fine
        if ($stmt = $conn->prepare('UPDATE fine SET book_id = ?, member_id = ?, fine_amount = ?, fine_date_modified = ? WHERE fine_id = ?')) {
            $stmt->bind_param('sssss', $bookId, $memberId, $amount, $fineDate, $fineId);
            if ($stmt->execute()) {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "success",title: "Fine updated successfully"});</script>';
            } else {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Fine update failed"});</script>';
            }
            $stmt->close();
        }
    } else {
        // Insert new fine
        if ($stmt = $conn->prepare('INSERT INTO fine (fine_id, book_id, member_id, fine_amount, fine_date_modified) VALUES (?, ?, ?, ?, ?)')) {
            $stmt->bind_param('sssss', $fineId, $bookId, $memberId, $amount, $fineDate);
            if ($stmt->execute()) {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "success",title: "Fine added successfully"});</script>';
            } else {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Error adding fine"});</script>';
            }
            $stmt->close();
        }
    }
    header("Location: index.php#v-pills-fine");
    exit();
?>