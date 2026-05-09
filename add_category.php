<?php
    include 'db_config.php';


    $categoryId = $_POST['category_id'];
    $categoryName = $_POST['category_name'];
    $modifiedDate = $_POST['category_modified_date'];


    $sql = "INSERT INTO bookcategory (category_id, category_Name, date_modified) VALUES ('$categoryId', '$categoryName', '$modifiedDate')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert_message'] = 'Category added successfully.';
        $_SESSION['alert_type'] = 'success';
    } else {
        $_SESSION['alert_message'] = 'Error adding category.';
        $_SESSION['alert_type'] = 'danger';
    }
    header("Location: index.php#v-pills-categories");
    exit();
?>