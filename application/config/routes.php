<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route = Luthier\Route::getRoutes();

$route['default_controller'] = 'Auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// $route['login'] = 'Auth';
// $route['login/proses'] = 'Auth/login';
// $route['login/capcay'] = 'Auth/capcay';
// $route['logout'] = 'Auth/logout';
// $route['dashboard'] = 'Dashboard';
$route['dashboard/ganti-password'] = 'Dashboard/ganti_password';
$route['dashboard/save-password'] = 'Dashboard/save_password';

// $route['kepegawaian'] = 'Kepegawaian';
// $route['kepegawaian/data-kepegawaian/(:any)'] = 'Kepegawaian/data_kepegawaian/$1';
// $route['kepegawaian/data-pendidikan/(:any)'] = 'Kepegawaian/data_pendidikan/$1';
// $route['kepegawaian/get-cabang'] = 'Kepegawaian/get_cabang';
// $route['kepegawaian/daftar-kontrak'] = 'Kepegawaian/daftar_kontrak';
// $route['kepegawaian/list-data'] = 'Kepegawaian/list_data';
// $route['kepegawaian/cetak-data'] = 'Kepegawaian/cetak_data';

// $route['dashboard/notif-izin'] = 'Dashboard/notif_izin';
// $route['dashboard/notif-lembur'] = 'Dashboard/notif_lembur';
// $route['dashboard/notif-reimbursement'] = 'Dashboard/notif_reimbursement';

// // BEGIN MASTER

// $route['master/cabang'] = 'Cabang';
// $route['master/cabang/list_data'] = 'Cabang/list_data';
// $route['master/cabang/form/tambah'] = 'Cabang/form';
// $route['master/cabang/form/edit/(:any)'] = 'Cabang/form/$1';
// $route['master/cabang/form/hapus/(:any)'] = 'Cabang/form/$1';
// $route['master/cabang/save'] = 'Cabang/save';
// $route['master/cabang/delete'] = 'Cabang/delete';
// $route['master/cabang/getCabang'] = 'Cabang/getCabangByName';

// $route['master/jam-kerja'] = 'Jadwal_kerja';
// $route['master/jam-kerja/list_data'] = 'Jadwal_kerja/list_data';
// $route['master/jam-kerja/form/tambah'] = 'Jadwal_kerja/form';
// $route['master/jam-kerja/form/edit/(:any)'] = 'Jadwal_kerja/form/$1';
// $route['master/jam-kerja/form/hapus/(:any)'] = 'Jadwal_kerja/form/$1';
// $route['master/jam-kerja/detail/(:any)'] = 'Jadwal_kerja/detail/$1';
// // $route['master/jam-kerja/select/(:any)'] = 'Jadwal_kerja/select/$1';
// $route['master/jam-kerja/select'] = 'Jadwal_kerja/select';
// $route['master/jam-kerja/save'] = 'Jadwal_kerja/save';
// $route['master/jam-kerja/update'] = 'Jadwal_kerja/update';
// $route['master/jam-kerja/delete'] = 'Jadwal_kerja/delete';

// $route['master/departemen'] = 'Departemen';
// $route['master/departemen/list_data'] = 'Departemen/list_data';
// $route['master/departemen/form/tambah'] = 'Departemen/form';
// $route['master/departemen/form/edit/(:any)'] = 'Departemen/form/$1';
// $route['master/departemen/form/hapus/(:any)'] = 'Departemen/form/$1';
// $route['master/departemen/save'] = 'Departemen/save';
// $route['master/departemen/delete'] = 'Departemen/delete';

// $route['master/jenis-izin'] = 'Jenis_izin';
// $route['master/jenis-izin/list_data'] = 'Jenis_izin/list_data';
// $route['master/jenis-izin/form/tambah'] = 'Jenis_izin/form';
// $route['master/jenis-izin/form/edit/(:any)'] = 'Jenis_izin/form/$1';
// $route['master/jenis-izin/form/hapus/(:any)'] = 'Jenis_izin/form/$1';
// $route['master/jenis-izin/save'] = 'Jenis_izin/save';
// $route['master/jenis-izin/delete'] = 'Jenis_izin/delete';

// $route['master/jabatan'] = 'Jabatan';
// $route['master/jabatan/list_data'] = 'Jabatan/list_data';
// $route['master/jabatan/form/tambah'] = 'Jabatan/form';
// $route['master/jabatan/form/edit/(:any)'] = 'Jabatan/form/$1';
// $route['master/jabatan/form/hapus/(:any)'] = 'Jabatan/form/$1';
// $route['master/jabatan/save'] = 'Jabatan/save';
// $route['master/jabatan/delete'] = 'Jabatan/delete';

// $route['master/shift'] = 'Shift';
// $route['master/shift/list_data'] = 'Shift/list_data';
// $route['master/shift/list_data/(:any)'] = 'Shift/list_data/$1';
// $route['master/shift/view_data/(:any)'] = 'Shift/view_data/$1';
// $route['master/shift/form/tambah'] = 'Shift/form';
// $route['master/shift/form/edit/(:any)'] = 'Shift/form/$1';
// $route['master/shift/form/hapus/(:any)'] = 'Shift/form/$1';
// $route['master/shift/save'] = 'Shift/save';
// $route['master/shift/delete'] = 'Shift/delete';

