<?php


class Carousel extends Database {

  /*
   * Read all carousel items method
   */
  public function readAll() {
    $query = "SELECT * FROM carousel";
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /*
   * Read all visible items method
   */
  public function readVisible() {
    $query = 'SELECT * FROM carousel WHERE visible=1 ORDER BY active DESC';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /*
   * Create new carousel item method
   */
  public function create($data) {
    $query = 'INSERT INTO carousel (' . implode(', ', array_keys($data)) . ') VALUES
      (:'. implode(', :', array_keys($data)) .')';
    $stmt = $this->dbConnect()->prepare($query);

    foreach ($data as $key => &$value) {
      $stmt->bindParam(":{$key}", $value);
    }

    $stmt->execute();
    return $stmt->rowCount();
  }


  /*
   * Update carousel item method
   */
  public function update($id, $data) {
    $cols = [];

    foreach($data as $key => $value) {
      $cols[] = "$key = :{$key}";
    }

    $query = 'UPDATE carousel SET '. implode(', ', $cols) .' WHERE id=:id';
    $stmt = $this->dbConnect()->prepare($query);

    foreach($data as $key => &$value) {
      $stmt->bindParam(":{$key}", $value);
    }

    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->rowCount();
  }


  /*
   * update status function
   */
  public function updateVisible($id, $status) {
    $query = 'UPDATE carousel SET visible=:status WHERE id=:id';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->rowCount();
  }


  /*
   * Update active function
   */
  public function updateActive($id) {
    $query = 'UPDATE carousel SET active=1 WHERE id=:id';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $query = 'UPDATE carousel SET active=0 WHERE id<>:id';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
  }


  /*
   * Read carousel item by ID
   */
  public function readByID($id) {
    $query = 'SELECT * FROM carousel WHERE id=?';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /*
   * Check for active items in carousel method
   */
  public function getActive() {
    $query = "SELECT * FROM carousel WHERE active = 1";
    return $this->dbConnect()->query($query)->rowCount();
  }


  /*
   * Check for active status for items by id
   */
  public function getActiveByID($id) {
    $query = 'SELECT active FROM carousel WHERE id=?';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetchColumn();
  }


  /*
   * check for visible status for items by id
   */
  public function getVisibleByID($id) {
    $query = 'SELECT visible FROM carousel WHERE id=?';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetchColumn();
  }
}