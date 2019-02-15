<?php
if(isset($_GET["user_id"])){
    $user_id = $_GET["user_id"];
}

$query = "SELECT * FROM users WHERE user_id='$user_id'";
$query_result = mysqli_query($connection, $query);
confirm($query_result);

while($row = mysqli_fetch_assoc($query_result)){
    $username = $row["user_name"];
    $firstname = $row["user_firstname"];
    $lastname = $row["user_lastname"];
    $role = $row["user_role"];
    $mail = $row["user_email"];
}

if(isset($_POST["edit_user"])){
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $mail = $_POST['mail'];
    $role= $_POST["role"];
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    //       $post_comment_count = 4;
    $query = "UPDATE users SET ";
    $query .= "user_name  = '{$username}', ";
    $query .= "user_password = '{$hashedPwd}',";
    $query .= "user_firstname  = '{$firstname}', ";
    $query .= "user_lastname  = '{$lastname}', ";
    $query .= "user_email     = '{$mail}', ";
    $query .= "user_role   = '{$role}' ";
    $query .= "WHERE user_id = {$user_id} ";
    $query_result = mysqli_query($connection,$query);
    confirm($query_result);

    echo "<div class='bg-success'> User edited: " . " " . "<a href='users.php'>View All Users</a></div>";
}
    ?>
<form action="" method="post">


    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname" value="<?php echo $firstname;?>">
    </div>
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname;?>">
    </div>

    <!-- <div class="form-group">
       <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div> -->

    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="" class="form-control">
             <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
       <?php

          if($role == 'admin') {

             echo "<option value='subscriber'>subscriber</option>";

          } else {

            echo "<option value='admin'>admin</option>";

          }?>
        </select>
    </div>



    <!--<div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file"  name="image" class="form-control-file">
    </div>-->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username;?>">
    </div>

    <div class="form-group">
        <label for="mail">Email</label>
        <input type="email" class="form-control" name="mail" value="<?php echo $mail?>">
    </div>
    <div class="form-group">
        <label for="passowrd">Password</label>
        <input type="password" class="form-control" name="password">
    </div>





    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>


</form>