// $route['master/kalender'] = 'Kalender';
// $route['master/kalender/list_data/(:any)'] = 'Kalender/list_data/$1';
// $route['master/kalender/form/tambah'] = 'Kalender/form';
// $route['master/kalender/form/edit/(:any)'] = 'Kalender/form/$1';
// $route['master/kalender/form/hapus/(:any)'] = 'Kalender/form/$1';
// $route['master/kalender/save'] = 'Kalender/save';
// $route['master/kalender/update'] = 'Kalender/update';
// $route['master/kalender/delete'] = 'Kalender/delete';
// $route['master/kalender/delete-holiday'] = 'Kalender/delete_holiday';
// $route['master/kalender/cek-tanggal'] = 'Kalender/cek_tanggal';
// $route['master/kalender/import'] = 'Kalender/import';
// $route['master/kalender/kalender_data'] = 'Kalender/kalender_data';
// $route['master/kalender/view_data/(:any)'] = 'Kalender/view_data/$1';
// $route['master/kalender/export/(:any)'] = 'Kalender/export/$1';

// $route['master/lokasi'] = 'Lokasi';
// $route['master/lokasi/tambah'] = 'Lokasi/tambah';
// $route['master/lokasi/list_data'] = 'Lokasi/ajax_list';
// $route['master/lokasi/edit/(:any)'] = 'Lokasi/edit/$1';
// $route['master/lokasi/delete'] = 'Lokasi/delete';
// $route['master/lokasi/save'] = 'Lokasi/insert';
// $route['master/lokasi/update'] = 'Lokasi/update';

// $route['master/karyawan'] = 'Karyawan';
// $route['master/karyawan/view_data/(:any)/(:any)/(:any)/(:any)'] = 'Karyawan/view_data/$1/$2/$3/$4';
// $route['master/karyawan/list_data/(:any)/(:any)/(:any)/(:any)'] = 'Karyawan/list_data/$1/$2/$3/$4';
// $route['master/karyawan/form/tambah'] = 'Karyawan/form';
// $route['master/karyawan/detail/(:any)'] = 'Karyawan/detail/$1';
// $route['master/karyawan/export-pdf/(:any)'] = 'Karyawan/export_pdf/$1';
// $route['master/karyawan/view-pdf/(:any)'] = 'Karyawan/view_pdf/$1';
// $route['master/karyawan/form/edit'] = 'Karyawan/edit';
// $route['master/karyawan/form/hapus/(:any)'] = 'Karyawan/form/$1';
// $route['master/karyawan/save'] = 'Karyawan/save';
// $route['master/karyawan/delete'] = 'Karyawan/delete';

// $route['master/karyawan/get-karyawan'] = 'Karyawan/get_karyawan';
// $route['master/karyawan/get-shift'] = 'Karyawan/get_shift';
// $route['master/karyawan/get-jabatan'] = 'Karyawan/get_jabatan';
// $route['master/karyawan/get-jabatan-home'] = 'Karyawan/get_jabatan_home';
// $route['master/karyawan/get-cabang'] = 'Karyawan/get_cabang';
// $route['master/karyawan/get-cabang-home'] = 'Karyawan/get_cabang_home';
// $route['master/karyawan/get-departemen/(:any)'] = 'Karyawan/get_departemen/$1';
// $route['master/karyawan/get-departemen-form'] = 'Karyawan/get_departemen_form';
// $route['master/karyawan/get-departemen-home/(:any)'] = 'Karyawan/get_departemen_home/$1';
// $route['master/karyawan/get-supervisi/(:any)/(:any)'] = 'Karyawan/get_supervisi/$1/$2';
// $route['master/karyawan/get-provinsi'] = 'Karyawan/get_provinsi';
// $route['master/karyawan/get-kota/(:any)'] = 'Karyawan/get_kota/$1';
// $route['master/karyawan/get-kecamatan/(:any)'] = 'Karyawan/get_kecamatan/$1';
// $route['master/karyawan/get-kelurahan/(:any)'] = 'Karyawan/get_kelurahan/$1';

// $route['master/karyawan/cek-jabatan'] = 'Data_diri/cek_jabatan';

// $route['master/karyawan/data-diri-edit/(:any)'] = 'Karyawan/data_diri_edit/$1';
// $route['master/karyawan/data-pendidikan/(:any)'] = 'Karyawan/data_pendidikan/$1';
// $route['master/karyawan/data-pengalaman-kerja/(:any)'] = 'Karyawan/data_pengalamankerja/$1';
// $route['master/karyawan/data-riwayat-kerja/(:any)'] = 'Karyawan/data_riwayatkerja/$1';
// $route['master/karyawan/data-akun/(:any)'] = 'Karyawan/data_akun/$1';
// $route['master/karyawan/data-file/(:any)'] = 'Karyawan/data_file/$1';

// $route['master/karyawan/form/data-diri'] = 'Data_diri';
// $route['master/karyawan/detail/data-diri/(:any)'] = 'Data_diri/detail_datadiri/$1';
// $route['master/karyawan/form/data-diri/edit/(:any)'] = 'Data_diri/edit/$1';
// $route['master/karyawan/form/data-diri/save'] = 'Data_diri/save';

