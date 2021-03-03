<?php
session_start();
if (isset($_SESSION['user']['email'])) {
    session_destroy();
  header('location:../index.php');
} else {
    echo"logout not work";
}