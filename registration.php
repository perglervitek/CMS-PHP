<?php  include "include/header.php"; ?>
<?php  include "include/navigation.php"; ?>
<?php
    if(isset($_POST["submit"])){

        if(!empty($_POST["username"])&&!empty($_POST["email"])&&!empty($_POST["password"])){
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
/*
            $user_image        = $_FILES['image']['name'];
            $user_image_tmp   = $_FILES['image']['tmp_name'];

            move_uploaded_file($user_image_tmp, "images/$user_image");
*/
            $user_image_path = "images/" . $_FILES["image"]["name"];
            if(preg_match("!image!", $_FILES["image"]["type"])){
                if(copy($_FILES["image"]["tmp_name"],$user_image_path)){
                    $username = mysqli_real_escape_string($connection, $username);
                    $email = mysqli_real_escape_string($connection, $email);
                    $password = mysqli_real_escape_string($connection,$password);
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    $query = "INSERT INTO users (user_name, user_email, user_password, user_role, user_image) VALUES ('$username','$email', '$hashedPwd', 'subscriber', '$user_image_path')";

                    $register_query = mysqli_query($connection, $query);
                    if(!$register_query){
                        die(mysqli_error($connection));
                    }
                    $message = "Succesfully registred!";
                }else{
                    $message = "Fields cannot be empty";
                }
                }
            }
    }
?>

    <!-- Navigation -->
    

    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form enctype="multipart/form-data" method="post" id="login-form" autocomplete="off">
                        <h6 class="bg-warning text-center">
                            <?php
                            if(isset($_POST["submit"])){
                                if(!empty($message))
                                    echo $message;
                            }
                            ?>
                        </h6>
                        <div class="form-group">
                            <label for="image" class="">Image</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>
