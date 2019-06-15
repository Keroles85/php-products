<?php
session_start();

//check if user is logged in and if user is admin
if(!isset($_SESSION['admin'])) {
  header('location: login.php');
}