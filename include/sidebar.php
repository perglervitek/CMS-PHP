<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
            </div>
        </form>

        <!-- /.input-group -->
    </div>

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Login</h4>

        <form method="post" action="include/login.php">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
            </div>

            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                       <button class="btn btn-primary" name="login" type="submit">
                           Submit
                       </button>
                    </span>
            </div>
        </form>

        <!-- /.input-group -->
    </div>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
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
                </ul>
            </div>
            <!-- /.col-lg-6 -->
            <!--
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                </ul>
            </div> -->
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php
        include("widget.php");
    ?>

</div>