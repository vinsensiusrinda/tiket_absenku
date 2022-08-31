<?php

/**
 * Welcome to Luthier-CI!
 *
 * This is your main route file. Put all your HTTP-Based routes here using the static
 * Route class methods
 *
 * Examples:
 *
 *    Route::get('foo', 'bar@baz');
 *      -> Route::['foo']['GET','bar/baz';
 *
 *    Route::post('bar', 'baz@fobie', [ 'namespace' => 'cats' ]);
 *      -> Route::['bar']['POST','cats/baz/foobie';
 *
 *    Route::get('blog/{slug}', 'blog@post');
 *      -> Route::['blog/{id}','blog/post'
 */

Route::get('/', function () {
    redirect(route('login'));
})->name('homepage');

Route::set('404_override', function () {
    show_404();
    // redirect(route('page.not.found'));
});

Route::set('translate_uri_dashes', FALSE);

Route::get('image', 'Image@index');
Route::get('auto_login/{username?}/{token?}', 'Auto_login@index');
Route::group('login', function () {
    Route::get('', 'Auth@index')->name('login');
    Route::post('proses', 'Auth@login');
    Route::get('captcha', 'Auth@captcha');
});
Route::get('logout', 'Auth@logout');

// Route::get('menu', 'Akses_menu@index');

Route::group('user', function () {
    Route::get('home', 'User@index')->name('user.home');
    Route::post('list_data', 'User@list_data')->name('user.listdata');
    Route::get('form/tambah', 'User@form')->name('user.form.tambah');
    Route::get('form/edit/{id?}', 'User@form')->name('user.form.edit');
    Route::get('form/hapus/{id?}', 'User@form')->name('user.form.hapus');
    Route::post('save', 'User@save')->name('user.save');
    Route::post('delete', 'User@delete')->name('user.delete');
});

Route::group('task', function () {
    Route::get('home', 'Task@index')->name('task.home');
    Route::post('list_data', 'Task@list_data')->name('task.listdata');
    Route::get('form/tambah', 'Task@form')->name('task.form.tambah');
    Route::post('getmodule', 'Task@getdatamodule')->name('task.form.module');
    Route::post('getsubmodule', 'Task@getdatasubmodule')->name('task.form.submodule');
    Route::get('form/edit/{no_tiket?}', 'Task@form')->name('task.form.edit');
    Route::get('form/hapus/{no_tiket?}', 'Task@form')->name('task.form.hapus');
    Route::post('save', 'Task@save')->name('task.save');
    Route::post('delete', 'Task@delete')->name('task.delete');
});

Route::group('api', function () {
    Route::group('notif', function () {
        Route::get('receive/{par}', 'Socket_send@receive_notification');
        Route::get('send/{target?}/{id_room?}', 'Socket_send@notif_izin');
    });
});

Route::get('halaman-tidak-ditemukan', 'Page_not_found@index')->name('page.not.found');


$args = ['foo' => 'bar'];
// $this->middleware->run('AuthMiddleware', $args);
Route::get('test/{id?}', function () {
    echo "routing";
}, ['namespace' => 'foo', 'middleware' => 'Staff:1,2,3']);

Route::get('test2', function () {
    echo "routing";
}, ['namespace' => 'foo', 'middleware' => 'Staff']);


