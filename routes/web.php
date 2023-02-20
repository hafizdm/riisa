<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::auth();

Route::get('login-user', function () {
    return view('login-form');
});

Route::group(['middleware' => 'auth'], function () {

	Route::group(['middleware' => 'auth.input'], function () {
		Route::get('', 'HomeController@index');
});
	
// Role Karyawan Request
Route::group(['namespace' => 'Request', 'middleware' => 'auth.karyawan'], function () {

	// Request Pembelian
	Route::get('request','ReqTransactionController@index');
	Route::get('request/create','ReqTransactionController@create');

	Route::post('request/store','ReqTransactionController@store');
	Route::post('request/{id}','ReqTransactionController@destroy')->name('deletedrequest');
	Route::get('request/{id}','ReqTransactionController@edit')->name('editrequest');
	Route::patch('request/{id}','ReqTransactionController@update')->name('updaterequest');
	Route::get('listRequest','ReqTransactionController@listPengajuan');
	Route::post('requestpembelian/{id}','ReqTransactionController@destroy');

	// Request Barang Keluar
	Route::get('request-barang-keluar','ReqTransactionController@indexRequestPengeluaran');
	Route::get('request-barang-keluar/{id}','ReqTransactionController@editRequestPengeluaran')->name('editrequest-barang-keluar');
	Route::patch('request-barang-keluar/{id}','ReqTransactionController@updateRequestPengeluaran')->name('updaterequest-barang-keluar');

	// reset password
	Route::get('ganti-password/{id}','resetPasswordController@edit')->name('editpassword');
	Route::patch('ganti-password/{id}','resetPasswordController@update')->name('updatepassword');
	// Route::post('request/chained', 'ReqTransactionController@chained_dropdown')->name('chained_dropdown');

	// Dropdown Barang 
	Route::post('get-barang/store','ReqTransactionController@getBarangList');
	
});


// Route::group(['namespace' => 'Staff', 'middleware' => 'auth.karyawan'], function () {
Route::group(['namespace' => 'Staff'], function () {
	// Data Diri
	Route::get('ubah-data-diri/{id}','DatadiriController@editProfil')->name('edit-profil');
	Route::patch('ubah-data-diri/{id}','DatadiriController@updateProfil')->name('update-profil');
	Route::post('get-jabatan-divisi_/store','DatadiriController@getJabatanDivisi');

	// Pengalaman 
	Route::get('pengalaman','DatadiriController@indexPengalaman');
	Route::get('pengalaman/create','DatadiriController@createPengalaman');
	Route::post('pengalaman/store','DatadiriController@storePengalaman');
	Route::get('pengalaman/{id}','DatadiriController@editPengalaman')->name('edit-pengalaman');
	Route::patch('pengalaman/{id}','DatadiriController@updatePengalaman')->name('update-pengalaman');
	Route::delete('pengalaman/{id}','DatadiriController@destroyPengalaman');

	// Pendidikan 
	Route::get('pendidikan','DatadiriController@indexPendidikan');
	Route::get('pendidikan/create','DatadiriController@createPendidikan');
	Route::post('pendidikan/store','DatadiriController@storePendidikan');
	Route::get('pendidikan/{id}','DatadiriController@editPendidikan')->name('edit-pendidikan');
	Route::patch('pendidikan/{id}','DatadiriController@updatePendidikan')->name('update-pendidikan');
	Route::delete('pendidikan/{id}','DatadiriController@destroyPendidikan');

	// Upload File
	Route::get('upload-file','DatadiriController@indexUploadFile');

	// upload cv
	Route::get('upload-cv/create','DatadiriController@createFileCV');
	Route::post('upload-cv/store','DatadiriController@storeFileCV');
	Route::get('upload-cv/{id}','DatadiriController@editFileCV')->name('edit-cv');
	Route::patch('upload-cv/{id}','DatadiriController@updateFileCV')->name('update-cv');

	// upload ijazah
	Route::get('upload-ijazah/create','DatadiriController@createFileIjazah');
	Route::post('upload-ijazah/store','DatadiriController@storeFileIjazah');
	Route::get('upload-ijazah/{id}','DatadiriController@editFileIjazah')->name('edit-ijazah');
	Route::patch('upload-ijazah/{id}','DatadiriController@updateFileIjazah')->name('update-ijazah');

	// upload sertifikat
	Route::get('upload-sertifikat/create','DatadiriController@createFileSertifikat');
	Route::post('upload-sertifikat/store','DatadiriController@storeFileSertifikat');
	Route::get('upload-sertifikat/{id}','DatadiriController@editFileSertifikat')->name('edit-sertifikat');
	Route::patch('upload-sertifikat/{id}','DatadiriController@updateFileSertifikat')->name('update-sertifikat');
	Route::delete('upload-sertifikat/{id}','DatadiriController@destroySertifikat');
	
	
	// Upload Vaksinasi
	Route::get('upload-vaksinasi/create','DatadiriController@createFileVaksinasi');
	Route::post('upload-vaksinasi/store','DatadiriController@storeFileVaksinasi');
	Route::get('upload-vaksinasi/{id}','DatadiriController@editFileVaksinasi')->name('edit-vaksinasi');
	Route::patch('upload-vaksinasi/{id}','DatadiriController@updateFileVaksinasi')->name('update-vaksinasi');
	Route::delete('upload-vaksinasi/{id}','DatadiriController@destroyVaksinasi');
	
	
	// Time Sheet
	Route::get('time-sheet','TimeSheetController@index');
	Route::get('time-sheet/create','TimeSheetController@create');
	Route::post('time-sheet/store','TimeSheetController@store');
	Route::get('time-sheet/{id}','TimeSheetController@edit')->name('edit-timesheet');
	Route::patch('time-sheet/{id}','TimeSheetController@update')->name('update-timesheet');
	Route::post('time-sheet/{id}','TimeSheetController@destroy');
	Route::post('get-proposal/show','TimeSheetController@getProposalList');
	Route::post('summary-timesheet/{id}','TimeSheetController@downloadSummaryTimesheet')->name('summary-timesheet');
	
});

// Manager
Route::group(['namespace' => 'HighLevel', 'middleware' => 'auth.manager'], function () {

	// Manager HO - Request
// 	Route::get('approvalManager','ApprovalControler@approvalManager');
// 	Route::get('approvalManager/{id}','ApprovalControler@editApprovalManager')->name('editapprovalmanager');
// 	Route::patch('approvalManager/{id}','ApprovalControler@updateApprovalManager')->name('updateapprovalmanager');
	
	// Manager Proyek - Request
	    Route::get('approvalManager','ApprovalControler@approvalManager');
		Route::get('approvalManagerProjek/{id}','ApprovalControler@editApprovalManagerProjek')->name('editapprovalmanagerprojek');
		Route::patch('approvalManagerProjek/{id}','ApprovalControler@updateApprovalManagerProjek')->name('updateapprovalmanagerprojek');
// 	Route::get('approvalManagerProjek/{id}','ApprovalControler@editApprovalManagerProjek')->name('editapprovalmanagerprojek');
// 	Route::patch('approvalManagerProjek/{id}','ApprovalControler@updateApprovalManagerProjek')->name('updateapprovalmanagerprojek');

	// Reset Password
	Route::get('ganti-password-manager/{id}','ApprovalControler@editPasswordManager')->name('editpassword-manager');
	Route::patch('ganti-password-manager/{id}','ApprovalControler@updatePasswordManager')->name('updatepassword-manager');
	
    // Purchased 
		Route::get('po-pm', 'ApprovalPurchaseController@indexApprovalPM');
		Route::get('po-pm-edit/{id}', 'ApprovalPurchaseController@editApprovalPM')->name('editapprovalpm-po');
		Route::patch('po-pm-update/{id}', 'ApprovalPurchaseController@updateApprovalPM')->name('updateapprovalpm-po');
});

// VP
Route::group(['namespace' => 'HighLevel', 'middleware' => 'auth.vp'], function () {
	// Request
	Route::get('approvalVP','ApprovalControler@approvalVP');
	Route::get('approvalVP/{id}','ApprovalControler@editApprovalVP')->name('editapprovalvp');
	Route::patch('approvalVP/{id}','ApprovalControler@updateApprovalVP')->name('updateapprovalvp');
    
    // Purchased 
		Route::get('po-vp', 'ApprovalPurchaseController@indexApprovalVP');
		Route::get('po-vp-edit/{id}', 'ApprovalPurchaseController@editApprovalVP')->name('editapprovalvp-po');
		Route::patch('po-vp-update/{id}', 'ApprovalPurchaseController@updateApprovalVP')->name('updateapprovalvp-po');
		
	// Reset Password
	Route::get('ganti-password-vp/{id}','ApprovalControler@editPasswordVP')->name('editpassword-vp');
	Route::patch('ganti-password-vp/{id}','ApprovalControler@updatePasswordVP')->name('updatepassword-vp');
});

// CEO
Route::group(['namespace' => 'HighLevel', 'middleware' => 'auth.ceo'], function () {
	// Request
// 	Route::get('approvalCEO','ApprovalControler@approvalCEO');
// 	Route::get('approvalCEO/{id}','ApprovalControler@editApprovalCEO')->name('editapprovalceo');
// 	Route::patch('approvalCEO/{id}','ApprovalControler@updateApprovalCEO')->name('updateapprovalceo');

	// Purchased 
// 	Route::get('po-CEO','ApprovalPurchaseController@ceo');
// 	Route::get('po-CEO/{id}','ApprovalPurchaseController@ceoEdit')->name('editapprovalceo-po');
// 	Route::patch('po-CEO-update/{id}','ApprovalPurchaseController@ceoUpdate')->name('updateapprovalceo-po');

	// Payment
	Route::get('payment-ceo','ApprovalPaymentController@paymentCEO');
	Route::get('payment-ceo/{id}','ApprovalPaymentController@paymentCEOEdit')->name('editapprovalceo-payment');
	Route::patch('payment-ceo/{id}','ApprovalPaymentController@paymentCEOUpdate')->name('updateapprovalceo-payment');

	// Reset Password
	Route::get('ganti-password-ceo/{id}','ApprovalControler@editPasswordCEO')->name('editpassword-ceo');
	Route::patch('ganti-password-ceo/{id}','ApprovalControler@updatePasswordCEO')->name('updatepassword-ceo');
});

// CO
Route::group(['namespace' => 'HighLevel', 'middleware' => 'auth.co'], function () {
	// Purchased
	Route::get('po','ApprovalPurchaseController@CostControl');
	Route::get('ApprovalCO/{id}','ApprovalPurchaseController@editApprovalCO')->name('editapprovalco-po');
	Route::patch('ApprovalCo/{id}','ApprovalPurchaseController@updateApprovalCO')->name('updateapprovalco-po');

	// Payment
	Route::get('payment-co','ApprovalPaymentController@paymentCO');
	Route::get('payment-co/{id}','ApprovalPaymentController@paymentCOEdit')->name('editapprovalco-payment');
	Route::patch('payment-co/{id}','ApprovalPaymentController@paymentCOUpdate')->name('updateapprovalco-payment');

	// Reset Password
	Route::get('ganti-password-co/{id}','ApprovalPurchaseController@editPasswordCO')->name('editpassword-co');
	Route::patch('ganti-password-co/{id}','ApprovalPurchaseController@updatePasswordCO')->name('updatepassword-co');
});

// CFO
Route::group(['namespace' => 'HighLevel', 'middleware' => 'auth.cfo'], function () {
// Purchased
// 	Route::get('po-cfo', 'ApprovalPurchaseController@cfo');
// 	Route::get('po-cfo-edit/{id}', 'ApprovalPurchaseController@cfoedit')->name('editapprovalcfo-po');
// 	Route::patch('po-cfo-update/{id}', 'ApprovalPurchaseController@cfoupdate')->name('updateapprovalcfo-po');

// Payment
	Route::get('payment-cfo','ApprovalPaymentController@paymentCFO');
	Route::get('payment-cfo/{id}','ApprovalPaymentController@paymentCFOEdit')->name('editapprovalcfo-payment');
	Route::patch('payment-cfo/{id}','ApprovalPaymentController@paymentCFOUpdate')->name('updateapprovalcfo-payment');

	// Reset Password
	Route::get('ganti-password-cfo/{id}','ApprovalPurchaseController@editPasswordCFO')->name('editpassword-cfo');
	Route::patch('ganti-password-cfo/{id}','ApprovalPurchaseController@updatePasswordCFO')->name('updatepassword-cfo');

});

// Admin
Route::group(['namespace' => 'Admin', 'middleware' => 'auth.admin'], function (){
	//Master Data Vendor
	Route::get('listVendor', 'VendorController@index');
	Route::get('vendor/create', 'VendorController@create');
	Route::post('vendor/store', 'VendorController@store');
	Route::post('vendor/{id}', 'VendorController@destroy')->name('deletedvendor');
	Route::get('vendor/edit/{id}', 'VendorController@edit')->name('editvendor');
	Route::patch('vendor/update/{id}', 'VendorController@update')->name('updatevendor');
	
	// Cetak PDF
// 	Route::get('karyawan/cetak_pdf', 'KaryawanController@cetak_pdf');
// 	Route::get('karyawan/cetak_excel', 'KaryawanController@cetak_excel');

	//Master Data Divisi
	Route::get('divisi','DivisiController@index');
	Route::get('divisi/create','DivisiController@create');
	Route::post('divisi/store','DivisiController@store');
	Route::get('divisi/store','DivisiController@store');
	Route::post('divisi/{id}','DivisiController@destroy');
	Route::get('divisi/edit{id}','DivisiController@edit')->name('editdivisi');
	Route::patch('divisi/update{id}','DivisiController@update')->name('updatedivisi');

	//Master Data Kategori Barang
	Route::get('kategoribarang','KategoriBarangController@index');
	Route::get('kategoribarang/create','KategoriBarangController@create');
	Route::post('kategoribarang/store','KategoriBarangController@store');
	Route::post('kategoribarang/{id}','KategoriBarangController@destroy');
	Route::get('kategoribarang/edit{id}','KategoriBarangController@edit')->name('editkategori');
	Route::patch('kategoribarang/update{id}','KategoriBarangController@update')->name('updatekategori');

	//Master Data Barang
	Route::get('barang','BarangController@index');
	Route::get('barang/create','BarangController@create');
	Route::post('barang/store','BarangController@store');
	Route::post('barang/{id_barang}','BarangController@destroy')->name('deletedbarang');
	Route::get('barang/edit{id_barang}','BarangController@edit')->name('editbarang');
	Route::patch('barang/update{id_barang}','BarangController@update')->name('updatebarang');

	//Master Data Proyek
	Route::get('proyek','ProyekController@index');
	Route::get('proyek/create','ProyekController@create');
	Route::post('proyek/store','ProyekController@store');
	Route::post('proyek/{id}','ProyekController@destroy')->name('deletedproyek');
	Route::get('proyek/edit{id}','ProyekController@edit')->name('editproyek');
	Route::patch('proyek/update{id}','ProyekController@update')->name('updateproyek');

	//Master Data Jabatan
	Route::get('jabatan', 'JabatanController@index');
	Route::get('jabatan/create','JabatanController@create');
	Route::post('jabatan/store','JabatanController@store');
	Route::post('jabatan/{id}','JabatanController@destroy')->name('deletedjabatan');
	Route::get('jabatan/edit{id}','JabatanController@edit')->name('editjabatan');
	Route::patch('jabatan/update{id}','JabatanController@update')->name('updatejabatan');

	
    //Master Resources
	Route::get('resource','ResourceController@index');
	Route::get('resource/create','ResourceController@create');
	Route::post('resource/store','ResourceController@store');
	Route::post('resource/{id}','ResourceController@destroy')->name('deletedresource');
	Route::get('resource/edit{id}','ResourceController@edit')->name('editresource');
	Route::patch('resource/update{id}','ResourceController@update')->name('updateresource');

	//Master Kategori Kerja
	Route::get('cost-account','CostaccountController@index');
	Route::get('cost-account/create','CostaccountController@create');
	Route::post('cost-account/store','CostaccountController@store');
	Route::post('cost-account/{id}','CostaccountController@destroy')->name('deleted');
	Route::get('cost-account/edit{id}','CostaccountController@edit')->name('editcostaccount');
	Route::patch('cost-account/update{id}','CostaccountController@update')->name('updatecostaccount');

	//Master General_working_type
	 Route::get('general-work','GeneralController@index');
	 Route::get('general-work/create','GeneralController@create');
	 Route::post('general-work/store','GeneralController@store');
	 Route::post('general-work/{id}','GeneralController@destroy');
	 Route::get('general-work/edit{id}','GeneralController@edit')->name('editgeneral');
	 Route::patch('general-work/update{id}','GeneralController@update')->name('updategeneral');
	 
	//List Inventory Asset
	// Route::get('inventory', 'InventoryController@listinventory');

	// // List Inventory Non Asset
	// Route::get('inventory-nonasset','InventoryController@listnonasset');

	// //list Inventory Jasa
	// Route::get('inventory-jasa','InventoryController@listjasa');

	// listRequest
	Route::get('list-procurement', 'listProcurementController@index');


	//Upload PO
	Route::get('listPO', 'POController@index');
	Route::get('listPO/edit{id}','POController@edit')->name('editbuktiPO');
	Route::patch('listPO/update{id}','POController@update')->name('updateBuktiPO');

	Route::resources([
		'users' => 'UserController',
	]);
	Route::resources([
		'user_role' => 'UserRoleController',
	]);

});

Route::group(['namespace' => 'Finance', 'middleware' => 'auth.finance'], function (){
		//Upload Invoice
		Route::get('list-invoice', 'InvoiceController@index');
		Route::get('list-invoice/edit{id}','InvoiceController@edit')->name('editbuktiinvoice');
		Route::patch('list-invoice/update{id}','InvoiceController@update')->name('updatebuktiinvoice');

		Route::get('ubah-status-paid', 'PaidController@index');
		Route::get('ubah-status-paid/edit{id}','PaidController@edit')->name('editpaid');
		Route::patch('ubah-status-paid/update{id}','PaidController@update')->name('updatepaid');

		// Reset Password
		Route::get('ganti-password-finance/{id}','ResetPasswordController@edit')->name('editpassword-finance');
		Route::patch('ganti-password-finance/{id}','ResetPasswordController@update')->name('updatepassword-finance');
	});

	Route::group(['namespace' => 'AssetManagement', 'middleware' => 'auth.asset.management'], function (){
		Route::get('list-approval-barang-keluar', 'AssetManagementController@index');
		Route::get('list-approval-barang-keluar/edit{id}','AssetManagementController@edit')->name('editapprovalbrg');
		Route::patch('list-approval-barang-keluar/update{id}','AssetManagementController@update')->name('updateapprovalbrg');

		// Reset Password
		Route::get('ganti-password-assetmanagement/{id}','ResetPasswordController@edit')->name('editpassword-assetmanagement');
		Route::patch('ganti-password-assetmanagement/{id}','ResetPasswordController@update')->name('updatepassword-assetmanagement');
		
// 		Asset 
		Route::get('list-asset','MonitoringAssetController@index');
		Route::get('list-asset/create','MonitoringAssetController@create');
		Route::post('list-asset/store','MonitoringAssetController@store');
		Route::post('list-asset/{id}','MonitoringAssetController@destroy')->name('deletedasset');
		Route::get('list-asset/edit{uid}','MonitoringAssetController@edit')->name('editasset');
		Route::patch('list-asset/update{id}','MonitoringAssetController@update')->name('updateasset');
		Route::get('downloadQrcode/{id}','MonitoringAssetController@downloadQRCode')->name('downloadqrcode');

		Route::post('downloadAllQrcode', 'MonitoringAssetController@downloadAllQRCode');
	});
	
	
    Route::group(['namespace'=> 'HRD', 'middleware'=> 'auth.hr'], function(){
        
		//Master Data Karyawan
		Route::get('karyawan','KaryawanController@index');
		Route::get('karyawan/create','KaryawanController@create');
		Route::post('karyawan/store','KaryawanController@store');
		Route::get('karyawan/edit{id}','KaryawanController@edit')->name('editkaryawan');
		Route::post('karyawan/{nik}', 'KaryawanController@destroy')->name('deletedkaryawan');
		Route::patch('karyawan/update/{id}', 'KaryawanController@update')->name('updatekaryawan');
		Route::post('get-jabatan-divisi/store','KaryawanController@getJabatanDivisi');
		
        // Riwayat Kontrak Kerja 
        Route::get('hapus-kontrak/{id}', 'KaryawanController@destroyKontrak')->name('deletedkontrak');
		
        // History SPD
        Route::get('history-spd','SPDController@index');
        Route::get('karyawan/cetak_excel', 'KaryawanController@cetak_excel');

        
        // History Cuti
		Route::get('histori-cuti','HistoryCutiController@index');
		Route::post('histori-cuti/{id}','HistoryCutiController@updateApprovalCuti')->name('update-approval-cuti');
		
        // Performance
		Route::post('upload-performance/store','KaryawanController@storePerformance');
		Route::delete('upload-performance/{id}','KaryawanController@destroyPerformance');
		
		// Talent Pool
		Route::get('list-talent-pool', 'TalentPoolController@index');
		Route::get('list-talent-pool/detail-talent/{id}', 'TalentPoolController@showTalent')->name('talent_show');
		Route::post('list-talent-pool/store','TalentPoolController@store');
		Route::post('list-talent-pool/{id}','TalentPoolController@destroy')->name('delete-talentpool');
		
		// Update Photo profile
		Route::get('list-talent-pool/detail-talent/profiles/{id}','TalentPoolController@getProfile');
		Route::post('list-talent-pool/detail-talent/profiles/update/{id}','TalentPoolController@updateProfile');
		
		// Update Contact Information
		Route::get('list-talent-pool/detail-talent/contact/{id}','TalentPoolController@getContact');
		Route::post('list-talent-pool/detail-talent/contact/update/{id}','TalentPoolController@updateContact');
		
		// Update Score
		Route::get('list-talent-pool/detail-talent/score/{id}','TalentPoolController@getScore');
		Route::post('list-talent-pool/detail-talent/score/update/{id}','TalentPoolController@updateScore');

		// Update Personal Info
		Route::get('list-talent-pool/detail-talent/personalinfo/{id}','TalentPoolController@getPersonalInfo');
		Route::post('list-talent-pool/detail-talent/personalinfo/update/{id}','TalentPoolController@updatePersonalInfo');

		// Upload CV/Resume
		Route::get('list-talent-pool/detail-talent/uploadcv/{id}','TalentPoolController@getCV');
		Route::post('list-talent-pool/detail-talent/uploadcv/update/{id}','TalentPoolController@updateCV')->name('postCV');

		// Upload File Score
		// Score HRD
		Route::get('list-talent-pool/detail-talent/scoreHRD/{id}','TalentPoolController@getFileScoreHRD');
		Route::post('list-talent-pool/detail-talent/scoreHRD/update/{id}','TalentPoolController@updateFileScoreHRD');

		// Score User
		Route::get('list-talent-pool/detail-talent/scoreuser/{id}','TalentPoolController@getFileScoreUser');
		Route::post('list-talent-pool/detail-talent/scoreuser/update/{id}','TalentPoolController@updateFileScoreUser');

		// Score BOD
		Route::get('list-talent-pool/detail-talent/scorebod/{id}','TalentPoolController@getFileScoreBOD');
		Route::post('list-talent-pool/detail-talent/scorebod/update/{id}','TalentPoolController@updateFileScoreBOD');

		// Job Position Master Data
		Route::get('posisi-kerja','JobPositionController@index');
		Route::get('posisi-kerja/create','JobPositionController@create');
		Route::post('posisi-kerja/store','JobPositionController@store');
		Route::post('posisi-kerja/{id}','JobPositionController@destroy');
		Route::get('posisi-kerja/{id}','JobPositionController@edit')->name('editposisikerja');
		Route::patch('posisi-kerja/{id}','JobPositionController@update')->name('updateposisikerja');

        // Reset semua cuti karyawan
		Route::get('reset-cuti', 'HistoryCutiController@indexReset')->name('index-reset');
		Route::post('reset-all-cuti','HistoryCutiController@resetAll');
		
		Route::get('approvalcuti/edit{id}','HistoryCutiController@edit')->name('editappcuti');
		Route::post('approvalcuti/{id}','HistoryCutiController@approveCuti')->name('approvalcuti');
    });

	Route::group(['namespace'=> 'TimeSheet', 'middleware'=> 'auth'], function () {
		Route::get('approval-timesheet','TimesheetApprovalController@index');
		Route::patch('approval-timesheet/{id}','TimesheetApprovalController@update')->name('update-timesheet-all');
		Route::post('approve-all', 'TimesheetApprovalController@approvalAllHO');
		Route::post('summary-timesheet-ho','TimesheetApprovalController@downloadSummaryTimesheetPersonal')->name('summary-timesheet-personal');
		Route::post('filter_summary','TimesheetApprovalController@FilterSummary')->name('filter-summary');
		Route::get('persentase-timesheet','TimesheetApprovalController@index');
	});
	
		
	// PSIKOTES
	Route::group(['namespace'=> 'HRD\Psikotes\Papikostik', 'middleware'=> 'auth.hr'], function(){
		// Papikostik 
		// Master Data Kategori
		Route::get('kategori-papikostik','KategoriController@index');
		Route::get('kategori-papikostik/create','KategoriController@create');
		Route::post('kategori-papikostik/store','KategoriController@store');
		Route::get('kategori-papikostik/{id}','KategoriController@edit')->name('editkategoripapikostik');
		Route::post('kategori-papikostik/update/{id}', 'KategoriController@update')->name('updatekategoripapikostik');
		Route::post('kategori-papikostik/{id}', 'KategoriController@destroy')->name('deletekategoripapikostik');

		// Master Data Statement
		Route::get('statement-papikostik','StatementController@index');
		Route::get('statement-papikostik/create','StatementController@create');
		Route::post('statement-papikostik/store','StatementController@store');
		Route::get('statement-papikostik/{id}','StatementController@edit')->name('editstatementpapikostik');
		Route::post('statement-papikostik/update/{id}', 'StatementController@update')->name('updatestatementpapikostik');
		Route::post('statement-papikostik/{id}', 'StatementController@destroy')->name('deletestatementpapikostik');

		// Master Data Kamus
		Route::get('kamus-papikostik','KamusController@index');
		Route::get('kamus-papikostik/create','KamusController@create');
		Route::post('kamus-papikostik/store','KamusController@store');
		Route::get('kamus-papikostik/{id}','KamusController@edit')->name('editkamuspapikostik');
		Route::post('kamus-papikostik/update/{id}', 'KamusController@update')->name('updatekamuspapikostik');
		Route::post('kamus-papikostik/{id}', 'KamusController@destroy')->name('deletekamuspapikostik');

		// Report Papikostik
		Route::get('report-papikostik', 'ReportController@index');
		Route::get('report-papikostik/scoring/{id}', 'ReportController@show')->name('show-report-papikostik');
	});
	
	Route::group(['namespace'=> 'HRD\Psikotes\DISC', 'middleware'=> 'auth.hr'], function(){
		// DISC 
		// Master Data Kategori
		Route::get('kategori-disc','KategoriController@index');
		Route::get('kategori-disc/create','KategoriController@create');
		Route::post('kategori-disc/store','KategoriController@store');
		Route::get('kategori-disc/{id}','KategoriController@edit')->name('editkategoridisc');
		Route::post('kategori-disc/update/{id}', 'KategoriController@update')->name('updatekategoridisc');
		Route::post('kategori-disc/{id}', 'KategoriController@destroy')->name('deletekategoridisc');

		// Master Data Statement
		Route::get('statement-disc','StatementController@index');
		Route::get('statement-disc/create','StatementController@create');
		Route::post('statement-disc/store','StatementController@store');
		Route::get('statement-disc/{id}','StatementController@edit')->name('editstatementdisc');
		Route::post('statement-disc/update/{id}', 'StatementController@update')->name('updatestatementdisc');
		Route::post('statement-disc/{id}', 'StatementController@destroy')->name('deletestatementdisc');

		// Report DISC
		Route::get('report-disc', 'ReportController@index');
		Route::get('report-disc/scoring/{id}', 'ReportController@show')->name('show-report-disc');
	});
	
	
	Route::group(['namespace'=> 'HRD\Psikotes\MSDT', 'middleware'=> 'auth.hr'], function(){
		// MSDT 
		// Master Data Kategori
		Route::get('kategori-msdt','KategoriController@index');
		Route::get('kategori-msdt/create','KategoriController@create');
		Route::post('kategori-msdt/store','KategoriController@store');
		Route::get('kategori-msdt/{id}','KategoriController@edit')->name('editkategorimsdt');
		Route::post('kategori-msdt/update/{id}', 'KategoriController@update')->name('updatekategorimsdt');
		Route::post('kategori-msdt/{id}', 'KategoriController@destroy')->name('deletekategorimsdt');

		// Master Data Statement
		Route::get('statement-msdt','StatementController@index');
		Route::get('statement-msdt/create','StatementController@create');
		Route::post('statement-msdt/store','StatementController@store');
		Route::get('statement-msdt/{id}','StatementController@edit')->name('editstatementmsdt');
		Route::post('statement-msdt/update/{id}', 'StatementController@update')->name('updatestatementmsdt');
		Route::post('statement-msdt/{id}', 'StatementController@destroy')->name('deletestatementmsdt');

		// Report MSDT
		Route::get('report-msdt', 'ReportController@index');
		Route::get('report-msdt/scoring/{id}', 'ReportController@show')->name('show-report-msdt');
	});
	
	Route::group(['namespace'=> 'HRD\Psikotes\MBTI', 'middleware'=> 'auth.hr'], function(){
		// MBTI 
		// Master Data Kategori
		Route::get('kategori-mbti','KategoriController@index');
		Route::get('kategori-mbti/create','KategoriController@create');
		Route::post('kategori-mbti/store','KategoriController@store');
		Route::get('kategori-mbti/{id}','KategoriController@edit')->name('editkategorimbti');
		Route::post('kategori-mbti/update/{id}', 'KategoriController@update')->name('updatekategorimbti');
		Route::post('kategori-mbti/{id}', 'KategoriController@destroy')->name('deletekategorimbti');

		// Master Data Statement
		Route::get('statement-mbti','StatementController@index');
		Route::get('statement-mbti/create','StatementController@create');
		Route::post('statement-mbti/store','StatementController@store');
		Route::get('statement-mbti/{id}','StatementController@edit')->name('editstatementmbti');
		Route::post('statement-mbti/update/{id}', 'StatementController@update')->name('updatestatementmbti');
		Route::post('statement-mbti/{id}', 'StatementController@destroy')->name('deletestatementmbti');

		// Report MBTI
		Route::get('report-mbti', 'ReportController@index');
		Route::get('report-mbti/scoring/{id}', 'ReportController@show')->name('show-report-mbti');
	});
	
	
	Route::group(['namespace'=> 'HRD\Psikotes', 'middleware'=> 'auth.hr'], function(){
		// Candidate 
		Route::get('kandidat-psikotes','CandidateController@index');
		Route::get('kandidat-psikotes/create','CandidateController@create');
		Route::post('kandidat-psikotes/store','CandidateController@store');
		Route::get('kandidat-psikotes/{id}','CandidateController@edit')->name('editkategoripapikostik');
		Route::post('kandidat-psikotes/update/{id}', 'CandidateController@update')->name('updatekategoripapikostik');
		Route::post('kandidat-psikotes/{id}', 'CandidateController@destroy')->name('deletekategoripapikostik');
	});


// Route::group(['namespace'=> 'TimeSheet', 'middleware' => 'auth.vp'], function () {

// 	// TimeSheet Proposal
// 	Route::get('time-sheet-proposal','TimeSheetController@timesheetProposal');
// 	Route::get('time-sheet-proposal/create','TimeSheetController@createTimesheetProposal');
// 	Route::post('time-sheet-proposal/store','TimeSheetController@storeTimesheetProposal');
// 	Route::get('time-sheet-proposal/{id}','TimeSheetController@editTimesheetProposal')->name('edit-timesheet-proposal');
// 	Route::patch('time-sheet-proposal/{id}','TimeSheetController@updateTimesheetProposal')->name('update-timesheet-proposal');
// 	Route::delete('time-sheet-proposal/{id}','TimeSheetController@destroyTimesheetProposal');
// 	Route::get('detail-timesheet/{id}','TimeSheetController@detailTimeSheetProposal');

// 	// Approval Timesheet Proposal
// 	Route::get('approval-timesheet/{id}','TimeSheetController@ubahApprovalTimesheet')->name('edit-status-timesheet');
// 	Route::patch('approval-timesheet/{id}','TimeSheetController@updateApprovalTimesheet')->name('update-status-timesheet');

// 	// Open Close Proposal
// 	Route::get('close-proposal/{id}','TimeSheetController@editCloseProposal')->name('edit-close-proposal');
// 	Route::patch('close-proposal/{id}','TimeSheetController@updateCloseProposal')->name('update-close-proposal');

// 	// Edit Resource Proposal
// 	Route::get('resource-proposal/{id}','TimeSheetController@editResourceProposal')->name('edit-resource-proposal');
// 	Route::patch('resource-proposal/{id}','TimeSheetController@updateResourceProposal')->name('update-resource-proposal');

// 	// Approval Timesheet HO
	
// 	Route::get('persentase-timesheet','TimeSheetController@timesheetHO');
// 	Route::get('approval-timesheet-ho/{id}','TimeSheetController@ubahApprovalTimesheetHO')->name('edit-status-timesheet-ho');
// 	Route::patch('approval-timesheet-ho/{id}','TimeSheetController@updateApprovalTimesheetHO')->name('update-status-timesheet-ho');
// 	Route::get('all-timesheet/{id}','TimeSheetController@alltimesheet');
// 	Route::post('filters/{id}','TimeSheetController@filter')->name('filters-ho');
// 	Route::post('filter_summary','TimeSheetController@FilterSummary')->name('filter-summary');
//   Route::post('summary-timesheet-ho','TimeSheetController@downloadSummaryTimesheetPersonal')->name('summary-timesheet-personal');


// // 	Route::get('time-sheet-ho','TimeSheetController@timesheetHO');
// // 	Route::get('approval-timesheet-ho/{id}','TimeSheetController@ubahApprovalTimesheetHO')->name('edit-status-timesheet-ho');
// // 	Route::patch('approval-timesheet-ho/{id}','TimeSheetController@updateApprovalTimesheetHO')->name('update-status-timesheet-ho');
// // 	Route::get('all-time-sheet/{id}','TimeSheetController@alltimesheet');
// // 	Route::post('filter/{id}','TimeSheetController@filter')->name('filter-ho');

// 	// TIMESHEET PROJECT
// 	Route::get('timesheet-project','TimeSheetController@TimesheetProject');
// 	Route::get('timesheet-project/create','TimeSheetController@Create_Timesheet_project');
// 	Route::post('timesheet-project/store','TimeSheetController@storeTimesheetProject');
// 	Route::delete('timesheet-project/{id}','TimeSheetController@destroyTimesheetProject');
// 	Route::get('detail-timesheet-project/{id}','TimeSheetController@detailTimeSheetProject');

// 	// Edit Resource Project
// 	Route::get('resource-project/{id}','TimeSheetController@editResourceProject')->name('edit-resource-project');
// 	Route::patch('resource-project/{id}','TimeSheetController@updateResourceProject')->name('update-resource-project');

// 	// Open Close Project
// 	Route::get('open-close-project/{id}','TimeSheetController@editCloseProject')->name('edit-open-close-project');
// 	Route::patch('open-close-project/{id}','TimeSheetController@updateCloseProject')->name('update-open-close-project');

// 	// Approval Timesheet Project
// 	Route::get('approval-timesheet-project/{id}','TimeSheetController@editTimesheetPR')->name('edit-status-timesheet-project');
// 	Route::patch('approval-timesheet-project/{id}','TimeSheetController@updateTimesheetPR')->name('update-status-timesheet-project');
	
//     // Approval for Marketing 
//         Route::get('time-sheet-marketing','TimeSheetController@TimesheetMarketing');
//     	Route::get('approval-timesheet-marketing/{id}','TimeSheetController@editTimesheetMarketing')->name('edit-status-timesheet-marketing');
// 	    Route::patch('approval-timesheet-marketing/{id}','TimeSheetController@updateTimesheetMarketing')->name('update-status-timesheet-marketing');
	    
//     // Fitur Approve All Timesheet
// // 	Route::post('approve-proposal', 'TimeSheetController@approvalAllProposal');
// // 	Route::post('approve-project', 'TimeSheetController@approvalAllProject');
// 	Route::post('approve-ho', 'TimeSheetController@approvalAllHO');
// });

// Route::group(['namespace'=> 'TimeSheet', 'middleware'=> 'auth.ceo'], function(){
	
// 	Route::get('approval-timesheet-ceo','TimeSheetController@approvalTimesheetProposal');
	
// 	// Approval Timesheet Proposal by CEO
// 	Route::get('approval-timesheet-ceo/{id}','TimeSheetController@ubahApprovalTimesheetProposal')->name('edit-approval-proposal');
// 	Route::patch('approval-timesheet-ceo/{id}','TimeSheetController@updateApprovalTimesheetProposal')->name('update-approval-proposal');

// 	// Approval Timesheet Project by CEO 
// 	Route::get('approval-project-ceo/{id}','TimeSheetController@ubahApprovalTimesheetProject')->name('edit-approval-project');
// 	Route::patch('approval-project-ceo/{id}','TimeSheetController@updateApprovalTimesheetProject')->name('update-approval-project');
	
//     // 	Approval Timesheet HO
// // 	Route::get('approval-timesheet-ho/{id}','TimeSheetController@ubahApprovalTimesheetHO')->name('edit-status-timesheet-ho');
// // 	Route::patch('approval-timesheet-ho/{id}','TimeSheetController@updateApprovalTimesheetHO')->name('update-status-timesheet-ho');
// // 	Route::post('approve-all', 'TimeSheetControllerCEO@approvalAll');
	
// 	Route::get('all-time-sheet/{id}','TimeSheetControllerCEO@alltimesheet');
// 	Route::post('filter/{id}','TimeSheetControllerCEO@filter')->name('filter-ho');
// });


    Route::group(['namespace' => 'SPD'], function (){
	// Pengajuan SPD to All Karyawan
		Route::get('pengajuan-spd','SPDController@index');
		Route::get('pengajuan-spd/create','SPDController@create');
		Route::post('pengajuan-spd/store','SPDController@store');
		Route::get('downloadpdf/{id}','SPDController@downloadpdf');
		Route::get('pengajuan-spd/{id}','SPDController@edit')->name('edit-spd');
		Route::patch('pengajuan-spd/{id}','SPDController@update')->name('update-spd');
		Route::post('pengajuan-spd/{id}','SPDController@destroy');
		Route::get('spd-request','SPDController@indexRequest');
		Route::get('add-report','SPDController@addReport');
		Route::get('spd-report','SPDController@indexReport');

	//Approval SPD Karyawan
		Route::get('spd/{id}/approve','SPDController@spdApproved');
		Route::get('spd/{id}/reject','SPDController@spdRejected');
		
		
	});
	
    
	Route::group(['namespace' => 'Cuti'], function (){
		Route::get('pengajuan-cuti','PengajuanCutiController@index');
		Route::get('pengajuan-cuti/create','PengajuanCutiController@create');
		Route::post('pengajuan-cuti/store','PengajuanCutiController@store');
		Route::get('pengajuan-cuti/{id}','PengajuanCutiController@edit')->name('edit-cuti');
		Route::patch('pengajuan-cuti/{id}','PengajuanCutiController@update')->name('update-cuti');
		Route::post('pengajuan-cuti/{id}','PengajuanCutiController@destroy');

		Route::get('downloadcuti/{id}','PengajuanCutiController@downloadCuti');
		Route::get('upload-file-scan/{id}','PengajuanCutiController@showUploadCuti')->name('showUpload');
		Route::patch('upload-file-scan/{id}','PengajuanCutiController@updateUploadCuti')->name('updateUpload');
		
		// Route::get('upload-file-scan/{id}','PengajuanCutiController@getCuti')->name('get-cuti');
		// Route::post('upload-file-scan/{id}','PengajuanCutiController@storeFileCuti');
	});

});

