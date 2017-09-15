<?php
include("includes/database.php");

// handle incoming data
$method = $_SERVER["REQUEST_METHOD"];
if($method == "POST"){
  $errors = array();
  $username = $_POST["username"];
  //check if username > 16 chrs
  if(strlen($username)>16){
    $errors["username"] = "username too long";
  }
  $email = $_POST["email"];
  //make user email is valid
  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $errors["email"] = "email address invalid"; 
  }
  $password1 = $_POST["password1"];
  $password2 = $_POST["password2"];
  if($password1 !== $password2){
    $errors["password"] = "passwords do not match";
  }
  
  $errorscount = count($errors);
  if($errorscount==0){
    //insert data into database
  }
}
?>
<!doctype html>
<html>
    <?php
    
    $page_title = "Home Page";
    include("includes/head.php");
    ?>
    <body>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
        <a href="index.php" class="navbar-brand">
          Hello
        </a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li class="active">
            <a href="index.php">Home</a>
          </li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        </div>
      </nav>  
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-xs-6">
            <h3>Column One</h3>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. 
            </p>
          </div>
          <div class="col-md-4 col-xs-6">
            <h3>Column Two</h3>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. 
            </p>
          </div>
          <div class="col-md-4">
            <h3>Column Three</h3>
            <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. 
            </p>
          </div>
        </div>
        <!--Register Form-->
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form id="register-form" action="index.php" method="post">
              <h2>Register For An Account</h2>
              <?php
              if($errors["username"]){
                $usernameclass = "has-error";
              }
              ?>
              <div class="form-group <?php echo $usernameclass;?> ">
                <label for="username">User Name</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="maximum 16 characters"
                value="<?php echo $username; ?>">
                <span class="help-block">
                  <?php echo $errors["username"];?>
                </span>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="user@domain.com">
              </div>
              <div class="form-group">
                <label for="password1">Password</label>
                <input type="password" name="password1" class="form-control" id="password1" placeholder="minimum 8 characters">
              </div>
              <div class="form-group">
                <label for="password2">Confirm Password</label>
                <input type="password" name="password2" class="form-control" id="password2" placeholder="retype your password">
              </div>
              <div class="form-buttons text-center">
                <button type="submit" name="submit" value="register" class="btn btn-info">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </body>
</html>