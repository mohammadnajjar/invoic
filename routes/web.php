<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomersReportController;
use App\Http\Controllers\hiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoicesDetailController;
use App\Http\Controllers\InvoicesReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('invoices_report', [InvoicesReportController::class, 'index']);
Route::post('Search_invoices', [InvoicesReportController::class, 'Search_invoices'])->name('Search_invoices');
Route::get('customers_report', [CustomersReportController::class, 'index'])->name("customers_report");
Route::post('Search_customers', [CustomersReportController::class, 'Search_customers']);

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});
Route::get('invoices/export/', [InvoiceController::class, 'export'])->name('invoices.export');
Route::get('/invoices-print/{id}', [InvoiceController::class, 'print'])->name('invoices.print');
Route::get('/invoices-archive', [InvoiceController::class, 'getArchive'])->name('invoices.archive');
Route::get('/invoices-paid', [InvoiceController::class, 'getPaid'])->name('invoices.paid');
Route::get('/invoices-unpaid', [InvoiceController::class, 'getUnpaid'])->name('invoices.unpaid');
Route::get('/invoices-partial', [InvoiceController::class, 'getPartial'])->name('invoices.partial');
Route::post('/invoices-restore', [InvoiceController::class, 'restore'])->name('invoices.restore');
Route::delete('/invoices', [InvoiceController::class, 'destroy'])->name('invoices.delete');
Route::PATCH('/invoices-statusUpdate', [InvoiceController::class, 'statusUpdate'])->name('invoices.statusUpdate');
Route::resource('/invoices', InvoiceController::class);

Route::get('section/{id}', [InvoiceController::class, 'getproducts']);
Route::resource('/sections', SectionController::class);
Route::resource('/products', ProductController::class);

Route::get('/invoicesDetails/{id}', [InvoicesDetailController::class, 'edit'])->name('invoicesDetails');
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailController::class, 'get_file']);
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailController::class, 'open_file']);
Route::post('delete_file', [InvoicesDetailController::class, 'destroy'])->name('delete_file');
Route::resource('/invoicesdetails', InvoicesDetailController::class);

Route::get('MarkAsRead_all', [InvoiceController::class, 'MarkAsRead_all'])->name('MarkAsRead_all');

//Route::get('unreadNotifications_count', [InvoiceController::class, 'unreadNotifications_count'])->name('unreadNotifications_count');
//
//Route::get('unreadNotifications', [InvoiceController::class, 'unreadNotifications'])->name('unreadNotifications');


Route::get('/{page}', [AdminController::class, 'index']);
Route::resource('/hi', hiController::class);

