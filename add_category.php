<?php
    include 'db_config.php';
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    $categoryId = $_POST['category_id'];
    $categoryName = $_POST['category_name'];
    $modifiedDate = $_POST['category_modified_date'];

    if (isset($_POST['edit_category'])) {
        // Update existing category
        if ($stmt = $conn->prepare('UPDATE bookcategory SET category_Name = ?, date_modified = ? WHERE category_id = ?')) {
            $stmt->bind_param('sss', $categoryName, $modifiedDate, $categoryId);
            if ($stmt->execute()) {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "success",title: "Category updated successfully"});</script>';
            } else {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Category update failed"});</script>';
            }
            $stmt->close();
        }
    } else {
        // Insert new category
        if ($stmt = $conn->prepare('INSERT INTO bookcategory (category_id, category_Name, date_modified) VALUES (?, ?, ?)')) {
            $stmt->bind_param('sss', $categoryId, $categoryName, $modifiedDate);
            if ($stmt->execute()) {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "success",title: "Category added successfully"});</script>';
            } else {
                $_SESSION['alert'] = '<script>const Toast = Swal.mixin({toast: true,position: "top-end",showConfirmButton: false,timer: 3000,timerProgressBar: true});Toast.fire({icon: "error",title: "Error adding category"});</script>';
            }
            $stmt->close();
        }
    }
    header("Location: index.php#v-pills-categories");
    exit();
?>