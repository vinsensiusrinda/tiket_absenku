<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

	public function index()
	{

		if (isset($this->id_user) && isset($this->nama_user) && isset($this->level_user)) {
			redirect(route('user.home'));
		} else {
			$this->load->view('auth/login', $data);
		}
	}

	public function login()
	{

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$capcay_post		= $this->input->post('captcha');
		$capcay_session 	= $this->session->userdata('captcha');

		$cek_username = $this->db->select("username")
			->from("users")
			->where("username", $username)
			->get();

		// if ($capcay_post != $capcay_session) {
		// 	$response = array(
		// 		'success' => false,
		// 		'message' => 'Captca salah'
		// 	);
		// } else {
		if ($cek_username->num_rows() > 0) {


			$select_password = $this->db->select("password")
				->from("users")
				->where("username", $username)
				->get()
				->row();

			$password_hash = $select_password->password;

			if (password_verify($password, $password_hash)) {
				$cek_password = true;
			} else {
				$cek_password = false;
			}

			if ($cek_password > 0) {
				$this->db->select("id_user,
										nama_user,
										level_user")
					->from("users")
					->where("username", $username)
					->where("aktif", "1");


				$select_user = $this->db->get();

				if ($select_user->num_rows() > 0) {
					$rows = $select_user->row();
					$id_user	= $rows->id_user;
					$nama_user	= $rows->nama_user;
					$level_user = $rows->level_user;

					$data_session = array(
						'id_user'			=> $id_user,
						'nama_user'		=> $rows->nama_user,
						'level_user'	=> $level_user
					);

					$this->session->set_userdata($data_session);

					if ($level_user == "1") {
						$url = route("user.home");
					} else {
						$url = route('task.home');
					}

					$response = array(
						'success' => true,
						'message' => 'Anda berhasil login',
						'url' => $url
					);
				} else {
					$response = array(
						'success' => false,
						'message' => 'Akun Anda sudah tidak aktif'
					);
				}
			} else {
				$response = array(
					'success' => false,
					'message' => 'Password Anda salah'
				);
			}
		} else {
			$response = array(
				'success' => false,
				'message' => 'Username Anda tidak terdaftar'
			);
		}
		// }


		$response = __response($this->MY_response, $response);

		echo json_encode($response);
	}

	public function captcha($id = '')
	{
		$text = substr(str_shuffle("123456789"), 0, 5);
		$this->session->set_userdata('captcha', $text);
		$width = 50;
		$height = 20;
		$fontsize = 12;

		$img = imagecreate($width, $height);

		$black = imagecolorallocate($img, 0, 0, 0);
		imagecolortransparent($img, $black);

		$red = imagecolorallocate($img, 255, 0, 0);
		imagestring($img, $fontsize, 3, 2, $text, $red);

		header('Content-type: image/png');
		imagepng($img);
		imagedestroy($img);
	}

	public function logout()
	{
		unset(
			$_SESSION['id_user'],
			$_SESSION['nama_user'],
			$_SESSION['level_user']
		);

		redirect(route('login'));
	}

	public function ganti_password()
	{
		$data['judul'] = 'Ganti Password';
		$data['aktif'] = 'password';
		$data['menu'] = $this->load->view('main_menu', $data, true);
		$data['content'] = $this->load->view('auth/ganti_password', $data, true);
		$this->load->view('main_template', $data, false);
	}

	public function ganti_password_save()
	{
		$id_karyawan = $this->session->userdata("id_karyawan");
		$id_company = $this->session->userdata("id_company");
		$password_lama = $this->input->post('password_lama');
		$password_lama = sha1(sha1(md5($password_lama)));
		$password_baru = $this->input->post('password_baru');
		$konfirmasi_password_baru = $this->input->post('konfirmasi_password_baru');

		$password = $this->db->select("password")
			->from("users")
			->where("id_karyawan", $id_karyawan)
			->get()
			->row("password");
		if ($password_lama !== $password) {
			$message = '<font color="#eb3a28"><i class="fa fa-exclamation-triangle">&nbsp;</i>Password lama tidak sesuai</font>';
			return __response_save(false, ["message" => $message]);
		} else if ($password_baru !== $konfirmasi_password_baru) {
			$message = '<font color="#eb3a28"><i class="fa fa-exclamation-triangle">&nbsp;</i>Konfirmasi password tidak sesuai</font>';
			return __response_save(false, ["message" => $message]);
		} else {
			$this->db->where('id_company', $id_company);
			$this->db->where('id_karyawan', $id_karyawan);
			$update = $this->db->update("users", ["password" => sha1(sha1(md5($password_baru)))]);
			if ($update) {
				$message = '<font color="#009900"><i class="fa fa-check-square">&nbsp;</i>Password berhasil diganti</font>';
				return __response_save(true, ["message" => $message]);
			} else {
				$message = '<font color="#eb3a28"><i class="fa fa-exclamation-triangle">&nbsp;</i>Password gagal diganti</font>';
				return __response_save(false, ["message" => $message]);
			}
		}
	}

	public function token_req_new()
	{
		if ($this->input->is_ajax_request()) {
			$response['status'] = true;
			$response = __response($this->MY_response, $response);

			echo json_encode($response);
		}
	}
}
