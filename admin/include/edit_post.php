<?php
if(isset($_GET["p_id"])){
    $the_post_id = $_GET["p_id"];
}
$query = "SELECT * FROM posts WHERE post_id='$the_post_id'";
$query_all_posts = mysqli_query($connection, $query);
confirm($query_all_posts);

while($row = mysqli_fetch_assoc($query_all_posts)) {
    $post_id = $row['post_id'];
    $post_tags = $row['post_tags'];
    $post_comment = $row['post_comment_count'];
    $post_status = $row['post_status'];
    $post_cat_id = $row['post_category_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
}

if(isset($_POST["edit_post"])){
    $post_title        = $_POST['title'];
    $post_user         = $_POST['post_user'];
    $post_category_id  = $_POST['post_category'];
    $post_status       = $_POST['post_status'];

    $post_image        = $_FILES['image']['name'];
    $post_image_temp   = $_FILES['image']['tmp_name'];

    $post_tags         = $_POST['post_tags'];
    $post_content      = $_POST['post_content'];
    $post_date         = date('d-m-y');
    $post_comment_count = 4;

    move_uploaded_file($post_image_temp, "../images/$post_image");
    if(empty($post_image)){
        $query= "SELECT * FROM posts WHERE post_id='$the_post_id'";
        $query_result = mysqli_query($connection, $query);
        confirm($query_result);
        while($row = mysqli_fetch_array($query_result)){
            $post_image = $row["post_image"];
        }
    }
    $query = "UPDATE posts SET ";
    $query .= "post_title  = '{$post_title}', ";
    $query .= "post_category_id = {$post_category_id}, "; // --> I removed single quotes around integer value, those are not required.
    $query .= "post_date    = now(), ";
    $query .= "post_author  = '{$post_user}', ";
    $query .= "post_status  = '{$post_status}', ";
    $query .= "post_tags     = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image   = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} ";

    $query_result = mysqli_query($connection,$query);
    confirm($query_result);

    echo "<div class='bg-success'> Post edited: " . " " . "<a href='posts.php'>View All Posts</a></div>";
}
?>
<form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>
    <?php
    $query ="SELECT cat_title FROM categories WHERE cat_id ='$post_cat_id'";
    $query_result= mysqli_query($connection, $query);
    if(!$query_result){
        die(mysqli_error());
    }
    $post_cat_name = mysqli_fetch_assoc($query_result);
    ?>
    <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control"name="post_category" id="">

            <option selected="selected" value="<?php echo $post_cat_id; ?>"><?php echo $post_cat_name["cat_title"];?></option>
            <?php
            $query= "SELECT cat_title, cat_id FROM categories";
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
        <input value="<?php echo $post_author;?>"type="text" class="form-control" name="post_user">
    </div>


    <!-- <div class="form-group">
       <label for="title">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div> -->



    <div class="form-group">
        <select value="<?php echo $post_status;?>"name="post_status" id="" class="form-control">
            <option value="<?php echo $post_status;?>"><?php echo $post_status;?></option>
            <?php
                if($post_status == "published"){
                     echo "<option value=\"draft\">draft</option>";
                }else{
                    echo "<option value=\"published\">publish</option>";
                }
            ?>
        </select>
    </div>



    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img width="100px" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file"  name="image" class="form-control-file">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags;?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control "name="post_content" id="" cols="30" rows="10"><?php echo $post_content;?></textarea>
    </div>



    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_post" value="Edit Post">
    </div>


</form>
