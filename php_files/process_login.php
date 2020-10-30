<?php
require_once 'php_files/login_helper.php';
require_once "db.php";
init_session();
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $email = $_POST['email_id'];
    $password = $_POST['password'];
    $query = "SELECT * FROM Users WHERE user_email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows>0) {
        $result = $result->fetch_assoc();
        $user_id = $result ['user_id'];
        $db_password = $result['password'];
        if(password_verify($password, $db_password)) {
            $_SESSION ['logged_in']=true;
            $_SESSION['user']=$user_id;

            header('Location: index.php');
            exit();

        } else {
            $error = 'Incorrect password';
        }
    } else {
        $error = 'Email is not registered';
    }
}
?>