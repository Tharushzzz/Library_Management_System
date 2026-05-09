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
        include 'db_config.php';

        $Uid = $_POST['uid'];
        $UName = $_POST['uname'];
        $FName = $_POST['fname'];
        $LName = $_POST['lname'];
        $Email = $_POST['email'];
        $Password = $_POST['new_password'];


        $sql = "INSERT INTO user (user_id, username, first_name, last_name, email, password) VALUES ('$Uid', '$UName', '$FName', '$LName', '$Email', '$Password')";
        if ($conn->query($sql) === TRUE) {
            // echo "New record created successfully";
            
            echo '
            <div class="alert alert-success" role="alert">
                Registration successful! Please login to continue.
            </div>
            ';

            header("Location: login.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    ?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

