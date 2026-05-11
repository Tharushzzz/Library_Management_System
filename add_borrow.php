<?php
    include 'db_config.php';
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }


    $borrowId = $_POST['borrow_id'];
    $originalBorrowId = isset($_POST['original_borrow_id']) && $_POST['original_borrow_id'] !== '' ? $_POST['original_borrow_id'] : $borrowId;
    $bookId = $_POST['book_id'];
    $memberId = $_POST['member_id'];
    $borrowStatus = $_POST['borrow_status'];
    $borrowDate = $_POST['borrow_date'];


    if ((isset($_POST['book_action']) && $_POST['book_action'] === 'edit') || isset($_POST['edit_borrow'])) {
        // Update existing book borrow
        if ($stmt = $conn->prepare('UPDATE bookborrower SET book_id = ?, member_id = ?, borrow_status = ?, borrower_date_modified = ? WHERE borrow_id = ?')) {
            $stmt->bind_param('sss', $bookId, $memberId, $borrowStatus, $borrowDate, $originalBorrowId);
            if ($stmt->execute()) {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "success",title: "Book borrow updated successfully"});</script>';
            } else {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Book borrow update failed"});</script>';
            }
            $stmt->close();
        }
    } else {
        // Insert new book
        if ($stmt = $conn->prepare('INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified) VALUES (?, ?, ?, ?, ?)')) {
            $stmt->bind_param('ssssss', $borrowId, $bookId, $memberId, $borrowStatus, $borrowDate);
            if ($stmt->execute()) {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "success",title: "Book borrow added successfully"});</script>';
            } else {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Book borrow added failed"});</script>';
            }
            $stmt->close();
        }
    }
    header("Location: index.php#v-pills-books");
    exit();



    
?>