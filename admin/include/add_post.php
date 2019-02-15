<?php
    if(isset($_POST["create_post"])){
        $post_title        = $_POST['title'];
        $post_user         = $_POST['post_user'];
        $post_category_id  = $_POST['post_category'];
        $post_status       = $_POST['post_status'];

        $post_image        = $_FILES['image']['name'];
        $post_image_temp   = $_FILES['image']['tmp_name'];

        $post_tags         = $_POST['post_tags'];
        $post_content      = $_POST['post_content'];
        $post_date         = date('d-m-y');
 //       $post_comment_count = 4;
        $query = "INSERT INTO posts (post_tags, post_status, post_category_id, post_title, post_author, post_date ,post_image, post_content
)VALUES ('$post_tags', '$post_status', '$post_category_id', '$post_title', '$post_user', now(),'$post_image', '$post_content')";
        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query_result = mysqli_query($connection,$query);
        confirm($query_result);

        echo "<div class='bg-success'>Post added: " . " " . "<a href='posts.php'>View All Posts</a></div>";
    }
?>
<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select name="post_category" id="" class="form-control">
            <?php
                $query= "SELECT * FROM categories";
                $query_result = mysqli_query($connection, $query);
                if(!$query_result){
                    die(mysqli_error());
                }
                while($row = mysqli_fetch_assoc($query_result)){
                    $id = $row['cat_id'];
                    $title = $row['cat_title'];
                    echo"<option value='{$id}'>{$title}</option>";
                }
            ?>
        </select>

    </div>

    <div class="form-group">
        <label for="title">Post Author</label>
        <input type="text" class="form-control" name="post_user">
    </div>


    <!-- <div class="form-group">
       <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div> -->



    <div class="form-group">
        <select name="post_status" id="" class="form-control">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>



    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file"  name="image" class="form-control-file">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control "name="post_content" id="body" cols="30" rows="10"></textarea>
        <script>
            CKEDITOR.replace( 'body' );
        </script>
    </div>



    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>


</form>
    