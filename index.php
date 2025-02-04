<!DOCTYPE html>
<html lang="en">
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
                    $query = "SELECT * FROM posts";
                    $select_all_posts = mysqli_query($connection, $query);
                    if(!$select_all_posts){
                        die ("Chyba vyberu z databaze " . mysqli_error($connection));
                    }
                    while($row = mysqli_fetch_assoc($select_all_posts)){
                        $post_id = $row["post_id"];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_image = $row["post_image"];
                        $post_content = substr($row["post_content"], 0, 100);
                        $post_content .= "...";
                        $post_status = $row["post_status"];
                        $post_status =strtoupper($post_status);
                        if($post_status == "PUBLISHED"){
                            ?>
                            <!-- First Blog Post -->
                            <h2>
                                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                            </h2>
                            <p class="lead">
                                <a href="author_post.php?author=<?php echo $post_author;?>"><?php echo $post_author; ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                            <hr>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image;?>" alt=""></a>
                            <hr>
                            <p><?php echo $post_content; ?></p>
                            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>
                            <?php
                        }
                        }
                ?>

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
