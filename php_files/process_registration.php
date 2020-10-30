<?php
require_once 'login_helper.php';
require_once "db.php";
init_session();
$error = null;
if($_SERVER['REQUEST_METHOD']=='POST') {
    $name = $_POST['name'];
    $email=$_POST['email_id'];
    $password=$_POST['password'];
    $r_password=$_POST['r-password'];

    if($password === $r_password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $select = "SELECT * FROM Users WHERE user_email = ?";
        $stmt=$conn->prepare($select);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows>0) {
            $error = "Email already registered";
        } else {

            $query = "INSERT INTO Users(user_name, user_email, password) VALUES (?,?,?)";
            $stmt=$conn->prepare($query);
            $stmt->bind_param('sss', $name, $email, $hash);

            if($stmt->execute()===false) {

                $error=$conn->error;
            } else {
                $error= "User registered.";
            }
        }
    } else {
        $error= 'Passwords do not match';
    }
}
?>
