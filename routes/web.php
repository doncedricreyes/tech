<?php
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'WebsiteController@about');
Route::get('/careers', 'WebsiteController@careers');
Route::get('/careers/{id}','WebsiteController@job');
Route::post('/application','WebsiteController@application')->name('application');
Route::get('/projects','WebsiteController@project');
Route::get('/contacts','WebsiteController@contact');
Route::post('/contacts','WebsiteController@add_contact')->name('add_contact');






Route::prefix('admin')->group(function()
{
Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Route::get('/employees/admins', 'AdminController@admin');
Route::get('/', 'AdminController@home')->name('admin.dashboard');
Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
Route::get('account','AdminController@account');
Route::put('account','AdminController@account_update')->name('update.admin');

Route::post('/employees/admins/create','AdminController@create_admin')->name('create.admin');
Route::put('/employees/admins/{id}/delete','AdminController@delete_admin')->name('delete.admin');
Route::get('/employees/admins/search','AdminController@search_admin')->name('search_admin');
Route::get('/employees/repairmen','AdminController@repair');
Route::post('/employees/repairmen/create','AdminController@create_repair')->name('create.repair');
Route::put('/employees/repairmen/{id}/delete','AdminController@delete_repair')->name('delete.repair');
Route::get('/employees/repairmen/search','AdminController@search_repair')->name('search_repair');
Route::get('/employees/techsupports','AdminController@tech');
Route::post('/employees/techsupports/create','AdminController@create_tech')->name('create.tech');
Route::put('/employees/techsupports/{id}/delete','AdminController@delete_tech')->name('delete.tech');
Route::get('/employees/techsupports/search','AdminController@search_tech')->name('search_tech');
Route::get('/brands','AdminController@show_brand');
Route::post('/brands','AdminController@create_brand')->name('create.brand');
Route::put('/brands/{id}/delete','AdminController@delete_brand')->name('delete.brand');
Route::put('/brands/{id}/edit','AdminController@edit_brand')->name('edit.brand');
Route::get('/brands/search','AdminController@search_brand')->name('search_brand');
Route::get('/branches','AdminController@show_branch');
Route::post('/branches','AdminController@create_branch')->name('create.branch');
Route::put('/branches/{id}/delete','AdminController@delete_branch')->name('delete.branch');
Route::put('/branches/{id}/edit','AdminController@edit_branch')->name('edit.branch');
Route::get('/branches/search','AdminController@search_branch')->name('search_branch');
Route::get('/products','AdminController@show_product');
Route::post('/products','AdminController@create_product')->name('create.product');
Route::put('/products/{id}/delete','AdminController@delete_product')->name('delete.product');
Route::put('/products/{id}/edit','AdminController@edit_product')->name('edit.product');
Route::get('/products/search','AdminController@search_product')->name('search_product');
Route::get('/inventory','AdminController@inventory')->name('inventory');

Route::post('/inventory/category','AdminController@category')->name('create.category');
Route::post('/inventory/product','AdminController@inventory_product')->name('create.inventory_product');
Route::get('/inventory/orders','AdminController@order');
Route::get('/inventory/orders/search','AdminController@search_order')->name('search_order');
Route::get('/inventory/requests','AdminController@request');
Route::get('/inventory/requests/search','AdminController@search_request')->name('search_request');
Route::put('/inventory/requests/{id}','AdminController@request_status')->name('request_status');
});

