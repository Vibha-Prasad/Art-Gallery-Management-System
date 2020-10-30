<?php
require_once'php_files/process_registration.php';
?>
<html>
<head>
    <title>
        Register
    </title>
    <?php
        require_once 'links.php';
    ?>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Art Gallery</a>
</nav>
<br>
<div class="card" style="width: 50%; border-radius: 25px; margin-left: auto; margin-right: auto">
    <div class="card-body">
        <form action="register.php" method="post">
            <h5 style="text-align: center">Create Account</h5>
            <br>
            <h6>Basic Details</h6>
                <?php if(isset($error)) {
                    echo '<div class= "alert alert-danger">';
                    echo "<p> {$error} </p>" ;
                    echo '</div>';
                } ?>

            <input type="text" class="form-control" name="name" placeholder="Name" required> <br>
            <input type="email" class="form-control" name="email_id" placeholder="Email id" required> <br>
            <input type="password" class="form-control" name="password" placeholder="Password" required> <br>
            <input type="password" class="form-control" name="r-password" placeholder="Confirm Password" required>
            <br>
            <button class="btn btn-outline-dark">Register</button>
        </form>
    </div>
</div>
<br>
</body>
</html>
