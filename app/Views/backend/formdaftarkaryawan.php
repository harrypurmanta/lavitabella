 
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
 <!-- Row -->
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body">
                                
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs customtab2" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Profile</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#account" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Account</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#setting" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Setting</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane active" id="profile" role="tabpanel">
                                        
                                    </div>
                                    <div class="tab-pane  p-20" id="account" role="tabpanel">2</div>
                                    <div class="tab-pane p-20" id="setting" role="tabpanel">3</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->

			</div>
		</div>

		<script type="text/javascript">
function simpan() {
        var person_nm = $('#person_nm').val();
        var ext_id = $('#ext_id').val();
        var gender_cd = $('#gender_cd').val();
        var birth_dttm = $('#birth_dttm').val();
        var birth_place = $('#birth_place').val();
        var cellphone = $('#cellphone').val();
        var addr_txt = $('#addr_txt').val();
        if (person_nm=='') {
        	Swal.fire({
                    title:"Nama harus di isi!!",
                    text:"GAGAL!",
                    type:"warning",
                    showCancelButton:!0,
                    confirmButtonColor:"#556ee6",
                    cancelButtonColor:"#f46a6a"
                })
        } else {
            $.ajax({
            url : "<?= base_url('karyawan/save') ?>",
            type: "post",
            data : {'person_nm':person_nm,'ext_id':ext_id,'gender_cd':gender_cd,'birth_dttm':birth_dttm,'birth_place':birth_place,'cellphone':cellphone,'addr_txt':addr_txt},
            success:function(_data){
             if (_data=='already') {
                Swal.fire({
                    title:"Nomor Identitas sudah ada!!",
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
                // setTimeout(function(){ window.location.href = "<?=base_url()?>/karyawan/formdaftarkaryawan"; }, 1000);
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
}
		</script>
                <?= $this->endSection(); ?>