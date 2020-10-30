<?php

$server = 'localhost';
$user = 'art_gallery_user';
$password = '9Uvtt3rwn1O7Mlrh';
$db = 'art_gallery_db';

$conn = new mysqli($server, $user, $password, $db);
if ($conn->connect_error) {
    die($conn->connect_error);
}