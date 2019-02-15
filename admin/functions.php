<?php
function confirm($query_result){
    global $connection;
    if(!$query_result){
        die("Failed " . mysqli_error($connection));
    }
}

function insert_category(){
    global $connection;
    $cat = $_POST["cat_title"];
    $category = mysqli_escape_string($connection,$cat);
    if($category =="" || empty($category)){
        echo "<p class='bg-warning'>This field can not be empty</p>";
    }else{
        $query = "INSERT INTO categories(cat_title) VALUES('$category')";
        $result_insert = mysqli_query($connection, $query);
        if(!$result_insert){
            die (mysqli_error());
        }
    }
}

function cat_table(){
    global $connection;
    //vypise kategorie query
    $query= "SELECT * FROM categories";
    $query_result = mysqli_query($connection, $query);
    if(!$query_result){

        echo "<tr>";
        echo "<td colspan='2'>Oops, Something went wrong!!!</td>";
        echo "<tr>";
    }
    while($row = mysqli_fetch_assoc($query_result)){
        $id = $row["cat_id"];
        $title = $row["cat_title"];
        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$title}</td>";
        echo "<td><a href='categories.php?edit={$id}'>Edit</a></td>";
        echo "<td><a href='categories.php?delete={$id}'>Delete</a></td>";
        echo "<tr>";
    }
}

function delete(){
    global  $connection;
    $deleteId = $_GET["delete"];
    $query = "DELETE FROM categories WHERE cat_id='$deleteId'";
    $queryDelete = mysqli_query($connection, $query);
    if(!$queryDelete){
        echo "<p class='bg-danger'>Category was not deleted</p>";
    }
    header("Location: categories.php");
}

function edit(){
    global $connection;
    $editId = $_GET["edit"];
    if(isset($_POST["submit_update"])){
        $editTitle = $_POST["cat_title_update"];
        $query = "UPDATE categories SET cat_title='$editTitle' WHERE cat_id='$editId'";
        $query_update = mysqli_query($connection,$query);
        if(!$query_update){
            echo "<p class='bg-danger'>asdasd</p>";
        }
        header("Location: categories.php");
    }
}
