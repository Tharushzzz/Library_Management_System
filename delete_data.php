
<?php
  
  include 'db_config.php';

    // Handle delete user
  if (isset($_GET['delete_user'])) {
    $deleteUserId = $conn->real_escape_string($_GET['delete_user']);
    $conn->query("DELETE FROM user WHERE user_id = '$deleteUserId'");
    header("Location: index.php#v-pills-staff");
    exit();
  }

  // Handle delete book
  if (isset($_GET['delete_book'])) {
    $deleteBookId = $conn->real_escape_string($_GET['delete_book']);
    $conn->query("DELETE FROM book WHERE book_id = '$deleteBookId'");
    header("Location: index.php#v-pills-books");
    exit();
  }

  // Handle delete category
  if (isset($_GET['delete_category'])) {
    $deleteCategoryId = $conn->real_escape_string($_GET['delete_category']);
    $conn->query("DELETE FROM bookcategory WHERE category_id = '$deleteCategoryId'");
    header("Location: index.php#v-pills-categories");
    exit();
  }

  ?>