// $route['master/karyawan/data-keluarga/(:any)'] = 'Data_keluarga/main/$1';
// $route['master/karyawan/form/data-keluarga/(:any)'] = 'Data_keluarga/form/$1';
// $route['master/karyawan/edit/data-keluarga/(:any)/(:any)'] = 'Data_keluarga/edit/$1/$2';
// $route['master/karyawan/save/data-keluarga'] = 'Data_keluarga/save';
// $route['master/karyawan/delete/data-keluarga'] = 'Data_keluarga/delete';

// $route['master/karyawan/riwayat-pendidikan/(:any)'] = 'Riwayat_pendidikan/index/$1';
// $route['master/karyawan/form/riwayat-pendidikan/(:any)'] = 'Riwayat_pendidikan/form/$1';
// $route['master/karyawan/edit/riwayat-pendidikan/(:any)/(:any)'] = 'Riwayat_pendidikan/edit/$1/$2';
// $route['master/karyawan/save/riwayat-pendidikan'] = 'Riwayat_pendidikan/save';
// $route['master/karyawan/delete/riwayat-pendidikan'] = 'Riwayat_pendidikan/delete';

// $route['master/karyawan/pengalaman-kerja/data/(:any)'] = 'Pengalaman_kerja/data/$1';
// $route['master/karyawan/pengalaman-kerja/list-data/(:any)'] = 'Pengalaman_kerja/list_data/$1';
// $route['master/karyawan/pengalaman-kerja/form/(:any)'] = 'Pengalaman_kerja/form/$1';
// $route['master/karyawan/pengalaman-kerja/edit/(:any)/(:any)'] = 'Pengalaman_kerja/form/$1/$2';
// $route['master/karyawan/pengalaman-kerja/detail/(:any)'] = 'Pengalaman_kerja/detail/$1';
// $route['master/karyawan/pengalaman-kerja/save'] = 'Pengalaman_kerja/save';
// $route['master/karyawan/pengalaman-kerja/delete'] = 'Pengalaman_kerja/delete';

// $route['master/karyawan/karir-pekerjaan/(:any)'] = 'Karir_pekerjaan/index/$1';
// $route['master/karyawan/form/karir-pekerjaan/(:any)'] = 'Karir_pekerjaan/form/$1';
// $route['master/karyawan/edit/karir-pekerjaan/(:any)/(:any)'] = 'Karir_pekerjaan/edit/$1/$2';
// $route['master/karyawan/save/karir-pekerjaan'] = 'Karir_pekerjaan/save';
// $route['master/karyawan/delete/karir-pekerjaan'] = 'Karir_pekerjaan/delete';

// $route['master/karyawan/data-sertifikat/(:any)'] = 'Data_sertifikat/index/$1';
// $route['master/karyawan/form/data-sertifikat/(:any)'] = 'Data_sertifikat/form/$1';
// $route['master/karyawan/edit/data-sertifikat/(:any)/(:any)'] = 'Data_sertifikat/edit/$1/$2';
// $route['master/karyawan/save/data-sertifikat'] = 'Data_sertifikat/save';
// $route['master/karyawan/delete/data-sertifikat'] = 'Data_sertifikat/delete';

// $route['master/karyawan/data-akun/(:any)'] = 'Data_akun/index/$1';
// $route['master/karyawan/form/data-akun/(:any)'] = 'Data_akun/form/$1';
// $route['master/karyawan/edit/data-akun/(:any)/(:any)'] = 'Data_akun/edit/$1/$2';
// $route['master/karyawan/save/data-akun'] = 'Data_akun/save';
// $route['master/karyawan/delete/data-akun'] = 'Data_akun/delete';

// $route['master/karyawan/data-file/(:any)'] = 'Data_kelengkapan_file/index/$1';
// $route['master/karyawan/form/data-file/(:any)'] = 'Data_kelengkapan_file/form/$1';
// $route['master/karyawan/edit/data-file/(:any)/(:any)'] = 'Data_kelengkapan_file/edit/$1/$2';
// $route['master/karyawan/save/data-file'] = 'Data_kelengkapan_file/save';
// $route['master/karyawan/delete/data-file'] = 'Data_kelengkapan_file/delete';

// $route['master/jenis-plafon'] = 'Jenis_plafon';
// $route['master/jenis-plafon/view-data/(:any)'] = 'Jenis_plafon/view_data/$1';
// $route['master/jenis-plafon/list-data/(:any)'] = 'Jenis_plafon/list_data/$1';
// $route['master/jenis-plafon/form/tambah'] = 'Jenis_plafon/form';
// $route['master/jenis-plafon/form/edit/(:any)'] = 'Jenis_plafon/form/$1';
// $route['master/jenis-plafon/form/hapus/(:any)'] = 'Jenis_plafon/form/$1';
// $route['master/jenis-plafon/save'] = 'Jenis_plafon/save';
// $route['master/jenis-plafon/delete'] = 'Jenis_plafon/delete';
// $route['master/jenis-plafon/get-cabang'] = 'Jenis_plafon/get_cabang';
// // END MASTER

