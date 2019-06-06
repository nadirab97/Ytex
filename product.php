<?php


class Product{
  private $product_name;
  private $description;
  private $price;
  private $image;
  private $category;


  public function get_product_name(){
    return $this->product_name;
  }
  public function get_description(){
    return $this->description;
  }
  public function get_price(){
    return $this->price;
  }
  public function get_image(){
    return $this->image;
  }
  public function get_category(){
    return $this->category;
  }
 
    
  public function find_product_by_category($category) {
    global $database;
    $sql = "SELECT `Product name`, `Description`, `Price`, `Image` FROM Products WHERE Category='". $category . "'";

    $products_by_category= array();
    $result_set = $database->get_connection()->query($sql);
    confirm_result_set($result_set);
    while ($curr_product = $result_set->fetch_assoc()) {
      $product = new Product();
      $product->instantation($curr_product);
      $products_by_category[] = $product;
    }
    $result_set->free_result();

    return $products_by_category;
  }

  private function instantation($product_asoc_array) {
    $this->product_name = $product_asoc_array['Product name'];
    $this->description = $product_asoc_array['Description'];
    $this->price = $product_asoc_array['Price'];
    $this->image = $product_asoc_array['Image'];
    $this->category = $product_asoc_array['Category'];
  }

  public function find_all_Products(){
    global $database;

    $sql = "SELECT `Product name`,`Description`,`Price`,`Image`,`Category` FROM Products ORDER BY 'Product name' ASC";

    $products = array();
    $result_set = $database->get_connection()->query($sql);
    confirm_result_set($result_set);
    while ($curr_product = $result_set->fetch_assoc()) {
      $product = new Product();
      $product->instantation($curr_product);
      $products[] = $product;
    }
    $result_set->free_result();

    return $products;
  }
   public function find_all_category(){
    global $database;

    $category_arr = array();
    $sql = "SELECT DISTINCT `Category` FROM Products";
    $result_set = $database->get_connection()->query($sql);
    confirm_result_set($result_set);
    while ($curr_category = $result_set->fetch_assoc()) {
      $category = new Product();
      $category->instantation($curr_category);
      $Categories[] = $category;
      }
    $result_set->free_result();

    return $Categories;
   }
}

?>
