<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Export extends CI_Controller {
    function __construct() {
        parent::__construct();

		$this->load->model('My','m');
		$this->load->helpers('form');
		$this->load->helpers('url');

		//if( $this->session->userdata('user_level') != 'admin' ){
			//redirect('auth');
		//}
		$this->text_ta = date("Y");
    }


    /**
	function getJurusan($jurusan_id){
		$jurusan_text = "Semua Jurusan";
		if($jurusan_id == "tkj") $jurusan_text = "Teknik Komputer dan Jaringan";
		elseif($jurusan_id == "tkr") $jurusan_text = "Teknik Kendaraan Ringan Otomotif";
		elseif($jurusan_id == "tbsm") $jurusan_text = "Teknik Bisnis Sepeda Motor";
		elseif($jurusan_id == "otkp") $jurusan_text = "Otomatisasi Tata Kelola Perkantoran";
		elseif($jurusan_id == "akp") $jurusan_text = "Akuntansi Perkantoran";

		return $jurusan_text;
	}*/

    function siswa() {
    	$by = $this->input->get('exportBy');

        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
			->setLastModifiedBy('My Notes Code')
			->setTitle("Data Siswa")
			->setSubject("Siswa")
			->setDescription("Laporan Semua Data Siswa")
			->setKeywords("Data Siswa");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$style_col2 = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$style_row2 = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PENDAFTARAN SISWA BARU "); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:L1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('A2', "T.A. ".$this->text_ta); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A2:L2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('A3', "JURUSAN :" . $this->m->getJurusan($by) );
		$excel->getActiveSheet()->mergeCells('A3:L3');

		$excel->setActiveSheetIndex(0)->setCellValue('A4', "NO");
		$excel->getActiveSheet()->mergeCells('A4:A5');
		$excel->getActiveSheet()->getStyle('A4:A5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('B4', "NO.PENDAFTARAN");
		$excel->getActiveSheet()->mergeCells('B4:B5');
		$excel->getActiveSheet()->getStyle('B4:B5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('C4', "NAMA SISWA");
		$excel->getActiveSheet()->mergeCells('C4:C5');
		$excel->getActiveSheet()->getStyle('C4:C5')->applyFromArray($style_col2);

		$excel->setActiveSheetIndex(0)->setCellValue('D4', "ASAL SEKOLAH");
		$excel->getActiveSheet()->mergeCells('D4:D5');
		$excel->getActiveSheet()->getStyle('D4:D5')->applyFromArray($style_col2);

		$excel->setActiveSheetIndex(0)->setCellValue('E4', "TANGGAL");
		$excel->getActiveSheet()->mergeCells('E4:E5');
		$excel->getActiveSheet()->getStyle('E4:E5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('F4', "BERKAS");
		$excel->getActiveSheet()->mergeCells('F4:K4');
		$excel->getActiveSheet()->getStyle('F4:K4')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "FOTO");
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "KK");
		$excel->setActiveSheetIndex(0)->setCellValue('H5', "RAPORT");
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "SKL");
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "KTP");
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "KIP");
		$excel->getActiveSheet()->getStyle('F5:K5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('L4', "PARAF");
		$excel->getActiveSheet()->mergeCells('L4:L5');
        $excel->getActiveSheet()->getStyle('L4:L5')->applyFromArray($style_col);


		$siswa = $this->db->select('*')->from('siswa');


		if($by != 'semua' )
		$siswa = $siswa->where('jurusan1',$by);

		$siswa = $siswa->order_by('siswa_nomor','asc');
		$siswa = $siswa->get();

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($siswa->result() as $data){ // Lakukan looping pada variabel siswa
			$berkas_foto = $berkas_kk = $berkas_raport = $berkas_skl = $berkas_ktp = $berkas_kip = "";

			if( $data->berkas_foto > 0 ) $berkas_foto = "✓";
			if( $data->berkas_kk > 0 ) $berkas_kk = "✓";
			if( $data->berkas_raport > 0 ) $berkas_raport = "✓";
			if( $data->berkas_skl > 0 ) $berkas_skl = "✓";
			if( $data->berkas_ktp > 0 ) $berkas_ktp = "✓";
			if( $data->berkas_kip > 0 ) $berkas_kip = "✓";

			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->pendaftaran_nomor);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->siswa_nama);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->sekolah_asal);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->pendaftar_tanggal);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $berkas_foto);
            $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $berkas_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $berkas_raport);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $berkas_skl);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $berkas_ktp);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $berkas_kip);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, "");

			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row2);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row2);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("PPDB");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="ppdb'.$this->m->getJurusan($by) .'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
    }


	function siswa2() {
		$by = $this->input->get('exportBy');
		$berkasBy = $this->input->get('berkasBy');

		include APPPATH.'third_party/PHPExcel/PHPExcel.php';

		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
			->setLastModifiedBy('My Notes Code')
			->setTitle("Data Siswa")
			->setSubject("Siswa")
			->setDescription("Laporan Semua Data Siswa")
			->setKeywords("Data Siswa");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$style_col2 = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$style_row2 = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PENDAFTARAN SISWA BARU"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:O1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1


		$excel->setActiveSheetIndex(0)->setCellValue('A2', "T.A. ".$this->text_ta); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A2:L2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('A3', "JURUSAN :" . $this->m->getJurusan($by) );
		$excel->getActiveSheet()->mergeCells('A3:L3');

		$excel->setActiveSheetIndex(0)->setCellValue('A4', "NO");
		$excel->getActiveSheet()->mergeCells('A4:A5');
		$excel->getActiveSheet()->getStyle('A4:A5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('B4', "NO.PENDAFTARAN");
		$excel->getActiveSheet()->mergeCells('B4:B5');
		$excel->getActiveSheet()->getStyle('B4:B5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('C4', "NAMA SISWA");
		$excel->getActiveSheet()->mergeCells('C4:C5');
		$excel->getActiveSheet()->getStyle('C4:C5')->applyFromArray($style_col2);

		$excel->setActiveSheetIndex(0)->setCellValue('D4', "ASAL SEKOLAH");
		$excel->getActiveSheet()->mergeCells('D4:D5');
		$excel->getActiveSheet()->getStyle('D4:D5')->applyFromArray($style_col2);

		$excel->setActiveSheetIndex(0)->setCellValue('E4', "TANGGAL");
		$excel->getActiveSheet()->mergeCells('E4:E5');
		$excel->getActiveSheet()->getStyle('E4:E5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('F4', "BERKAS");
		$excel->getActiveSheet()->mergeCells('F4:K4');
		$excel->getActiveSheet()->getStyle('F4:K4')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "FOTO");
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "KK");
		$excel->setActiveSheetIndex(0)->setCellValue('H5', "RAPORT");
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "SKL");
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "KTP");
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "KIP");
		$excel->getActiveSheet()->getStyle('F5:K5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('L4', "PARAF");
		$excel->getActiveSheet()->mergeCells('L4:L5');
		$excel->getActiveSheet()->getStyle('L4:L5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('M4', "NO.HP SISWA");
		$excel->getActiveSheet()->mergeCells('M4:M5');
		$excel->getActiveSheet()->getStyle('M4:M5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('N4', "NO.HP AYAH");
		$excel->getActiveSheet()->mergeCells('N4:N5');
		$excel->getActiveSheet()->getStyle('N4:N5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('O4', "NO.HP IBU");
		$excel->getActiveSheet()->mergeCells('O4:O5');
		$excel->getActiveSheet()->getStyle('O4:O5')->applyFromArray($style_col);

		$siswa = $this->db->select('*')->from('siswa');


		if($by != 'semua' )
			$siswa = $siswa->where('jurusan1',$by);

		//$siswa = $siswa->where('berkas_skl <= 0');
		//$siswa = $siswa->where('pendaftar_tanggal_kembali = "0000-00-00"');


		if($berkasBy == "sudah") $siswa = $siswa->where('pendaftar_status_kumpul = "Sudah"');
		else if($berkasBy == "belum") $siswa = $siswa->where('pendaftar_status_kumpul = "Belum"');

		$siswa = $siswa->order_by('siswa_nomor','desc');
		$siswa = $siswa->get();

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($siswa->result() as $data){ // Lakukan looping pada variabel siswa
			$berkas_foto = $berkas_kk = $berkas_raport = $berkas_skl = $berkas_ktp = $berkas_kip = $paraf = "";

			if( $data->berkas_foto > 0 ) $berkas_foto = "✓";
			if( $data->berkas_kk > 0 ) $berkas_kk = "✓";
			if( $data->berkas_raport > 0 ) $berkas_raport = "✓";
			if( $data->berkas_skl > 0 ) $berkas_skl = "✓";
			if( $data->berkas_ktp > 0 ) $berkas_ktp = "✓";
			if( $data->berkas_kip > 0 ) $berkas_kip = "✓";

			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->pendaftaran_nomor);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->siswa_nama);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->sekolah_asal);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->pendaftar_tanggal);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $berkas_foto);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $berkas_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $berkas_raport);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $berkas_skl);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $berkas_ktp);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $berkas_kip);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $paraf);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data->siswa_nohp);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->ortu_ayah_nohp);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data->ortu_ibu_nohp);

			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row2);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("PPDB");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="ppdb'.$this->m->getJurusan($by) .'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}


	function siswa3() {
		$by = $this->input->get('exportBy');
		$berkasBy = $this->input->get('berkasBy');

		include APPPATH.'third_party/PHPExcel/PHPExcel.php';

		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
			->setLastModifiedBy('My Notes Code')
			->setTitle("Data Siswa")
			->setSubject("Siswa")
			->setDescription("Laporan Semua Data Siswa")
			->setKeywords("Data Siswa");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$style_col2 = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$style_row2 = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PENDAFTARAN SISWA BARU"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:Q1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1


		$excel->setActiveSheetIndex(0)->setCellValue('A2', "T.A. ".$this->text_ta); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A2:Q2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('A3', "JURUSAN :" . $this->m->getJurusan($by) );
		$excel->getActiveSheet()->mergeCells('A3:Q3');

		$excel->setActiveSheetIndex(0)->setCellValue('A4', "NO");
		$excel->getActiveSheet()->mergeCells('A4:A5');
		$excel->getActiveSheet()->getStyle('A4:A5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('B4', "NO PENDAFTARAN");
		$excel->getActiveSheet()->mergeCells('B4:B5');
		$excel->getActiveSheet()->getStyle('B4:B5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('C4', "NAMA SISWA");
		$excel->getActiveSheet()->mergeCells('C4:C5');
		$excel->getActiveSheet()->getStyle('C4:C5')->applyFromArray($style_col2);

		$excel->setActiveSheetIndex(0)->setCellValue('D4', "ASAL SEKOLAH");
		$excel->getActiveSheet()->mergeCells('D4:D5');
		$excel->getActiveSheet()->getStyle('D4:D5')->applyFromArray($style_col2);

		$excel->setActiveSheetIndex(0)->setCellValue('E4', "TANGGAL");
		$excel->getActiveSheet()->mergeCells('E4:E5');
		$excel->getActiveSheet()->getStyle('E4:E5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('F4', "BERKAS");
		$excel->getActiveSheet()->mergeCells('F4:K4');
		$excel->getActiveSheet()->getStyle('F4:K4')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "FOTO");
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "KK");
		$excel->setActiveSheetIndex(0)->setCellValue('H5', "RAPOT");
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "SKL");
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "KTP");
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "KIP");
		$excel->getActiveSheet()->getStyle('F5:K5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('L4', "PRESTASI");
		$excel->getActiveSheet()->mergeCells('L4:L5');
		$excel->getActiveSheet()->getStyle('L4:L5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('M4', "PARAF");
		$excel->getActiveSheet()->mergeCells('M4:M5');
		$excel->getActiveSheet()->getStyle('M4:M5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('N4', "TOTAL");
		$excel->getActiveSheet()->mergeCells('N4:N5');
		$excel->getActiveSheet()->getStyle('N4:N5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('O4', "RANK");
		$excel->getActiveSheet()->mergeCells('O4:O5');
		$excel->getActiveSheet()->getStyle('O4:O5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('P4', "MINAT 1");
		$excel->getActiveSheet()->mergeCells('P4:P5');
		$excel->getActiveSheet()->getStyle('P4:P5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('Q4', "MINAT 2");
		$excel->getActiveSheet()->mergeCells('Q4:Q5');
		$excel->getActiveSheet()->getStyle('Q4:Q5')->applyFromArray($style_col);

		$siswa = $this->db->select('*,(nilai_ilmupengetahuanalam+nilai_ilmupengetahuansosial+nilai_matematika+nilai_bahasa_indonesia+nilai_bahasa_asing+nilai_pkn) as total')->from('siswa');


		if($by != 'semua' )
			$siswa = $siswa->where('jurusan1',$by);

		//$siswa = $siswa->where('berkas_skl <= 0');
		//$siswa = $siswa->where('pendaftar_tanggal_kembali = "0000-00-00"');

		if($berkasBy == "sudah") $siswa = $siswa->where('pendaftar_status_kumpul = "Sudah"');
		else if($berkasBy == "belum") $siswa = $siswa->where('pendaftar_status_kumpul = "Belum"');

		$siswa = $siswa->order_by('total','desc');
		$siswa = $siswa->get();

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($siswa->result() as $data){ // Lakukan looping pada variabel siswa
			$berkas_foto = $berkas_kk = $berkas_raport = $berkas_skl = $berkas_ktp = $berkas_kip = $paraf = $prestasi = "";

			if( $data->berkas_foto > 0 ) $berkas_foto = "✓";
			if( $data->berkas_kk > 0 ) $berkas_kk = "✓";
			if( $data->berkas_raport > 0 ) $berkas_raport = "✓";
			if( $data->berkas_skl > 0 ) $berkas_skl = "✓";
			if( $data->berkas_ktp > 0 ) $berkas_ktp = "✓";
			if( $data->berkas_kip > 0 ) $berkas_kip = "✓";


			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->pendaftaran_nomor);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->siswa_nama);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->sekolah_asal);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->pendaftar_tanggal);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $berkas_foto);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $berkas_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $berkas_raport);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $berkas_skl);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $berkas_ktp);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $berkas_kip);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $paraf);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->total);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $this->m->getJurusan( $data->jurusan1) );
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $this->m->getJurusan( $data->jurusan2) );

			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row)->getAlignment()->setWrapText(true);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row)->getAlignment()->setWrapText(true);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);

			//$excel->getActiveSheet()->getStyle("D'.$numrow")->getAlignment()->setWrapText(true);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(6);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("PPDB");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="ppdb'.$this->m->getJurusan($by) .'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}


	function siswa4() {
		$by = $this->input->get('exportBy');
		$berkasBy = $this->input->get('berkasBy');

		include APPPATH.'third_party/PHPExcel/PHPExcel.php';

		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
			->setLastModifiedBy('My Notes Code')
			->setTitle("Data Siswa")
			->setSubject("Siswa")
			->setDescription("Laporan Semua Data Siswa")
			->setKeywords("Data Siswa");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$style_col2 = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$style_row2 = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PENDAFTARAN SISWA BARU"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:Q1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1


		$excel->setActiveSheetIndex(0)->setCellValue('A2', "T.A. ".$this->text_ta); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A2:Q2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('A3', "JURUSAN :" . $this->m->getJurusan($by) );
		$excel->getActiveSheet()->mergeCells('A3:Q3');

		$excel->setActiveSheetIndex(0)->setCellValue('A4', "NO");
		$excel->getActiveSheet()->mergeCells('A4:A5');
		$excel->getActiveSheet()->getStyle('A4:A5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('B4', "NO PENDAFTARAN");
		$excel->getActiveSheet()->mergeCells('B4:B5');
		$excel->getActiveSheet()->getStyle('B4:B5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('C4', "NAMA SISWA");
		$excel->getActiveSheet()->mergeCells('C4:C5');
		$excel->getActiveSheet()->getStyle('C4:C5')->applyFromArray($style_col2);

		$excel->setActiveSheetIndex(0)->setCellValue('D4', "ASAL SEKOLAH");
		$excel->getActiveSheet()->mergeCells('D4:D5');
		$excel->getActiveSheet()->getStyle('D4:D5')->applyFromArray($style_col2);

		$excel->setActiveSheetIndex(0)->setCellValue('E4', "JENIS KELAMIN");
		$excel->getActiveSheet()->mergeCells('E4:E5');
		$excel->getActiveSheet()->getStyle('E4:E5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('F4', "BERKAS");
		$excel->getActiveSheet()->mergeCells('F4:K4');
		$excel->getActiveSheet()->getStyle('F4:K4')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "FOTO");
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "KK");
		$excel->setActiveSheetIndex(0)->setCellValue('H5', "RAPOT");
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "SKL");
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "KTP");
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "KIP");
		$excel->getActiveSheet()->getStyle('F5:K5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('L4', "PRESTASI");
		$excel->getActiveSheet()->mergeCells('L4:L5');
		$excel->getActiveSheet()->getStyle('L4:L5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('M4', "PARAF");
		$excel->getActiveSheet()->mergeCells('M4:M5');
		$excel->getActiveSheet()->getStyle('M4:M5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('N4', "TOTAL");
		$excel->getActiveSheet()->mergeCells('N4:N5');
		$excel->getActiveSheet()->getStyle('N4:N5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('O4', "RANK");
		$excel->getActiveSheet()->mergeCells('O4:O5');
		$excel->getActiveSheet()->getStyle('O4:O5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('P4', "MINAT 1");
		$excel->getActiveSheet()->mergeCells('P4:P5');
		$excel->getActiveSheet()->getStyle('P4:P5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('Q4', "MINAT 2");
		$excel->getActiveSheet()->mergeCells('Q4:Q5');
		$excel->getActiveSheet()->getStyle('Q4:Q5')->applyFromArray($style_col);

		$siswa = $this->db->select('*,(nilai_ilmupengetahuanalam+nilai_ilmupengetahuansosial+nilai_matematika+nilai_bahasa_indonesia+nilai_bahasa_asing+nilai_pkn) as total')->from('siswa');


		if($by != 'semua' )
			$siswa = $siswa->where('jurusan1',$by);

		//$siswa = $siswa->where('berkas_skl <= 0');
		//$siswa = $siswa->where('pendaftar_tanggal <= "2020-06-21"');
		//$siswa = $siswa->where('pendaftar_tanggal_kembali <= "2020-06-21"');

		if($berkasBy == "sudah") $siswa = $siswa->where('pendaftar_status_kumpul = "Sudah"');
		else if($berkasBy == "belum") $siswa = $siswa->where('pendaftar_status_kumpul = "Belum"');

		$siswa = $siswa->order_by('total','desc');
		$siswa = $siswa->get();

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($siswa->result() as $data){ // Lakukan looping pada variabel siswa
			$berkas_foto = $berkas_kk = $berkas_raport = $berkas_skl = $berkas_ktp = $berkas_kip = $paraf = $prestasi = "";

			if( $data->berkas_foto > 0 ) $berkas_foto = "✓";
			if( $data->berkas_kk > 0 ) $berkas_kk = "✓";
			if( $data->berkas_raport > 0 ) $berkas_raport = "✓";
			if( $data->berkas_skl > 0 ) $berkas_skl = "✓";
			if( $data->berkas_ktp > 0 ) $berkas_ktp = "✓";
			if( $data->berkas_kip > 0 ) $berkas_kip = "✓";


			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->pendaftaran_nomor);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->siswa_nama);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->sekolah_asal);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, strtoupper($data->siswa_jk));
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $berkas_foto);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $berkas_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $berkas_raport);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $berkas_skl);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $berkas_ktp);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $berkas_kip);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $paraf);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->total);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $this->m->getJurusan( $data->jurusan1) );
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $this->m->getJurusan( $data->jurusan2) );

			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row)->getAlignment()->setWrapText(true);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row)->getAlignment()->setWrapText(true);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);

			//$excel->getActiveSheet()->getStyle("D'.$numrow")->getAlignment()->setWrapText(true);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(6);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("PPDB");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="ppdb'.$this->m->getJurusan($by) .'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}



	function siswa5() {
		$by = $this->input->get('exportBy');
		$berkasBy = $this->input->get('berkasBy');

		include APPPATH.'third_party/PHPExcel/PHPExcel.php';

		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
			->setLastModifiedBy('My Notes Code')
			->setTitle("Data Siswa")
			->setSubject("Siswa")
			->setDescription("Laporan Semua Data Siswa")
			->setKeywords("Data Siswa");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$style_col2 = array(
			'font' => array('bold' => true), // Set font nya jadi bold
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$style_row2 = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
			)
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PENDAFTARAN SISWA BARU SMK NEGERI 1 CANDIPURO"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:Q1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1


		$excel->setActiveSheetIndex(0)->setCellValue('A2', "T.A. ".$this->text_ta); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A2:Q2'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$excel->setActiveSheetIndex(0)->setCellValue('A3', "JURUSAN :" . $this->m->getJurusan($by) );
		$excel->getActiveSheet()->mergeCells('A3:Q3');

		$excel->setActiveSheetIndex(0)->setCellValue('A4', "NO");
		$excel->getActiveSheet()->mergeCells('A4:A5');
		$excel->getActiveSheet()->getStyle('A4:A5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('B4', "NO PENDAFTARAN");
		$excel->getActiveSheet()->mergeCells('B4:B5');
		$excel->getActiveSheet()->getStyle('B4:B5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('C4', "NAMA SISWA");
		$excel->getActiveSheet()->mergeCells('C4:C5');
		$excel->getActiveSheet()->getStyle('C4:C5')->applyFromArray($style_col2);

		$excel->setActiveSheetIndex(0)->setCellValue('D4', "ASAL SEKOLAH");
		$excel->getActiveSheet()->mergeCells('D4:D5');
		$excel->getActiveSheet()->getStyle('D4:D5')->applyFromArray($style_col2);

		$excel->setActiveSheetIndex(0)->setCellValue('E4', "JENIS KELAMIN");
		$excel->getActiveSheet()->mergeCells('E4:E5');
		$excel->getActiveSheet()->getStyle('E4:E5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('F4', "BERKAS");
		$excel->getActiveSheet()->mergeCells('F4:K4');
		$excel->getActiveSheet()->getStyle('F4:K4')->applyFromArray($style_col);
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "FOTO");
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "KK");
		$excel->setActiveSheetIndex(0)->setCellValue('H5', "RAPOT");
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "SKL");
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "KTP");
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "KIP");
		$excel->getActiveSheet()->getStyle('F5:K5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('L4', "PRESTASI");
		$excel->getActiveSheet()->mergeCells('L4:L5');
		$excel->getActiveSheet()->getStyle('L4:L5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('M4', "PARAF");
		$excel->getActiveSheet()->mergeCells('M4:M5');
		$excel->getActiveSheet()->getStyle('M4:M5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('N4', "TOTAL");
		$excel->getActiveSheet()->mergeCells('N4:N5');
		$excel->getActiveSheet()->getStyle('N4:N5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('O4', "RANK");
		$excel->getActiveSheet()->mergeCells('O4:O5');
		$excel->getActiveSheet()->getStyle('O4:O5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('P4', "MINAT 1");
		$excel->getActiveSheet()->mergeCells('P4:P5');
		$excel->getActiveSheet()->getStyle('P4:P5')->applyFromArray($style_col);

		$excel->setActiveSheetIndex(0)->setCellValue('Q4', "MINAT 2");
		$excel->getActiveSheet()->mergeCells('Q4:Q5');
		$excel->getActiveSheet()->getStyle('Q4:Q5')->applyFromArray($style_col);


		$excel->setActiveSheetIndex(0)->setCellValue('R4', "AGAMA");
		$excel->setActiveSheetIndex(0)->setCellValue('S4', "TEMPAT LAHIR");
		$excel->setActiveSheetIndex(0)->setCellValue('T4', "TANGGAL LAHIR");
		$excel->setActiveSheetIndex(0)->setCellValue('U4', "STATUS KELUARGA");
		$excel->setActiveSheetIndex(0)->setCellValue('V4', "ALAMAT");
		$excel->setActiveSheetIndex(0)->setCellValue('W4', "NAMA AYAH");
		$excel->setActiveSheetIndex(0)->setCellValue('X4', "KEADAAN AYAH");
		$excel->setActiveSheetIndex(0)->setCellValue('Y4', "PENDIDIKAN AYAH");
		$excel->setActiveSheetIndex(0)->setCellValue('Z4', "PEKERJAAN AYAH");
		$excel->setActiveSheetIndex(0)->setCellValue('AA4', "PENGHASILAN AYAH");
		$excel->setActiveSheetIndex(0)->setCellValue('AB4', "NAMA IBU");
		$excel->setActiveSheetIndex(0)->setCellValue('AC4', "KEADAAN IBU");
		$excel->setActiveSheetIndex(0)->setCellValue('AD4', "PENDIDIKAN IBU");
		$excel->setActiveSheetIndex(0)->setCellValue('AE4', "PEKERJAAN IBU");
		$excel->setActiveSheetIndex(0)->setCellValue('AF4', "PENGHASILAN IBU");
		$excel->setActiveSheetIndex(0)->setCellValue('AG4', "NAMA WALI");
		$excel->setActiveSheetIndex(0)->setCellValue('AH4', "PENDIDIKAN WALI");
		$excel->setActiveSheetIndex(0)->setCellValue('AI4', "PEKERJAAN WALI");
		$excel->setActiveSheetIndex(0)->setCellValue('AJ4', "PENGHASILAN WALI");
		$excel->setActiveSheetIndex(0)->setCellValue('AK4', "NPSN SEKOLAH");
		$excel->setActiveSheetIndex(0)->setCellValue('AL4', "STATUS SEKOLAH");
		$excel->setActiveSheetIndex(0)->setCellValue('AM4', "MODEL UJIAN SEKOLAH");
		$excel->setActiveSheetIndex(0)->setCellValue('AN4', "ALAMAT SEKOLAH");
		$excel->setActiveSheetIndex(0)->setCellValue('AO4', "TAHUN LULUS");

		$siswa = $this->db->select('*,(nilai_ilmupengetahuanalam+nilai_ilmupengetahuansosial+nilai_matematika+nilai_bahasa_indonesia+nilai_bahasa_asing+nilai_pkn) as total')->from('siswa');


		if($by != 'semua' )
			$siswa = $siswa->where('jurusan1',$by);

		//$siswa = $siswa->where('berkas_skl <= 0');
		//$siswa = $siswa->where('pendaftar_tanggal <= "2020-06-21"');
		//$siswa = $siswa->where('pendaftar_tanggal_kembali <= "2020-06-21"');

		if($berkasBy == "sudah") $siswa = $siswa->where('pendaftar_status_kumpul = "Sudah"');
		else if($berkasBy == "belum") $siswa = $siswa->where('pendaftar_status_kumpul = "Belum"');

		$siswa = $siswa->order_by('total','desc');
		$siswa = $siswa->get();

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($siswa->result() as $data){ // Lakukan looping pada variabel siswa
			$berkas_foto = $berkas_kk = $berkas_raport = $berkas_skl = $berkas_ktp = $berkas_kip = $paraf = $prestasi = "";

			if( $data->berkas_foto > 0 ) $berkas_foto = "✓";
			if( $data->berkas_kk > 0 ) $berkas_kk = "✓";
			if( $data->berkas_raport > 0 ) $berkas_raport = "✓";
			if( $data->berkas_skl > 0 ) $berkas_skl = "✓";
			if( $data->berkas_ktp > 0 ) $berkas_ktp = "✓";
			if( $data->berkas_kip > 0 ) $berkas_kip = "✓";


			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->pendaftaran_nomor);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->siswa_nama);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->sekolah_asal);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, strtoupper($data->siswa_jk));
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $berkas_foto);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $berkas_kk);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $berkas_raport);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $berkas_skl);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $berkas_ktp);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $berkas_kip);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $paraf);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->total);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $this->m->getJurusan( $data->jurusan1) );
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $this->m->getJurusan( $data->jurusan2) );
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->siswa_agama);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->siswa_tempat_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->siswa_tanggal_lahir);
			$excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->siswa_status_dl_keluarga);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->siswa_alamat);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, $data->ortu_ayah_nama);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->ortu_ayah_keadaan);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $data->ortu_ayah_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $data->ortu_ayah_pekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $data->ortu_ayah_penghasilan);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $data->ortu_ibu_nama);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $data->ortu_ibu_keadaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $data->ortu_ibu_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $data->ortu_ibu_pekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $data->ortu_ibu_penghasilan);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $data->wali_nama);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $data->wali_pendidikan);
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, $data->wali_pekerjaan);
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, $data->wali_penghasilan);
			$excel->setActiveSheetIndex(0)->setCellValue('AK'.$numrow, $data->sekolah_npsn);
			$excel->setActiveSheetIndex(0)->setCellValue('AL'.$numrow, $data->sekolah_status);
			$excel->setActiveSheetIndex(0)->setCellValue('AM'.$numrow, $data->sekolah_model_ujian);
			$excel->setActiveSheetIndex(0)->setCellValue('AN'.$numrow, $data->sekolah_alamat);
			$excel->setActiveSheetIndex(0)->setCellValue('AO'.$numrow, $data->sekolah_tahun_lulus);

			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row)->getAlignment()->setWrapText(true);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row)->getAlignment()->setWrapText(true);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row2);
			$excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('V'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('W'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('X'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Y'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Z'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AA'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AB'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AC'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AD'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AE'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AF'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AG'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AH'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AI'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AJ'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AK'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AL'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AM'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AN'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('AO'.$numrow)->applyFromArray($style_row);

			//$excel->getActiveSheet()->getStyle("D'.$numrow")->getAlignment()->setWrapText(true);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(8);
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(6);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("PPDB");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="ppdb'.$this->m->getJurusan($by) .'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
}
?>