// //PENGATURAN
// $route['pengaturan/perusahaan'] = 'Pengaturan_perusahaan';
// $route['pengaturan/perusahaan/edit/data-profil/(:any)'] = 'Pengaturan_perusahaan/edit_profil/$1';
// $route['pengaturan/perusahaan/save/data-profil'] = 'Pengaturan_perusahaan/save_profil';
// $route['pengaturan/perusahaan/invoice-pdf/(:any)'] = 'Pengaturan_perusahaan/invoice_pdf/$1';

// $route['pengaturan/shift'] = 'Pengaturan_shift';
// $route['pengaturan/shift/tambah'] = 'Pengaturan_shift/form';
// $route['pengaturan/shift/edit/(:any)'] = 'Pengaturan_shift/edit/$1';
// $route['pengaturan/shift/save'] = 'Pengaturan_shift/save';
// $route['pengaturan/shift/update'] = 'Pengaturan_shift/save_lawas';
// $route['pengaturan/shift/delete'] = 'Pengaturan_shift/delete';
// $route['pengaturan/shift/import'] = 'Pengaturan_shift/import';
// $route['pengaturan/shift/view-data/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Pengaturan_shift/view_data/$1/$2/$3/$4/$5';
// $route['pengaturan/shift/export/(:any)/(:any)/(:any)/(:any)'] = 'Pengaturan_shift/export_xls/$1/$2/$3/$4';
// $route['pengaturan/shift/get-karyawan/(:any)/(:any)'] = 'Pengaturan_shift/get_karyawan/$1/$2';
// $route['pengaturan/shift/get-departemen/(:any)'] = 'Pengaturan_shift/get_departemen/$1';
// $route['pengaturan/shift/get-shift/(:any)'] = 'Pengaturan_shift/get_shift/$1';

// $route['pengaturan/kepala-cabang'] = 'Kepala_cabang';
// $route['pengaturan/kepala-cabang/list-data'] = 'Kepala_cabang/list_data';
// $route['pengaturan/kepala-cabang/form/tambah'] = 'Kepala_cabang/form';
// $route['pengaturan/kepala-cabang/detail-cabang/(:any)'] = 'Kepala_cabang/detail_cabang/$1';
// $route['pengaturan/kepala-cabang/form/edit/(:any)'] = 'Kepala_cabang/form/$1';
// $route['pengaturan/kepala-cabang/form/hapus/(:any)'] = 'Kepala_cabang/form/$1';
// $route['pengaturan/kepala-cabang/save'] = 'Kepala_cabang/save';
// $route['pengaturan/kepala-cabang/delete'] = 'Kepala_cabang/delete';

// $route['pengaturan/kepala-departemen'] = 'Kepala_departemen';
// $route['pengaturan/kepala-departemen/list-data'] = 'Kepala_departemen/list_data';
// $route['pengaturan/kepala-departemen/form/tambah'] = 'Kepala_departemen/form';
// $route['pengaturan/kepala-departemen/detail-departemen/(:any)'] = 'Kepala_departemen/detail_departemen/$1';
// $route['pengaturan/kepala-departemen/form/edit/(:any)'] = 'Kepala_departemen/form/$1';
// $route['pengaturan/kepala-departemen/form/hapus/(:any)'] = 'Kepala_departemen/form/$1';
// $route['pengaturan/kepala-departemen/save'] = 'Kepala_departemen/save';
// $route['pengaturan/kepala-departemen/delete'] = 'Kepala_departemen/delete';

// $route['pengaturan/atasan-khusus'] = 'Atasan_khusus';
// $route['pengaturan/atasan-khusus/list-data'] = 'Atasan_khusus/list_data';
// $route['pengaturan/atasan-khusus/form/tambah'] = 'Atasan_khusus/form';
// $route['pengaturan/atasan-khusus/form/edit/(:any)'] = 'Atasan_khusus/form/$1';
// $route['pengaturan/atasan-khusus/form/hapus/(:any)'] = 'Atasan_khusus/form/$1';
// $route['pengaturan/atasan-khusus/save'] = 'Atasan_khusus/save';
// $route['pengaturan/atasan-khusus/delete'] = 'Atasan_khusus/delete';
// $route['pengaturan/atasan-khusus/get-atasan/(:any)'] = 'Atasan_khusus/get_atasan/$1';

// $route['pengaturan/ijin'] = 'Pengaturan_ijin';
// $route['pengaturan/ijin/list-data'] = 'Pengaturan_ijin/list_data';
// $route['pengaturan/ijin/form/tambah'] = 'Pengaturan_ijin/form';
// $route['pengaturan/ijin/form/edit/(:any)'] = 'Pengaturan_ijin/form/$1';
// $route['pengaturan/ijin/form/hapus/(:any)'] = 'Pengaturan_ijin/form/$1';
// $route['pengaturan/ijin/save'] = 'Pengaturan_ijin/save';
// $route['pengaturan/ijin/delete'] = 'Pengaturan_ijin/delete';
// $route['pengaturan/ijin/get-atasan/(:any)'] = 'Pengaturan_ijin/get_atasan/$1';

