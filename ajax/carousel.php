<?php
include_once dirname(__DIR__) . '/includes/autoload.php';

$id = $_POST['id'];
$action = $_POST['action'];
$carousel = new Carousel();

if ($action == 'visible') {
  $checked = $_POST['visible'];
  $stmt = $carousel->getActiveByID($id);
  if ($stmt) {
    //if item is active don't update visibility
    echo 'active';
  } else {
    $carousel->updateVisible($id, $checked);
  }
} else {
  //don't update active if item is invisible
  $stmt = $carousel->getVisibleByID($id);
  if(!$stmt) {
    echo 'invisible';
  } else {
    $carousel->updateActive($id);
  }
}

//$carousel->updateStatus($id, 'visible', $checked);
