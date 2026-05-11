<?php
    include 'db_config.php';
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }


    $bookId = $_POST['book_id'];
    $originalBookId = isset($_POST['original_book_id']) && $_POST['original_book_id'] !== '' ? $_POST['original_book_id'] : $bookId;
    $bookName = $_POST['book_name'];
    $categoryId = $_POST['book_category'];


    if ((isset($_POST['book_action']) && $_POST['book_action'] === 'edit') || isset($_POST['edit_book'])) {
        // Update existing book
        if ($stmt = $conn->prepare('UPDATE book SET book_name = ?, category_id = ? WHERE book_id = ?')) {
            $stmt->bind_param('sss', $bookName, $categoryId, $originalBookId);
            if ($stmt->execute()) {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "success",title: "Book updated successfully"});</script>';
            } else {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Book update failed"});</script>';
            }
            $stmt->close();
        }
    } else {
        // Insert new book
        if ($stmt = $conn->prepare('INSERT INTO book (book_id, book_name, category_id) VALUES (?, ?, ?)')) {
            $stmt->bind_param('sss', $bookId, $bookName, $categoryId);
            if ($stmt->execute()) {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "success",title: "Book added successfully"});</script>';
            } else {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Book added failed"});</script>';
            }
            $stmt->close();
        }
    }
    header("Location: index.php#v-pills-books");
    exit();



    
?>