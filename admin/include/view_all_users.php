<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $query = "SELECT * FROM users";
    $query_all_users = mysqli_query($connection, $query);
    confirm($query_all_users);
    while($row = mysqli_fetch_assoc($query_all_users))
    {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];

        echo "<tr>";
        echo"<td>{$user_id}</td>";
        echo"<td>{$user_name}</td>";
        echo"<td>{$user_firstname}</td>";
        echo"<td>{$user_lastname}</td>";
        echo"<td>{$user_email}</td>";
        echo "<td>{$user_role}</td>";

        echo"<td><a href='users.php?admin_role=$user_id'>Admin</a></td>";
        echo"<td><a href='users.php?subscriber_role=$user_id'>Subscriber</a></td>";
        echo"<td><a href='users.php?source=edit&user_id=$user_id'>Edit</a></td>";
        echo"<td><a href='users.php?delete=$user_id'>Delete</a></td>";
        echo"<tr>";
    }

    if(isset($_GET["admin_role"])){
        $user_id = $_GET["admin_role"];
        if(!empty($user_id)){
            $query = "UPDATE users SET user_role='admin' WHERE user_id='$user_id'";
            $query_result = mysqli_query($connection, $query);
            confirm($query_result);
        }
        header("Location: users.php");
    }

    if(isset($_GET["subscriber_role"])){
        $user_id = $_GET["subscriber_role"];
        if(!empty($user_id)){
            $query = "UPDATE users SET user_role='subscriber' WHERE user_id='$user_id'";
            $query_result = mysqli_query($connection, $query);
            confirm($query_result);
        }
        header("Location: users.php");
    }


    if(isset($_GET["delete"])){
        $user_id = $_GET["delete"];
        if(!empty($user_id)){
            $query = "DELETE FROM users WHERE user_id = '$user_id'";
            $query_result = mysqli_query($connection, $query);
            confirm($query_result);
        }
        header("Location: users.php");
    }
    ?>
    </tbody>
</table>