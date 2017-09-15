<?php
//start session
session_start();
//include database connection
include("includes/database.php");

//handle GET data
if($_GET["productid"]){
  $productid = $_GET["productid"];
}
else{
  //if no product is being requested
  //redirect to shop page
  header("location: products.php");
}

if(isset($productid)){
  $query = "SELECT 
  products.id AS id,
  products.name AS name,
  products.description AS description,
  products.brand AS brand,
  products.price AS price,
  products.details1 As details1,
  products.details2 As details2,
  products.details3 As details3,
  products.details4 As details4,
  images.image_file AS image
  FROM products 
  INNER JOIN products_images
  ON products.id = products_images.product_id
  INNER JOIN images
  ON products_images.image_id = images.image_id
  WHERE products.id=?";
  $statement = $connection -> prepare( $query );
  $statement -> bind_param( "i" , $productid );
  $statement -> execute();
  $result = $statement -> get_result();
  $product = $result -> fetch_assoc();
  //make variables with each column
  $id = $product["id"];
  $Pname = $product["name"];
  $price = $product["price"];
  $image = $product["image"];
  $details1 = $product["details1"];
  $details2 = $product["details2"];
  $details3 = $product["details3"];
  $details4 = $product["details4"];
  $description = $product["description"];
}
?>

<!doctype html>

<html>
  <?php include("includes/head.php"); ?>
  <body>
    <?php include("includes/navigation.php"); ?>
    
    <div class="container">
      
       <div class="col-md-6">
          <div class="row">
      
                <img src= "<?php echo "images/$image" ; ?> "  style = "    height: 50%; width: 90%;; margin: 0 auto; padding-bottom: 30px;" >
                

          </div>
        </div>
      
        <div class="col-md-6" style=" padding-top: 30px; padding-left: 30px;">
             <div class="row">
                <h3 class="product"><?php echo $Pname ?></h3>
                <h3 class="product"><?php echo $price ?></h3>       
           </div>
           
        
           <div class="row">
             <div class="col-md-3">
           <div class ="left"style="padding-top: 30px;">
             <lable for "quantity" >Quantity</lable>
             <input type="number"min="1" size="4" class = "quantity" 
              name="quantity" id="quantity" value="1" max="55">
             </div>
             </div>
             
             <div class="col-md-6" style="padding-top: 15px;">
             <div class="purchase"style=" margin-top: 15px;">
             <button type ="submit" name="add" class "action_button_add_to_cart"
             data-lable="Add to Cart" style=" background: #00aeef; border: 20px;
                          padding: 14px;
                          font-size: 14px;
                          text-align: center; ">
               
              <span class ="text">Add to Cart</span>
              </button>
            </div>
            </div>
           </div>
        
            </div>
            </div>
            
 <div class="container">
     
     <div class="row">
        <div class="col-md-6">
          
            <h3 class="headers">DESCRIPTION</h3>
            <P class="content"><?php echo $description ?></p>
            </div>
            
            
            
            <div class="col-md-6">
            
            
               <h3 class="headers">DETAILS</h3>
               
            <P class="content"><?php echo $details1 ?></p>
            <P class="content"><?php echo $details2 ?></p>
            <P class="content"><?php echo $details3 ?></p>
            <P class="content"><?php echo $details4 ?></p>
               </div>
        </div>
                            
        
        </div>



</div>
</div>
</body>
</html>
