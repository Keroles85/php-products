<?php

class Category extends Database {

  /*
   * read all categories method
   */
  public function readAll() {
    $query = 'SELECT * FROM categories';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /*
   * create new category method
   */
  public function create($data) {
    $query = 'INSERT INTO categories ('. implode(', ', array_keys($data)) .') VALUES 
      (:'. implode(', :', array_keys($data)) .')';

    $stmt = $this->dbConnect()->prepare($query);

    foreach ($data as $key => &$value) {
      $stmt->bindParam(":{$key}", $value);
    }

    $stmt->execute();
    return $stmt->rowCount();
  }


  /*
   * read category by id
   */
  public function readCategory($id) {
    $query = 'SELECT name, description FROM categories WHERE id=?';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /*
   * update category method
   */
  public function update($id, $data) {
    $cols = [];

    foreach($data as $key => $value) {
      $cols[] = "$key = :{$key}";
    }

    $query = 'UPDATE categories SET ' . implode(', ', $cols) . ' WHERE id=:id';
    $stmt = $this->dbConnect()->prepare($query);

    foreach($data as $key => &$value) {
      $stmt->bindParam(":{$key}", $value);
    }

    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->rowCount();
  }
}