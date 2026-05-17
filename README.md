# 📚 Library Management System

A web-based **Library Management System** developed using **HTML, CSS, Bootstrap, PHP, JavaScript, and MySQL**.

This project was created as a final group assignment for the **BICT Degree Program – University of Colombo**.

The system helps library staff manage books, members, borrow records, fines, and user authentication through a simple admin dashboard.

---

# 🚀 Features

## 🔐 User Authentication
- User Registration
- User Login & Logout
- Session-based Authentication
- Password Validation
- Email Validation
- Username & Email Duplicate Checking

## 📚 Book Management
- Add Books
- Update Book Details
- Delete Books
- Display Books in Table Format
- Book Category Selection

## 🗂️ Book Category Management
- Add Categories
- Update Categories
- Delete Categories
- Track Modified Date & Time

## 👥 Library Member Management
- Register Members
- Update Member Details
- Delete Members
- Email Format Validation

## 📖 Borrow Book Management
- Add Borrow Records
- Update Borrow Status
- Track Borrowed / Available Status
- View Borrow Records

## 💰 Fine Management
- Assign Fines to Members
- Update Fine Amounts
- Delete Fine Records
- Fine Validation (2 LKR – 500 LKR)

---

# 🛠️ Technologies Used

- HTML5
- CSS3
- Bootstrap
- JavaScript
- PHP
- MySQL
- XAMPP

---

# 🗄️ Database Setup

## 1️⃣ Create Database

Create a database named:

```sql
library_system
```

## 2️⃣ Import Database

- Open phpMyAdmin
- Select the created database
- Go to the **Import** section
- Import the `database.sql` file

---

# ▶️ How to Run the Project

1. Install XAMPP
2. Start Apache and MySQL
3. Copy the project folder into:

```bash
xampp/htdocs/
```

4. Open your browser and run:

```bash
http://localhost/your-project-folder
```

---

# ✅ Validations Implemented

- User ID Format → `U001`
- Book ID Format → `B001`
- Category ID Format → `C001`
- Member ID Format → `M001`
- Borrow ID Format → `BR001`
- Email Format Validation
- Password Minimum Length Validation
- Fine Amount Range Validation

---

# 📂 Project Structure

```bash
/project-folder
│
├── assets/
├── css/
├── js/
├── includes/
├── database/
├── index.php
├── login.php
├── dashboard.php
└── database.sql
```

---

# 👨‍💻 Developer

**Tharusha Dilim**  
BICT Undergraduate  
University of Colombo

---

# 📌 Notes

- This project was developed for educational purposes.
- Runs on localhost using XAMPP.
- GitHub was used for version control and collaboration.

---
