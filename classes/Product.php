<?php

class Product extends Database {

  /*
   * CREATE NEW PRODUCT METHOD
   */
  public function create($data, $img) {
    $query = 'INSERT INTO products (' . implode(', ', array_keys($data)) . ') VALUES 
      (:' . implode(', :', array_keys($data)) . ')';

    $stmt = $this->dbConnect()->prepare($query);

    foreach($data as $key => &$value) {
      $stmt->bindParam(":{$key}", $value);
    }

    $stmt->execute();

    //upload product image in images table
    $image = new Image();
    $image->insertFile($this->getLastInserted(), $img);

    return $stmt->rowCount();
  }


  /*
   * GET THE ID OF LAST INSERTED PRODUCT METHOD
   */
  private function getLastInserted() {
    //LAST_INSERT_ID() NOT WORKING?!
    $stmt = $this->dbConnect()->query("SELECT id FROM products ORDER BY id DESC LIMIT 1");
    return $stmt->fetchColumn();
  }


  /*
   * READ ALL PRODUCTS METHOD
   */
  public function readAll() {
    $query = 'SELECT prds.id, prds.name AS product_name, prds.description, prds.price, 
      cat.id AS cat_id, cat.name AS cat_name, img.image_url FROM 
      products AS prds INNER JOIN categories AS cat ON prds.cat_id = cat.id
      INNER JOIN images AS img ON prds.id = img.product_id ORDER BY cat_id, prds.id';

    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /*
   * READ PRODUCTS BY CATEGORY_ID METHOD
   */
  public function readAllByCategory($cat_id) {
    $query = 'SELECT prds.id, prds.name AS product_name, prds.description, prds.price, 
        cat.id AS cat_id, cat.name AS cat_name, img.image_url FROM 
        products AS prds INNER JOIN categories AS cat ON prds.cat_id = cat.id
        INNER JOIN images AS img ON prds.id = img.product_id WHERE cat_id = ?';

    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute([$cat_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  /*
   * READ PRODUCT BY ID METHOD
   */
  public function readByID($id) {
    $query = "SELECT img.image_url, prdt.*  
      FROM images AS img INNER JOIN products AS prdt ON img.product_id = prdt.id 
      WHERE prdt.id=?";
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /*
   * UPDATE PRODUCT METHOD
   */
  public function update($id, $data, $img = null) {
    $cols = [];

    foreach($data as $key => $value) {
      $cols[] = "$key = :{$key}";
    }

    $query = 'UPDATE products SET ' . implode(', ', $cols) . ' WHERE id=:id';
    $stmt = $this->dbConnect()->prepare($query);

    foreach($data as $key => &$value) {
      $stmt->bindParam(":{$key}", $value);
    }

    $stmt->bindParam(":id", $id);
    $stmt->execute();

    //check if no image parameter was passed
    if ($img === null) {
      return $stmt->rowCount();

      //if image parameter was passed
    } else {
      $image = new Image();
      $img_stmt = $image->updateFile($id, $img);
      return ($stmt->rowCount() > 0 || $img_stmt > 0) ? 1 : 0;
    }
  }


  /*
   * Get featured products
   */
  public function getFeatured() {
    $query = 'SELECT prds.id, prds.name, prds.description, imgs.image_url 
      FROM products AS prds INNER JOIN images AS imgs ON imgs.product_id = prds.id
      WHERE featured = 1 LIMIT 3';

    $stmt = $this->dbConnect()->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}