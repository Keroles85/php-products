<?php


class Image extends Database {

  private $file;

  /*
   * upload the file method and get the uploaded file URL
   */
  public function uploadFile($file) {
    $this->file = $file;
    $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
    $imgURL = "upload/" . time() . ".{$extension}";
    $tmpLocation = $file['tmp_name'];
    move_uploaded_file($tmpLocation, '../'.$imgURL);
    return $imgURL;
  }


  /*
   * insert the uploaded file URL in DB by product id
   */
  public function insertFile($id, $file) {
    $imgURL = $this->uploadFile($file);
    $query = "INSERT INTO images (product_id, image_url) VALUES (?, ?)";
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute([$id, $imgURL]);
  }


  /*
   * update product image
   */
  public function updateFile($id, $file){
    $imgURL = $this->uploadFile($file);
    $query = 'UPDATE images SET image_url=? WHERE product_id=?';
    $stmt = $this->dbConnect()->prepare($query);
    $stmt->execute([$imgURL, $id]);
    return $stmt->rowCount();
  }

}