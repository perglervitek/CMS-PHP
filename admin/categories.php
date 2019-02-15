<?php
    include("include/admin_header.php");
    include_once ("functions.php");
    ?>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include("include/admin_navigation.php");?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcomte to admin
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">

                        <?php
                            if(isset($_POST["submit"])){
                                insert_category();
                            }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label class="" for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                        <?php
                                if(isset($_GET["edit"])){
                                    ?>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label class="" for="cat_title">Update title</label>
                                        <input class="form-control" type="text" name="cat_title_update">
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="submit_update" value="Update Category">
                                    </div>
                                </form>
                                        <?php
                                }
                                ?>
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category title</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                cat_table();
                            ?>
                            <?php
                                if(isset($_GET["delete"])){
                                    delete();
                                }

                                if(isset($_GET["edit"])){
                                    edit();
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php  include("include/admin_footer.php");?>