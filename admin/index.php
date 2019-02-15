<?php include("include/admin_header.php");?>

    <div id="wrapper">
    <?php
        //if($connection){echo "asdasasdasd";}
    ?>
        <!-- Navigation -->
        <?php include("include/admin_navigation.php");?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcomte to admin
                            <small>
                                <?php
                                    echo $_SESSION["firstname"] . " " . $_SESSION["lastname"];
                                ?>
                            </small>
                        </h1>
                        <!--<ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>-->
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php
                                                $query = "SELECT post_id FROM posts";
                                                $query_result = mysqli_query($connection, $query);
                                                confirm($query_result);
                                                $post_num = mysqli_num_rows($query_result);
                                                echo $post_num;
                                            ?>
                                        </div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php
                                            $query = "SELECT comment_id FROM comments";
                                            $query_result = mysqli_query($connection, $query);
                                            confirm($query_result);
                                            $comment_num = mysqli_num_rows($query_result);
                                            echo $comment_num;
                                            ?>
                                        </div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php
                                            $query = "SELECT user_id FROM users";
                                            $query_result = mysqli_query($connection, $query);
                                            confirm($query_result);
                                            $users_num = mysqli_num_rows($query_result);
                                            echo $users_num;
                                            ?>
                                        </div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php
                                            $query = "SELECT cat_id FROM categories";
                                            $query_result = mysqli_query($connection, $query);
                                            confirm($query_result);
                                            $cat_num = mysqli_num_rows($query_result);
                                            echo $cat_num;
                                            ?>
                                        </div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                    $query = "SELECT post_id FROM posts WHERE post_status='published'";
                    $query_result = mysqli_query($connection,$query);
                    confirm($query_result);
                    $active_num = mysqli_num_rows($query_result);
                    $draft_num = $post_num - $active_num;
                ?>
                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['bar']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ["Data", "Count"],
                                <?php
                                    $text = ["Active Posts", "Draft Posts", "Categories", "Users", "Comments"];
                                    $count = [$active_num, $draft_num, $cat_num, $users_num, $comment_num];
                                    for($i = 0; $i < count($text); $i++){
                                        echo "['{$text[$i]}'" . "," . "'{$count[$i]}'],";
                                    }
                                ?>

                            ]);

                            var options = {
                                chart: {
                                    title: 'Web statistic',

                                }

                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php  include("include/admin_footer.php");?>