<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">


                <?php
                include("db.php");
                $query = "SELECT * FROM categories LIMIT 10";
                $query_cat_result= mysqli_query($connection, $query);
                if(!$query_cat_result){
                die("Chyba vypisu kategorie " . mysqli_error());
                }
                while($row = mysqli_fetch_assoc($query_cat_result)){
                $category = $row["cat_title"];
                $cat_id = $row["cat_id"];
                echo "<li><a href='category.php?category=$cat_id'>{$category}</a></li>";
                }
                ?>

                <li>
                    <a href="registration.php">Registration</a>
                </li>
                <li>
                    <a href="admin">Admin</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>