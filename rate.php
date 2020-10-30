<?php
require_once 'php_files/login_helper.php';
init_session();
if (!isLoggedIn())
{
header('Location: login.php');
exit();
}
require_once 'php_files/db.php';
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $art_id=$_POST['art_id'];
    $user_id=$_POST['user_id'];
    $rated_value=$_POST['rated_value'];

    $query = 'CALL SET_RATING(?,?,?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iii', $rated_value, $user_id, $art_id);
    if ($stmt->execute() === false) {
        error_log($stmt->error);
    }
    else {
        header('Location: profile.php');
    }
}
?>
<html>
<head>
    <title>Rating</title>
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
        <form action="rate.php" method="post" enctype="multipart/form-data">
            <h5>Rate art</h5> <br>
            <input type="number" class="form-control" name="rated_value" placeholder="number of stars" required>
            <br>
            <input type="hidden" class="form-control" name="art_id" value="<?php echo $_GET['art']; ?>" required>
            <input type="hidden" class="form-control" name="user_id" value="<?php echo $_SESSION['user']; ?>" required>

            <br> <button type="submit" class="btn btn-outline-dark">rate</button>
        </form>
    </div>
</div>
