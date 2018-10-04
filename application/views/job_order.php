<div class="row">
     <div class="col-md-12">
         <!-- BEGIN EXAMPLE TABLE PORTLET-->
         <div class="portlet light bordered">
             <div class="portlet-title">
                 <div class="caption font-green">
                     <i class="icon-diamond font-green"></i>
                     <span class="caption-subject bold uppercase">JOB ORDER</span>
                 </div>
                 <div class="tools"> </div>
             </div>
             <a  class="btn green btn-outline sbold" onclick="tambah_job_order()"><i class="fa fa-plus"></i> Tambah</a>
             <a  class="btn yellow-lemon btn-outline sbold" data-toggle="modal" href="#modal_filter"><i class="fa fa-filter"></i> Filter</a>
             <a  class="btn green-jungle btn-outline sbold"  href="<?php echo base_url() ?>report_job/download?start_date=<?php echo $this->session->userdata('start_date'); ?> & end_date=<?php echo $this->session->userdata('end_date'); ?>"><i class="fa fa-download"></i> Download</a>
             <div class="portlet-body table-both-scroll">

                 <table class="table table-striped table-bordered  order-column" id="table">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th width="60px">Action </th>
                             <th width="150">Job Nomer</th>
                             <th width="120">Cust Ref No</th>
                             <th>Stuffing</th>
                             <th>Closing CY</th>
                             <th>POL</th>
                             <th>POD</th>
                             <th>Qty / Volume</th>
                             <th width="53px">ETD</th>
                             <th width="53px">ETA</th>
                             <th width="53px">Lift On</th>
                             <th width="53px">Lift Off</th>
                             <th width="53px">Input VGM</th>
                             <th width="53px">Final S/i</th>
                             <th width="53px">BL date</th>
                             <th width="53px">Collect BL</th>
                             <th>Vessel Veeder</th>
                             <th>Linner</th>
                             <th>Vessel Conn</th>
                             <th>BL / MAWB</th>
                             <th>HBL / HAWB</th>
                             <th>Other</th>
                             <th>Status</th>

                         </tr>
                     </thead>
                 </table>
             </div>
         </div>
     </div>
</div>

