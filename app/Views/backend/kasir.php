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
                <div class="row">
                    <div class="col-lg-7 col-md-12">
                        <div class="card">
                            <div class="card-body">
                            <?php
                              foreach ($meja->getResult() as $key) {
                            ?>
                            <div style="display: inline-block; margin: 10px;">
                              <button onclick="showbillingbymeja(<?= $key->meja_id ?>)" class="btn btn-info font-weight-bold" style="font-size: 30px; padding: 20px;"><?= $key->meja_nm ?></button>
                            </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                      <div class="col-lg-5 col-md-12">
                        <div class="card">
                            <div class="card-body" id="cardbody"> 
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="modaledit" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                              
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

<script type="text/javascript">
function showbillingbymeja(id) {
    $.ajax({
     url : "<?= base_url('kasir/getbymejaidkasir') ?>",
     type: "post",
     data : {'id':id},
     success:function(data){
      $('#cardbody').html(data);
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