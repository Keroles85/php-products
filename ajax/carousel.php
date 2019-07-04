<?php
include_once dirname(__DIR__) . '/includes/autoload.php';

$id = $_POST['id'];
$checked = $_POST['visible'];
$action = $_POST['action'];
$carousel = new Carousel();
$stmt = $carousel->getActiveByID($id);
if ($stmt) {
  echo 'active';
} else {
  $carousel->updateStatus($id, 'visible', $checked);
}
//$carousel->updateStatus($id, 'visible', $checked);
