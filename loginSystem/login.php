<?php
  $login=false;
  $showError=false;
  
if($_SERVER["REQUEST_METHOD"]=='POST'){
include 'partials/_dbconnect.php';
$useranme=$_POST['username'];
$password=$_POST['password'];
// $cpassword=$_POST['cpassword'];

// $exists=false;

// $sql="SELECT * FROM `users` WHERE `username`='$useranme' AND `password`='$password'";
$sql="SELECT * FROM `users` WHERE `username`='$useranme' ";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
if($num=1){
    while($row=mysqli_fetch_assoc($result)){
        if(password_verify($password, $row['password'])){
        $login=true;

        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        header("location: welcome.php");//this will send to the redirected page after session start
        
    }
    else{
        $showError="Invalid Credentials";
    }
} 
}

else{
    $showError="Invalid Credentials";
}
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
        <?php
                require 'partials/_nav.php';
             ?>
            <?php
                    if($login){
                   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> You are logged in.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                    }
                    if($showError){
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                             <strong>Oops!</strong> '. $showError.'
                             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                             </div>';
                         }
            ?>

        <div class="conatiner my-2">
            <h1 class="text-center">Login to our website</h1>
            <!-- form from bootsrap -->
            <form action="/loginsystem/login.php" method="post">
                <div class="mb-3 col-md-6 my-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                              
                <button type="submit" class="btn btn-primary">Login</button>
            </form>


        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>