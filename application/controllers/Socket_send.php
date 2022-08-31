<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Socket_send extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('socket');
	}

	public function receive_notification($par)
	{
		// $par_parsed = str_replace(array('-', '_', '~'), array('+', '/', '='), $par);
		// $res_raw 	= base64_decode($par_parsed);
		$res_raw  = base64_decode(strtr($par, '._-', '+/='));
		$res_json 	= json_decode($res_raw);
		$res_key	= $res_json->web_key;
		$own_key 	= '123';

		if($res_key !== $own_key)
		{
			echo 'Unauthorized';
			exit;
		}else{ 
			$penerima = $res_json->id_karyawan;
			$id 	  = $res_json->id_data;
			$jenis 	  = $res_json->jenis;

			if(count($penerima) > 0)
			{				
				$title = 'PENGAJUAN ';
				switch ($jenis) {
					case 'I':
						$title .= 'IZIN';
						$type = 'izin';
						$url_redir = 'pengajuan/izin/detail_izin/'.md5($id);

						$sl1 = ', i.tgl_mulai_izin as tgl_mulai, i.tgl_selesai_izin as tgl_selesai, i.jenis_izin, i.nama_izin';
						$jn = ['data_izin i', 'i.id_karyawan=k.id_karyawan'];
						$wh = 'i.id_izin';
						break;
					case 'L':
						$title .= 'LEMBUR';
						$type = 'lembur';
						$url_redir = 'pengajuan/lembur/detail_lembur/'.md5($id);

						$sl1 = ', l.tgl_absen as tgl_mulai';
						$jn = ['lembur_mulai l', 'l.id_karyawan=k.id_karyawan'];
						$wh = 'l.id_lemmulai';
						break;
					
					default:
						$title .= 'UNDEFINED';
						$type = '';
						$url_redir = '';

						$sl1 = ', i.tgl_mulai_izin as tgl_mulai, i.tgl_selesai_izin as tgl_selesai';
						$jn = ['data_izin i', 'i.id_karyawan=k.id_karyawan'];
						$wh = 'i.id_izin';
						break;
				}

				$qk = $this->db->select('k.nik, k.nama_lengkap'.$sl1);
				$qk->join($jn[0], $jn[1]);
				$qk->from('data_karyawan k');
				$qk->where($wh, $id);
				$result = $qk->get()->row();

				if($result != null)
				{
					$title .= (isset($result->nama_izin)) ? '('.strtoupper($result->nama_izin).')' : '';
					$ext = (isset($result->tgl_selesai)) ? ' s/d '.date('d-m-Y', strtotime($result->tgl_selesai)) : '';
					$peng_ext = (isset($result->jenis_izin)) ? $result->jenis_izin.'('.$result->nama_izin.')' : $type;
					$message = 'Pengajuan '.ucwords($peng_ext).' atas nama '.$result->nik.' - '.$result->nama_lengkap.' pada tanggal '.date('d-m-Y', strtotime($result->tgl_mulai)).$ext;
				
					foreach ($penerima as $key => $value) {
						
						$params['id_karyawan'] = $value;
						$params['show_notification'] = true;
						$params['type'] = $type;

						$sub_params['image'] 		= null;
						$sub_params['message'] 		= $message;
						$sub_params['title'] 		= $title;
						$sub_params['redirect_url'] = site_url($url_redir);
						$params['params'] = $sub_params;

						$this->socket->send('send-notif', $params);
					}

				}
			}
		}
	}

	public function receive_notification2($jenis, $receiver)
	{
		// id_karyawan array
		// id_izin/id_lembur encrypted
		// token

		$aa['id_karyawan'] = ['AK-00001-7777'];
		$aa['id_data']	   = '1';
		$aa['jenis']	   = 'I';
		$aa['token']	   = '1212';

		// if ($o) {
        //     $rt = $ci->encryption->encrypt($str);
        //     $rt = str_replace(array('+', '/', '='), array('-', '_', '~'), $rt);
        // } else {
        //     $rt = str_replace(array('-', '_', '~'), array('+', '/', '='), $str);
        //     $rt = $ci->encryption->decrypt($rt);
        // }
		echo strlen(base64_encode(json_encode($aa)));
		exit;



		$params['id_karyawan'] = $receiver;
		$params['show_notification'] = true;

		$sub_params['image'] 		= null;
		$sub_params['message'] 		= 'ISI TESTING';
		$sub_params['title'] 		= 'JUDUL TEST';
		$sub_params['redirect_url'] = site_url('pengajuan/izin');
		$params['params'] = $sub_params;
		// echo strlen(base64_encode(json_encode($params)));
		// echo crypt('test', 'ok');
		$this->socket->send('send-izin', $params);
	}

	public function notif_izin($target = null, $id_room = null)
	{
		// echo "oeka";
		$params = array('room' => $id_room);
		// var_dump($params);
		$this->socket->send("izin", $params);
	}
}
