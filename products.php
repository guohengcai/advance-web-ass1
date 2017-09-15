<?php
session_start();
include("includes/database.php");
//a reference to self (this page's url)
$self = $_SERVER["PHP_SELF"];



//Handle GET request for pages
if(!$_GET["page"]){
  $pagenumber = 1;
}
else{
  $pagenumber = $_GET["page"];
}
//Handle GET requests for categories
if(!$_GET["category"]){
  $cat_selected = 0;
}
else{
  $cat_selected = $_GET["category"];
}

//Get total of products
if($cat_selected == 0){
$total_query = "SELECT products.id FROM products 
                INNER JOIN products_images 
                ON products_images.product_id = products.id
                GROUP BY products.id";
$total = $connection->prepare($total_query);
}
else{
//if there is a category selected
$total_query = "SELECT products.id FROM products 
                INNER JOIN products_images 
                ON products_images.product_id = products.id
                INNER JOIN products_categories
                ON products_categories.product_id = products.id
                WHERE products_categories.category_id = ?
                GROUP BY products.id";
$total = $connection->prepare($total_query);
$total->bind_param("i",$cat_selected);
}
$total->execute();
$total_result = $total->get_result();
$total_row = $total_result->num_rows;
$total_products = $total_result->num_rows;

//number of products per page
$products_perpage = 6;
//total number of product pages
$total_pages = ceil($total_products/$products_perpage);

if($pagenumber > $total_pages){
  $pagenumber = 1;
}



//offset for the database query
$offset =  ($pagenumber-1)*$products_perpage;
// $offset = 0;
// $pagelimit = 8;
//GET PRODUCTS WITH PAGES
//for pages we add LIMIT [how many per page] and OFFSET [which page number]
if($cat_selected == 0){
$product_query = "SELECT * FROM products 
                  INNER JOIN products_images 
                  ON products.id=products_images.product_id 
                  INNER JOIN images
                  ON products_images.image_id=images.image_id
                  GROUP BY products.id
                  ORDER BY products.id ASC LIMIT ? OFFSET ? ";
}
else{
$product_query = "SELECT * FROM products 
                  INNER JOIN products_images 
                  ON products.id=products_images.product_id 
                  INNER JOIN images
                  ON products_images.image_id=images.image_id
                  INNER JOIN products_categories
                  ON products_categories.product_id = products.id 
                  WHERE products_categories.category_id = ?
                  GROUP BY products.id
                  ORDER BY products.id ASC LIMIT ? OFFSET ? ";
}

//$result = $connection->query($product_query);

//send query to the database
$statement = $connection->prepare($product_query);
//bind parameters
if($cat_selected==0){
  $statement->bind_param("ii",$products_perpage,$offset);
}
else{
  $statement->bind_param("iii",$cat_selected,$products_perpage,$offset);
}
//execute the statement
$statement->execute();
$result = $statement->get_result();

//check if there are results
if($result->num_rows > 0){
  echo "Itworks";
  $products = array();
  while($row = $result->fetch_assoc() ){
    array_push($products,$row);
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
          <div class="col-md-12">
            <nav aria-label="Page navigation" class="navbar">
              <p class="navbar-text">
                <?php 
                echo "page ".$pagenumber." of ".$total_pages;
                ?>
              </p>
              <ul class="pagination navbar-right">
                <li>
                  <?php //previous
                  if($pagenumber>1){
                    $previous_page = $pagenumber-1;
                    $previous_disable = "";
                  }
                  else{
                    $previous_disable = "disabled";
                  }
                  $previous_link = $_SERVER["PHP_SELF"]."?page=$previous_page&category=$cat_selected";
                  ?>
                  <a <?php echo $previous_disable; ?>href="<?php echo $previous_link; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php
                for($i=0;$i<$total_pages;$i++){
                  $page_label = $i+1;
                  $page_url= $_SERVER["PHP_SELF"]."?page=$page_label&category=$cat_selected";
                  if($page_label==$pagenumber){
                    $page_active = "active";
                  }
                  else{
                    $page_active = "";
                  }
                  echo "<li class=\"$page_active\"><a href=\"$page_url\">$page_label</a></li>";
                }
                ?>
                <li>
                  <?php //previous
                  if($pagenumber < $total_pages){
                    $nextpage = $pagenumber+1;
                    $next_disable="";
                  }
                  else{
                    $next_disable = "disabled";
                  }
                  
                  
                  $nextlink = $_SERVER["PHP_SELF"]."?page=$nextpage&category=$cat_selected";
                  ?>
                  <a <?php echo $next_disable; ?>href="<?php echo $nextlink; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      <div class="row">
        <!--Side Bar-->
        
        <div class="col-md-2">
          <?php
          include("includes/product_sidebar.php");
          ?>
        </div>
        
        
        <div class="col-md-10">
        <?php 
          if(count($products) > 0){
            //counter to count columns
            $counter = 0;
            $total = count($products);
            
            foreach($products as $item){
              $id = $item["id"];
              $image = "products/".$item["image_file"];
              $name = $item["name"];
             
              $price = $item["price"];
              
              //increment counter by 1
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
        </div>
        
        
        <div class="row">
          <div class="col-md-12">
            <nav aria-label="Page navigation" class="navbar">
              <ul class="pagination navbar-right">
                <li>
                  <?php //previous
                  if($pagenumber>1){
                    $previous_page = $pagenumber-1;
                    $previous_disable = "";
                  }
                  else{
                    $previous_disable = "disabled";
                  }
                  $previous_link = $_SERVER["PHP_SELF"]."?page=$previous_page&category=$cat_selected";
                  ?>
                  <a <?php echo $previous_disable; ?>href="<?php echo $previous_link; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php
                for($i=0;$i<$total_pages;$i++){
                  $page_label = $i+1;
                  $page_url= $_SERVER["PHP_SELF"]."?page=$page_label&category=$cat_selected";
                  if($page_label==$pagenumber){
                    $page_active = "active";
                  }
                  else{
                    $page_active = "";
                  }
                  echo "<li class=\"$page_active\"><a href=\"$page_url\">$page_label</a></li>";
                }
                ?>
                <li>
                  <?php //previous
                  if($pagenumber < $total_pages){
                    $nextpage = $pagenumber+1;
                    $next_disable="";
                  }
                  else{
                    $next_disable = "disabled";
                  }
                  
                  
                  $nextlink = $_SERVER["PHP_SELF"]."?page=$nextpage&category=$cat_selected";
                  ?>
                  <a <?php echo $next_disable; ?>href="<?php echo $nextlink; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
     </div>
  </body>
</html>