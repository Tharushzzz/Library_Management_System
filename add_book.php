<?php
    include 'db_config.php';


    $bookId = $_POST['book_id'];
    $bookName = $_POST['book_name'];
    $categoryId = $_POST['book_category'];


    $sql = "INSERT INTO book (book_id, book_name, category_id) VALUES ('$bookId', '$bookName', '$categoryId')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert_message'] = 'Book added successfully.';
        $_SESSION['alert_type'] = 'success';
    } else {
        $_SESSION['alert_message'] = 'Error adding book.';
        $_SESSION['alert_type'] = 'danger';
    }
    header("Location: index.php#v-pills-books");
    exit();
?>