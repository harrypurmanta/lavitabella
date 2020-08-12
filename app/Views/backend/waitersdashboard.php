<?php
$uri = current_url(true);
?>
<!DOCTYPE html>
<html>
<head>
	<title>DATA MEJA</title>
  <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#dc0000">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#dc0000">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#dc0000">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    
	<link href="<?=base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
    <link href="<?=base_url() ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?=base_url() ?>/assets/css/custom.css" rel="stylesheet">
    <link href="<?=base_url() ?>/assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

</head>
<body>
<div class="col-lg-12 col-md-12">
<div class="container-fluid" id="container_content">
	

</div>
</div>
<div class="d-none" id='loader-wrapper'>
    <div class="loader"></div>
</div>
<script src="<?=base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?=base_url() ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Sweet-Alert  -->
<script src="<?=base_url() ?>/assets/plugins/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="<?=base_url() ?>/assets/plugins/sweetalert2/sweet-alert.init.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$.ajax({
	 url : "<?= base_url('meja/viewmejawaiters') ?>",
	 beforeSend: function () { 
	  $("#loader-wrapper").removeClass("d-none");
	 },
	success:function(data){
	  $('#container_content').html(data);
	  setTimeout(function(){ $("#loader-wrapper").addClass("d-none"); }, 1000);
	},
	error:function(){
	Swal.fire({
	  title:"Error!",
	  type:"warning",
	  showCancelButton:!0,
	  confirmButtonColor:"#556ee6",
	  cancelButtonColor:"#f46a6a"
	})
	}
	});
});
</script>
</body>
</html>