Route::group('', ['middleware' => ['Otentikasi_login']], function () {

    Route::get('new-token-req', 'Auth@token_req_new')->name('new.token.req');

    Route::get('ganti-password', 'Auth@ganti_password')->name("ganti.password");
    Route::post('gantipassword/proses', 'Auth@ganti_password_save')->name("ganti.password.proses");

    Route::group('dropdown', function () {
        Route::get('modul', 'Dropdown_menu@modul')->name('dropdown.modul');
        Route::get('submodul/{id_modul_kategori?}', 'Dropdown_menu@submodul')->name('dropdown.submodul');
        Route::get('layanan', 'Dropdown_menu@tipe_pelanggan')->name('dropdown.tipe_pelanggan');
        Route::get('pelanggan/{pelanggan?}', 'Dropdown_menu@pelanggan')->name('dropdown.pelanggan');
        Route::get('jabatan', 'Dropdown_menu@jabatan')->name('dropdown.jabatan');
        Route::get('jabatan/by/{cabang?}/{departemen?}', 'Dropdown_menu@jabatan_by_departemen')->name('dropdown.jabatan.by.departemen');
        Route::get('cabang', 'Dropdown_menu@cabang')->name('dropdown.cabang');
        Route::get('departemen', 'Dropdown_menu@departemen')->name('dropdown.departemen');
        Route::get('departemen/by/cabang/{cabang?}', 'Dropdown_menu@departemen_by_cabang')->name('dropdown.departemen.by.cabang');
        Route::get('supervisi/{id_cabang?}/{id_departemen?}', 'Dropdown_menu@supervisi')->name('dropdown.supervisi');
        Route::get('karyawan', 'Dropdown_menu@karyawan')->name('dropdown.karyawan');
        Route::get('karyawan/aktif/{id_cabang?}', 'Dropdown_menu@karyawanAktif')->name('dropdown.karyawan.aktif');
        Route::get('lokasi-absensi', 'Dropdown_menu@lokasi_absensi')->name('dropdown.lokasiabsensi');
        Route::get('provinsi', 'Dropdown_menu@provinsi')->name('dropdown.provinsi');
        Route::get('kota/{id_prov?}', 'Dropdown_menu@kota')->name('dropdown.kota');
        Route::get('kecamatan/{id_kota?}', 'Dropdown_menu@kecamatan')->name('dropdown.kecamatan');
        Route::get('kelurahan/{id_kecamatan?}', 'Dropdown_menu@kelurahan')->name('dropdown.kelurahan');
        Route::get('jam-kerja/{id_cabang?}', 'Dropdown_menu@getJamKerja')->name('dropdown.jamkerja');
        Route::get('jam-kerja-karyawan', 'Dropdown_menu@getJamKerjaKaryawan')->name('dropdown.jamkerjakaryawan');
        Route::get('jam-shift', 'Dropdown_menu@getJamShift')->name('dropdown.jamshift');
        Route::get('nama-shift/{id_cabang?}', 'Dropdown_menu@getNamaShift')->name('dropdown.shift.nama');
        Route::get('jenis-izin', 'Dropdown_menu@getJenisIzin')->name('dropdown.jenisizin');
    });

    Route::group('notification', function () {
        Route::get('notif-izin/{param?}', 'Dashboard@notif_izin');
        Route::get('notif-lembur/{param?}', 'Dashboard@notif_lembur');
        Route::get('notif-reimbursement/{param?}', 'Dashboard@notif_reimbursement');
    });

    Route::group('dashboard', ['middleware' => 'Auth_menu:1,2,4,5,7'], function () {
        Route::group('absensi', function () {
            Route::get('', 'dashboard@index')->name('dashboard.absensi');
            Route::get('lst/data/{jenis?}', 'dashboard@dashboard_list')->name('dashboard.list.data');

            Route::get('list_cabang_selected', 'dashboard@list_cabang_selected');
            Route::get('data/diagram/pie/{id_cabang?}/{id_shift?}', 'Dashboard@data_pie')->name('dashboard.absensi.data.diagram.pie');

            Route::group('detail', function () {
                Route::get('data/{id_cabang?}/{id_shift?}', 'Dashboard_absensi@index')->name('dashboard.absensi.detail.data');
                Route::get('list', 'Dashboard_absensi@list_data');
                Route::get('list_absensi', 'Dashboard_absensi@list_absensi');
                Route::get('list_absensi_selected', 'Dashboard_absensi@list_absensi_selected');
                Route::get('excel', 'Dashboard_absensi@excel');
                Route::get('view-data/{cabang?}/{departemen?}/{jadwal?}/{status?}', 'Dashboard_absensi@view_data');
                Route::post('list-data/{cabang?}/{departemen?}/{jadwal?}/{status?}', 'Dashboard_absensi@list_data');
                Route::get('lokasi/{jenis?}/{id?}', 'Dashboard_absensi@lokasi');
                Route::get('data_dashboard/{id_cabang?}/{id_departemen?}/{id_shift?}/{status?}', 'Dashboard_absensi@data_dashboard');
                // Route::get('get-departemen/{id}','Dashboard_absensi@get_departemen');
            });
        });

        Route::group('kepegawaian', function () {
            Route::get('', 'Kepegawaian@index')->name('dashboard.kepegawaian');
            Route::get('diagram/status-karyawan/{id?}', 'Kepegawaian@data_kepegawaian')->name("dashboard.kepegawaian.diagram.status");
            Route::get('diagram/pendidikan/{id_cabang?}', 'Kepegawaian@data_pendidikan')->name("dashboard.kepegawaian.diagram.pendidikan");
            Route::get('data/kontrak-berakhir', 'Kepegawaian@daftar_kontrak')->name("dashboard.kepegawaian.data.kontrak.berakhir");
            Route::post('data/kontrak-berakhir/list', 'Kepegawaian@list_data')->name("dashboard.kepegawaian.data.kontrak.list");;
            Route::get('data/kontrak-berakhir/download', 'Kepegawaian@download')->name('dashboard.kepegawaian.kontrak.berakhir.download');
        });
    });

    Route::group('master', function () {

        Route::group('cabang', function () {
            Route::group('', ['middleware' => 'Auth_menu:1,4'], function () {
                Route::get('', 'Cabang@index');
                Route::post('list_data', 'Cabang@list_data');
            });
            Route::group('', ['middleware' => 'Auth_menu:1'], function () {
                Route::get('form/tambah', 'Cabang@form');
                Route::get('form/edit/{id}', 'Cabang@form');
                Route::get('form/hapus/{id}', 'Cabang@form');
                Route::post('save', 'Cabang@save');
                Route::post('delete', 'Cabang@delete');
                Route::get('getCabang', 'Cabang@getCabangByName');
            });
        });

        Route::group('lokasi', function () {
            Route::group('', ['middleware' => 'Auth_menu:1,4,5'], function () {
                Route::get('', 'Lokasi@index');
                Route::post('list_data', 'Lokasi@ajax_list');
                Route::get('maps/json/{id_cabang?}', 'Lokasi@maps')->name('master.lokasi.maps.json');
            });
            Route::group('', ['middleware' => 'Auth_menu:1'], function () {
                Route::get('tambah', 'Lokasi@tambah');
                Route::get('edit/{id}', 'Lokasi@edit');
                Route::post('delete', 'Lokasi@delete');
                Route::post('save', 'Lokasi@insert');
                Route::post('update', 'Lokasi@update');
            });
        });

        Route::group('departemen', function () {
            Route::group('', ['middleware' => 'Auth_menu:1,4,5'], function () {
                Route::get('', 'Departemen@index');
                Route::post('list_data', 'Departemen@list_data');
            });
            Route::group('', ['middleware' => 'Auth_menu:1'], function () {
                Route::get('form/tambah', 'Departemen@form');
                Route::get('form/edit/{id}', 'Departemen@form');
                Route::get('form/hapus/{id}', 'Departemen@form');
                Route::post('save', 'Departemen@save');
                Route::post('delete', 'Departemen@delete');
            });
        });

        Route::group('jabatan', function () {
            Route::group('', ['middleware' => 'Auth_menu:1,4,5'], function () {
                Route::get('', 'Jabatan@index');
                Route::post('list_data', 'Jabatan@list_data');
            });
            Route::group('', ['middleware' => 'Auth_menu:1'], function () {
                Route::get('form/tambah', 'Jabatan@form');
                Route::get('form/edit/{id}', 'Jabatan@form');
                Route::get('form/hapus/{id}', 'Jabatan@form');
                Route::post('save', 'Jabatan@save');
                Route::post('delete', 'Jabatan@delete');
            });
        });

        Route::group('jenis-izin', function () {
            Route::group('', ['middleware' => 'Auth_menu:1,4'], function () {
                Route::get('', 'Jenis_izin@index');
                Route::post('list_data', 'Jenis_izin@list_data')->name('master.jenisizin.listdata');
            });
            Route::group('', ['middleware' => 'Auth_menu:1'], function () {
                Route::get('form/tambah', 'Jenis_izin@form')->name('master.jenisizin.form.tambah');
                Route::get('form/edit/{id_izin?}', 'Jenis_izin@form')->name('master.jenisizin.form.edit');
                Route::get('form/hapus/{id_izin?}', 'Jenis_izin@form')->name('master.jenisizin.form.hapus');
                Route::post('save', 'Jenis_izin@save')->name('master.jenisizin.save');
                Route::post('delete', 'Jenis_izin@delete')->name('master.jenisizin.delete');
            });
        });
    });

    //PENGATURAN
    Route::group('pengaturan', function () {

        Route::group('jam-kerja', function () {
            Route::group('', ['middleware' => 'Auth_menu:1,4'], function () {
                Route::get('', 'Jadwal_kerja@index')->name('pengaturan.jamkerja.home');
                Route::post('data', 'Jadwal_kerja@list_data')->name('pengaturan.jamkerja.listdata');
                Route::get('detail/{id_cabang?}', 'Jadwal_kerja@detail')->name('pengaturan.jamkerja.detail');
                Route::post('jadwal', 'Jadwal_kerja@jam_kerja')->name('pengaturan.jamkerja.jadwal');
            });
            Route::post('update', 'Jadwal_kerja@update', ['middleware' => 'Auth_menu:1'])->name('pengaturan.jamkerja.update');
        });

        Route::group('izin', function () {
            Route::group('', ['middleware' => 'Auth_menu:1,4'], function () {
                Route::get('', 'Pengaturan_izin@index');
                Route::get('data', 'Pengaturan_izin@list_data')->name('pengaturan.izin.data');
            });
            Route::group('', ['middleware' => 'Auth_menu:1'], function () {
                Route::post('save', 'Pengaturan_izin@save')->name('pengaturan.izin.save');
                Route::get('get-atasan/{id}', 'Pengaturan_izin@get_atasan');
            });
        });

        Route::group('lembur', function () {
            Route::group('', ['middleware' => 'Auth_menu:1,4'], function () {
                Route::get('', 'Pengaturan_lembur@index');
                Route::get('data', 'Pengaturan_lembur@list_data')->name('pengaturan.lembur.data');
            });
            Route::group('', ['middleware' => 'Auth_menu:1'], function () {
                Route::post('save', 'Pengaturan_lembur@save')->name('pengaturan.lembur.save');
                Route::get('get-atasan/{id}', 'Pengaturan_lembur@get_atasan');
            });
        });

        Route::group('hari-libur', function () {
            Route::group('', ['middleware' => 'Auth_menu:1,4'], function () {
                Route::get('', 'Kalender@index');
                Route::post('list_data', 'Kalender@list_data');
                Route::get('view/thumbnail', 'Kalender@kalender_data')->name("pengaturan.harilibur.view.thumbnail");
                Route::get('view/list', 'Kalender@view_data');
            });
            Route::group('', ['middleware' => 'Auth_menu:1,4'], function () {
                Route::get('export/{id}', 'Kalender@export');
                Route::get('form/tambah', 'Kalender@form');
                Route::get('form/edit/{id}', 'Kalender@form');
                Route::get('form/hapus/{id}', 'Kalender@form');
                Route::post('save', 'Kalender@save');
                Route::post('update', 'Kalender@save');
                Route::post('delete', 'Kalender@delete');
                Route::post('delete-holiday', 'Kalender@delete_holiday');
                Route::get('cek-tanggal', 'Kalender@cek_tanggal');
                Route::post('import', 'Kalender@import');
            });
        });
    });
    //END PENGATURAN

    // START KELOLA ABSENSI
    Route::group('absensi', function () {
        Route::get('data', 'Data_absensi@index');
        Route::get('list/cabang', 'Data_absensi@list_cabang');
        Route::get('list/departemen/{id?}', 'Data_absensi@list_departemen');
        Route::get('list/karyawan', 'Data_absensi@list_karyawan');
        Route::get('data/download/{tgl_mulai?}/{tgl_selesai?}/{id_karyawan?}/{id_cabang?}/{id_departemen?}/{jenis?}', 'Data_absensi@download');
        Route::get('data/view-data/{tgl_mulai?}/{tgl_selesai?}/{id_karyawan?}/{id_cabang?}/{id_departemen?}', 'Data_absensi@view_data');
        Route::post('list/data/{tgl_mulai?}/{tgl_selesai?}/{id_karyawan?}/{id_cabang?}/{id_departemen?}', 'Data_absensi@list_data');
        Route::get('lokasi/{jenis?}/{tanggal?}/{karyawan?}', 'Data_absensi@lokasi');
        Route::get('form', 'Data_absensi@form');
        Route::group('', ['middleware' => 'Auth_menu:1'], function () {
            Route::get('form/edit/{id_karyawan?}/{tanggal?}', 'Data_absensi@form');
            Route::post('save', 'Data_absensi@save');
            Route::post('update', 'Data_absensi@update');
            Route::post('delete/{id_karyawan?}/{tanggal?}', 'Data_absensi@delete');
        });
        Route::get('absensi/list/cabang_selected', 'Data_absensi@list_cabang_selected');
    });

    Route::group('rekap', function () {
        Route::group('absensi', function () {
            Route::get('data', 'Rekap_absensi@index');
            Route::get('list/cabang', 'Rekap_absensi@list_cabang');
            Route::get('list/departemen/{id?}', 'Rekap_absensi@list_departemen');
            Route::get('data/download/{tgl_mulai?}/{tgl_selesai?}/{id_cabang?}/{id_departemen?}/{jenis?}', 'Rekap_absensi@download');
            Route::get('data/view/{tgl_mulai?}/{tgl_selesai?}/{id_cabang?}/{id_departemen?}', 'Rekap_absensi@view_data')->name('rekap.absensi.data.view');
            Route::post('list/data/{tgl_mulai?}/{tgl_selesai?}/{id_cabang?}/{id_departemen?}', 'Rekap_absensi@list_data');
        });
    });
});
