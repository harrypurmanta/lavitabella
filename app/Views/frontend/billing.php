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
    <link href="<?=base_url() ?>/assets/css/custom.css" rel="stylesheet">
</head>
<body>
<div class="col-lg-12 col-md-12">
<div class="container-fluid">
	<?php
	if ($billing[0]->member_id == 0) {
		$billname = $billing[0]->meja_nm;
	} else {
		$billname = $billing[0]->person_nm;
	}

	if ($billing[0]->statusbilling == 'verified') {
		$collctedby = "<tr>
	          <td align='left'>Collected By</td>
	          <td align='right'>".$billing[0]->collected_nm."</td>
	        </tr>";
	} else {
		$collctedby = "";
	}

	if ($billing[0]->statusbilling == 'normal') {
		$footer = "<button onclick='cancelorder(".$billing[0]->billing_id.")' type='button' class='btn btn-danger float-left' style='font-size: 50px; font-weight: bold;'>Cancel</button>
			<button onclick='order(".$billing[0]->billing_id.")' class='btn btn-success float-right' style='font-size: 50px; font-weight: bold;'>Order</button>";
		$buttonmenu = "<div style='display:inline-block;' class='float-left'>
			<button onclick='listmenu()' type='button' class='btn btn-info float-left' style='font-size: 40px; font-weight: bold;'>Menu</button>
			</div>";
	} else if ($billing[0]->statusbilling == 'waiting') {
		$footer = "<div align='center' class='alert alert-info alert-rounded'> 
						<i class='far fa-handshake'></i> SILAHKAN TUNGGU WAITERS UNTUK KONFIRMASI PESANAN ANDA !!
					</div>";

		$buttonmenu = "<div style='display:inline-block;' class='float-left'>
						<button onclick='listmenu()' type='button' class='btn btn-info float-left' style='font-size: 40px; font-weight: bold;'>Menu</button>
						</div>";
	} else if ($billing[0]->statusbilling == 'verified') {
		$footer = "<div align='center' class='alert alert-success alert-rounded'> 
						<i class='far fa-handshake'></i>  PESANAN ANDA SEDANG DI PROSES. SILAHKAN TUNGGU !!
					</div>";
		$buttonmenu = "";
	}
	
	
	
$subtotal = 0;
$ret = "<div align='center'>
			$buttonmenu
			<div style='display:inline-block; margin-left: -137px;'>
				<img style='max-height: 100%; width: 150px;' src='../../images/lib/logo.jpeg'>
			</div>
			<div style='margin-top: 30px;'>
				<p>
					<span style='font-size: 30px;'>Butcher Steak & Pasta Palembang</span><br>
					<span style='font-size: 30px;'>Jl. AKBP Cek Agus No. 284, Palembang</span><br>
					<span style='font-size: 30px;'>Sumatera Selatan, 30114, 07115626366</span>
				</p>
			</div>
		</div>";
$ret .= "<table width='100%' style='margin-top: 20px;font-size: 30px;'>
	        <tr>
	          <td align='left'>Tanggal</td>
	          <td align='right'>".$billing[0]->created_dttm."</td>
	        </tr>
	        <tr>
	          <td align='left'>Bill Name</td>
	          <td align='right'>".$billname."</td>
	        </tr>
	        $collctedby
	      </table>
	      <hr style='border: 1px solid red'>
	      <table style='font-size: 30px;' width='100%'>";
foreach ($billing as $key) {
	$total = $key->produk_harga * $key->qty;
	$subtotal = $subtotal + $total;
	$ret .= "<tr>
	        <td colspan='3' align='left' style='font-weight: bold;font-size: 30px;'>
	            $key->produk_nm
	          </td>
	        </tr>
	        <tr style='font-size: 30px;'>
	          <td align='left' width='50'>$key->qty X</td>
	          <td align='center'>@".number_format($key->produk_harga)."</td>
	          <td align='right'>".number_format($total)."</td>
	        </tr>
	        <tr style='line-height:40px;'>
	        <td>&nbsp </td>
	        <td></td>
	        <td></td>
	        </tr>";
	 }
	$ret .= "</table>
			<hr style='border: 1px solid red'>";
	$tax = $subtotal * 0.10;
	$service = $subtotal * 0.05;
	$grandtotal = $subtotal + $tax + $service;
	        
	$ret .= "<table style='font-size: 30px; margin-top:30px;' width='100%'>
	        <tr>
	          <td align='left'>Subtotal</td>
	          <td colspan='2' align='right'>Rp. ".number_format($subtotal)."</td>
	        </tr>
	        <tr>
	          <td align='left'>Tax</td>
	          <td colspan='2' align='right'>Rp. ".number_format($tax)."</td>
	        </tr>
	        <tr>
	          <td align='left'>service</td>
	          <td colspan='2' align='right'>Rp. ".number_format($service)."</td>
	        </tr>
	        <tr>
	          <td align='left'>Rounding Amount</td>
	          <td colspan='2' align='right'>Rp. dak tau rumusnyo</td>
	        </tr>
	        <tr>
	          <td align='left' style='font-weight:bold;'>Total</td>
	          <td colspan='2' align='right'>Rp. ".number_format($grandtotal)."</td>
	        </tr>
			</table>
			<hr style='border: 1px solid red;margin-bottom:100px;'>
			<div style='margin-bottom: 150px;'>
			$footer
			</div>";
	echo $ret;
	?>

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
function listmenu() {
  window.location.href = "<?=base_url()?>/produk/listmenu2/"+<?= $uri->getSegment(3)?>;
}

function order(id) {
Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, order it!'
}).then((result) => {
    if (result.value == true) {
    	$.ajax({
		   url : "<?= base_url('meja/orderbilling')?>",
		   type: "POST",
		   data : {id:id},
		   beforeSend: function () { 
		      $("#loader-wrapper").removeClass("d-none")
		   },
		   success:function(){
		      setTimeout(function(){ 
		        $("#loader-wrapper").addClass("d-none");
		        Swal.fire(
		            'Ordered!',
		            'Your order has been send to waiters.',
		            'success'
		        )
		        window.location.href = "<?=base_url()?>/produk/listmenu/"+<?= $uri->getSegment(3)?>;
		      });  
		    },
		    error:function(){
		    Swal.fire(
		        'Gagal!',
		        'Silahkan Coba Lagi.',
		        'warning'
		    )
		    }
		  });
    	
    }
 })
}

function cancelorder(id) {
Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
}).then((result) => {
    if (result.value == true) {
    	$.ajax({
		   url : "<?= base_url('meja/cancelbilling')?>",
		   type: "POST",
		   data : {id:id},
		   beforeSend: function () { 
		      $("#loader-wrapper").removeClass("d-none")
		   },
		   success:function(){
		      setTimeout(function(){ 
		        $("#loader-wrapper").addClass("d-none");
		        Swal.fire(
		            'Canceled!',
		            'Your order has been canceled.',
		            'success'
		        )
		        window.location.href = "<?=base_url()?>/produk/listmenu/"+<?= $uri->getSegment(3)?>;
		      });  
		    },
		    error:function(){
		    Swal.fire(
		        'Gagal!',
		        'Silahkan Coba Lagi.',
		        'warning'
		    )
		    }
		  });
    	
    }
 })
}
</script>
</body>
</html>