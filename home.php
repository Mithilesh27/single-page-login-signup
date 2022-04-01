<?php


$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "sampledb"; 

$conn = mysqli_connect($servername, $username, $pwd, $dbname);

// I am Checking connection here. 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
    // echo 'connection succesful';
    
}


//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

// isset($_POST['btnSubmit']
// if ($_SERVER["REQUEST_METHOD"]=="POST"){

if(isset($_POST['signupsubmit'])){

    $signupusername=$_POST['signupusername'];
    $signuppassword=$_POST['signuppassword'];
    $signupcpassword=$_POST['signupcpassword'];

    
    if($signuppassword==$signupcpassword){
        $hash=password_hash($signuppassword, PASSWORD_BCRYPT);

        $sql="INSERT INTO `sampletable` (`name`, `password`) VALUES ('$signupusername', '$hash')";

    $result = mysqli_query($conn , $sql);

    if($result){                                            
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success </strong> Account Created;
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    }else{
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Warning !</strong>Passwords do not match;
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }

}


elseif(isset($_POST['loginsubmit'])){

    $loginusername=$_POST['loginusrname'];
    $loginpassword=$_POST['loginpwd'];

    $sql= "SELECT * FROM `sampletable` WHERE `name`='$loginusername' ";


    $result= mysqli_query($conn, $sql);
    
    $num=mysqli_num_rows($result);

    if($num==1){


        while($rows=mysqli_fetch_assoc($result)){
             if(password_verify($loginpassword, $rows['password'])){
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                     <strong>Success </strong>Login Successful;
                     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                     </div>";
        }
    }
    }
    else{
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Failed  </strong>Login failed;
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
}

else{

}

?>

<!doctype html>



<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
    body {
        background-color: #f0f0f0;
    }

    .login,
    .signup {
        width: 600px;
        margin: 40px;
        background-color: #ffffff;

    }

    .login{
        height: fit-content;
    }
    </style>

</head>

<body>

    <div class="container-fluid">

        <div class="row text-center mt-5">
            <h1>Single Page Login and Signup</h1>
        </div>

        <div class="row gx-5">

            <div class="login shadow-lg p-3 mb-5 rounded-3">

                <form action="home.php" method="POST">

                    <h3>Login</h3>



                    <div class="mb-3">
                        <label for="loginusername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="loginusername" name="loginusrname" placeholder="Enter the username">

                    </div>
                    <div class="mb-3">
                        <label for="loginpassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginpassword" name="loginpwd" placeholder="Enter the password">
                    </div>
                    <div class="text-center ">

                        <button type="submit" class="btn btn-primary" name="loginsubmit">Login</button>
                    </div>
                </form>
            </div>

            <div class="signup shadow-lg p-3 mb-5 rounded-3">
                <form action="home.php" method="POST">
                    <h3>Sign Up</h3>
                    <div class="mb-3">
                        <label for="signupusername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="signupusername" name="signupusername"
                            placeholder="Enter the username">

                    </div>
                    <div class="mb-3">
                        <label for="signuppassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signuppassword" name="signuppassword" placeholder="Enter the password">
                    </div>

                    <div class="mb-3">
                        <label for="signupcpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="signupcpassword" name="signupcpassword"  placeholder="Confirm the password">
                    </div>
                    <div class="text-center">

                        <button type="submit" class="btn btn-primary " name="signupsubmit">Signup</button>
                    </div>
                </form>

            </div>

        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</body>

</html>