// $route['pengaturan/lembur'] = 'Pengaturan_lembur';
// $route['pengaturan/lembur/list-data'] = 'Pengaturan_lembur/list_data';
// $route['pengaturan/lembur/form/tambah'] = 'Pengaturan_lembur/form';
// $route['pengaturan/lembur/form/edit/(:any)'] = 'Pengaturan_lembur/form/$1';
// $route['pengaturan/lembur/form/hapus/(:any)'] = 'Pengaturan_lembur/form/$1';
// $route['pengaturan/lembur/save'] = 'Pengaturan_lembur/save';
// $route['pengaturan/lembur/delete'] = 'Pengaturan_lembur/delete';
// $route['pengaturan/lembur/get-atasan/(:any)'] = 'Pengaturan_lembur/get_atasan/$1';

// $route['pengaturan/reimbursement'] = 'Pengaturan_reimbursement';
// $route['pengaturan/reimbursement/list-data'] = 'Pengaturan_reimbursement/list_data';
// $route['pengaturan/reimbursement/form/tambah'] = 'Pengaturan_reimbursement/form';
// $route['pengaturan/reimbursement/form/edit/(:any)'] = 'Pengaturan_reimbursement/form/$1';
// $route['pengaturan/reimbursement/form/hapus/(:any)'] = 'Pengaturan_reimbursement/form/$1';
// $route['pengaturan/reimbursement/save'] = 'Pengaturan_reimbursement/save';
// $route['pengaturan/reimbursement/delete'] = 'Pengaturan_reimbursement/delete';
// $route['pengaturan/reimbursement/get-atasan/(:any)'] = 'Pengaturan_reimbursement/get_atasan/$1';

// $route['pengaturan/notif'] = 'Pengaturan_notif';
// $route['pengaturan/notif/list_data'] = 'Pengaturan_notif/list_data';
// $route['pengaturan/notif/form/tambah'] = 'Pengaturan_notif/form';
// $route['pengaturan/notif/form/edit/(:any)'] = 'Pengaturan_notif/form/$1';
// $route['pengaturan/notif/form/hapus/(:any)'] = 'Pengaturan_notif/form/$1';
// $route['pengaturan/notif/save'] = 'Pengaturan_notif/save';
// $route['pengaturan/notif/delete'] = 'Pengaturan_notif/delete';

// //END PENGATURAN

// //START PENGAJUAN

// //IZIN//
// $route['pengajuan/izin'] = 'Pengajuan_izin';
// $route['pengajuan/izin/approve_data'] = 'Pengajuan_izin/approve_data';
// $route['pengajuan/izin/tambah'] = 'Pengajuan_izin/form';
// $route['pengajuan/izin/edit/(:any)'] = 'Pengajuan_izin/edit/$1';
// $route['pengajuan/izin/detail/(:any)'] = 'Pengajuan_izin/detail/$1';
// $route['pengajuan/izin/save'] = 'Pengajuan_izin/save';
// $route['pengajuan/izin/update'] = 'Pengajuan_izin/update';
// $route['pengajuan/izin/delete'] = 'Pengajuan_izin/delete';
// $route['pengajuan/izin/import'] = 'Pengajuan_izin/import';
// $route['pengajuan/izin/view-data/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Pengajuan_izin/view_data/$1/$2/$3/$4/$5/$6';
// $route['pengajuan/izin/list-data/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Pengajuan_izin/list_data/$1/$2/$3/$4/$5/$6';

// $route['pengajuan/izin/verifikasi/spv/(:any)'] = 'Pengajuan_izin/modal_spv/$1';
// $route['pengajuan/izin/verifikasi/kedep/(:any)'] = 'Pengajuan_izin/modal_kedep/$1';
// $route['pengajuan/izin/verifikasi/kacab/(:any)'] = 'Pengajuan_izin/modal_kacab/$1';
// $route['pengajuan/izin/verifikasi/hrd/(:any)'] = 'Pengajuan_izin/modal_hrd/$1';
// $route['pengajuan/izin/verifikasi/direksi/(:any)'] = 'Pengajuan_izin/modal_direksi/$1';

// $route['pengajuan/izin/approve-spv'] = 'Pengajuan_izin/approve_spv';
// $route['pengajuan/izin/approve-kedep'] = 'Pengajuan_izin/approve_kedep';
// $route['pengajuan/izin/approve-kacab'] = 'Pengajuan_izin/approve_kacab';
// $route['pengajuan/izin/approve-hrd'] = 'Pengajuan_izin/approve_hrd';
// $route['pengajuan/izin/approve-direksi'] = 'Pengajuan_izin/approve_direksi';

// $route['pengajuan/izin/get-jenis'] = 'Pengajuan_izin/get_jenis';
// $route['pengajuan/izin/get-jenis-form'] = 'Pengajuan_izin/get_jenis_form';
// $route['pengajuan/izin/get-cabang'] = 'Pengajuan_izin/get_cabang';
// $route['pengajuan/izin/get-departemen/(:any)'] = 'Pengajuan_izin/get_departemen/$1';
// $route['pengajuan/izin/get-karyawan/(:any)/(:any)'] = 'Pengajuan_izin/get_karyawan/$1/$2';

// //untuk link notif
// $route['pengajuan/data-izin/(:any)'] = 'Pengajuan_izin/data_izin/$1';
// //untuk link notif
// //IZIN//

