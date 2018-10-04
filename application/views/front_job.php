<link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center> <h2> JOB ORDER </h2></center>
      <table class="table table-striped table-bordered table-hover order-column" id="table">
          <thead>
              <tr>
                  <th style="width:10px;">No</th>
                  <th>JOB NO</th>
                  <th>INV.NO</th>
                  <th>Stuffing</th>
                  <th>Closing</th>
                  <th>Qty</th>
                  <th>POD</th>
                  <th>ETD</th>
                  <th>ETA</th>
                  <th>STATUS</th>

              </tr>
          </thead>
      </table>
    </div>
  </div>
</div>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script>
  $(document).ready(function() {
    var table;
    table = $('#table').DataTable({
      "deferRender":    true,
      "scrollCollapse": true,
			"processing": true,
			"serverSide": true,
			"order": [],
      "ajax":{
				url : "<?php echo site_url('front_job/ajax_list')?>", // json datasource
				type: "POST"
			},
      "columnDefs": [
			{
				"orderable": false
			}
			],
      "fnRowCallback":function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
        if (aData[10]== "00-00-0000")
        {
          $('td', nRow).css('background-color', '#f8d7da');
        }else if (aData[11]== "00-00-0000") {
          $('td', nRow).css('background-color', '#f8d7da');
        }else if (aData[12]== "00-00-0000") {
          $('td', nRow).css('background-color', '#f8d7da');
        }else if (aData[13]== "00-00-0000") {
          $('td', nRow).css('background-color', '#f8d7da');
        }else if (aData[14]== "00-00-0000") {
          $('td', nRow).css('background-color', '#f8d7da');
        }else if (aData[15]== "00-00-0000") {
          $('td', nRow).css('background-color', '#f8d7da');
        }
        else if(aData[9]== "SUCCESS")
        {
          $('td', nRow).css('background-color', '#d4edda');
        }
        else if(aData[9]== "CLOSED")
        {
          $('td', nRow).css('background-color', '#f8d7da');
        }
      }

    });
    setInterval( function () {
      table.ajax.reload();
  }, 20000 );
  table.columns( [10,11,12,13,14,15] ).visible( false );

  });

</script>
