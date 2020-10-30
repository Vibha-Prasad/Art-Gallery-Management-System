<?php
require_once 'php_files/login_helper.php';
init_session();
if (!isLoggedIn())
{
    header('Location: login.php');
    exit();
}
require_once 'php_files/db.php';
require_once 'php_files/process_add_art.php';
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
        <form action="add-art.php" method="post" enctype="multipart/form-data">
            <h5>Add art</h5> <br>
            <input type="text" class="form-control" name="art_name" placeholder="art name" required>
            <br>
            <input type="text" class="form-control" name="art_desc" placeholder="art description" required>
            <br>
            <select name = "art_cat" class="form-control" id="exampleFormControlSelect1">
                <option disabled selected>select category</option>
                <?php
                $query= ' SELECT * FROM `arts category`';
                $result= $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['cat_id']}'>{$row['cat_name']}</option>";
                }
                ?>
            </select>
            <br> <input type="file" class="form-control" accept="image/*" name="art_image" placeholder="art image" required>
            <br>

            <br> <button class="btn btn-outline-dark">add art</button>
        </form>
    </div>
</div>
</body>
</html>