// //LEMBUR//
// $route['pengajuan/lembur'] = 'Pengajuan_lembur';
// $route['pengajuan/lembur/approve_data'] = 'Pengajuan_lembur/approve_data';
// $route['pengajuan/lembur/tambah'] = 'Pengajuan_lembur/form';
// $route['pengajuan/lembur/edit/(:any)'] = 'Pengajuan_lembur/edit/$1';
// $route['pengajuan/lembur/detail-lembur-mulai/(:any)'] = 'Pengajuan_lembur/detail_lembur_mulai/$1';
// $route['pengajuan/lembur/detail-lembur-selesai/(:any)'] = 'Pengajuan_lembur/detail_lembur_selesai/$1';
// $route['pengajuan/lembur/save'] = 'Pengajuan_lembur/save';
// $route['pengajuan/lembur/update'] = 'Pengajuan_lembur/update';
// $route['pengajuan/lembur/delete'] = 'Pengajuan_lembur/delete';
// $route['pengajuan/lembur/import'] = 'Pengajuan_lembur/import';
// $route['pengajuan/lembur/view-data/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Pengajuan_lembur/view_data/$1/$2/$3/$4/$5/$6';
// $route['pengajuan/lembur/list-data/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Pengajuan_lembur/list_data/$1/$2/$3/$4/$5/$6';

// $route['pengajuan/lembur/verifikasi/(:any)'] = 'Pengajuan_lembur/modal/$1';
// $route['pengajuan/lembur/verifikasi/kedep/(:any)'] = 'Pengajuan_lembur/modal/$1';
// $route['pengajuan/lembur/verifikasi/kacab/(:any)'] = 'Pengajuan_lembur/modal/$1';
// $route['pengajuan/lembur/verifikasi/hrd/(:any)'] = 'Pengajuan_lembur/modal/$1';
// $route['pengajuan/lembur/verifikasi/direksi/(:any)'] = 'Pengajuan_lembur/modal/$1';

// $route['pengajuan/lembur/approve'] = 'Pengajuan_lembur/approve';
// $route['pengajuan/lembur/approve-kedep'] = 'Pengajuan_lembur/approve_kedep';
// $route['pengajuan/lembur/approve-kacab'] = 'Pengajuan_lembur/approve_kacab';
// $route['pengajuan/lembur/approve-hrd'] = 'Pengajuan_lembur/approve_hrd';
// $route['pengajuan/lembur/approve-direksi'] = 'Pengajuan_lembur/approve_direksi';

// $route['pengajuan/lembur/get-jenis'] = 'Pengajuan_lembur/get_jenis';
// $route['pengajuan/lembur/get-jenis-form'] = 'Pengajuan_lembur/get_jenis_form';
// $route['pengajuan/lembur/get-cabang'] = 'Pengajuan_lembur/get_cabang';
// $route['pengajuan/lembur/get-departemen/(:any)'] = 'Pengajuan_lembur/get_departemen/$1';
// $route['pengajuan/lembur/get-karyawan/(:any)/(:any)'] = 'Pengajuan_lembur/get_karyawan/$1/$2';

// //untuk link notif
// $route['pengajuan/data-lembur/(:any)'] = 'Pengajuan_lembur/data_lembur/$1';
// //untuk link notif
// //LEMBUR//
// //END PENGAJUAN

// // DASHBOARD
// $route['dashboard'] = 'Dashboard';
// $route['dashboard/list_cabang_selected'] = 'Dashboard/list_cabang_selected';
// $route['dashboard/list_jam_kerja/(:any)'] = 'Dashboard/list_jam_kerja/$1';
// $route['dashboard/data_dashboard/(:any)/(:any)'] = 'Dashboard/data_dashboard/$1/$2';
// $route['dashboard/absensi'] = 'Dashboard_absensi';
// $route['dashboard/absensi/list'] = 'Dashboard_absensi/list_data';
// $route['dashboard/absensi/list_absensi'] = 'Dashboard_absensi/list_absensi';
// $route['dashboard/absensi/list_absensi_selected'] = 'Dashboard_absensi/list_absensi_selected';
// $route['dashboard/absensi/excel'] = 'Dashboard_absensi/excel';
// $route['dashboard/absensi/view-data/(:any)/(:any)/(:any)/(:any)'] = 'Dashboard_absensi/view_data/$1/$2/$3/$4';
// $route['dashboard/absensi/list-data/(:any)/(:any)/(:any)/(:any)'] = 'Dashboard_absensi/list_data/$1/$2/$3/$4';
// $route['lokasi/(:any)/(:any)'] = 'Dashboard_absensi/lokasi/$1/$2';
// $route['dashboard/absensi/get-cabang'] = 'Dashboard_absensi/get_cabang';
// $route['dashboard/absensi/get-departemen/(:any)'] = 'Dashboard_absensi/get_departemen/$1';
// // END DASHBOARD

