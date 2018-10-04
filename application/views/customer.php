<div class="row">
     <div class="col-md-12">
         <!-- BEGIN EXAMPLE TABLE PORTLET-->
         <div class="portlet light bordered">
             <div class="portlet-title">
                 <div class="caption font-green">
                     <i class="icon-user font-green"></i>
                     <span class="caption-subject bold uppercase">Customer</span>
                 </div>
                 <div class="tools"> </div>

             </div>
             <a class="btn green btn-outline sbold" onclick="tambah_customer()"><i class="fa fa-plus"></i> Tambah</a>
             <div class="portlet-body table-both-scroll">

                 <table class="table table-striped table-bordered table-hover order-column" id="table">
                     <thead>
                         <tr>
                             <th style="width:10px;">No</th>
                             <th>Code</th>
                             <th width="150">Nama Customer</th>
                             <th width="150">Alamat 1</th>
                             <th width="150">Alamat 2</th>
                             <th width="150">Alamat 3</th>
                             <th>Kota </th>
                             <th>Negara</th>
                             <th>Kode POS</th>
                             <th widht="120">Phone No</th>
                             <th>Fax No</th>
                             <th>Email </th>
                             <th>Credit Terms</th>
                             <th width="60">Action</th>
                         </tr>
                     </thead>
                 </table>
             </div>
         </div>
     </div>
</div>

<!-- /.modal -->
<div class="modal fade bs-modal-lg" id="modal_cust" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">CUSTOMER</h4>
            </div>
            <div class="modal-body">
              <form role="form" id="form_cust">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6">
                      <input type="hidden" class="form-control" name="id_customer">
                      <div class="form-group">
                          <label>CODE</label>
                          <input type="text" class="form-control" name="code" placeholder="" id="code">
                      </div>
                      <div class="form-group">
                          <label>Nama Customer</label>
                          <input type="text" class="form-control" name="nama_customer" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Alamat 1</label>
                          <input type="text" class="form-control" name="alamat1" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Alamat 2</label>
                          <input type="text" class="form-control" name="alamat2" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Alamat 3</label>
                          <input type="text" class="form-control" name="alamat3" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Kota</label>
                          <input type="text" class="form-control" name="kota" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Negara</label>
                          <input type="text" class="form-control" name="negara" placeholder="">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Kode Pos</label>
                              <input type="text" class="form-control" name="kode_pos" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Phone No</label>
                              <input type="text" class="form-control" name="phone_no" placeholder="">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <label>Fax No</label>
                          <input type="text" class="form-control" name="fax_no" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Email</label>
                          <input type="text" class="form-control" name="email" placeholder="">
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Bank Name 1</label>
                              <input type="text" class="form-control" name="bank_name1" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Bank Account 1</label>
                              <input type="text" class="form-control" name="bank_account1" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Bank Name 2</label>
                              <input type="text" class="form-control" name="bank_name2" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>Bank Account 2</label>
                              <input type="text" class="form-control" name="bank_account2" placeholder="">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <label>Contact Name</label>
                          <input type="text" class="form-control" name="contact_name" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Credit Terms</label>
                          <input type="text" class="form-control" name="credit_terms" placeholder="">
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
      "deferRender":    true,
      "scrollX":        true,
      "scrollCollapse": true,
			"processing": true,
			"serverSide": true,
			"order": [],
      "ajax":{
				url : "<?php echo site_url('customer/ajax_list')?>", // json datasource
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
  function tambah_customer() {
  	save_method = 'tambah';
  	$('#form_cust')[0].reset(); // reset form on modals
  	$('#modal_cust').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}

  function get_customer(id_customer){
    save_method = 'update';
    $('#form_cust')[0].reset();
        $.ajax({
          url: "<?php echo site_url('customer/get_customer')?>/" + id_customer,
          type: "GET",
          dataType: "JSON",
          success: function (data) {

                  $('[name="id_customer"]').val(data.id_customer);
                  $('[name="code"]').val(data.code);
                  $('[name="nama_customer"]').val(data.nama_customer);
                  $('[name="alamat1"]').val(data.alamat1);
                  $('[name="alamat2"]').val(data.alamat2);
                  $('[name="alamat3"]').val(data.alamat3);
                  $('[name="kota"]').val(data.kota);
                  $('[name="negara"]').val(data.negara);
                  $('[name="kode_pos"]').val(data.kode_pos);
                  $('[name="phone_no"]').val(data.phone_no);
                  $('[name="fax_no"]').val(data.fax_no);
                  $('[name="email"]').val(data.email);
                  $('[name="bank_name1"]').val(data.bank_name1);
                  $('[name="bank_account1"]').val(data.bank_account1);
                  $('[name="bank_name2"]').val(data.bank_name2);
                  $('[name="bank_account2"]').val(data.bank_account2);
                  $('[name="contact_name"]').val(data.contact_name);
                  $('[name="credit_terms"]').val(data.credit_terms);

                  $('#modal_cust').modal('show');
                  $('.modal-title').text('UPDATE CUSTOMER');
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
      	url = "<?php echo site_url('customer/tambah_customer')?>";
  	}
  	else{
    	url = "<?php echo site_url('customer/update_customer')?>";
  	}
          // ajax adding data to database
           $.ajax({
             url : url,
             type: "POST",
             data: $('#form_cust').serialize(),
             dataType: "JSON",
             success: function(data, response)
             {
               //if success close modal and reload ajax table
               $('#modal_cust').modal('hide');
               location.reload();
                // location.reload();// for reload a page
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
                 alert('Error, Try again!');
             }
         });
     }

     function delete_customer(id_customer) {

      	if(confirm('Are you sure delete this data?'))
      	{
        	// ajax delete data from database
          	$.ajax({
            	url : "<?php echo site_url('customer/delete_customer')?>/"+ id_customer,
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
