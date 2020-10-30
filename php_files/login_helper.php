<?php
function init_session()
{
    session_name('user_session');
    session_start();
    session_regenerate_id(true);
}
function isLoggedIn() {
    if(isset($_SESSION['logged_in']) && isset($_SESSION['user']) ) {
        return true;
    } else {
        return false;
    }
}