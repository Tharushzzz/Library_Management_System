<?php

// If editing a book, load its data so the form can be prefilled
    $selectedBook = null;
    if (isset($_GET['edit_book'])) {
        $editBookId = $conn->real_escape_string($_GET['edit_book']);
        $editBookResult = $conn->query("SELECT book_id, book_name, category_id FROM book WHERE book_id = '$editBookId' LIMIT 1");
        if ($editBookResult && $editBookResult->num_rows === 1) {
        $selectedBook = $editBookResult->fetch_assoc();
        }
    }


    // Edit book
    if (isset($_POST['edit_book'])) {
        $editBookId = $_POST['book_id'];
        $editBookName = $_POST['book_name'];
        $editCategoryId = $_POST['book_category'];

        $sql = "UPDATE book SET book_name='$editBookName', category_id='$editCategoryId' WHERE book_id='$editBookId'";
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
                                    title: "Book updated successfully"
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
                                    title: "Error updating book"
                                    });
                                    </script>';
        }
        header("Location: index.php#v-pills-books");
        exit();
    }


?>