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



    
?>