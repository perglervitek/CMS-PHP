<?php
if(isset($_POST["checkBoxArray"]) && isset($_POST["bulk_options"])){
    foreach ($_POST["checkBoxArray"] as  $checkBoxValue){
        $bulk_options = $_POST["bulk_options"];
        switch ($bulk_options){
            case "published":
                $query = "UPDATE posts SET post_status='$bulk_options' WHERE post_id='$checkBoxValue' ";
                $query_result = mysqli_query($connection,$query);
                confirm($query_result);
                break;
            case "draft":
                $query = "UPDATE posts SET post_status='$bulk_options' WHERE post_id='$checkBoxValue' ";
                $query_result = mysqli_query($connection,$query);
                confirm($query_result);
                break;
            case "delete":
                $query = "DELETE FROM posts WHERE post_id='$checkBoxValue'";
                $query_result = mysqli_query($connection,$query);
                confirm($query_result);
                break;
            case "duplicate":
                $query = "INSERT INTO posts (post_tags, post_status, post_category_id, post_title, post_author, post_date ,post_image, post_content )";
                $query .= "SELECT post_tags, post_status, post_category_id, post_title, post_author, now() ,post_image, post_content";
                $query .= " posts WHERE post_id='{$checkBoxValue}'";
                $query_result = mysqli_query($connection, $query);
                confirm($query_result);
                break;
        }
    }
}
?>
<table class="table table-bordered table-hover">
<form method="post" action="">
    <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options" id="">

            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="duplicate">Duplicate</option>



            <?php
            /*$query= "SELECT DISTINCT post_status FROM posts";
            $query_result = mysqli_query($connection, $query);
            confirm($query_result);
            while($row = mysqli_fetch_assoc($query_result)){
                $status = $row['post_status'];
                echo"<option value='$status'>{$status}</option>";
            }*/
            ?>
        </select>
    </div>
    <div class="col-xs-4">
        <input class="btn btn-success" type="submit" name="submit" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>


    <thead>
    <tr>
        <th><input type="checkbox" id="selectAllBoxes"> </th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM posts";
    $query_all_posts = mysqli_query($connection, $query);
    if(!$query_all_posts){
        die(mysqli_error());
    }
    while($row = mysqli_fetch_assoc($query_all_posts))
    {
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

        echo "<tr>";
        ?>
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $post_id;?>"></td>
        <?php
        echo"<td>{$post_id}</td>";
        echo"<td>{$post_author}</td>";
        echo"<td>{$post_title}</td>";

        $query1 ="SELECT cat_title FROM categories WHERE cat_id ='$post_cat_id'";
        $query_result= mysqli_query($connection, $query1);
        if(!$query_result){
            die(mysqli_error());
        }
        $post_cat_name = mysqli_fetch_assoc($query_result);

        echo"<td>{$post_cat_name["cat_title"]}</td>";
        echo"<td>{$post_status}</td>";
        ?>
        <td><img width="100px" class="img-responsive" src="../images/<?php echo $post_image;?>" alt="" ></td>
        <?php
        echo"<td>{$post_tags}</td>";
        echo"<td>{$post_comment}</td>";
        echo"<td>{$post_date}</td>";
        echo "<td><a href='../post.php?p_id=$post_id'>View post</a></td>";
        echo"<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
        echo"<td><a onClick=\"javascript: return confirm('Do you really want to delete?')\" href='posts.php?delete=$post_id'>Delete</a></td>";
        echo"<tr>";
    }

    if(isset($_GET["delete"])){
        if(!empty($post_id)){
            $query = "DELETE FROM posts WHERE post_id = '$post_id'";
            $query_result = mysqli_query($connection, $query);
            confirm($query_result);
        }
        header("Location: posts.php");
    }
    ?>
    </tbody>
</table>
</form>