<?php
if(isset($_POST["create_user"])){
    $user_name = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = $_POST['password'];
    $mail        = $_POST['mail'];
    $role= $_POST["role"];
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    //       $post_comment_count = 4;
    $query = "INSERT INTO users (user_name, user_firstname, user_lastname, user_password, user_email, user_role)VALUES ('$user_name', '$firstname', '$lastname', '$hashedPwd', '$mail', '$role')";
    $query_result = mysqli_query($connection,$query);
    confirm($query_result);

    echo "<div class='bg-success'> User added: " . " " . "<a href='users.php'>View All Users</a></div>";
}
?>
<form action="" method="post">


    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname">
    </div>
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname">
    </div>

    <!-- <div class="form-group">
       <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div> -->

    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="" class="form-control">
            <option selected="selected">Choose role</option>
            <option value='admin'>Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>



    <!--<div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file"  name="image" class="form-control-file">
    </div>-->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="mail">Email</label>
        <input type="email" class="form-control" name="mail">
    </div>
    <div class="form-group">
        <label for="passowrd">Password</label>
        <input type="password" class="form-control" name="password">
    </div>





    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>


</form>
