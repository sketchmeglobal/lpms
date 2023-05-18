<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 11-03-2020
 * Time: 08:55
 Last updated on 29-mar-2021 at 04:04 pm
 */
?>
<?php
// print_r($buyer_details);die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Receive Purchase Order | <?=WEBSITE_NAME;?></title>
    <meta name="description" content="add Purchase order">

    <!--Select2-->
    <link href="<?=base_url();?>assets/admin_panel/css/select2.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/admin_panel/css/select2-bootstrap.css" rel="stylesheet">

    <!--iCheck-->
    <link href="<?=base_url();?>assets/admin_panel/js/icheck/skins/all.css" rel="stylesheet">

    <!-- common head -->
    <?php $this->load->view('components/_common_head'); ?>
    <!-- /common head -->
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
            <h3 class="m-b-less">Add Receive Purchase Order</h3>
            <div class="state-information">
                <ol class="breadcrumb m-b-less bg-less">
                    <li><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
                    <li class="active"> Add Receive Purchase Order</li>
                </ol>
            </div>
        </div>
        <!-- page head end-->

        <!--body wrapper start-->
        <div class="wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <section class="panel">
                        <div class="panel-body">
                            <form id="form_add_receive_purchase_order" method="post" action="<?=base_url('admin/form_add_receive_purchase_order')?>" class="cmxform form-horizontal tasi-form">
                            	<div class="form-group ">
                                	<div class="col-lg-3">
                                    <label for="purchase_order_receive_bill_no" class="control-label text-danger">Purchase Receive Number *</label>
                                    <input id="purchase_order_receive_bill_no" name="purchase_order_receive_bill_no" type="text" placeholder="Purchase Receive Number" class="form-control round-input" />
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="purchase_order_receive_date" class="control-label text-danger">Purchase Receive Date *</label>
                                        <?php 

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
?>
                                        <input id="purchase_order_receive_date" name="purchase_order_receive_date" type="date" placeholder="Purchase Receive Date" class="form-control round-input" value="<?php echo $today; ?>"/>
                                    </div>                                    
                                    <div class="col-lg-3">
                                        <label for="am_id_add" class="control-label text-danger">Select Supplier *</label>
                                        <select id="am_id" name="am_id" class="form-control select2">
                                        <option value="">Select Supplier</option>
                                                <?php
                                                foreach($buyer_details as $bd){
                                                    $sn = ($bd->short_name == '' ? '-' : $bd->short_name);
                                                ?> 
                                                    <option value="<?= $bd->am_id ?>"><?= $bd->name . ' ['. $sn .']' ?></option>
                                                    <?php
                                                }
                                                ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="control-label text-danger">Status *</label><br />
                                        <input type="radio" name="supp_status" id="enable" value="1" checked required class="iCheck-square-green">
                                        <label for="enable" class="control-label">Enable</label>

                                        <input type="radio" name="supp_status" id="disable" value="0" required class="iCheck-square-red">
                                        <label for="disable" class="control-label">Disable</label>
                                    </div>
                                </div>                               

                                <div class="form-group">
                                    <div class="col-lg-6">
                                        <button class="btn btn-success pull-right" type="submit"><i class="fa fa-plus"> Add Receive Purchase Order</i></button>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="edit_btn" href="javascript:void(0)" class="hidden btn btn-info"><i class="fa fa-pencil"> Edit Receive Purchase Order</i></a>
                                    </div>
                                </div>
                            </form>
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
<script src="<?=base_url()?>assets/admin_panel/js/jquery-1.10.2.min.js"></script>
<!-- common js -->
<?php $this->load->view('components/_common_js'); //left side menu ?>
<!--Select2-->
<script src="<?=base_url();?>assets/admin_panel/js/select2.js" type="text/javascript"></script>
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
	//Get ajax Purchase order
	/*$("#pur_order_date").change(function(){
        $pur_order_date = $(this).val();
        $.ajax({
            url: "<?= base_url('admin/ajax-all-purchase-order') ?>",
            method: "post",
            dataType: 'json',
            data: {'pur_order_date': $pur_order_date,},
            success: function(all_items){
                console.log(all_items);
                $("#po_id").html("");
				if(all_items.status == true){
					$.each(all_items.all_po, function(index, item) {
						$str = '<option value=' + item.po_id + ' item_group_val=' + item.po_id + '> '+ item.po_number + '</option>';
						$("#po_id").append($str);
					});
				}else{
					alert(all_items.message);
				}
                // open the item tray 
                //$('#id_id').select2('open');
            },
            error: function(e){console.log(e);}
        });
    });*/
	
    //add-item-form validation and submit
    $("#form_add_receive_purchase_order").validate({
        
        rules: {
            /*supp_po_number: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax-unique-supp-purchase-order-number')?>",
                    type: "post",
                    data: {
                        supp_po_number_add: function() {
                          return $("#supp_po_number").val();
                        }
                    },
                },
            },*/
            purchase_order_receive_bill_no: {
                required: true,
                remote: {
                    url: "<?=base_url('admin/ajax-unique-purchase-order-receive_num')?>",
                    type: "post",
                    data: {
                        order_no: function() {
                          return $("#purchase_order_receive_bill_no").val();
                        }
                    },
                },
            },
            purchase_order_receive_date: {
                required: true
            },
            am_id: {
                required: true
            }
        },
        messages: {

        }
    });
    $('#form_add_receive_purchase_order').ajaxForm({
        beforeSubmit: function () {
             //alert('HI');
            return $("#form_add_receive_purchase_order").valid(); // TRUE when form is valid, FALSE will cancel submit
        },
        success: function (returnData) {
            obj = JSON.parse(returnData);
			//console.log(obj);
			notification(obj);
			
			if(obj.insert_id > 0){
				$('#form_add_receive_purchase_order')[0].reset(); //reset form
				$("#form_add_receive_purchase_order select").select2("val", ""); //reset all select2 fields
				$('#form_add_receive_purchase_order :radio').iCheck('update'); //reset all iCheck fields
				$("#form_add_receive_purchase_order").validate().resetForm(); //reset validation
	
				$('#edit_btn').attr('href', '<?=base_url()?>admin/edit-receive-purchase-order/'+obj.insert_id);
				$('#edit_btn').removeClass('hidden');
			}
        }
    });

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
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "15000",
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        })
    }
</script>

</body>
</html>