<?php
require_once 'login_helper.php';
require_once 'db.php';
$error = null;
if($_SERVER['REQUEST_METHOD']=='POST') {
    $ord_copies = $_POST['ord_copies'];
    $ord_address = $_POST['ord_address'];
    $ord_phn = $_POST['ord_phn'];
    $art_id = $_POST['art_id'];
    $user_id = $_POST['user_id'];
    $price = $_POST['ord_price'];

    $query = "INSERT INTO orders(ord_by, art_ordered, ord_copies, ord_cost) VALUES (?,?,?, ?)";
    $stmt=$conn->prepare($query);
    $stmt->bind_param('iiii', $user_id, $art_id, $ord_copies, $price);
    $stmt->execute();
    header('Location: /Art Gallery?purchased');
    exit();

}



