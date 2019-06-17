<?php

class User extends Database {

  /*private $conn;
  public function __construct($conn) {
    $this->conn = $conn;
  }*/


  /*
   * login method
   */
  public function login($email, $password, $cookie) {

    $query = "SELECT * FROM users WHERE email=:email AND password=:password";
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute(['email' => $email, 'password' => $password]);
    $queryOk = $stmt->rowCount();

    if ($queryOk) {
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      //check if user is admin
      if ($user['isadmin']) {
        $_SESSION['admin'] = $user;
        header("location: http://localhost/Assignment/php-products/backend/");
      } else {
        $_SESSION['user'] = $user;
        if ($cookie) {
          setcookie('user', )
        }
        header("location: http://localhost/Assignment/php-products/");
      }

    } else {
      header("location: login.php?status=invalid&email={$this->email}");
    }
  }


  /*
   * create and register user
   */
  public function create($data) {
    $query = 'INSERT INTO users ('. implode(', ', array_keys($data)) .') 
        VALUES (:' . implode(', :', array_keys($data)) . ')';

    $stmt = $this->dbConnect()->prepare($query);

    //bind data with placeholders (calling variable by reference)
    foreach ($data as $key => &$value) {
      $stmt->bindParam(":{$key}", $value);
    }

    $stmt->execute();
    return $stmt->rowCount();
  }


  /*
   * read all users method
   */
  public function readAll() {
    $query = 'SELECT * FROM users';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /*
   * read user by id method
   */
  public function readByID($id) {
    $query = 'SELECT * FROM users WHERE id=:id';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute(['id' => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /*
   * update user function
   */
  public function update($id, $data){
    $cols = [];

    foreach($data as $key => $value) {
      $cols[] = "$key = :{$key}";
    }

    $query = 'UPDATE users SET ' . implode(', ', $cols) . ' WHERE id=:id'; //using positional placeholders
    $stmt = $this->dbConnect()->prepare($query);

    foreach ($data as $key => &$value) {
      $stmt->bindParam(":{$key}", $value);
    }

    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->rowCount();
  }


  /*
   * logout method
   */
  public function logout() {
    $_SESSION = array();
    session_destroy();
  }

}