<div class="modal fade" id="modal_filter" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Filter Data</h4>
            </div>
            <div class="modal-body">

                  <div class="form-group">
    								<label>Start Date: </label>
    								<div class="input-group">
    									<span class="input-group-addon"><i class="icon-calendar"></i></span>
    									<input id="start_date" name="start_date" type="text" class="form-control" value="<?= $this->session->userdata('start_date') ?>">
    								</div>
    							</div>
                  <div class="form-group">
    								<label>End Date: </label>
    								<div class="input-group">
    									<span class="input-group-addon"><i class="icon-calendar"></i></span>
    									<input id="end_date" name="end_date" type="text" class="form-control" value="<?= $this->session->userdata('end_date') ?>">
    								</div>
    							</div>
                  <div class="form-group">
    								<label>STATUS </label>
    									<select class="form-control" name="status" id="status_filter">
                        <?php if( $this->session->userdata('status') !='') { ?>
                        <option value="<?= $this->session->userdata('status') ?>"> <?= $this->session->userdata('status') ?></option>
                        <?php }?>
                        <option value=""> ALL</option>
                        <option value="OPEN"> OPEN</option>
                        <option value="SUCCESS"> SUCCESS</option>
                        <option value="CLOSED"> CLOSED</option>
                      </select>
    							</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                <button class="btn green" id="filter"><i class="fa fa-filter"></i> Filter</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade bs-modal-lg" id="modal_job" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">JOB ORDER</h4>
            </div>
            <div class="modal-body">
              <form role="form" id="form_job">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6">
                      <input type="hidden" class="form-control" name="id_job_order">
                      <div class="form-group">
                          <label>JOB NO</label>
                          <input type="text" class="form-control" name="job_no" placeholder="" id="job_no" readonly>
                      </div>
                      <div class="form-group">
                          <label>PRODUCT</label>
                          <select class="form-control" name="product" id="product" onchange="testing()">
                            <option value=""> -- Pilih --</option>
                            <?php foreach ($product as $row) { ?>
                              <option value="<?php echo $row['code']; ?>"> <?php echo $row['code'];?> - <?php echo $row['description']; ?> </option>
                            <?php } ?>
                          </select>
                      </div>
                      <!--
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>SHIPPING TYPE</label>
                              <select class="form-control" name="shipping_type" id="shipping_type">
                                  <option value=""> -- Pilih --</option>
                                  <option value="EXPORT">EXPORT</option>
                                  <option value="IMPORT">IMPORT</option>
                              </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>SHIPPING MODE</label>
                            <select class="form-control" name="shipping_mode" id="shipping_mode">
                                <option value=""> -- Pilih --</option>
                                <option value="SEA">SEA</option>
                                <option value="AIR">AIR</option>
                            </select>
                          </div>
                        </div>
                      </div> -->
                      <div class="form-group">
                          <label>SHIPPER</label>
                          <select class="form-control" name="shipper" id="shipper" onchange="get_job_no()">
                            <option value=""> -- Pilih --</option>
                            <?php foreach ($shipper as $row) { ?>
                              <option value="<?php echo $row['code']; ?>"><?php echo $row['code'];?> - <?php echo $row['nama_customer'];?></option>
                            <?php } ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>CONSIGNEE</label>
                          <select class="form-control" name="consignee" id="consignee">
                            <option value=""> -- Pilih --</option>
                            <?php foreach ($consignee as $row) { ?>
                              <option value="<?php echo $row['nama_consignee']; ?>"><?php echo $row['nama_consignee'];?></option>
                            <?php } ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>NOTIFY</label>
                          <input type="text" class="form-control" name="notify" placeholder="">
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>ETD</label>
                              <input type="text" class="form-control" name="etd" id="etd" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>ETA</label>
                              <input type="text" class="form-control" name="eta" id="eta" placeholder="">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>LIFT ON</label>
                              <input type="text" class="form-control" name="lift_on" id="lift_on" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>INPUT VGM</label>
                              <input type="text" class="form-control" name="input_vgm" id="input_vgm" placeholder="">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>FINAL S/I</label>
                              <input type="text" class="form-control" name="final_si" id="final_si" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>BL DATE</label>
                              <input type="text" class="form-control" name="bl_date" id="bl_date" placeholder="">
                          </div>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-6">

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>COLLECT BL</label>
                              <input type="text" class="form-control" name="collect_bl" id="collect_bl" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>LIFT OFF</label>
                              <input type="text" class="form-control" name="lift_off" id="lift_off" placeholder="">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <label>CUSTOMER REF NO</label>
                          <input type="text" class="form-control" name="customer_ref_no"  placeholder="">
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>STUFFING</label>
                              <input type="text" class="form-control" name="stuffing" placeholder="" id="stuffing">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>CLOSING CY</label>
                              <input type="text" class="form-control" name="closing_cy" placeholder="" id="closing_cy">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>QTY / VOLUME</label>
                              <input type="text" class="form-control" name="quantity" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>POL</label>
                              <input type="text" class="form-control" name="pol" id="pol" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>POD</label>
                              <input type="text" class="form-control" name="pod" id="pod" placeholder="" onkeyup="get_hbl()">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>VESSEL VEEDER</label>
                              <input type="text" class="form-control" name="vessel_veeder" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>LINNER</label>
                              <input type="text" class="form-control" name="linner" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>VESSEL CONN</label>
                              <input type="text" class="form-control" name="vessel_conn" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>BL / MAWB</label>
                              <input type="text" class="form-control" name="bl" placeholder="">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <label>HBL / HAWB</label>
                              <input type="text" class="form-control" name="hbl" placeholder="" id="hbl" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                          <label>OTHER</label>
                          <textarea name="other" class="form-control"> </textarea>
                      </div>
                      <div class="form-group" id="status1">
                          <label>STATUS</label>
                          <select class="form-control" name="status" id="status">
                            <option value=""> -- Pilih --</option>
                            <option value="OPEN">OPEN</option>
                            <option value="SUCCESS">SUCCESS</option>
                          </select>
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
<?php
function IndonesiaTgl($tanggal){
    $tgl=substr($tanggal,8,2);
    $bln=substr($tanggal,5,2);
    $thn=substr($tanggal,0,4);
    $tanggal="$tgl-$bln-$thn";
    return $tanggal;
  }
