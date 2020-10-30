<?php
require_once 'login_helper.php';
require_once 'db.php';
$error = null;
if($_SERVER['REQUEST_METHOD']=='POST') {
    $art_name = $_POST['art_name'];
    $art_desc = $_POST['art_desc'];
    $art_cat = $_POST['art_cat'];
    $art_image = file_get_contents($_FILES['art_image']['tmp_name']);
    $art_owner = $_SESSION['user'];
    $n = NULL;
    $query = "INSERT INTO arts(art_name, art_desc, art_cat, art_owner, art_image) VALUES (?,?,?,?,?)";
    $stmt=$conn->prepare($query);
    $stmt->bind_param('ssiib', $art_name, $art_desc, $art_cat, $art_owner, $n);
    $stmt->send_long_data(4,$art_image);
$stmt->execute();

}



