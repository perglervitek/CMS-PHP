<?php
include_once("include/header.php");
?>
<!-- Navigation -->
<?php
include_once("include/navigation.php");
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php

            if(isset($_GET["p_id"])){
                $the_post_id = $_GET["p_id"];
            }
            $query = "SELECT * FROM posts WHERE post_id='$the_post_id'";
            $select_post = mysqli_query($connection, $query);
            if(!$select_post){
                die ("Chyba vyberu z databaze " . mysqli_error());
            }
            while($row = mysqli_fetch_assoc($select_post)){
                $post_title = $row["post_title"];
                $post_author = $row["post_author"];
                $post_date = $row["post_date"];
                $post_image = $row["post_image"];
                $post_content = $row["post_content"];

                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>
                <?php
            }
            ?>


            <!-- Blog Comments -->
            <?php
                if(isset($_POST["create_comment"])){
                    $the_post_id = $_GET["p_id"];
                    $comment_author = $_POST["comment_author"];
                    $comment_email = $_POST["comment_email"];
                    $comment_content = $_POST["comment_content"];
                    if(!empty($comment_author) && !empty($comment_content) && !empty($comment_email))
                    {
                        if(filter_var($comment_email, FILTER_VALIDATE_EMAIL)){
                            $query= "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES('$the_post_id', '$comment_author', '$comment_email', '$comment_content','unapproved', now())";
                            $query_result = mysqli_query($connection, $query);
                            if(!$query_result){
                                die(mysqli_error($connection));
                            }
                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id='$the_post_id'";
                            $query_result = mysqli_query($connection, $query);
                            if(!$query_result){
                                die(mysqli_error($connection));
                            }
                        }
                        }else{
                        echo "<script>alert('Fields cant be empty')</script>";
                    }
                }
            ?>



            <!-- Comment -->
            <?php
            $query = "SELECT comment_author, comment_date, comment_content FROM comments WHERE comment_post_id = {$the_post_id} AND comment_status='approved' ORDER BY comment_id DESC";
            $query_result = mysqli_query($connection, $query);
            if(!$query_result){
                die(mysqli_error($connection));
            }
            while($comment = mysqli_fetch_assoc($query_result)){
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment["comment_author"]?>
                            <small><?php echo $comment["comment_date"]?></small>
                        </h4>
                        <?php echo $comment["comment_content"];?>
                    </div>
                </div>
                <?php
            }


            ?>
            </div>
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input class="form-control"type="text" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input class="form-control" type="email" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="Comment">Comment</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->






        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php
        include("include/sidebar.php");
        ?>

    </div>
    <!-- /.row -->

    <hr>
    <?php
    include("include/footer.php");
    ?>
