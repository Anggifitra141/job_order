<div class="row">
     <div class="col-md-12">
         <!-- BEGIN EXAMPLE TABLE PORTLET-->
         <div class="portlet light bordered">
             <div class="portlet-title">
                 <div class="caption font-green">
                     <i class="icon-user font-green"></i>
                     <span class="caption-subject bold uppercase">Consignee</span>
                 </div>
                 <div class="tools"> </div>

             </div>
             <a class="btn green btn-outline sbold" onclick="tambah_consignee()"><i class="fa fa-plus"></i> Tambah</a>
             <div class="portlet-body table-both-scroll">

                 <table class="table table-striped table-bordered table-hover order-column" id="table">
                     <thead>
                         <tr>
                             <th style="width:10px;">No</th>
                             <th>Nama Consignee</th>
                             <th>Description</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                 </table>
             </div>
         </div>
     </div>
</div>

<!-- /.modal -->
<div class="modal fade bs-modal-lg" id="modal_consignee" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">consignee</h4>
            </div>
            <div class="modal-body">
              <form role="form" id="form_consignee">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="hidden" class="form-control" name="id_consignee">
                      <div class="form-group">
                          <label>Nama Consignee</label>
                          <input type="text" class="form-control" name="nama_consignee" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Description</label>
                          <textarea class="form-control" name="description"> </textarea>
                      </div>
                    </div>

                  </div>
                </div>
              </form>

            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button type="button" class="btn green" onclick="save()">Save </button>
            </div>
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
<!-- /.modal -->
</div>

<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>
  $(document).ready(function() {
    $('#table').DataTable({
      "scrollY":        300,
      "deferRender":    true,
      "scrollCollapse": true,
			"processing": true,
			"serverSide": true,
			"order": [],
      "ajax":{
				url : "<?php echo site_url('consignee/ajax_list')?>", // json datasource
				type: "POST"
			},
      "columnDefs": [
			{
				"orderable": false
			}
			],
    });
  });

  /* -- Action -- */
  function tambah_consignee() {
  	save_method = 'tambah';
  	$('#form_consignee')[0].reset(); // reset form on modals
  	$('#modal_consignee').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}

  function get_consignee(id_consignee){
    save_method = 'update';
    $('#form_consignee')[0].reset();
        $.ajax({
          url: "<?php echo site_url('consignee/get_consignee')?>/" + id_consignee,
          type: "GET",
          dataType: "JSON",
          success: function (data) {

                  $('[name="id_consignee"]').val(data.id_consignee);
                  $('[name="nama_consignee"]').val(data.nama_consignee);
                  $('[name="description"]').val(data.description);

                  $('#modal_consignee').modal('show');
                  $('.modal-title').text('UPDATE CONSIGNEE');
          },
          error: function (jqXHR, textStatus, errorThrown){
                  alert('Error get data from ajax');
          }
        });
  }

  function save() {
    var url;
  	if(save_method == 'tambah')
  	{
      	url = "<?php echo site_url('consignee/tambah_consignee')?>";
  	}
  	else{
    	url = "<?php echo site_url('consignee/update_consignee')?>";
  	}
          // ajax adding data to database
           $.ajax({
             url : url,
             type: "POST",
             data: $('#form_consignee').serialize(),
             dataType: "JSON",
             success: function(data, response)
             {
               //if success close modal and reload ajax table
               $('#modal_consignee').modal('hide');
               location.reload();
                // location.reload();// for reload a page
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
                 alert('Error, Try again!');
             }
         });
     }

     function delete_consignee(id_consignee) {

      	if(confirm('Are you sure delete this data?'))
      	{
        	// ajax delete data from database
          	$.ajax({
            	url : "<?php echo site_url('consignee/delete_consignee')?>/"+ id_consignee,
            	type: "POST",
            	dataType: "JSON",
            	success: function(data)
            	{
               		location.reload();
            	},
            	error: function (jqXHR, textStatus, errorThrown)
            	{
                	alert('Error deleting data');
            	}
        	});
      	}
    }
</script>
