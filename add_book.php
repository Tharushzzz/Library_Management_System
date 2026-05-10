<?php
    include 'db_config.php';
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }


    $bookId = $_POST['book_id'];
    $bookName = $_POST['book_name'];
    $categoryId = $_POST['book_category'];


    $sql = "INSERT INTO book (book_id, book_name, category_id) VALUES ('$bookId', '$bookName', '$categoryId')";
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
                                title: "Book added successfully"
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
                                title: "Book added failed"
                                });
                                </script>';
    }
    header("Location: index.php#v-pills-books");
    exit();





    // edit book
    $selectedBook = null;
    $selectedCategory = null;

    if (isset($_GET['edit_book'])) {
        $editBookId = $conn->real_escape_string($_GET['edit_book']);
        $editBookResult = $conn->query("SELECT book_id, book_name, category_id FROM book WHERE book_id = '$editBookId' LIMIT 1");
        if ($editBookResult && $editBookResult->num_rows === 1) {
        $selectedBook = $editBookResult->fetch_assoc();
        }
    }

    if (isset($_GET['edit_category'])) {
        $editCategoryId = $conn->real_escape_string($_GET['edit_category']);
        $editCategoryResult = $conn->query("SELECT category_id, category_Name, date_modified FROM bookcategory WHERE category_id = '$editCategoryId' LIMIT 1");
        if ($editCategoryResult && $editCategoryResult->num_rows === 1) {
        $selectedCategory = $editCategoryResult->fetch_assoc();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_book'])) {
        $bookId = $conn->real_escape_string($_POST['book_id']);
        $bookName = $conn->real_escape_string($_POST['book_name']);
        $bookCategory = $conn->real_escape_string($_POST['book_category']);

        $conn->query("UPDATE book SET book_name = '$bookName', category_id = '$bookCategory' WHERE book_id = '$bookId'");
        header("Location: index.php#v-pills-books");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_category'])) {
        $categoryId = $conn->real_escape_string($_POST['category_id']);
        $categoryName = $conn->real_escape_string($_POST['category_name']);
        $categoryModifiedDate = $conn->real_escape_string($_POST['category_modified_date']);

        $conn->query("UPDATE bookcategory SET category_Name = '$categoryName', date_modified = '$categoryModifiedDate' WHERE category_id = '$categoryId'");
        header("Location: index.php#v-pills-categories");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
        $bookId = $conn->real_escape_string($_POST['book_id']);
        $bookName = $conn->real_escape_string($_POST['book_name']);
        $bookCategory = $conn->real_escape_string($_POST['book_category']);

        $conn->query("INSERT INTO book (book_id, book_name, category_id) VALUES ('$bookId', '$bookName', '$bookCategory')");
        header("Location: index.php#v-pills-books");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
        $categoryId = $conn->real_escape_string($_POST['category_id']);
        $categoryName = $conn->real_escape_string($_POST['category_name']);
        $categoryModifiedDate = $conn->real_escape_string($_POST['category_modified_date']);

        $conn->query("INSERT INTO bookcategory (category_id, category_Name, date_modified) VALUES ('$categoryId', '$categoryName', '$categoryModifiedDate')");
        header("Location: index.php#v-pills-categories");
        exit();
    }
?>