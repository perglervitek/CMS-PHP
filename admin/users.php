<?php include("include/admin_header.php");?>

    <div id="wrapper">
    <?php
        //if($connection){echo "asdasasdasd";}
    ?>
        <!-- Navigation -->
        <?php include("include/admin_navigation.php");?>

        <div id="page-wrapper">

            <div class="container-fluid table-responsive fixed-table-body">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcomte to admin
                            <small>Author</small>
                        </h1>
                        <?php
                            if(isset($_GET["source"])){
                                $source = $_GET["source"];
                            }else{
                                $source = "";
                            }
                        switch($source){
                                case "add_user":
                                    include("include/add_user.php");
                                break;
                                case "edit":
                                    include("include/edit_user.php");
                                break;
                            default:
                                include("include/view_all_users.php");
                                break;
                        }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php  include("include/admin_footer.php");?>