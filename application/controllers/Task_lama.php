<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Task extends MY_Controller
{
	//construct
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Task_m');
		$this->load->helper('string_helper');
		$this->load->library('Uploadfile');
	}

	//index
	public function index()
	{
		$data['judul'] = 'Tiket';
		$data['aktif'] = 'task';
		$data['menu'] = $this->load->view('main_menu', $data, true);
		$data['content'] = $this->load->view('task/home', $data, true);
		$this->load->view('main_template', $data, false);
	}

	//list data tiket
	public function list_data()
	{
		$list = $this->Task_m->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $field->no_tiket;
			$row[] = date_format(date_create($field->tgl_pengaduan), "Y-m-d") . "<br>" . date_format(date_create($field->tgl_pengaduan), "H:i:s");
			$row[] = $field->status;
			$row[] = $field->tipe;
			$row[] = $field->prioritas;
			$row[] = $field->jenis_layanan;
			$row[] = $field->nm_pelanggan . "<br>" . $field->id_pelanggan;
			$row[] = $field->modul;
			$row[] = $field->judul;
			$row[] = $field->keterangan;
			$row[] = $field->platform;
			$row[] = $field->pelimpahan;
			$row[] = date_format(date_create($field->tgl_dikerjakan), "Y-m-d") . "<br>" . date_format(date_create($field->tgl_dikerjakan), "H:i:s");
			$row[] = date_format(date_create($field->tgl_selesai), "Y-m-d") . "<br>" . date_format(date_create($field->tgl_selesai), "H:i:s");
			$row[] = date_format(date_create($field->tgl_konfirmasi), "Y-m-d") . "<br>" . date_format(date_create($field->tgl_konfirmasi), "H:i:s");



			$btn_edit = '<a href="#" class="text-warning" title="EDIT"> <i id="' . md5($field->no_tiket) . '" class="btn_edit fa fa-edit (alias) "> </i></a>';
			$btn_hapus = '<a href="#" class="text-danger" title="HAPUS"><i id="' . md5($field->no_tiket) . '" class="btn_delete fa fa-trash"></i></a>';

			$row[] = $btn_edit . ' ' . $btn_hapus;

			$data[] = $row;
		}

		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $this->Task_m->count_all(),
			"recordsFiltered" => $this->Task_m->count_filtered(),
			"data"            => $data
		);

		$output = __response($this->MY_response, $output);

		echo json_encode($output);
	}

	//tampilan form tambah
	public function form()
	{

		$data['judul'] = 'Tambah Data';
		$data['aktif'] = 'task';
		// $data['pelanggan'] = $this->Task_m->get_pelanggan();
		$data['users'] = $this->Task_m->get_user();
		$data['menu'] = $this->load->view('main_menu', $data, true);
		$data['content'] = $this->load->view('task/form', $data, true);
		$this->load->view('main_template', $data, false);
	}

	public function getdatasubmodule()
	{
		$searchTerm = $this->input->post('searchTerm');
		$id_modul_kategori = $this->input->post('id_modul_kategori');
		$response	= $this->Task_m->getsubmodule($id_modul_kategori, $searchTerm);
		$output['csrf_token'] = $this->MY_response;
		$output['data'] = $response;

		echo json_encode($output);
	}

	//function save
	public function save()
	{
		$no_tiket = $this->input->post('no_tiket');

		$data = array(
			'judul'					=> $this->input->post('judul'),
			'modul'					=> $this->input->post('modul'),
			'submodul'				=> $this->input->post('submodul'),
			'keterangan'			=> $this->input->post('keterangan'),
			'tipe_pelanggan'		=> $this->input->post('tipe_pelanggan'),
			'pelanggan'				=> $this->input->post('pelanggan'),
			'tipe'					=> $this->input->post('tipe'),
			'platform'				=> $this->input->post('platform'),
			'status'				=> $this->input->post('status'),
			'prioritas'				=> $this->input->post('prioritas'),
			'pelimpahan'			=> $this->input->post('pelimpahan'),
			'tgl_pengaduan'			=> date('Y-m-d', strtotime($this->input->post('tgl_pengaduan'))),
			'tgl_dikerjakan'		=> date('Y-m-d', strtotime($this->input->post('tgl_dikerjakan'))),
			'tgl_selesai'			=> date('Y-m-d', strtotime($this->input->post('tgl_selesai'))),
			'tgl_konfirmasi'		=> date('Y-m-d', strtotime($this->input->post('tgl_konfirmasi'))),
			// 'tgl_konfirmasi'		=> (($this->input->post('konfirmasi_pelanggan') == "null") ? "" : $this->input->post('konfirmasi_pelanggan')),
		);

		$this->Task_m->save($data, $no_tiket);
		//Upload foto1
		// $foto1_lama = $this->input->post('foto1_lama');
		// $file1 = $_FILES['foto1'];
		// if ($file1['name'] == "") {
		// 	$foto_profil = $foto1_lama;
		// } else {
		// 	$fileUpload['fname']    = 'foto1';
		// 	$fileUpload['location'] = 'karyawan/';
		// 	$fileUpload['allowed']  = 'jpg|png|jpeg';
		// 	$fileUpload['compress_image']  = true;
		// 	$fileUpload['filename']  = preg_replace('/[^A-Za-z0-9\-]/', '', random_string('alnum', 20));
		// 	// print_r($fileUpload);
		// 	$upload = $this->uploadfile->doUpload($fileUpload);
		// 	if ($upload["success"] == true) {
		// 		$foto_profil = $upload['url'];
		// 		if (!empty($foto1_lama)) {
		// 			if ($foto_profil != $foto1_lama) {
		// 				$this->fungsi->delete_fileupload($foto1_lama);
		// 			}
		// 		}
		// 	} else {
		// 		$message = ["message" => $upload["message"]];
		// 		return __response_save(false, ["params" => $message]);
		// 	}
		// }
		// $no_tiket = $this->input->post('no_tiket');

		// $data = array(
		// 	'judul'					=> $this->input->post('judul'),
		// 	'modul'					=> $this->input->post('modul'),
		// 	'submodul'				=> $this->input->post('submodul'),
		// 	'keterangan'			=> $this->input->post('keterangan'),
		// 	'tipe_pelanggan'		=> $this->input->post('tipe_pelanggan'),
		// 	'pelanggan'				=> $this->input->post('pelanggan'),
		// 	'tipe'					=> $this->input->post('tipe'),
		// 	'platform'				=> $this->input->post('platform'),
		// 	'status'				=> $this->input->post('status'),
		// 	'prioritas'				=> $this->input->post('prioritas'),
		// 	'pelimpahan'			=> $this->input->post('pelimpahan'),
		// 	'tgl_pengaduan'			=> date('Y-m-d', strtotime($this->input->post('tgl_pengaduan'))),
		// 	'tgl_dikerjakan'		=> date('Y-m-d', strtotime($this->input->post('tgl_dikerjakan'))),
		// 	'tgl_selesai'			=> date('Y-m-d', strtotime($this->input->post('tgl_selesai'))),
		// 	'tgl_konfirmasi'		=> date('Y-m-d', strtotime($this->input->post('tgl_konfirmasi'))),
		// 	// 'tgl_konfirmasi'		=> (($this->input->post('konfirmasi_pelanggan') == "null") ? "" : $this->input->post('konfirmasi_pelanggan')),
		// );


		// $this->Task_m->save($data, $no_tiket);
	}

	//function delete
	public function delete()
	{
		$no_tiket = $this->input->post("no_tiket");
		$this->Task_m->delete($no_tiket);
	}
}
