<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM comments";
    $query_all_cmmts = mysqli_query($connection, $query);
    confirm($query_all_cmmts);
    while($row = mysqli_fetch_assoc($query_all_cmmts))
    {
        $cmmt_id = $row['comment_id'];
        $cmmt_author = $row['comment_author'];
        $cmmt_content = $row['comment_content'];
        $cmmt_email = $row['comment_email'];
        $cmmt_status = $row['comment_status'];
        $cmmt_site_id = $row['comment_post_id'];
        $cmmt_date = $row['comment_date'];

        echo "<tr>";
        echo"<td>{$cmmt_id}</td>";
        echo"<td>{$cmmt_author}</td>";
        echo"<td>{$cmmt_content}</td>";
        echo"<td>{$cmmt_email}</td>";
        echo"<td>{$cmmt_status}</td>";

        $query1 ="SELECT post_title, post_id FROM posts WHERE post_id ='$cmmt_site_id'";
        $query_result= mysqli_query($connection, $query1);
        confirm($query_result);
        $post_name = mysqli_fetch_assoc($query_result);

        echo"<td><a href='../post.php?p_id={$post_name["post_id"]}'>{$post_name["post_title"]}</a></td>";
        echo"<td>{$cmmt_date}</td>";
        echo"<td><a href='comments.php?approve=$cmmt_id'>Approve</a></td>";
        echo"<td><a href='comments.php?unapprove=$cmmt_id'>Unapprove</a></td>";
        echo"<td><a href='comments.php?delete=$cmmt_id'>Delete</a></td>";
        echo"<tr>";
    }

    if(isset($_GET["approve"])){
        $comment_id = $_GET["approve"];
        if(!empty($comment_id)){
            $query = "UPDATE comments SET comment_status='approved' WHERE comment_id='$comment_id'";
            $query_result = mysqli_query($connection, $query);
            confirm($query_result);
        }
        header("Location: comments.php");
    }

    if(isset($_GET["unapprove"])){
        $comment_id = $_GET["unapprove"];
        if(!empty($comment_id)){
            $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id='$comment_id'";
            $query_result = mysqli_query($connection, $query);
            confirm($query_result);
        }
        header("Location: comments.php");
    }

    if(isset($_GET["delete"])){
        $comment_id = $_GET["delete"];
        if(!empty($cmmt_id)){
            $query = "DELETE FROM comments WHERE comment_id = '$comment_id'";
            $query_result = mysqli_query($connection, $query);
            confirm($query_result);
        }
        header("Location: comments.php");
    }
    ?>
    </tbody>
</table>