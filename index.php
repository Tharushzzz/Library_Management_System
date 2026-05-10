<?php
  session_start();
  include 'db_config.php';
  include 'updateuser.php';
  include 'delete_data.php';
  include 'edite.php';


  // Check if user is logged in
  if (!isset($_SESSION['Login']) || $_SESSION['Login'] !== True) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
  }
  
  

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </link>
  <script src="https://kit.fontawesome.com/d3c42d7fff.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="stylesheet.css">
  <script src="script.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <title>Library Management System</title>
</head>

<body>
  
  <!-- Nav bar -->
  <div id="menu" class="d-flex align-items-start nav-container">
    


    <!-- mobile view btn -->
    <button id="menu_btn" class="btn btn-primary d-md-none menu_mobile_btn">
      <i class="fas fa-bars" style="color: rgb(230, 232, 232);"></i>
    </button>


    <div class="nav flex-column gap-2 nav-pills me-3 menu_bg_color menu" id="navbar" role="tablist"
      aria-orientation="vertical">

      <button id="menu-close" class="btn d-md-none menu_close_btn">
        <i class="fa-solid fa-xmark" style="color: rgb(255, 255, 255);"></i>
      </button>

      <!-- title -->
      <h3 class="menu_title">Library <br> Management</h3>
      <div class="menu_title_line"></div>

      <!-- menu-items -->
      <button class="nav-link active mt-4 d-flex gap-2 align-items-center menu_btn" id="v-pills-staff-tab"
        data-bs-toggle="pill" data-bs-target="#v-pills-staff" type="button" role="tab" aria-controls="v-pills-staff"
        aria-selected="true">
        <i class="fa-regular fa-user" style="color: rgb(160, 164, 165);"></i>
        Staff Users
      </button>


      <button class="nav-link d-flex gap-2 align-items-center menu_btn" id="v-pills-books-tab" data-bs-toggle="pill"
        data-bs-target="#v-pills-books" type="button" role="tab" aria-controls="v-pills-books" aria-selected="false">
        <i class="fa-solid fa-book-open" style="color: rgb(160, 164, 165);"></i>
        Book
      </button>


      <button class="nav-link d-flex gap-2 align-items-center menu_btn" id="v-pills-categories-tab"
        data-bs-toggle="pill" data-bs-target="#v-pills-categories" type="button" role="tab"
        aria-controls="v-pills-categories" aria-selected="false">
        <i class="fa-solid fa-table-cells-large" style="color: rgb(160, 164, 165);"></i>
        Categories
      </button>


      <button class="nav-link d-flex gap-2 align-items-center menu_btn" id="v-pills-Members-tab" data-bs-toggle="pill"
        data-bs-target="#v-pills-Members" type="button" role="tab" aria-controls="v-pills-Members"
        aria-selected="false">
        <i class="fa-solid fa-user-group" style="color: rgb(160, 164, 165);"></i>
        Members
      </button>


      <button class="nav-link d-flex gap-2 align-items-center menu_btn" id="v-pills-borrow-tab" data-bs-toggle="pill"
        data-bs-target="#v-pills-borrow" type="button" role="tab" aria-controls="v-pills-borrow" aria-selected="false">
        <i class="fa-solid fa-bookmark" style="color: rgb(160, 164, 165);"></i>
        Borrow Details
      </button>

      <button class="nav-link d-flex gap-2 align-items-center menu_btn" id="v-pills-fine-tab" data-bs-toggle="pill"
        data-bs-target="#v-pills-fine" type="button" role="tab" aria-controls="v-pills-fine" aria-selected="false">
        <i class="fa-solid fa-magnifying-glass" style="color: rgb(160, 164, 165);"></i>
        Fine Users
      </button>


      <div class="nav_bottom">
        <p class="welcome d-none d-md-block">Welcome, <spam><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'User'; ?></spam>
        </p>

        <!-- Profile edit -->
        <button class=" btn btn-secondary edit_btn" id="v-pills-edit-tab" data-bs-toggle="pill"
          data-bs-target="#v-pills-edit" type="button" role="tab" aria-controls="v-pills-edit" aria-selected="false">
          <i class="fa-solid fa-user-pen" style="color: rgb(255, 255, 255);"></i>
          Edit Profile
        </button>


        <!-- Logout-btn -->
        <form action="login_check.php" method="get" style="width: 100%; display: flex; justify-content: center;">
          <button type="submit" class="btn btn-danger logout_btn" name="Logout">
            <i class="fa-solid fa-arrow-right-from-bracket" style="color: rgb(255, 255, 255);"></i>
            Logout
          </button>
        </form>
      </div>


    </div>


    <!-- menu-tabs -->
    <div class="tab-content" id="v-pills-tabContent">

      <!-- Staff-Users-tab -->
      <div class="tab-pane fade show active" id="v-pills-staff" role="tabpanel" aria-labelledby="v-pills-staff-tab"
        tabindex="0">
        <div class="staff_users_tab">
          <div class="staff_title">User Management</div>


          <div class="staff_content">
            <div class="staff_content_title_box">
              <div class="staff_content_title">Staff Users</div>
              <div class="staff_content_title_line"></div>
            </div>

            <div class="Staff_tab_head">
              <table class="table staff_table">
                <thead class="">
                  <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql = "SELECT * FROM user";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['user_id']) . "</td>
                                    <td>" . htmlspecialchars($row['first_name']) . "</td>
                                    <td>" . htmlspecialchars($row['last_name']) . "</td>
                                    <td>" . htmlspecialchars($row['username']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>
                                      <a class='btn btn-danger btn-sm' href='index.php?delete_user=" . urlencode($row['user_id']) . "' onclick=\"return confirm('Delete this user?');\">Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users found.</td></tr>";
                    }


                  ?>


                </tbody>
              </table>

            </div>
          </div>

        </div>

      </div>

      <!-- Books-tab -->
      <div class="tab-pane fade" id="v-pills-books" role="tabpanel" aria-labelledby="v-pills-books-tab"
        tabindex="0">
        
        <div class="book_users_tab">
          <div class="book_title_box">
            <span class="book_title">Book Management </span>
            <button class="btn btn-success btn-md book_add_btn" id="book_add_btn" onclick="toggleBookForm('add')">Add Book</button>
          </div>

          <div class="book_content">
            <div class="book_content_title_box">
              <div class="book_content_title">Book Registration</div>
              <div class="book_content_title_line"></div>
          </div>

           <div class="book_tab_head">
              <table class="table book_table">
                <thead class="book_table_head">
                  <tr>
                    <th scope="col">Book ID</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Category ID</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                 <tbody>
                    <?php
                      $sql2 = "SELECT * FROM book";
                      $result2 = $conn->query($sql2);
                      if ($result2->num_rows > 0) {
                          while($row2 = $result2->fetch_assoc()) {
                              echo "<tr>
                                      <td>" . htmlspecialchars($row2['book_id']) . "</td>
                                      <td>" . htmlspecialchars($row2['book_name']) . "</td>
                                      <td>" . htmlspecialchars($row2['category_id']) . "</td>
                                      <td>
                                        <button class='btn btn-primary btn-sm book_edit_btn' onclick=\"toggleBookForm('edit')\">Edit</button>
                                        <a class='btn btn-danger btn-sm' href='index.php?delete_book=" . urlencode($row2['book_id']) . "' onclick=\"return confirm('Delete this book?');\">Delete</a>
                                      </td>
                                    </tr>";
                          }
                      } else {
                          echo "<tr><td colspan='4'>No books found.</td></tr>";
                      }
                    ?>
                
                </tbody>
              </table>

            </div>
          </div>

        </div>

         <!-- Books add form -->
        <div class="book_form" id="book_form">
          <form action="add_book.php" method="POST" class="book_add_form">
            <div class="mb-3">
              <label for="book_id" class="form-label">Book ID</label>
              <input type="text" class="form-control form-control-id" id="book_id" name="book_id" value="<?php echo isset($selectedBook['book_id']) ? htmlspecialchars($selectedBook['book_id']) : ''; ?>" placeholder="Enter book ID">
            </div>
            <div class="mb-3">
              <label for="book_name" class="form-label">Book Name</label>
              <input type="text" class="form-control" id="book_name" name="book_name" value="<?php echo isset($selectedBook['book_name']) ? htmlspecialchars($selectedBook['book_name']) : ''; ?>" placeholder="Enter book name">
            </div>
             <div class="mb-3">
              <label for="book_category" class="form-label">Category ID</label>
              <select class="form-control" id="book_category" name="book_category">
                <option value="">Select a category</option>
                <?php
                  $sql = "SELECT * FROM bookcategory";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      $selected = (isset($selectedBook['category_id']) && $selectedBook['category_id'] == $row['category_id']) ? 'selected' : '';
                      echo "<option value='" . htmlspecialchars($row['category_id']) . "' $selected>" . htmlspecialchars($row['category_id']) . "</option>";
                      }
                  }
                ?>
              </select>
            </div>
             <div>
              <button type="submit" class="btn btn-primary" id="book_submit_add_btn">Add Book</button>
              <button type="submit" class="btn btn-primary" name="edit_book" style="display:none;">Update Book</button>
              <button type="button" class="btn btn-secondary" onclick="toggleBookForm()">Cancel</button>
            </div>
            
          </form>
        </div>

      </div>



      <!-- categories-tab  -->
      <div class="tab-pane fade" id="v-pills-categories" role="tabpanel" aria-labelledby="v-pills-categories-tab"
        tabindex="0">

          <div class="categories_users_tab">
          <div class="categories_title_box">
            <span class="categories_title">Categories Management </span>
            <button class="btn btn-success btn-md categories_add_btn" id="categories_add_btn" onclick="toggleCategoriesForm()">Add Category</button>
          </div>


          <div class="categories_content">
            <div class="categories_content_title_box">
              <div class="categories_content_title">Book Categories</div>
              <div class="categories_content_title_line"></div>
            </div>

            <div class="categories_tab_head">
              <table class="table categories_table">
                <thead class="categories_table_head">
                  <tr>
                    <th scope="col">Category ID</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Modified Date</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $sql3 = "SELECT * FROM bookcategory";
                    $result3 = $conn->query($sql3);
                    if ($result3->num_rows > 0) {
                        while($row3 = $result3->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($row3['category_id']) . "</td>
                                    <td>" . htmlspecialchars($row3['category_Name']) . "</td>
                                    <td>" . htmlspecialchars($row3['date_modified']) . "</td>
                                    <td>
                                      <button class='btn btn-primary btn-sm' onclick=\"toggleCategoriesForm()\">Edit</button>
                                      <a class='btn btn-danger btn-sm' href='index.php?delete_category=" . urlencode($row3['category_id']) . "' onclick=\"return confirm('Delete this category?');\">Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No categories found.</td></tr>";
                    }
                  ?>
                </tbody>
              </table>

            </div>
          </div>

        </div>

        <!-- Books-categories add form -->
        <div class="book_categories_form" id="book_categories_form">
          <form class="categories_add_form" action="add_category.php" method="POST">
             <div class="mb-3">
              <label for="category_id" class="form-label">Category ID</label>
              <input type="text" class="form-control form-control-id" id="category_id" name="category_id" placeholder="Enter category ID">
            </div>
            <div class="mb-3">
              <label for="category_name" class="form-label">Category Name</label>
              <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category name">
            </div>
            <div class="mb-3">
              <label for="category_description" class="form-label">Modified Date</label>
              <input type="date" class="form-control" id="category_modified_date" name="category_modified_date" rows="3"
                value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div>
              <button type="submit" class="btn btn-primary">Add Category</button>
              <button type="button" class="btn btn-secondary" onclick="toggleCategoriesForm()">Cancel</button>
            </div>
            
          </form>
        </div>

      </div>

      <!-- Members-tab  -->
      <div class="tab-pane fade" id="v-pills-Members" role="tabpanel" aria-labelledby="v-pills-Members-tab"
        tabindex="0">
        <div class="member_users_tab">
          <div class="member_title_box">
            <span class="member_title">Member Management</span>
            <button class="btn btn-success btn-md member_add_btn" id="member_add_btn" onclick="toggleMemberForm()">Add Member</button>
          </div>

          <div class="member_content">
            <div class="member_content_title_box">
              <div class="member_content_title">Members</div>
              <div class="member_content_title_line"></div>
            </div>

            <div class="member_tab_head">
              <table class="table member_table">
                <thead class="member_table_head">
                  <tr>
                     <th scope="col">Member ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Birth Date</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                 <tbody>
                    <?php
                      $sql4 = "SELECT * FROM member";
                      $result4 = $conn->query($sql4);
                      if ($result4->num_rows > 0) {
                          while($row4 = $result4->fetch_assoc()) {
                              echo "<tr>
                                      <td>" . htmlspecialchars($row4['member_id']) . "</td>
                                      <td>" . htmlspecialchars($row4['first_name']) . "</td>
                                      <td>" . htmlspecialchars($row4['last_name']) . "</td>
                                      <td>" . htmlspecialchars($row4['birthday']) . "</td>
                                      <td>" . htmlspecialchars($row4['email']) . "</td>
                                      <td>
                                        <button class='btn btn-primary btn-sm' onclick=\"toggleMemberForm()\">Edit</button>
                                        <a class='btn btn-danger btn-sm' href='index.php?delete_member=" . urlencode($row4['member_id']) . "' onclick=\"return confirm('Delete this member?');\">Delete</a>
                                      </td>
                                    </tr>";
                          }
                      } else {
                          echo "<tr><td colspan='6'>No members found.</td></tr>";
                      }
                  ?>
                   </tbody>
              </table>

            </div>
          </div>

        </div>

         <!-- Member add form -->
          <div class="member_form" id="member_form">
          <form class="member_add_form" action="add_member.php" method="POST">
            <div class="mb-3">
               <label for="member_id" class="form-label">Member ID</label>
              <input type="text" class="form-control form-control-id" id="member_id" placeholder="Enter member ID" name="member_id">
            </div>
            <div class="mb-3">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" class="form-control" id="first_name" placeholder="Enter first name" name="first_name">
            </div>
            <div class="mb-3">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="last_name" placeholder="Enter last name" name="last_name">
            </div>
            <div class="mb-3">
              <label for="birth_date" class="form-label">Birth Date</label>
              <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
             <div>
              <button type="submit" class="btn btn-primary">Add Member</button>
              <button type="button" class="btn btn-secondary" onclick="toggleMemberForm()">Cancel</button>
            </div>
             </form>
        </div>    

      </div>




      <!-- Borrow-Books-tab -->
      <div class="tab-pane fade" id="v-pills-borrow" role="tabpanel" aria-labelledby="v-pills-borrow-tab" tabindex="0">
        
          


      </div>

      <!-- Fine-Users-tab -->
      <div class="tab-pane fade" id="v-pills-fine" role="tabpanel" aria-labelledby="v-pills-fine-tab" tabindex="0">
        
          <div class="fine_users_tab">
          <div class="fine_title_box">
            <span class="fine_title">Fine Management</span>
            <button class="btn btn-success btn-md fine_add_btn" id="fine_add_btn" onclick="toggleFineForm()">Add Fine</button>
          </div>

          <div class="fine_content">
            <div class="fine_content_title_box">
              <div class="fine_content_title">Fines</div>
              <div class="fine_content_title_line"></div>
            </div>

            <div class="fine_tab_head">
              <table class="table fine_table">
                <thead class="fine_table_head">
                  <tr>
                     <th scope="col">Fine ID</th>
                    <th scope="col">Book ID</th>
                    <th scope="col">Member ID</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Fine Date</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                 <tbody>
                    <?php
                      $sql4 = "SELECT * FROM fine";
                      $result4 = $conn->query($sql4);
                      if ($result4->num_rows > 0) {
                          while($row4 = $result4->fetch_assoc()) {
                              echo "<tr>
                                      <td>" . htmlspecialchars($row4['fine_id']) . "</td>
                                      <td>" . htmlspecialchars($row4['book_id']) . "</td>
                                      <td>" . htmlspecialchars($row4['member_id']) . "</td>
                                      <td>" . htmlspecialchars($row4['fine_amount']) . "</td>
                                      <td>" . htmlspecialchars($row4['fine_date_modified']) . "</td>
                                      <td>
                                        <button class='btn btn-primary btn-sm' onclick=\"toggleFineForm()\">Edit</button>
                                        <a class='btn btn-danger btn-sm' href='index.php?delete_fine=" . urlencode($row4['fine_id']) . "' onclick=\"return confirm('Delete this fine?');\">Delete</a>
                                      </td>
                                    </tr>";
                          }
                      } else {
                          echo "<tr><td colspan='6'>No fines found.</td></tr>";
                      }
                  ?>
                   </tbody>
              </table>

            </div>
          </div>

        </div>

         <!-- Fine add form -->
          <div class="fine_form" id="fine_form">
          <form class="fine_add_form" action="add_fine.php" method="POST">
            <div class="mb-3">
               <label for="fine_id" class="form-label">Fine ID</label>
              <input type="text" class="form-control form-control-id" id="fine_id" placeholder="Enter fine ID" name="fine_id">
            </div>
            <div class="mb-3">
              <label for="book_id" class="form-label">Book ID</label>
              <select class="form-control" id="book_id" name="book_id">
                <option value="">Select a book</option>
                <?php
                  $sql = "SELECT * FROM book";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<option value='" . htmlspecialchars($row['book_id']) . "'>" . htmlspecialchars($row['book_id']) . "</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="member_id" class="form-label">Member ID</label>
              <select class="form-control" id="member_id" name="member_id">
                <option value="">Select a member</option>
                <?php
                  $sql = "SELECT * FROM member";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<option value='" . htmlspecialchars($row['member_id']) . "'>" . htmlspecialchars($row['member_id']) . "</option>";
                    }
                  }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="amount" class="form-label">Amount</label>
              <input type="number" class="form-control" id="amount" placeholder="Enter amount" name="amount" step="0.01">
            </div>
            <div class="mb-3">
              <label for="fine_date" class="form-label">Fine Date</label>
              <input type="date" class="form-control" id="fine_date" name="fine_date" value="<?php echo date('Y-m-d'); ?>">
            </div>
             <div>
              <button type="submit" class="btn btn-primary">Add Fine</button>
              <button type="button" class="btn btn-secondary" onclick="toggleFineForm()">Cancel</button>
            </div>
             </form>
        </div>

      </div>

      <!-- Edit-Profile-tab -->
      <div class="tab-pane fade" id="v-pills-edit" role="tabpanel" aria-labelledby="v-pills-edit-tab" tabindex="0">

        <h3 class="pro_title">Edit Profile</h3>

        <div class="pro_cont">
          <p class="pro_form_title">User Information</p>
          <div class="pro_form_title_line"></div>

          <form class="edit_form" method="post" action="index.php">

            <!-- User ID -->
            <div class="mb-3">
              <label for="User_ID" class="form-label">User ID</label>
              <input type="text" class="form-control form-control-id" id="User_ID" name="user_id" value="<?php echo isset($selectedUser['user_id']) ? htmlspecialchars($selectedUser['user_id']) : ''; ?>" readonly>
              <p class="pro_note">User ID cannot be changed.</p>
            </div>

            <!-- Names -->
            <div class="d-flex gap-3 justify-content-between">
              <div class="mb-3 pro_name_box">
                <label for="first_name" class="form-label ">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($selectedUser['first_name']) ? htmlspecialchars($selectedUser['first_name']) : ''; ?>" placeholder="your first name">
              </div>
              <div class="mb-3 pro_name_box">
                <label for="last_name" class="form-label ">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($selectedUser['last_name']) ? htmlspecialchars($selectedUser['last_name']) : ''; ?>" placeholder="your last name">
              </div>
            </div>

            <!-- Username -->
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($selectedUser['username']) ? htmlspecialchars($selectedUser['username']) : ''; ?>" placeholder="your username">
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($selectedUser['email']) ? htmlspecialchars($selectedUser['email']) : ''; ?>" placeholder="your email">
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control form-control-id" id="password" name="password" value="<?php echo isset($selectedUser['password']) ? htmlspecialchars($selectedUser['password']) : ''; ?>" placeholder="your new password">
              <p class="pro_note">Must be more than 8 characters.</p>
            </div>

            <!-- Save Changes Button -->
            <button type="submit" name="update_user" class="btn btn-primary pro_save_btn">Save Changes</button>
          </form>
        </div>

      </div>

    </div>
  </div>


  <!-- bootstrap-scrip -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

  <!-- Alert Script -->
  <?php
    if(isset($_SESSION['alert'])){
      echo $_SESSION['alert'];
      unset($_SESSION['alert']);
    }
  ?>
  
  

</body>

</html>