// //LAPORAN
// $route['absensi/data'] = 'Data_absensi';
// $route['absensi/list/cabang'] = 'Data_absensi/list_cabang';
// $route['absensi/list/departemen/(:any)'] = 'Data_absensi/list_departemen/$1';
// $route['absensi/list/karyawan'] = 'Data_absensi/list_karyawan';
// $route['absensi/data/download/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Data_absensi/download/$1/$2/$3/$4/$5/$6';
// $route['absensi/data/view-data/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Data_absensi/view_data/$1/$2/$3/$4/$5';
// $route['absensi/list/data/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Data_absensi/list_data/$1/$2/$3/$4/$5';
// $route['absensi/list/data_dep/(:any)/(:any)/(:any)/(:any)'] = 'Data_absensi/list_data_dep/$1/$2/$3/$4';
// $route['absensi/lokasi/(:any)/(:any)/(:any)'] = 'Data_absensi/lokasi/$1/$2/$3';
// $route['absensi/form'] = 'Data_absensi/form';
// $route['absensi/form/edit/(:any)/(:any)'] = 'Data_absensi/form/$1/$2';
// $route['absensi/save'] = 'Data_absensi/save';
// $route['absensi/update'] = 'Data_absensi/update';
// $route['absensi/delete/(:any)/(:any)'] = 'Data_absensi/delete/$1/$2';
// $route['cron/rekap/(:any)'] = 'Cron/rekap/$1';
// $route['absensi/list/cabang_selected'] = 'Data_absensi/list_cabang_selected';
// //LAPORAN

// //REKAP
// $route['rekap/absensi/data'] = 'Rekap_absensi';
// $route['rekap/absensi/list/cabang'] = 'Rekap_absensi/list_cabang';
// $route['rekap/absensi/list/departemen/(:any)'] = 'Rekap_absensi/list_departemen/$1';
// $route['rekap/absensi/data/download/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Rekap_absensi/download/$1/$2/$3/$4/$5';
// $route['rekap/absensi/data/view-data/(:any)/(:any)/(:any)/(:any)'] = 'Rekap_absensi/view_data/$1/$2/$3/$4';
// $route['rekap/absensi/list/data/(:any)/(:any)/(:any)/(:any)'] = 'Rekap_absensi/list_data/$1/$2/$3/$4';
// //REKAP

// $route['laporan/aktivitas'] = 'Laporan_aktivitas';
// $route['laporan/aktivitas/approve_data'] = 'Laporan_aktivitas/approve_data';
// $route['laporan/aktivitas/tambah'] = 'Laporan_aktivitas/form';
// $route['laporan/aktivitas/edit/(:any)'] = 'Laporan_aktivitas/edit/$1';
// $route['laporan/aktivitas/detail/(:any)'] = 'Laporan_aktivitas/detail/$1';
// $route['laporan/aktivitas/detail-lembur-selesai/(:any)'] = 'Laporan_aktivitas/detail_lembur_selesai/$1';
// $route['laporan/aktivitas/save'] = 'Laporan_aktivitas/save';
// $route['laporan/aktivitas/update'] = 'Laporan_aktivitas/update';
// $route['laporan/aktivitas/delete'] = 'Laporan_aktivitas/delete';
// $route['laporan/aktivitas/import'] = 'Laporan_aktivitas/import';
// $route['laporan/aktivitas/export/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Laporan_aktivitas/export/$1/$2/$3/$4/$5';
// $route['laporan/aktivitas/view-data/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Laporan_aktivitas/view_data/$1/$2/$3/$4/$5';
// $route['laporan/aktivitas/list-data/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'Laporan_aktivitas/list_data/$1/$2/$3/$4/$5';

// $route['laporan/aktivitas/verifikasi/(:any)'] = 'Laporan_aktivitas/modal/$1';
// $route['laporan/aktivitas/approve'] = 'Laporan_aktivitas/approve';

// $route['laporan/aktivitas/get-jenis'] = 'Laporan_aktivitas/get_jenis';
// $route['laporan/aktivitas/get-jenis-form'] = 'Laporan_aktivitas/get_jenis_form';
// $route['laporan/aktivitas/get-cabang'] = 'Laporan_aktivitas/get_cabang';
// $route['laporan/aktivitas/get-departemen/(:any)'] = 'Laporan_aktivitas/get_departemen/$1';
// $route['laporan/aktivitas/get-karyawan/(:any)/(:any)'] = 'Laporan_aktivitas/get_karyawan/$1/$2';
// //LAPORAN

// //GAJI
// $route['informasi/gaji'] = 'Informasi_gaji';
// $route['informasi/gaji/view-data/(:any)/(:any)/(:any)/(:any)'] = 'Informasi_gaji/view_data/$1/$2/$3/$4';
// $route['informasi/gaji/list-data/(:any)/(:any)/(:any)/(:any)'] = 'Informasi_gaji/list_data/$1/$2/$3/$4';
// $route['informasi/gaji/download/(:any)/(:any)/(:any)'] = 'Informasi_gaji/download/$1/$2/$3';
// $route['informasi/gaji/import-main'] = 'Informasi_gaji/import_main';
// $route['informasi/gaji/view-import'] = 'Informasi_gaji/view_import';
// $route['informasi/gaji/list-import'] = 'Informasi_gaji/list_import';
// $route['informasi/gaji/template-import'] = 'Informasi_gaji/template_import';
// $route['informasi/gaji/import_data_excel'] = 'Informasi_gaji/import_data_excel';

// $route['informasi/gaji/export/(:any)/(:any)/(:any)'] = 'Informasi_gaji/export/$1/$2/$3';

