<?php
$uri = current_url(true);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Billing Anda</title>
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
    <link href="<?=base_url() ?>/assets/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

    <style type="text/css">
		#loader-wrapper {
		  display: flex;
		  position: fixed;
		  z-index: 1060;
		  top: 0;
		  right: 0;
		  bottom: 0;
		  left: 0;
		  flex-direction: row;
		  align-items: center;
		  justify-content: center;
		  padding: 0.625em;
		  overflow-x: hidden;
		  transition: background-color 0.1s;
		  background-color: rgb(253 253 253 / 58%);
		  -webkit-overflow-scrolling: touch;
		}

		.loader {
		  border: 10px solid #f3f3f3;
		  border-radius: 50%;
		  border-top: 10px solid #3af3f5;
		  border-bottom: 10px solid #3abcec;
		  width: 50px;
		  height: 50px;
		  -webkit-animation: spin 2s linear infinite;
		  animation: spin 2s linear infinite;
		  margin: 1.75rem auto;
		}

		#form-input {
		  animation: fadeIn ease 1s;
		  -webkit-animation: fadeIn ease 1s;
		  -moz-animation: fadeIn ease 1s;
		  -o-animation: fadeIn ease 1s;
		  -ms-animation: fadeIn ease 1s;
		}

		#content {
		  animation: fadeIn ease 1s;
		  -webkit-animation: fadeIn ease 1s;
		  -moz-animation: fadeIn ease 1s;
		  -o-animation: fadeIn ease 1s;
		  -ms-animation: fadeIn ease 1s;
		}

		.border-form {
		  border: 2px solid #dee2e6;
		  padding: 20px;
		  border-radius: 5px;
		}

		@keyframes fadeIn {
		  0% {
		    opacity: 0;
		  }
		  100% {
		    opacity: 1;
		  }
		}

		@-moz-keyframes fadeIn {
		  0% {
		    opacity: 0;
		  }
		  100% {
		    opacity: 1;
		  }
		}

		@-webkit-keyframes fadeIn {
		  0% {
		    opacity: 0;
		  }
		  100% {
		    opacity: 1;
		  }
		}

		@-o-keyframes fadeIn {
		  0% {
		    opacity: 0;
		  }
		  100% {
		    opacity: 1;
		  }
		}

		@-ms-keyframes fadeIn {
		  0% {
		    opacity: 0;
		  }
		  100% {
		    opacity: 1;
		  }
		}

		@-webkit-keyframes spin {
		  0% {
		    -webkit-transform: rotate(0deg);
		  }
		  100% {
		    -webkit-transform: rotate(360deg);
		  }
		}

		@keyframes spin {
		  0% {
		    transform: rotate(0deg);
		  }
		  100% {
		    transform: rotate(360deg);
		  }
		}

    </style>
</head>
<body>
<div class="col-lg-12 col-md-12">
<div class="container-fluid">
	

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
		 var meja_id = <?=$uri->getSegment(3)?>
		 
		    $.ajax({
		     url : "<?= base_url('meja/databilling') ?>",
		     data : {'meja_id':meja_id},
		     type: "post",
		     beforeSend: function () { 
		      $("#loader-wrapper").removeClass("d-none");
		     },
		     success:function(data){
		      $('#container_content').html(data);
		      setTimeout(function(){ $("#loader-wrapper").addClass("d-none"); }, 3000);
		    },
		    error:function(){
		    Swal.fire({
		      title:"Gagal!",
		      text:"Data gagal disimpan!",
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