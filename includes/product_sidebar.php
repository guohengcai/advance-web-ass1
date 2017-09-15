<?php
//Get all categories
//$cat_query = "SELECT id,name FROM categories";
$cat_query = 
"SELECT
categories.name AS name, 
products_categories.category_id AS id,
COUNT(products_categories.category_id) AS cat_count
FROM products_categories 
INNER JOIN categories 
ON products_categories.category_id = categories.id 
GROUP BY products_categories.category_id";
$cat_statement = $connection->prepare($cat_query);
$cat_statement->execute();
$cat_result = $cat_statement->get_result();
?>
<!--Categories-->
<h4>Filter by Categories</h4>
<!--Start of nav list-->
<ul class="nav nav-stacked nav-pills">

<?php
//All Categories link
$cat_url = $self."?page=".$pagenumber."&category=0";
if($cat_selected==0){
  $cat_active = "class=\"active\"";
}
else{
  $cat_active = "";
}
echo "<li $cat_active>
      <a href=\"$cat_url\" data-id=\"$cat_id\">
      All
      </a>
      </li>";
//Each of the categories from database
if($cat_result->num_rows > 0){
  while($cat_row = $cat_result->fetch_assoc()){
    $cat_name = $cat_row["name"];
    $cat_id = $cat_row["id"];
    $cat_count = $cat_row["cat_count"];
    //$cat_url = $self."?page=".$pagenumber."&category=".$cat_id;
    $cat_url = $self."?page=1&category=".$cat_id;
    if($cat_selected==$cat_id){
      $cat_active = "class=\"active\"";
    }
    else{
      $cat_active = "";
    }
    echo "<li $cat_active>
          <a href=\"$cat_url\" data-id=\"$cat_id\">
          $cat_name <span class=\"badge\">$cat_count</span>
          </a>
          </li>";
  }
}
?>

</ul>
<!--End of nav list-->