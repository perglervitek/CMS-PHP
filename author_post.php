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
                if(isset($_GET["author"])){
                    $post_author_name = $_GET["author"];
                }
                    $query = "SELECT * FROM posts WHERE post_author='$post_author_name'";
                    $select_all_posts = mysqli_query($connection, $query);
                    if(!$select_all_posts){
                        die ("Chyba vyberu z databaze " . mysqli_error());
                    }
                    while($row = mysqli_fetch_assoc($select_all_posts)){
                        $post_id = $row["post_id"];
                        $post_title = $row["post_title"];
                        $post_author = $row["post_author"];
                        $post_date = $row["post_date"];
                        $post_image = $row["post_image"];
                        $post_content = substr($row["post_content"], 0, 100);
                        $post_content .= "...";
                        ?>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>
                    <?php
                    }
                ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
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
