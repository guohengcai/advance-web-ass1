<?php
session_start();
include("includes/database.php");

//Process Login
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $name = $_POST["user"];
  $password = $_POST["password"];
  
  if(filter_var($name,FILTER_VALIDATE_EMAIL)){
    $login_query = "SELECT * FROM accounts WHERE email=?";
  }
  else{
    $login_query = "SELECT * FROM accounts WHERE name=?";
  }
  //$result = $connection->query($login_query);
  $statement = $connection->prepare($login_query);
  //there are four different types
  //"s" is string
  //"i" is integer
  //"d" is double (or float)
  //"b" is blob (binary data, eg image)
  
  $statement->bind_param("s", $name);

  $statement->execute();
  $result = $statement->get_result();
  
  if($result->num_rows > 0){
    $userdata = $result->fetch_assoc();
    //check if password matches the one in database
    $stored = $userdata["password"];
    $user_id = $userdata["id"];
    $user_name = $userdata["name"];
    $user_email = $userdata["email"];
    if(password_verify($password,$stored)){
      //user has entered the correct password
      //echo "Welcome!";
      $_SESSION["id"] = $user_id;
      $_SESSION["username"] = $user_name;
      $_SESSION["email"] = $user_email;
    }
    else{
      echo "Wrong credentials supplied";
    }
  }
  else{
    echo "account does not exist";
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
        <div class="col-md-4 col-md-offset-4">
          <h2>Login to your account</h2>
          <form id="register-form" action="login.php" method="post">
            <div class="form-group">
              <label for="user">Username or email</label>
              <input class="form-control" type="text" id="user" placeholder="user name or email" name="user">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input class="form-control" type="password" id="password" placeholder="your password" name="password">
            </div>
            <div class="text-center">
              <button class="btn btn-info" type="submit">Log In</button>
            </div>
          </form>
          <div class="text-center">
            <p>
              Don't have an account yet? 
              <a href="register.php">Register</a>
              for an account
            </p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>