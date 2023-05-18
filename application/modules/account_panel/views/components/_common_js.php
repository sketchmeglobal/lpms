<?php
/**
 * Coded by: Pran Krishna Das
 * Social: www.fb.com/pran93
 * CI: 3.0.6
 * Date: 09-07-17
 * Time: 12:00
 */
?>

<script>var base_url = "<?=base_url();?>"</script>
<script src="<?=base_url();?>assets/admin_panel/js/bootstrap.min.js"></script>
<script src="<?=base_url();?>assets/admin_panel/js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="<?=base_url();?>assets/admin_panel/js/jquery.nicescroll.js" type="text/javascript"></script>

<!--toastr-->
<script src="<?=base_url();?>assets/admin_panel/js/toastr-master/toastr.js"></script>

<!--common scripts for all pages-->
<script src="<?=base_url();?>assets/admin_panel/js/scripts.js"></script>

<?php
//notification
if($this->session->flashdata('msg')) {
    $notification_type = $this->session->flashdata('type') ? $this->session->flashdata('type') : "warning";
    ?>
    <script>
        toastr["<?=$notification_type;?>"]("<?=$this->session->flashdata('msg');?>", "<?=$this->session->flashdata('title');?>", {
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
    </script>
    <?php
}
?>