?>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script>

  $(document).ready(function() {

    fetch_data('no');

    function fetch_data(is_date_search, start_date='', end_date='', status='')
    {
      var table;
      table = $('#table').DataTable({

        "deferRender":    true,
        "scrollX":        true,
        "scrollCollapse": true,
  			"processing": true,
  			"serverSide": true,
  			"order": [],

        "ajax":{
  				url : "<?php echo site_url('job_order/ajax_list')?>", // json datasource
  				type: "POST",
          data: {is_date_search:is_date_search, start_date:start_date, end_date:end_date, status:status}
  			},
        "columnDefs": [
  			{
  				"orderable": false
  			}
  			],
        "fnRowCallback":function(nRow, aData, iDisplayIndex, iDisplayIndexFull){
          if (aData[11]== "00-00-0000")
          {
            $('td', nRow).css('background-color', '#f8d7da');
          }else if (aData[12]== "00-00-0000") {
            $('td', nRow).css('background-color', '#f8d7da');
          }else if (aData[13]== "00-00-0000") {
            $('td', nRow).css('background-color', '#f8d7da');
          }else if (aData[14]== "00-00-0000") {
            $('td', nRow).css('background-color', '#f8d7da');
          }else if (aData[15]== "00-00-0000") {
            $('td', nRow).css('background-color', '#f8d7da');
          }else if (aData[16]== "00-00-0000") {
            $('td', nRow).css('background-color', '#f8d7da');
          }
          else if(aData[23]== "SUCCESS")
          {
            $('td', nRow).css('background-color', '#d4edda');
          }
          else if(aData[23]== "CLOSED")
          {
            $('td', nRow).css('background-color', '#f8d7da');
          }
        }
      });
    }

    $('#filter').click(function(){
      var start_date = $('#start_date').val();
      var end_date = $('#end_date').val();
      var status = $('#status_filter').val();
      if(start_date != '' || end_date !='' || status !='')
      {
      $('#table').DataTable().destroy();
       fetch_data('yes', start_date, end_date, status);
      }
      else
      {
       alert("Both Date is Required");
      }
      $('#modal_filter').modal('hide');
     });

    $('#start_date').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });
    $('#end_date').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });
    $('#etd').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });
    $('#eta').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });
    $('#lift_on').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });
    $('#input_vgm').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });
    $('#final_si').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });
    $('#bl_date').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });
    $('#collect_bl').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });
    $('#lift_off').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });
    $('#stuffing').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });
    $('#closing_cy').datepicker({
      rtl: App.isRTL(),
      format: 'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
    });

  });

  function testing() {
    var a = $('#product').val();
    var b = $('#output_type').val(a);
    return b;

  }

  function get_job_no(){
    var product = $('#product').val();
    var shipper = $('#shipper').val();
    var month;
    switch (new Date().getMonth()) {
        case 0:
            month = "I";
            break;
        case 1:
            month = "II";
            break;
        case 2:
            month = "III";
            break;
        case 3:
            month = "IV";
            break;
        case 4:
            month = "V";
            break;
        case 5:
            month = "VI";
            break;
        case 6:
            month = "VII";
            break;
        case 7:
            month = "VIII";
            break;
        case 8:
            month = "IX";
            break;
        case 9:
            month = "X";
            break;
        case 10:
            month = "XI";
            break;
        case 11:
            month = "XII";
    }
    var tahun = new Date().getFullYear();
    var no_urut_product;
        $.ajax({
            type: "GET",
            url: "<?php echo site_url('job_order/get_no_urut_product');?>/" + product,
            dataType: "json",
            async: false,
            success: function(data){
                no_urut_product = data; //or something similar
            }
        });

    var generate = $('#job_no').val(product + "-" + no_urut_product + "/" + shipper +  "/" + month + "/" + tahun);
    return generate;

  }

  function get_hbl() {
    var pol = $('#pol').val();
    var pod = $('#pod').val();
    var tahun = new Date().getFullYear().toString().substr(-2);
    var month;
    switch (new Date().getMonth()) {
        case 0:
            month = "01";
            break;
        case 1:
            month = "02";
            break;
        case 2:
            month = "03";
            break;
        case 3:
            month = "04";
            break;
        case 4:
            month = "05";
            break;
        case 5:
            month = "06";
            break;
        case 6:
            month = "07";
            break;
        case 7:
            month = "08";
            break;
        case 8:
            month = "09";
            break;
        case 9:
            month = "10";
            break;
        case 10:
            month = "11";
            break;
        case 11:
            month = "12";
      }
    var no_urut_hbl = <?php echo $no_urut_hbl; ?>;
    var generate = $('#hbl').val(pol + pod + tahun + month + no_urut_hbl);
    return generate;
  }

  /* -- Action -- */
  function tambah_job_order() {
  	save_method = 'tambah';
  	$('#form_job')[0].reset(); // reset form on modals
    $('#status1').hide();
  	$('#modal_job').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}

  function get_job_order(id_job_order){
    save_method = 'update';
    $('#form_job')[0].reset();
        $.ajax({
          url: "<?php echo site_url('job_order/get_job_order')?>/" + id_job_order,
          type: "GET",
          dataType: "JSON",
          success: function (data) {
            // ETD
            var a1 = new Date(data.etd);
            var b1 = a1.getDate();
            var c1 = a1.getMonth()+1;
            var d1 = a1.getFullYear();
            var etd = (b1 <= 9 ? '0' + b1 : b1) + "-" + (c1 <= 9 ? '0' + c1 : c1) + "-" + d1;
            // ETA
            var a2 = new Date(data.eta);
            var b2 = a2.getDate();
            var c2 = a2.getMonth()+1;
            var d2 = a2.getFullYear();
            var eta = (b2 <= 9 ? '0' + b2 : b2) + "-" + (c2 <= 9 ? '0' + c2 : c2) + "-" + d2;
            // STUFFING
            var a3 = new Date(data.stuffing);
            var b3 = a3.getDate();
            var c3 = a3.getMonth()+1;
            var d3 = a3.getFullYear();
            var stuffing = (b3 <= 9 ? '0' + b3 : b3) + "-" + (c3 <= 9 ? '0' + c3 : c3) + "-" + d3;
            // CLOSING CY
            var a4 = new Date(data.closing_cy);
            var b4 = a4.getDate();
            var c4 = a4.getMonth()+1;
            var d4 = a4.getFullYear();
            var closing_cy = (b4 <= 9 ? '0' + b4 : b4) + "-" + (c4 <= 9 ? '0' + c4 : c4) + "-" + d4;
            // LIFT ON
            var a5 = new Date(data.lift_on);
            var b5 = a5.getDate();
            var c5 = a5.getMonth()+1;
            var d5 = a5.getFullYear();
            var lift_on = (b5 <= 9 ? '0' + b5 : b5) + "-" + (c5 <= 9 ? '0' + c5 : c5) + "-" + d5;
            // INPUT VGM
            var a6 = new Date(data.input_vgm);
            var b6 = a6.getDate();
            var c6 = a6.getMonth()+1;
            var d6 = a6.getFullYear();
            var input_vgm = (b6 <= 9 ? '0' + b6 : b6) + "-" + (c6 <= 9 ? '0' + c6 : c6) + "-" + d6;
            // FINAL S/i
            var a7 = new Date(data.final_si);
            var b7 = a7.getDate();
            var c7 = a7.getMonth()+1;
            var d7 = a7.getFullYear();
            var final_si = (b7 <= 9 ? '0' + b7 : b7) + "-" + (c7 <= 9 ? '0' + c7 : c7) + "-" + d7;
            // BL DATE
            var a8 = new Date(data.bl_date);
            var b8 = a8.getDate();
            var c8 = a8.getMonth()+1;
            var d8 = a8.getFullYear();
            var bl_date = (b8 <= 9 ? '0' + b8 : b8) + "-" + (c8 <= 9 ? '0' + c8 : c8) + "-" + d8;
            // COLLECT BL
            var a9 = new Date(data.collect_bl);
            var b9 = a9.getDate();
            var c9 = a9.getMonth()+1;
            var d9 = a9.getFullYear();
            var collect_bl = (b9 <= 9 ? '0' + b9 : b9) + "-" + (c9 <= 9 ? '0' + c9 : c9) + "-" + d9;
            // LIFT OFF
            var a10 = new Date(data.lift_off);
            var b10 = a10.getDate();
            var c10 = a10.getMonth()+1;
            var d10 = a10.getFullYear();
            var lift_off = (b10 <= 9 ? '0' + b10 : b10) + "-" + (c10 <= 9 ? '0' + c10 : c10) + "-" + d10;

                  $('[name="id_job_order"]').val(data.id_job_order);
                  $('[name="job_no"]').val(data.job_no);
                  $('[name="shipping_type"]').val(data.shipping_type);
                  $('[name="shipping_mode"]').val(data.shipping_mode);
                  $('[name="product"]').val(data.product);
                  $('[name="shipper"]').val(data.shipper);
                  $('[name="consignee"]').val(data.consignee);
                  $('[name="notify"]').val(data.notify);
                  $('[name="etd"]').val(etd);
                  $('[name="eta"]').val(eta);
                  $('[name="lift_on"]').val(lift_on);
                  $('[name="input_vgm"]').val(input_vgm);
                  $('[name="final_si"]').val(final_si);
                  $('[name="bl_date"]').val(bl_date);
                  $('[name="collect_bl"]').val(collect_bl);
                  $('[name="lift_off"]').val(lift_off);
                  $('[name="customer_ref_no"]').val(data.customer_ref_no);
                  $('[name="stuffing"]').val(stuffing);
                  $('[name="closing_cy"]').val(closing_cy);
                  $('[name="quantity"]').val(data.quantity);
                  $('[name="pol"]').val(data.pol);
                  $('[name="pod"]').val(data.pod);
                  $('[name="vessel_veeder"]').val(data.vessel_veeder);
                  $('[name="linner"]').val(data.linner);
                  $('[name="vessel_conn"]').val(data.vessel_conn);
                  $('[name="bl"]').val(data.bl);
                  $('[name="hbl"]').val(data.hbl);
                  $('[name="other"]').val(data.other);
                  $('[name="status"]').val(data.status);
                  $('#status1').show();
                  $('#modal_job').modal('show');
                  $('.modal-title').text('UPDATE JOB ORDER');
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
      	url = "<?php echo site_url('job_order/tambah_job_order')?>";
  	}
  	else{
    	url = "<?php echo site_url('job_order/update_job_order')?>";
  	}
          // ajax adding data to database
           $.ajax({
             url : url,
             type: "POST",
             data: $('#form_job').serialize(),
             dataType: "JSON",
             success: function(data, response)
             {
               //if success close modal and reload ajax table
               $('#modal_job').modal('hide');
               location.reload();
                // location.reload();// for reload a page
             },
             error: function (jqXHR, textStatus, errorThrown)
             {
                 alert('Error, Try again!');
             }
         });
     }

     function delete_job_order(id_job_order) {

      	if(confirm('Are you sure delete this data?'))
      	{
        	// ajax delete data from database
          	$.ajax({
            	url : "<?php echo site_url('job_order/delete_job_order')?>/"+ id_job_order,
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
