<?php
require_once 'php_files/process_login.php';
?>
<html>
<head>
    <title>Login</title>
    <?php
    require_once 'links.php';
    ?>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Art Gallery</a>
</nav>
<br>
<div class="card" style="width: 30%; border-radius: 25px; margin-left: auto; margin-right: auto">
    <div class="card-body" >
        <form action="login.php" method="post">
            <h5>Login</h5> <br>
            <input type="email" class="form-control" name="email_id" placeholder="Email id" required>
            <br>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <br>
            <button class="btn btn-outline-dark">Login</button>
        </form>
    </div>
</div>
</body>
</html>
