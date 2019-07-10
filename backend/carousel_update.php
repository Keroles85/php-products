<?php
if (isset($_GET['act'])) {
  $action = $_GET['id'];
  echo "<script>
    alert(' . $action . ');
  </script>
  ";
}