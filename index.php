<?php
require_once 'php_files/login_helper.php';
init_session();
require_once 'php_files/db.php';
?>
<html>
<head>
    <title>
        Art Gallery
    </title>
    <?php
    require_once 'links.php';
    ?>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="#" > Art Gallery </a>
    <div>
        <?php if (!isLoggedIn()) : ?>
        <a class="btn btn-outline-light" href="register.php" >Register</a>
        <a class="btn btn-outline-light" href="login.php" >Login</a>
        <?php else: ?>
        <a class="btn btn-outline-light" href="add-art.php" >Add Art</a>
            <a class="btn btn-outline-light" href="profile.php" >Profile</a>
        <?php endif; ?>
    </div>
</nav>
<div class="container">
    <div class="row">
        <?php
        $query = 'SELECT * FROM arts';
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            $base64img = base64_encode($row['art_image']);
            $html = <<<html
<div class="col-sm-12 col-md-4">
<div class="card" style="width: 18rem;">
  <img src="data:image/jpeg;base64,$base64img" class="card-img-top" alt="..." style="height: 200px; width: auto">
  <div class="card-body">
    <h5 class="card-title">{$row['art_name']}</h5>
    <p class="card-text">{$row['art_desc']}</p>
    <h6 class="text-muted">Rs {$row['art_price']}</h6>
    <a href="buy.php?art={$row['art_id']}" class="btn btn-primary"> Buy this now </a>
  </div>
</div>
</div>
html;

            echo $html;
        }
        ?>
    </div>
</div>
</body>
<?php
if (isset($_GET['purchased'])) {
    echo '<script>alert("Purchased")</script>';
}
?>

</html>

