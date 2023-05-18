<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 09:55
 */
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Office Invoice Json | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="edit Purchase Order">

     <!--Data Table-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/css/buttons.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/css/responsive.bootstrap.min.css"/>

    <!--Select2-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!--iCheck-->
    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        text-align: right;
        }

        /* Firefox */
        input[type=number] {
            text-align: right;
            -moz-appearance: textfield;
        }

        .border-black-bottom{border-bottom: 1px dotted #000}
        
        .dt-buttons{width: 100%;}
        .buttons-pdf,.buttons-excel{margin: 10px 5px 10px;float: right!important;}
        .buttons-pdf{background: #5cc691; color: #fff}
        .buttons-excel{background: #9c78cd; color: #fff}

        .bg-danger-fade{background: #ef8987;color: #fff}

        #change_packing_details_edit_span {
  animation: blinker 1s linear infinite;
  background-color: #419341;
    padding: 1%;
    border-radius: 6px;
    color: white;
}

@-webkit-keyframes blinker {
      0% { opacity: 1; }
     49% { opacity: 1; }
     50% { opacity: 0; }
    100% { opacity: 0; }
}

h4 {
    font-family: sans-serif;
    /* margin: 100px auto; */
    color: #6c6363;
    text-align: center;
    /* font-size: 30px; */
    /* max-width: 600px; */
    position: relative;
}

h4:before {
  content: "";
  display: block;
  width: 60px;
  height: 2px;
  background: #6c6363;
  left: 0;
  top: 50%;
  position: absolute;
}

h4:after {
  content: "";
  display: block;
  width: 60px;
  height: 2px;
  background: #6c6363;
  right: 0;
  top: 50%;
  position: absolute;
}
        
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
            <h3 class="m-b-less">Office Invoice Json</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Office Invoice Json </li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <!--Edit Article Costing-->
            <form id="form_edit_receive_purchase_order" method="post" action="<?=base_url('admin/form-download-office-jsonfle')?>" class="cmxform form-horizontal tasi-form">
            <div class="row">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Create Json file of <?= $office_invoice_data[0]->office_invoice_number ?>
                            <span class="tools pull-right">
                                <a class="t-collapse fa fa-chevron-down" href="javascript:;"></a>
                            </span>
                        </header>
                        <div class="panel-body">
                        <?php #print_r($purchase_order_details); die;?>
                            	<div class="form-group ">
                                	<div class="col-lg-4">
                                    <label for="office_invoice_number" class="control-label text-danger">GST or URP no of the buyer*</label>
                                    <input id="office_invoice_gst" name="office_invoice_gst" type="text" placeholder="Invoice Number" class="form-control round-input" value=""   required  />
                                    </div>
                                    
                                    <div class="col-lg-4">
                                    <label for="shipping_legal_currnc" class="control-label text-danger">Mode*</label>
                                        <select id="shipping_legal_currnc" name="shipping_legal_currnc" class="form-control round-input">
                                            <option value="">Select Currency</option>
                                            <option value="EUR"> EURO</option>
                                            <option value="GBP"> POUND STERLING </option>
                                            <option value="AUD"> AUSTRALIAN DOLLAR </option>
                                            <option value="INR"> RUPEES </option>
                                            <option value="USD"> US DOLLAR</option>
                                            <option value="HKD"> HONG KONG DOLLER</option>
                                             <option value="NOK"> NORWEGIAN KRONER</option>
                                        </select>
                                    </div>
                                    
                                 </div>
                                 
                                <!-- <div class="row">-->
                                <!-- <div class="col-sm-4"></div>-->
                                <!-- <div class="col-sm-4">-->
                                <!--     <h4>Shipping Details</h4>-->
                                <!-- </div>-->
                                <!-- </div>-->
                                 
                                 
                                <!--<div class="form-group ">    -->
                                    
                                <!--    <div class="col-lg-4">-->
                                <!--    <label for="shipping_legal_name" class="control-label text-danger">Legal Name*</label>-->
                                <!--    <input id="shipping_legal_name" name="shipping_legal_name" type="text" placeholder="Legal Name" class="form-control round-input" value=""  required  />-->
                                <!--    </div>-->
                                    
                                <!--    <div class="col-lg-4">-->
                                <!--    <label for="shipping_legal_location" class="control-label text-danger">Location*</label>-->
                                <!--    <input id="shipping_legal_location" name="shipping_legal_location" type="text" placeholder= "Location" class="form-control round-input" value=""  required  />-->
                                <!--    </div>-->
                                    
                                <!--    <div class="col-lg-4">-->
                                <!--    <label for="shipping_legal_pincode" class="control-label text-danger">Pincode*</label>-->
                                <!--    <input id="shipping_legal_pincode" name="shipping_legal_pincode" type="number" placeholder= "Pincode" class="form-control round-input" value=""  required  />-->
                                <!--    </div>-->
                                    
                                <!--    <div class="col-lg-4">-->
                                <!--    <label for="shipping_legal_address" class="control-label text-danger">Address*</label>-->
                                <!--    <input id="shipping_legal_address" name="shipping_legal_address" type="text" placeholder="Address" class="form-control round-input" value=""  required  />-->
                                <!--    </div>-->
                                
                                
                                <!-- </div>-->
                                 
                                 
                                 <div class="row">
                                 <div class="col-sm-4"></div>
                                 <div class="col-sm-4">
                                     <h4>Transport Details</h4>
                                 </div>
                                 </div>
                                 
                                 
                                 <div class="form-group ">    
                                    
                                    <div class="col-lg-4">
                                    <label for="transport_name" class="control-label text-danger">Name*</label>
                                    <input id="transport_name" name="transport_name" type="text" placeholder="Name" class="form-control round-input" value=""  required  />
                                    </div>
                                    
                                    <div class="col-lg-4">
                                    <label for="shipping_legal_mode" class="control-label text-danger">Mode*</label>
                                        <select id="shipping_legal_mode" name="shipping_legal_mode" class="form-control round-input">
                                            <option value="">Shipping Mode</option>
                                            <option value="1"> Road</option>
                                            <option value="2"> Rail </option>
                                            <option value="3"> Air </option>
                                            <option value="4"> Ship/Road Cum Ship</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                    <label for="shipping_legal_distance" class="control-label text-danger">Distance*</label>
                                    <input id="shipping_legal_distance" name="shipping_legal_distance" type="number" placeholder= "" class="form-control round-input" value=""  required  />
                                    </div>
                                
                                
                                 </div>
                                
                                
                        </div>
                        <br/>
                        <br/>
                        <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-4">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-refresh"> Downlod Json file </i></button>
                                    </div>
                                    
                                </div> 
                                <input type="hidden" id="office_invoice_id_edit" name="office_invoice_id_edit" class="hidden" value="<?= $office_invoice_data[0]->office_invoice_id ?>" />
                    </section>
                </div>
               </form> 
            </div>
        
            </div>

        </div>
        <!--body wrapper end-->

        <!--footer section start-->
        <!--footer section end-->

    </div>
    <!-- body content end-->
</section>


<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?=base_url()?>assets/admin_panel/js/jquery-1.10.2.min.js"></script>
<!-- common js -->
<?php $this->load->view('components/_common_js'); //left side menu ?>
<!--Data Table-->
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/DataTables-1.10.18/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/admin_panel/js/DataTables/Responsive-2.2.2/js/responsive.bootstrap.min.js"></script>
<!--data table init-->
<script src="<?=base_url()?>assets/admin_panel/js/data-table-init.js"></script>

<!--Select2-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js" integrity="sha256-D84eXFg8c1WCaWR3vsFNQgUeYMdGgOXUs7dXyMbx70A=" crossorigin="anonymous"></script>
<script>
    $('.select2').select2();
</script>
<!--Icheck-->
<script src="<?=base_url();?>assets/admin_panel/js/icheck/skins/icheck.min.js"></script>
<script src="<?=base_url();?>assets/admin_panel/js/icheck-init.js"></script>
<!--form validation-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.validate.min.js"></script>
<!--ajax form submit-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.form.min.js"></script>

<script>


    //toastr notification
    function notification(obj) {
        toastr[obj.type](obj.msg, obj.title, {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "100",
            "hideDuration": "2000",
            "timeOut": "2000",
            "extendedTimeOut": "5000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        })
    }
    
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });    


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

</body>
</html>
