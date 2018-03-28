<script type="text/javascript">
$(function() {
  $('#btn-submit-modal').bind('click',function(e) {
    e.preventDefault();
    var m = $('input[name="menu_title"]');
    if(m.val() == '') {
      alert('Maaf, Judul harap diisi !');
      m.focus();
    } else {
      $.post('<?=site_url("webmin_menu/insert_partial/$parent_id")?>',$('#form-validate-modal').serialize(),function(data) {
        if(data.prepend == 'false') {
          alert('Maaf, Kategori sudah ada. Silahkan masukan kategori yang lain !');
          m.focus();
        } else {
          $('#modal-kategori').modal('hide');
          $("#menu_id").prepend(data.prepend);
        }        
      },'json');
    }    
  });
});
</script>
<!-- Modal -->
<div id="modal-kategori" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form class="row-fluid margin-none" method="post" enctype="multipart/form-data" id="form-validate-modal">  
    <div class="modal-content">
      <div class="modal-header" style="padding:10px 0 5px 10px">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">+ Tambah Kategori Informasi</h5>
      </div>
      <div class="modal-body">
            <table width="100%">
            <tr>
              <td width="25%"><div class="span12">Judul Kategori</div></td>
              <td width="75%"><div class="span12"><input type="text" name="menu_title" class="span12"></div></td>
            </tr>            
            </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-icon btn-submit" id="btn-submit-modal"><i></i> Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
  </div>
</div>