// $route['informasi/gaji/detail/(:any)'] = 'Informasi_gaji/detail/$1';
// $route['informasi/gaji/edit/(:any)'] = 'Informasi_gaji/edit/$1';
// $route['informasi/gaji/update'] = 'Informasi_gaji/update';
// $route['informasi/gaji/delete'] = 'Informasi_gaji/delete';
// $route['informasi/gaji/publish'] = 'Informasi_gaji/publish';
// $route['informasi/gaji/unpublish'] = 'Informasi_gaji/unpublish';
// $route['informasi/gaji/publish-all'] = 'Informasi_gaji/publish_all';
// $route['informasi/gaji/unpublish-all'] = 'Informasi_gaji/unpublish_all';

// $route['informasi/gaji/edit-temp/(:any)'] = 'Informasi_gaji/edit_temp/$1';
// $route['informasi/gaji/update-temp'] = 'Informasi_gaji/update_temp';
// $route['informasi/gaji/delete-temp'] = 'Informasi_gaji/delete_temp';
// $route['informasi/gaji/save-all-temp'] = 'Informasi_gaji/save_all_temp';
// $route['informasi/gaji/delete-all-temp'] = 'Informasi_gaji/delete_all_temp';

// $route['informasi/gaji/get-cabang'] = 'Informasi_gaji/get_cabang';
// $route['informasi/gaji/get-departemen/(:any)'] = 'Informasi_gaji/get_departemen/$1';
// $route['informasi/gaji/get-karyawan'] = 'Informasi_gaji/get_karyawan';
// $route['informasi/gaji/cabang'] = 'Informasi_gaji/cabang';
// $route['informasi/gaji/departemen/(:any)'] = 'Informasi_gaji/departemen/$1';
// //GAJI

// //REIMBURSEMENT
// $route['data/reimburse'] = 'Data_reimburse';
// $route['data/reimburse/view-data/(:any)'] = 'Data_reimburse/view_data/$1';
// $route['data/reimburse/list-data/(:any)'] = 'Data_reimburse/list_data/$1';
// $route['data/reimburse/detail/(:any)'] = 'Data_reimburse/detail/$1';
// $route['data/reimburse/simpan'] = 'Data_reimburse/simpan';

// $route['data/reimburse/approve_data'] = 'Data_reimburse/approve_data';
// $route['data/reimburse/tambah'] = 'Data_reimburse/form';
// $route['data/reimburse/edit/(:any)'] = 'Data_reimburse/edit/$1';
// $route['data/reimburse/detail/(:any)'] = 'Data_reimburse/detail/$1';
// $route['data/reimburse/detail-lembur-selesai/(:any)'] = 'Data_reimburse/detail_lembur_selesai/$1';
// $route['data/reimburse/save'] = 'Data_reimburse/save';
// $route['data/reimburse/update'] = 'Data_reimburse/update';
// $route['data/reimburse/delete'] = 'Data_reimburse/delete';
// $route['data/reimburse/import'] = 'Data_reimburse/import';
// $route['data/reimburse/export/(:any)'] = 'Data_reimburse/export/$1';
// //REIMBURSEMENT

// //REKAP_REIMBURSEMENT
// $route['rekap/reimburse/departemen'] = 'Rekap_reimburse';
// $route['rekap/reimburse/rekap-departemen/(:any)/(:any)/(:any)/(:any)'] = 'Rekap_reimburse/rekap_departemen/$1/$2/$3/$4';
// $route['rekap/reimburse/karyawan'] = 'Rekap_reimburse/main_karyawan';
// $route['rekap/reimburse/rekap-karyawan/(:any)/(:any)/(:any)'] = 'Rekap_reimburse/rekap_karyawan/$1/$2/$3';
// $route['rekap/reimburse/list-karyawan'] = 'Rekap_reimburse/get_karyawan';

// $route['rekap/reimburse/export_pdf_all/(:any)/(:any)/(:any)/(:any)'] = 'Rekap_reimburse/export_pdf_all/$1/$2/$3/$4';
// $route['rekap/reimburse/export_pdf_karyawan/(:any)/(:any)/(:any)/(:any)'] = 'Rekap_reimburse/export_pdf_karyawan/$1/$2/$3/$4';

// //REKAP_REIMBURSEMENT

// //INFORMASI
// $route['informasi/berita'] = 'Berita';
// $route['informasi/berita/list-data'] = 'Berita/list_data';
// $route['informasi/berita/save'] = 'Berita/save';
// $route['informasi/berita/delete'] = 'Berita/delete';
// $route['informasi/berita/form'] = 'Berita/form';
// $route['informasi/berita/detail/(:any)'] = 'Berita/detail/$1';
// $route['informasi/berita/edit/(:any)'] = 'Berita/form/$1';

// $route['informasi/pengumuman'] = 'Pengumuman';
// $route['informasi/pengumuman/list-data'] = 'Pengumuman/list_data';
// $route['informasi/pengumuman/save'] = 'Pengumuman/save';
// $route['informasi/pengumuman/delete'] = 'Pengumuman/delete';
// $route['informasi/pengumuman/form'] = 'Pengumuman/form';
// $route['informasi/pengumuman/detail/(:any)'] = 'Pengumuman/detail/$1';
// $route['informasi/pengumuman/edit/(:any)'] = 'Pengumuman/form/$1';
// //INFORMASi


// Disabled akses langsung ke controller
$route['(.*)'] = "error404";
