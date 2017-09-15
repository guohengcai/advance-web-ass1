<?php
session_start();
include("includes/database.php");
if(!$_GET["search"]){
  //if no search term, go back to index page
  header("location:index.php");
}
else{
  $search_term = "%".$_GET["search"]."%";
  $search_query = "SELECT *
                  FROM products 
                  INNER JOIN products_images 
                  ON products.id=products_images.product_id 
                  INNER JOIN images 
                  ON products_images.image_id=images.image_id 
                  WHERE products.name 
                  LIKE ? OR products.description LIKE ? 
                  GROUP BY products.id ORDER BY products.id ASC";
  $statement = $connection->prepare($search_query);
  $statement->bind_param("ss",$search_term,$search_term);
  $statement->execute();
  $result = $statement->get_result();
  if($result->num_rows > 0){
    $result_array = array();
    while($row = $result->fetch_assoc()){
      array_push($result_array,$row);
    }
  }
  
}
?>
<!doctype html>
<html>
  <?php include("includes/head.php"); ?>
  <body>
    <?php include("includes/navigation.php"); ?>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <?php
          $keyword = $_GET["search"];
          echo "You searched for <strong>$keyword</strong>";
          echo " with ".count($result_array)." results returned";
          ?>
        </div>
      </div>
      <?php
      if(count($result_array) > 0){
        foreach($result_array as $item){
          $id = $item["id"];
          $name = $item["name"];
          $price = $item["price"];
          $image = "products/".$item["image_file"];
          $counter++;
         
         
          if($counter == 1){
                echo "<div class=\"row\">";
              }
              echo "<div class=\"col-md-4\">
              
              <img class=\"img-responsive\" src=\"$image\">
              <h3 class=\"product-name\">$name&nbsp;</h3>
              <h4 class=\"price\">$price</h4>
              
              <a href=\"productdetail.php?productid=$id\">View Details</a>
              </div>
              ";
          
          //check whether to close the row
          if($counter == 3){
            echo "</div>";
            $counter = 0;
          }
        }
      }
      ?>
    </div>
  </body>
</html>