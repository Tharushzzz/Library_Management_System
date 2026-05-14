
<?php
  
  include 'db_config.php';
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

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
    $categoryInUseResult = $conn->query("SELECT COUNT(*) AS total FROM book WHERE category_id = '$deleteCategoryId'");
    $categoryInUseRow = $categoryInUseResult ? $categoryInUseResult->fetch_assoc() : ['total' => 0];

    if ((int) $categoryInUseRow['total'] > 0) {
      $_SESSION['alert_type'] = 'danger';
      $_SESSION['alert_message'] = 'This category cannot be deleted because it is currently assigned to one or more books. Please reassign or delete those books first.';
    } else {
      $conn->query("DELETE FROM bookcategory WHERE category_id = '$deleteCategoryId'");
      $_SESSION['alert_type'] = 'success';
      $_SESSION['alert_message'] = 'Category deleted successfully.';
    }

    header("Location: index.php#v-pills-categories");
    exit();
  }

  // Handle book borrow 
  if (isset($_GET['delete_borrow'])) {
    $deleteBorrowID = $conn->real_escape_string($_GET['delete_borrow']);
    $conn->query("DELETE FROM bookborrower WHERE borrow_id = '$deleteBorrowID'");
    header("Location: index.php#v-pills-borrow");
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
                                title: "Book borrow deleted successfully"
                                });
                                </script>';
    exit();
  }
  ?>