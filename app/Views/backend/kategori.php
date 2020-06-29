<?= $this->extend('backend/layout/template'); 
?>
    

    <?= $this->section('content'); ?>
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?= $subtitle ?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item">Pengaturan</li>
                        <li class="breadcrumb-item active"><?= $subtitle ?></li>
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
          		 <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                              <form>
                              	<?= csrf_field(); ?>
                                    <div class="form-body">
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nama Kategori Produk</label>
                                                    <input type="text" id="namakategori" class="form-control text-uppercase" placeholder="Input disini" required="">
                                                    <small class="form-control-feedback"> Contoh : starter, pizza, pasta dll </small> </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="form-actions">
                                        <button type="button" class="btn btn-success" onclick="simpan()"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                        	<div class="card-header bg-info">
                                <h4 class="m-b-0 text-white d-inline">Tabel Data Kategori</h4>
                            </div>
                            <div class="card-body">
                               <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                        		$no=1;
                                        		foreach ($kategori as $k) {
                                        	?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $k['kategori_nm'] ?></td>
                                                <td><?= $k['status_cd'] ?></td>
                                                <td><?= $k['created_dttm'] ?></td>
                                                <td><?= $k['created_user'] ?></td>
                                                <td>$320,800</td>
                                            </tr>
                                        <?php } ?>
                                     </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

              <script type="text/javascript">

              	


                function simpan() {
                    var kategori_nm = $('#namakategori').val();
                    $.ajax({
						url : "<?= base_url('kategori/save') ?>",
						type: "post",
						data : {'kategori_nm':kategori_nm},
						success:function(_data){
							if (_data=='already') {
								Swal.fire({
									title:"Nama kategori sudah ada!!",
									text:"GAGAL!",
									type:"warning",
									showCancelButton:!0,
									confirmButtonColor:"#556ee6",
									cancelButtonColor:"#f46a6a"
								})

							} else {
								Swal.fire({
									title:"Berhasil!",
									text:"Data berhasil disimpan!",
									type:"success",
									showCancelButton:!0,
									confirmButtonColor:"#556ee6",
									cancelButtonColor:"#f46a6a"
								})
								window.location.href = "<?=base_url()?>/kategori";
							}
							


		                   
		                   
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
                }

            </script>
<?= $this->endSection(); ?>