Route::prefix('techsupport')->group(function()
{
Route::get('/login', 'Auth\TechsupportLoginController@showLoginForm')->name('techsupport.login');
Route::get('/','TechsupportController@home')->name('techsupport.dashboard');
Route::post('/login', 'Auth\TechsupportLoginController@login')->name('techsupport.login.submit');
Route::get('/logout', 'Auth\TechsupportLoginController@logout')->name('techsupport.logout');
Route::post('/password/email', 'Auth\TechsupportForgotPasswordController@sendResetLinkEmail')->name('techsupport.password.email');
Route::get('/password/reset', 'Auth\TechsupportForgotPasswordController@showLinkRequestForm')->name('techsupport.password.request');
Route::post('/password/reset', 'Auth\TechsupportResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\TechsupportResetPasswordController@showResetForm')->name('techsupport.password.reset');
Route::get('account','TechsupportController@account');
Route::put('account','TechsupportController@account_update')->name('update.techsupport');
Route::get('/tickets/pending','TechsupportController@pending')->name('techsupport.pending');
Route::put('/tickets/pending/{id}','TechsupportController@pending_status')->name('techsupport.pending.ticket_status');
Route::get('/tickets/pending/search','TechsupportController@search_pending')->name('search_pending');
Route::get('/tickets/open','TechsupportController@open')->name('techsupport.open');
Route::put('/tickets/open/{id}','TechsupportController@open_status')->name('techsupport.open.ticket_status');
Route::get('/tickets/open/search','TechsupportController@search_open')->name('search_open');
Route::get('/tickets/closed','TechsupportController@close')->name('techsupport.close');
Route::put('/tickets/closed/{id}','TechsupportController@close_status')->name('techsupport.close.ticket_status');
Route::get('/tickets/closed/search','TechsupportController@search_close')->name('search_close');
Route::get('/tickets/{id}','TechsupportController@ticket');
Route::post('/tickets/{id}/message','TechsupportController@send_message')->name('techsupport.message');
Route::get('/tickets/repairs/{id}','TechsupportController@repair');
Route::post('/tickets/repairs/{id}','TechsupportController@send_repair')->name('techsupport.repair');
Route::get('/tickets/repairs/{id}/messages','TechsupportController@repair_message');
Route::post('/tickets/repairs/{id}/message','TechsupportController@send_repair_message')->name('techsupport.repair_message');
});

Route::prefix('repair')->group(function()
{
Route::get('/login', 'Auth\RepairLoginController@showLoginForm')->name('repair.login');
Route::post('/login', 'Auth\RepairLoginController@login')->name('repair.login.submit');
Route::get('/logout', 'Auth\RepairLoginController@logout')->name('repair.logout');
Route::post('/password/email', 'Auth\RepairForgotPasswordController@sendResetLinkEmail')->name('repair.password.email');
Route::get('/password/reset', 'Auth\RepairForgotPasswordController@showLinkRequestForm')->name('repair.password.request');
Route::post('/password/reset', 'Auth\RepairResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\RepairResetPasswordController@showResetForm')->name('repair.password.reset');
Route::get('account','RepairController@account');
Route::put('account','RepairController@account_update')->name('update.repair');
Route::get('/','RepairController@home');
Route::get('/repairs','RepairController@repairs')->name('repair.dashboard');
Route::get('/repairs/{id}','RepairController@repair_message');
Route::post('/repairs/{id}','RepairController@send_repair_message')->name('repair.repair_message');
Route::get('/search/repairs','RepairController@search_repair')->name('repair_search');
Route::get('/inventory','RepairController@inventory')->name('repair.inventory');
Route::post('/inventory/order/{id}','RepairController@order')->name('repair.order');
Route::post('/inventory/request','RepairController@request')->name('request_inventory');
Route::get('/inventory/orders','RepairController@view_order');
Route::get('/inventory/orders/search','RepairController@search_order')->name('order_search');
Route::get('/inventory/requests','RepairController@view_request');
Route::get('/inventory/requests/search','RepairController@search_request')->name('request_search');
});

Route::prefix('customer')->group(function()
{
    Route::get('/register', 'Auth\CustomerRegisterController@showRegistrationForm');
    Route::post('/register', 'Auth\CustomerRegisterController@register')->name('customer.register');
    Route::get('/login', 'Auth\CustomerLoginController@showLoginForm')->name('customer.login');
Route::post('/login', 'Auth\CustomerLoginController@login')->name('customer.login.submit');
Route::get('/logout', 'Auth\CustomerLoginController@logout')->name('customer.logout');
Route::post('/password/email', 'Auth\CustomerForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
Route::get('/password/reset', 'Auth\CustomerForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
Route::post('/password/reset', 'Auth\CustomerResetPasswordController@reset');
Route::get('/password/reset/{token}', 'Auth\CustomerResetPasswordController@showResetForm')->name('customer.password.reset');
Route::get('/','CustomerController@home')->name('customer.dashboard');
Route::get('/service','CustomerController@service');
Route::post('/service/products/','CustomerController@brand')->name('service.brand');
Route::post('/service/products/ticket','CustomerController@ticket')->name('service.product');
Route::post('/service/products/ticket/submit','CustomerController@send_ticket')->name('service.send_ticket');
Route::get('/service/tickets','CustomerController@index_ticket')->name('index_ticket');
Route::get('/service/tickets/{id}','CustomerController@view_ticket');
Route::post('/service/tickets/{id}/message','CustomerController@send_message')->name('customer.message');
});