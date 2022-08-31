<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_m');
	}

	public function index()
	{
		$data['judul'] = 'user';
		$data['aktif'] = 'user';
		$data['menu'] = $this->load->view('main_menu', $data, true);
		$data['content'] = $this->load->view('user/home', $data, true);
		$this->load->view('main_template', $data, false);
	}

	public function list_data()
	{
		$list = $this->User_m->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $field->username;
			$row[] = $field->nama_user;
			$row[] = $field->level_user;
			$row[] = $field->aktif;


			$btn_edit = '<a href="#" class="text-warning" title="EDIT"> <i id="' . md5($field->id_user) . '" class="btn_edit fa fa-edit (alias) "> </i></a>';
			$btn_hapus = '<a href="#" class="text-danger" title="HAPUS"><i id="' . md5($field->id_user) . '" class="btn_delete fa fa-trash"></i></a>';

			$row[] = $btn_edit . ' ' . $btn_hapus;

			$data[] = $row;
		}

		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $this->User_m->count_all(),
			"recordsFiltered" => $this->User_m->count_filtered(),
			"data"            => $data
		);

		$output = __response($this->MY_response, $output);

		echo json_encode($output);
	}

	public function form($id = null)
	{
		if ($id == null) {
			$this->load->view('user/form');
		} else {
			$data['data'] = $this->User_m->getDataById($id);
			$this->load->view('user/form', $data);
		}
	}

	public function save()
	{
		$id_user = $this->input->post('id_user');

		$data = array(
			'username'			=> $this->input->post('username'),
			'nama_user'			=> $this->input->post('nm_user'),
			'level_user'		=> $this->input->post('lvl_user')
		);

		$this->User_m->save($data, $id_user);
	}

	public function delete()
	{
		$id_user = $this->input->post("id_user");
		$this->User_m->delete($id_user);
	}
}
