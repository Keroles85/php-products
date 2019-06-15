<?php
include_once dirname(__DIR__) . '/includes/admin-session.php';
include_once dirname(__DIR__) . '/includes/autoload.php';

function getUsers($user) {
  return $user->readAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP Products Home Page</title>
  <link rel="stylesheet" href="../style/css/bootstrap.min.css"> <!-- bootstrap -->
  <link rel="stylesheet" href="../style/css/all.min.css"> <!-- fontaweson -->
  <link rel="stylesheet" href="../style/css/main.css"> <!-- my-style -->
</head>
<body>
  <div id="nav-section"></div>

  <section class="main-section">
    <div class="container">
      <h1>Users Management</h1>
      <a href='add.php?type=user' class="btn btn-success" style="margin: 0 0 2em 1em;">Add New user</a>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Admin</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
            $users = getUsers(new User());
            foreach($users as $user): ?>
          <tr>
            <th scope="row"><?= $user['id'] ?></th>
            <td><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
              <input type="checkbox" name="admin" id="admin" <?= $user['isadmin']? 'checked' : '' ?> disabled>
            </td>
            <td>
              <a href="update.php?type=user&id=<?= $user['id'] ?>" title="Update Record">
                <i class="fas fa-pen"></i>
              </a> &nbsp;&nbsp;
              <a onClick="javascript: return confirm('Are you sure?!');" href="delete.php?type=user&id=<?= $user['id'] ?>" title="Delete Record">
                <i class="fas fa-trash-alt" style="color:red"></i>
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <script src="../js/jquery-3.4.1.min.js"></script> <!-- jQuery script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="../js/bootstrap.min.js"></script> <!-- bootstrap -->
  <script src="../js/admin.js"></script> <!-- my-script -->
</body>
</html>