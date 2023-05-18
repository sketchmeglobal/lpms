<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 09-07-17
 * Time: xx:xx
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$tab_title.' | '.WEBSITE_NAME?></title>
    <meta name="description" content="admin panel">

    <!-- common head -->
    <?php $this->load->view('components/_common_head'); //left side menu ?>
    <!-- /common head -->

    <!-- Start grocerycrud JS & STYLES -->
    <?php
    if(!empty($output)){
    foreach($css_files as $file):
        ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
    <?php
    endforeach;
    foreach($js_files as $file):
    ?>
        <script src="<?php echo $file; ?>"></script>
        <?php
    endforeach;
    }
    ?>
    <!--  End grocerycrud JS & STYLES  -->
    <style type="text/css">
        .dataTablesContainer{overflow-x: scroll;}
    </style>
</head>

<body class="sticky-header">

<section>
    <!-- sidebar left start (Menu)-->
    <?php $this->load->view('components/left_sidebar'); //left side menu ?>
    <!-- sidebar left end (Menu)-->

    <!-- body content start-->
    <div class="body-content" style="min-height: 1500px;">

        <!-- header section start-->
        <?php $this->load->view('components/top_menu'); ?>
        <!-- header section end-->

        <!-- page head start-->
        <div class="page-head">
            <h3 class="m-b-less">
                <?=$menu_name;?>
            </h3>
            <!--<span class="sub-title">Welcome to Static Table</span>-->
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> <?=$menu_name;?> </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            <?=$section_heading;?>
                        </header>
                        <div class="panel-body">
                        
                        <!-- User Permission Area -->

                            <!-- <?php # if($tab_title == 'User Permission'){
                                // echo '<form method="get" action="">';
                                // echo '<select name="username" style="width: 200px;padding: 0.5%;background: #708090;color: #fff;">';
                                // echo '<option>Select From The List</option>';
                                // foreach ($active_users as $au) 
                                ?>
                                    <option class="form-control" value="<?= $au->user_id ?>"><?= $au->username ?></option>
                                <?php
                                // echo '</select><input name="user_permission" class="btn btn-success" style="padding: 0.5%;" value="View" type="submit" /></form>';
                            //} ?> -->

                        <!-- User Permission Area Ends-->

                            <?php echo $add_button; ?>
                            <?php echo $output; ?>
                        </div>
                    </section>
                </div>
            </div>

        </div>
        <!--body wrapper end-->


        <!--footer section start-->
        <?php $this->load->view('components/footer'); ?>
        <!--footer section end-->

    </div>
    <!-- body content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<!--<script src="--><?//=base_url();?><!--assets/admin_panel/js/jquery-1.10.2.min.js"></script>-->
<!--<script src="--><?//=base_url();?><!--assets/admin_panel/js/jquery-migrate.js"></script>-->

<!-- common js -->
<?php $this->load->view('components/_common_js'); //left side menu ?>
<!-- /common js -->

<?php
//open print page
if(isset($print)){
    ?>
    <script>window.open("<?=base_url($print);?>");</script>
    <?php
}
?>

<script>
    //making required fields label color red
    $("span.required").parents('div.form-display-as-box').css("color", "red");
</script>

</body>
</html>