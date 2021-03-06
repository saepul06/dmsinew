<?php

	class Berita extends MY_Controller {

		

		function  __construct() {

			// load application base

			parent::__construct();

			$this->PrivateAppBase();

		}



		public

		function index() {

			// template content

			$this->smarty->assign("template_content", "private/berita/list");

			// load

			$this->load->model('beritamodel');

			$this->load->library('notification');

			$this->load->library('pagination');

			$this->layout->load_javascript("js/admin/plugins/datatables/jquery.dataTables.js");

			$this->layout->load_javascript("js/admin/plugins/datatables/dataTables.bootstrap.js");

			// get data

			$data = $this->beritamodel->get_list_berita_private();

			

			if(!empty($data)):

			foreach($data as $k=>$row):

			$pathdok = 'doc/berita/'.$row['id_berita'].'/'.$row['image'];

			

			if(!is_file($pathdok)):

			$data[$k]['image'] = ''; else :

			$data[$k]['image'] = BASEURL.$pathdok;

			endif;

			

			if($row['id_asosiasi'] == 100):

			$data[$k]['nama_asosiasi'] = 'DMSI';

			endif;

			endforeach;

			endif;

			$this->smarty->assign("data", $data);

			$this->smarty->assign("no",1);

			//$this->smarty->assign("total", $totaldata);

			// parse url

			$this->smarty->assign('url_add', site_url('private/berita/add'));

			$this->smarty->assign('url_list', site_url('private/berita/index'));

			$this->smarty->assign('url_process', site_url('private/berita/process/hapus'));

			$this->smarty->assign('url_edit', site_url('private/berita/edit'));

			// notification

			$arr_notify = $this->notification->get_notification();

			// notification

			$this->smarty->assign("notification_msg", $arr_notify['message']);

			$this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':

			'green'));

			// display document

			$this->parser->parse('private/base-layout/document.html');

		}



		// switcher

		public

		function process($action) {

			switch($action) {

				case 'add':

					$this->process_add();

					break;

				case 'edit':

					$this->process_edit();

					break;

				case 'hapus':

					$this->process_hapus();

					break;

				case 'hapusgambar':

					$this->hapusgambar();

					break;

				case 'download':

					$this->download_lampiran();

					break;

				default :

					// default redirect

					redirect('private/berita/add');

					break;

			}



	}



	public

	function add() {

		// template content

		$this->smarty->assign("template_content", "private/berita/add");

		//load

		$this->load->library('notification');

		$this->load->model('beritamodel');

		$data = $this->beritamodel->get_list_asosiasi_private();
		$this->smarty->assign("data", $data);
		// url

		$listasosiasi = $this->beritamodel->get_list_asosiasi();

		$this->smarty->assign('listasosiasi', $listasosiasi);

		$this->smarty->assign("url_add", site_url("private/berita/add"));

		$this->smarty->assign("url_list", site_url("private/berita"));

		

		$this->smarty->assign("url_process", site_url("private/berita/process/add"));

		// notification

		$arr_notify = $this->notification->get_notification();

		

		if(!empty($arr_notify['post'])) {

			$this->smarty->assign("data", $arr_notify['post']);

		}



		// notification

		$this->smarty->assign("notification_msg", $arr_notify['message']);

		$this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':

		'green'));

		// display document

		$this->parser->parse('private/base-layout/document.html');

	}



	public

	function process_add() {

		// load library

		$this->load->model('beritamodel');

		$this->load->library('notification');

		$this->load->library("uploader");

		// set rules

		$this->notification->check_post('id_asosiasi', 'Asosiasi', 'required');

		$this->notification->check_post('judul', 'Judul', 'required');

		$this->notification->check_post('content', 'Konten', 'required');

		$this->notification->check_post('content_english', 'Konten English', 'required');

		$this->notification->check_post('judul_english', 'Judul English', 'required');

		$this->notification->check_post('tanggal', 'Tanggal', 'required');

		// run

		

		if ($this->notification->valid_input()) {

			// params

			$params = array('id_asosiasi' => $this->input->post('id_asosiasi'),                    'judul' => $this->input->post('judul'),                    'content' => $this->input->post('content'),                    'tanggal' => $this->input->post('tanggal'),'keterangan_gambar' => $this->input->post('keterangan_gambar'),'judul_english' => $this->input->post('judul_english'),'content_english' => $this->input->post('content_english'),'caption_picture' => $this->input->post('caption_picture'));

			// execute

			

			if($this->beritamodel->process_berita_add($params)) {

				$id_berita = $this->db->insert_id();

				

				if (!empty($_FILES['image_berita']['tmp_name'])) {

					// set file attachment

					$_FILES['image_berita']['name'] = $id_berita.'_'.$_FILES['image_berita']['name'];

					$this->uploader->set_file($_FILES['image_berita']);

					// set rules (kosongkan jika tidak menggunakan batasan sama sekali)

					$rules = array('allowed_filesize' => 5120000);

					$this->uploader->set_rules($rules);

					// $this->uploader->set_file_name();

					// direktori

					$dir = 'doc/berita/' . $id_berita . '/';

					// proses upload

					

					if ($this->uploader->upload_image($dir, 1000)) {

						$this->db->set("image",$this->uploader->get_file_name());

						$this->db->where("id_berita", $id_berita);

						$this->db->update("berita_m");

						$_FILES['image_berita']['name'] = 'kecil_'.$_FILES['image_berita']['name'];

						$this->uploader->set_file($_FILES['image_berita']);

						$this->uploader->upload_image($dir, 500);

					} else {

						//echo $this->upload->message;

						$this->notification->set_message("File Gambar gagal diupload");

						$this->notification->sent_notification(false);

					}



				}



				

				if(!empty($_FILES['file']['name'])){

					$this->load->library("uploader");

					// set file attachment

					$this->uploader->set_file($_FILES['file']);

					// set rules (kosongkan jika tidak menggunakan batasan sama sekali)

					$rules = array('allowed_filesize' => 11200000);

					$this->uploader->set_rules($rules);

					// direktori

					$dir = 'doc/berita/'. $id_berita.'/';

					

					if ($this->uploader->upload_file($dir)) {

						$this->db->set("file_berita",$this->uploader->get_file_name());

						$this->db->where("id_berita", $id_berita);

						$this->db->update("berita_m");

					} else {

						//echo $this->upload->message;

						$this->notification->set_message("File lampiran gagal diupload");

						$this->notification->sent_notification(false);

					}



				}



				$this->notification->clear_post();

				$this->notification->set_message("Data berhasil disimpan");

				$this->notification->sent_notification(true);

			} else {

				$this->notification->set_message("Data gagal disimpan");

				$this->notification->sent_notification(false);

			}



		} else {

			$this->notification->sent_notification(false);

		}



		// default redirect

		redirect('private/berita/add');

	}



	public

	function edit() {

		// template content

		$this->smarty->assign("template_content", "private/berita/edit");

		// load

		$this->load->model('beritamodel');

		$this->load->library('notification');

		$this->load->library('DateTimeManipulation');

		// get asosiasi

		$listasosiasi = $this->beritamodel->get_list_asosiasi();

		$this->smarty->assign('listasosiasi', $listasosiasi);

		// parse url

		$this->smarty->assign("url_add", site_url("private/berita/add"));

		$this->smarty->assign("url_list", site_url("private/berita"));

		$this->smarty->assign("url_process", site_url("private/berita/process/edit"));

		// data

		$id_berita = $this->uri->segment(4, 0);

		$data = $this->beritamodel->get_berita_by_id($id_berita);

		$path = 'doc/berita/'.$data['id_berita']."/";

		

		if(is_file($path.$data['image'])){

			$url_hapus = site_url('private/berita/process/hapusgambar/')."/".$data['id_berita'];

			$data['image_berita'] = '<img src="'.BASEURL.$path.$data['image'].'" border="0" height="200px"><br /><input type="button" value="Hapus Gambar" onClick="javascript:document.location=\''.$url_hapus.'\';">';

		} else {

			$data['image_berita']= '-tidak ada gambar- ';

		}



		$this->smarty->assign("image_berita", $data['image_berita']);

		

		if(!empty($data)):

		$pathdok = 'doc/berita/'.$data['id_berita'].'/'.$data['file_berita'];

		

		if(is_file($pathdok)):

		$ukuran =  $this->display_ukuran_file(filesize($pathdok));

		$url_download = site_url('private/berita/process/download/'.$data['id_berita']);

		$data['file_berita'] = '<br />Download File Lampiran : <a href="'.$url_download.'">'.$data['file_berita'].' [ '.$ukuran.']</a><br />';

		endif;

		endif;

		$this->smarty->assign("data", $data);

		$tanggal_berita = $this->datetimemanipulation->format_full_date($data['tanggal']);

		$this->smarty->assign("tanggal_berita", $tanggal_berita);

		// notification

		$arr_notify = $this->notification->get_notification();

		

		if(!empty($arr_notify['post'])) {

			$this->smarty->assign("data", $arr_notify['post']);

		}



		// notification

		$this->smarty->assign("notification_msg", $arr_notify['message']);

		$this->smarty->assign("notification_status", (empty($arr_notify['message_status'])?'red':

		'green'));

		// display document

		$this->parser->parse('private/base-layout/document.html');

	}



	

	function display_ukuran_file($ukuran_file = 0){

		

		if($ukuran_file >= 1048576):

		$ukuran =  number_format(($ukuran_file/1048576),2,".",",");

		return $ukuran." MB"; else :

		$ukuran = ceil($ukuran_file/1024);

		return $ukuran." Kb";

		endif;

	}



	public

	function download_lampiran(){

		$this->load->model('beritamodel');

		$this->load->helper('download');

		// data

		$id_berita = $this->uri->segment(5,0);

		$data = $this->beritamodel->get_berita_by_id($id_berita);

		$dir = 'doc/berita/' . $id_berita. '/'.$data['file_berita'];

		

		if(is_file($dir)):

		$filedata = file_get_contents($dir);

		force_download($data['file_berita'], $filedata);

		endif;

		redirect('private/berita/edit/'.$id_berita);

	}



	public

	function process_edit() {

		// load library

		$this->load->model('beritamodel');

		$this->load->library('notification');

		$this->load->library("uploader");

		// set rules

		$this->notification->check_post('id_asosiasi', 'Asosiasi', 'required');

		$this->notification->check_post('judul', 'Judul', 'required');

		$this->notification->check_post('content', 'Konten', 'required');

		$this->notification->check_post('content_english', 'Konten English', 'required');

		$this->notification->check_post('judul_english', 'Judul English', 'required');

		$this->notification->check_post('tanggal', 'Tanggal', 'required');

		// run

		

		if ($this->notification->valid_input()) {

			// params

			$params = array('id_asosiasi' => $this->input->post('id_asosiasi'),                    'judul' => $this->input->post('judul'),                    'content' => $this->input->post('content'),                    'tanggal' => $this->input->post('tanggal'),'keterangan_gambar' => $this->input->post('keterangan_gambar'),'judul_english' => $this->input->post('judul_english'),'content_english' => $this->input->post('content_english'),'caption_picture' => $this->input->post('caption_picture'), 'id_berita' => $this->input->post('id_berita'));

			// execute

			

			if($this->beritamodel->process_berita_edit($params)) {

				$id_berita = $this->input->post('id_berita');

				

				if (!empty($_FILES['image_berita']['name'])) {

					// set file attachment

					$_FILES['image_berita']['name'] = $id_berita.'_'.$_FILES['image_berita']['name'];

					$this->uploader->set_file($_FILES['image_berita']);

					// set rules (kosongkan jika tidak menggunakan batasan sama sekali)

					$rules = array('allowed_filesize' => 5120000);

					$this->uploader->set_rules($rules);

					//$this->uploader->set_file_name($id_berita);

					// direktori

					$dir = 'doc/berita/' . $id_berita . '/';

					// proses upload

					

					if ($this->uploader->upload_image($dir, 1000)) {

						$this->db->set("image", $this->uploader->get_file_name());

						$this->db->where("id_berita", $id_berita);

						$this->db->update("berita_m");

						$_FILES['image_berita']['name'] = 'kecil_'.$_FILES['image_berita']['name'];

						$this->uploader->set_file($_FILES['image_berita']);

						$this->uploader->upload_image($dir, 500);

					} else {

						$this->notification->set_message("Data gagal diupdate");

						$this->notification->set_message("File Gambar gagal diupload, ".$this->uploader->message);

						$this->notification->sent_notification(false);

					}



				}



				

				if(!empty($_FILES['file']['name'])){

					$this->load->library("uploader");

					// set file attachment

					$this->uploader->set_file($_FILES['file']);

					// set rules (kosongkan jika tidak menggunakan batasan sama sekali)

					$rules = array('allowed_filesize' => 11200000);

					$this->uploader->set_rules($rules);

					// direktori

					$dir = 'doc/berita/'.$id_berita.'/';

					

					if ($this->uploader->upload_file($dir)) {

						$this->db->set("file_berita",$this->uploader->get_file_name());

						$this->db->where("id_berita", $id_berita);

						$this->db->update("berita_m");

					} else {

						//echo $this->upload->message;

						$this->notification->set_message("File Gambar gagal diupload");

						$this->notification->sent_notification(false);

					}



				}



				$this->notification->clear_post();

				$this->notification->set_message("Data berhasil disimpan");

				$this->notification->sent_notification(true);

			} else {

				$this->notification->set_message("Data gagal disimpan");

				$this->notification->sent_notification(false);

			}



		} else {

			$this->notification->sent_notification(false);

		}



		// default redirect

		redirect('private/berita/edit/'.$this->input->post('id_berita'));

	}



	public

	function process_hapus() {

		// load library

		$this->load->library('notification');

		$this->load->library('uploader');

		$this->load->model('beritamodel');

		// set rules

		$this->notification->check_post('id_berita', 'id', 'required');

		// run

		

		if ($this->notification->valid_input()) {

			// params

			$params = $this->input->post('id_berita');

			

			if(is_array($params)):

			// execute

			foreach($params as $id):

			$berita = $this->beritamodel->get_berita_by_id($id);

			$this->beritamodel->process_berita_delete($id);

			$this->uploader->remove_dir('doc/berita/'.$id."/");

			endforeach;

			$this->notification->clear_post();

			$this->notification->set_message("Data berhasil dihapus");

			$this->notification->sent_notification(true); else :

			$this->notification->set_message("Tidak ada data yang terpilih untuk dihapus!");

			$this->notification->sent_notification(false);

			endif;

		}



		// default redirect

		redirect('private/berita');

	}



	public

	function hapusgambar() {

		// load library

		$this->load->library('notification');

		$this->load->library('uploader');

		$this->load->model('beritamodel');

		// set rules

		$id_berita = $this->uri->segment(5, 0);

		// run

		

		if (!empty($id_berita)) {

			// params

			$this->db->set('image','');

			$this->db->where('id_berita' , $id_berita);

			$this->db->update('berita_m');

			$this->uploader->remove_dir('doc/berita/'.$id_berita."/");

			$this->notification->set_message("Gambar berhasil dihapus");

			$this->notification->sent_notification(true);

		}



		// default redirect

		redirect('private/berita/edit/'.$id_berita);

	}



}