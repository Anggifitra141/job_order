<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_job extends CI_Controller {
  /**
   *  =======   Author  : Anggi Fitrahandika         =======
   *  =======   Email   : anggifitra141@gmail.com    =======
   *  =======   Version : V.1.0                      =======
   *  ===========       Copyright 2018          ===========
  */
    public function __construct()
    {
      parent::__construct();
      $this->load->database();
      $this->load->library('PHPExcel');
    }

    public function index()
    {
      if(!$this->session->userdata('start_date') && !$this->session->userdata('end_date')){
			$data = array(
					'start_date' => date('Y-m-d'),
					'end_date' => date('Y-m-d')
					);
			$this->session->set_userdata($data);
		  }
    }

    public function InggrisTgl($tanggal)
    {
    	$bln=substr($tanggal,3,2);
    	$tgl=substr($tanggal,0,2);
    	$thn=substr($tanggal,6,4);
    	$tanggal="$thn-$bln-$tgl";
    	return $tanggal;
    }

    public function IndonesiaTgl($tanggal){
    	$tgl=substr($tanggal,8,2);
    	$bln=substr($tanggal,5,2);
    	$thn=substr($tanggal,0,4);
    	$tanggal="$tgl/$bln/$thn";
    	return $tanggal;
    }



    public function download()
    {
      if(!$this->session->userdata('start_date') && !$this->session->userdata('end_date')){
      $data = array(
          'start_date' => date('Y-m-d'),
          'end_date' => date('Y-m-d')
          );
      $this->session->set_userdata($data);
      }
      $start_date = $this->InggrisTgl($_GET['start_date']);
  		$end_date= $this->InggrisTgl($_GET['end_date']);

  		$tgl = date("d F Y", strtotime($start_date));

  		$data = array();
      if(!empty($start_date)){
        $this->db->where('activation_date >=', date('Y-m-d', strtotime($start_date))." 00:00:00");
      }
      if(!empty($end_date)){
        $this->db->where('activation_date <=', date('Y-m-d', strtotime($end_date))." 23:59:59");
      }
      $this->db->select('*');
      $this->db->from('job_order');

      $select = $this->db->get()->result();

      $objPHPExcel    = new PHPExcel();
      $baris = 1;

      $styleArray = array(
        'font'  => array(
            'bold'  => true,
            'size'  => 15,
        ));
            // Tulis judul tabel
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$baris, 'NO')
            ->setCellValue('B'.$baris, 'JOB NO')
            ->setCellValue('C'.$baris, 'CUSTOMER REF NO')
            ->setCellValue('D'.$baris, 'SHIPPER')
            ->setCellValue('E'.$baris, 'STUFFING')
            ->setCellValue('F'.$baris, 'CLOSING CY')
            ->setCellValue('G'.$baris, 'POL')
            ->setCellValue('H'.$baris, 'POD')
            ->setCellValue('I'.$baris, 'QUANTITY')
            ->setCellValue('J'.$baris, 'ETD')
            ->setCellValue('K'.$baris, 'ETA')
            ->setCellValue('L'.$baris, 'VESSEL VEEDER')
            ->setCellValue('M'.$baris, 'LINNER')
            ->setCellValue('N'.$baris, 'VESSEL CONN')
            ->setCellValue('O'.$baris, 'BL')
            ->setCellValue('P'.$baris, 'HBL')
            ->setCellValue('Q'.$baris, 'OTHER')
            ->setCellValue('R'.$baris, 'STATUS');

        $baris=2; // pindah ke row bawahnya. (ke row 2)
        $no= 1;
        foreach ($select as $row) {
          $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A'.$baris, $no)
          ->setCellValue('B'.$baris, $row->job_no )
          ->setCellValue('C'.$baris, $row->customer_ref_no )
          ->setCellValue('D'.$baris, $row->shipper )
          ->setCellValue('E'.$baris, $this->IndonesiaTgl($row->stuffing) )
          ->setCellValue('F'.$baris, $this->IndonesiaTgl($row->closing_cy) )
          ->setCellValue('G'.$baris, $row->pol )
          ->setCellValue('H'.$baris, $row->pod )
          ->setCellValue('I'.$baris, $row->quantity )
          ->setCellValue('J'.$baris, $this->IndonesiaTgl($row->etd) )
          ->setCellValue('K'.$baris, $this->IndonesiaTgl($row->eta) )
          ->setCellValue('L'.$baris, $row->vessel_veeder )
          ->setCellValue('M'.$baris, $row->linner )
          ->setCellValue('N'.$baris, $row->vessel_conn )
          ->setCellValue('O'.$baris, $row->bl )
          ->setCellValue('P'.$baris, $row->hbl )
          ->setCellValue('Q'.$baris, $row->other )
          ->setCellValue('R'.$baris, $row->status);

$baris++; // pindah ke row bawahnya ($baris + 1)
$no++;

        }

          $objPHPExcel->getProperties()->setCreator("Anggi Fitrahandika")
              		->setTitle("Report Data Job Order");
          $objPHPExcel->getActiveSheet()->setTitle('Sheet1');
          // Set sheet yang aktif adalah index pertama, jadi saat dibuka akan langsung fokus ke sheet pertama
          $objPHPExcel->setActiveSheetIndex(0);

          // Download (Excel2007)
          header('Content-Type: application/vnd.ms-excel');
          header('Content-Disposition: attachment;filename="Data Job Order_'.date('d_m_Y').'.xls"');
          header('Cache-Control: max-age=0');
          // If you're serving to IE 9, then the following may be needed
          header('Cache-Control: max-age=1');
          // If you're serving to IE over SSL, then the following may be needed
          header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
          header('Last-Modified:'. gmdate("D, d M Y H:i:s").'GMT');
          header('Chace-Control: no-cache, must-revalation');
          header('Chace-Control: post-check=0, pre-check=0', FALSE);
          header('Pragma: no-cache');
          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
          $objWriter->save('php://output');
          exit;
    }

}
