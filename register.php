<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    <?php
        session_start();
        include 'db_config.php';

        $Uid = $_POST['uid'];
        $UName = $_POST['uname'];
        $FName = $_POST['fname'];
        $LName = $_POST['lname'];
        $Email = $_POST['email'];
        $Password = $_POST['new_password'];

        $UidFristChar = $Uid[0];


        // Check user ID starts with 'U'
        if ($UidFristChar !== 'U') {
            $_SESSION['alert_type'] = 'danger';
            $_SESSION['alert_message'] = 'Registration failed! User ID must start with "U".';
        } else {
            $sql = "INSERT INTO user (user_id, username, first_name, last_name, email, password) VALUES ('$Uid', '$UName', '$FName', '$LName', '$Email', '$Password')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['alert_type'] = 'success';
                $_SESSION['alert_message'] = 'Registration successful! Please login to continue.';
            } else {
                $_SESSION['alert_type'] = 'danger';
                $_SESSION['alert_message'] = 'Error: ' . $conn->error;
            }
        }
        header("Location: login.php");
        exit();
    ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

