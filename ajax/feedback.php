<?php

include_once dirname(__DIR__) . '/includes/autoload.php';

$database = new Database();
$db = $database->dbConnect();

$name = $_POST['name'];
$email = $_POST['email'];
$comment = $_POST['comment'];

$query = 'INSERT INTO feedback (name, email, comment) VALUES (?, ?, ?)';
$stmt = $db->prepare($query);
$stmt->execute([$name, $email, $comment]);
return ($stmt->rowCount() > 0)? true : false;

