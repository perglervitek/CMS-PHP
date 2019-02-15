<?php include("include/admin_header.php");
    if (isset($_SESSION["username"])){
        $username = $_SESSION["username"];
        $query = "SELECT * FROM users WHERE user_name='$username'";
        $query_result = mysqli_query($connection, $query);
        confirm($query_result);
        while($row = mysqli_fetch_array($query_result)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_email = $row['user_email'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_role = $row['user_role'];
        }
    }
    if (isset($_POST["edit_profile"])){
        $user_name = $_POST["username"];
        $user_firstname = $_POST["firstname"];
        $user_lastname = $_POST["lastname"];
        $user_password = $_POST["password"];
        $user_email = $_POST["mail"];
        $user_role = $_POST["role"];

        $query = "UPDATE users SET user_name = '$user_name', user_firstname='$user_firstname', user_lastname='$user_lastname', user_email = '$user_email', user_password = '$user_password', user_role='$user_role' WHERE user_name='$username'";
        $query_result = mysqli_query($connection, $query);
        confirm($query_result);
    }

?>

    <div id="wrapper">
    <?php
        //if($connection){echo "asdasasdasd";}
    ?>
        <!-- Navigation -->
        <?php include("include/admin_navigation.php");?>

        <div id="page-wrapper">

            <div class="container-fluid table-responsive fixed-table-body">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcomte to admin
                            <small>Author</small>
                        </h1>
                        <form action="" method="post">


                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input type="text" class="form-control" name="firstname" value="<?php echo $user_firstname;?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="text" class="form-control" name="lastname" value="<?php echo $user_lastname;?>">
                            </div>

                            <!-- <div class="form-group">
                               <label for="title">Post Author</label>
                                <input type="text" class="form-control" name="author">
                            </div> -->

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="" class="form-control">
                                    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                                    <?php

                                    if($user_role == 'admin') {

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
                                <input type="text" class="form-control" name="username" value="<?php echo $user_name;?>">
                            </div>

                            <div class="form-group">
                                <label for="mail">Email</label>
                                <input type="email" class="form-control" name="mail" value="<?php echo $user_email?>">
                            </div>
                            <div class="form-group">
                                <label for="passowrd">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_profile" value="Edit Profile">
                            </div>


                        </form>

        </div>
        <!-- /#page-wrapper -->

<?php  include("include/admin_footer.php");?>