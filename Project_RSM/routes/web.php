<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BranchsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MenusController;
use App\Http\Controllers\MenuWebController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\TableTypeController;
use App\Http\Controllers\UnitsControler;
use App\Http\Controllers\ClientBookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*------------------------------------------ADMIN-----------------------------------------------*/
Route::get('/admin', [HomeAdminController::class, 'statistical']);
Route::get('/admin/login.html', [HomeAdminController::class, 'login'])->name('login');
Route::post('/admin/login.html', [HomeAdminController::class, 'login_post']);
Route::get('/admin/logout', [HomeAdminController::class, 'logout']);
Route::get('/admin/home/statistical/{filter?}', [HomeAdminController::class, 'statistical'])->name('statistical');

//User - Nhân viên
Route::get('/admin/user/index', [UserAdminController::class, 'index']);
Route::get('/admin/user/create', [UserAdminController::class, 'create']);
Route::post('/admin/user/create', [UserAdminController::class, 'create_post']);
Route::get('/admin/user/show/{UserName}-{FirstName}', [UserAdminController::class, 'show']);
Route::put('/admin/user/{UserName}', [UserAdminController::class, 'edit_put']);
Route::get('/admin/user/delete/{UserName}', [UserAdminController::class, 'delete']);

//Role - Phân quyền
Route::get('/admin/role/index', [RoleAdminController::class, 'index']);
Route::get('/admin/role/create', [RoleAdminController::class, 'create']);
Route::post('/admin/role/create', [RoleAdminController::class, 'create_post']);
Route::get('/admin/role/show/{IdGroup}-{FirstName}', [RoleAdminController::class, 'show']);
Route::put('/admin/role/{IdGroup}', [RoleAdminController::class, 'edit_put']);
Route::get('/admin/role/delete/{IdGroup}', [RoleAdminController::class, 'delete']);

//API
Route::get('/provinces',  [APIController::class, 'getProvinces']);
Route::get('/districts/{province_id}',  [APIController::class, 'getDistricts']);
Route::get('/wards/{district_id}',  [APIController::class, 'getWards']);

//Customer - Khách hàng
Route::get('/admin/customer/index', [CustomerController::class, 'index']);
Route::get('/admin/customer/create', [CustomerController::class, 'create']);
Route::post('/admin/customer/create', [CustomerController::class, 'create_post']);
Route::get('/admin/customer/show/{IdCustomer}-{FirstName}', [CustomerController::class, 'show']);
Route::put('/admin/customer/{IdCustomer}', [CustomerController::class, 'edit_put']);
Route::get('/admin/customer/delete/{IdCustomer}', [CustomerController::class, 'delete']);
Route::post('/admin/customer/export-csv', [CustomerController::class, 'export_csv']);
Route::post('/admin/customer/import-csv', [CustomerController::class, 'import_csv']);

//Items - Mặt hàng (Món ăn,...)
Route::get('/admin/items/index', [ItemsController::class, 'index']);
Route::get('/admin/items/create', [ItemsController::class, 'create']);
Route::post('/admin/items/create', [ItemsController::class, 'create_post']);
Route::get('/admin/items/show/{IdItems}-{ItemsName}', [ItemsController::class, 'show']);
Route::post('/admin/items/{IdItems}', [ItemsController::class, 'edit_put']);
Route::get('/admin/items/delete/{IdItems}', [ItemsController::class, 'delete']);
Route::post('/admin/items/delete/all', [ItemsController::class, 'delete_all']);//xóa nhiều
Route::post('/admin/items/export-csv', [ItemsController::class, 'export_csv']);
Route::post('/admin/items/import-csv', [ItemsController::class, 'import_csv']);

//Menus - Thực đơn các món ăn
Route::get('/admin/menus/index', [MenusController::class, 'index']);
Route::get('/admin/menus/create', [MenusController::class, 'create']);
Route::post('/admin/menus/create', [MenusController::class, 'create_post']);
Route::get('/admin/menus/show/{IdMenu}-{MenuName}', [MenusController::class, 'show']);
Route::post('/admin/menus/{IdMenu}', [MenusController::class, 'edit_put']);
Route::get('/admin/menus/delete/{IdMenu}', [MenusController::class, 'delete']);
Route::post('/admin/menus/delete/all', [MenusController::class, 'delete_all']);//xóa nhiều
Route::post('/admin/menus/export-csv', [MenusController::class, 'export_csv']);
Route::post('/admin/menus/import-csv', [MenusController::class, 'import_csv']);

//Category - Danh mục mặt hàng
Route::get('/admin/category/index', [CategoryController::class, 'index']);
Route::get('/admin/category/create', [CategoryController::class, 'create']);
Route::post('/admin/category/create', [CategoryController::class, 'create_post']);
Route::get('/admin/category/show/{IdCategory}-{CategoryName}', [CategoryController::class, 'show']);
Route::put('/admin/category/{IdCategory}', [CategoryController::class, 'edit_put']);
Route::get('/admin/category/delete/{IdCategory}', [CategoryController::class, 'delete']);
Route::post('/admin/category/delete/all', [CategoryController::class, 'delete_all']);//xóa nhiều

//Unit - Đơn vị tính
Route::get('/admin/unit/index', [UnitsControler::class, 'index']);
Route::get('/admin/unit/create', [UnitsControler::class, 'create']);
Route::post('/admin/unit/create', [UnitsControler::class, 'create_post']);
Route::get('/admin/unit/show/{IdUnit}-{UnitName}', [UnitsControler::class, 'show']);
Route::put('/admin/unit/{IdUnit}', [UnitsControler::class, 'edit_put']);
Route::get('/admin/unit/delete/{IdUnit}', [UnitsControler::class, 'delete']);
Route::post('/admin/unit/delete/all', [UnitsControler::class, 'delete_all']);//xóa nhiều

//Combo - Các combo trong nhà hàng
Route::get('/admin/combo/index', [ComboController::class, 'index']);
Route::get('/admin/combo/create', [ComboController::class, 'create']);
Route::post('/admin/combo/create', [ComboController::class, 'create_post']);
Route::get('/admin/combo/show/{IdCombo}-{ComboName}', [ComboController::class, 'show']);
Route::post('/admin/combo/{IdCombo}', [ComboController::class, 'edit_put']);
Route::get('/admin/combo/delete/{IdCombo}', [ComboController::class, 'delete']);
Route::post('/admin/combo/delete/all', [ComboController::class, 'delete_all']);//Xóa nhiều

//Setting - thiết lập nhà hàng (Cơ sở, Khu vực, Danh sách bàn, Loại bàn)
Route::get('/admin/settings/index', [SettingController::class, 'index']);
Route::get('/admin/settings/infomation/show', [SettingController::class, 'show_res_info'])->name('show-res-info');
Route::post('/admin/settings/infomation/update', [SettingController::class, 'update_post'])->name('update-res-info');
Route::get('/admin/settings/infomation', [SettingController::class, 'res_info_post']);
Route::get('/admin/settings/infomation/create', [SettingController::class, 'create_res_info'])->name('create-res-info');
Route::post('/admin/settings/infomation/created', [SettingController::class, 'create_post']);

// tabletype - Loại bàn
Route::get('/admin/tabletype/index', [TableTypeController::class, 'index']);
Route::get('/admin/tabletype/create', [TableTypeController::class, 'create']);
Route::post('/admin/tabletype/create', [TableTypeController::class, 'create_post']);
Route::get('/admin/tabletype/show/{IdType}', [TableTypeController::class, 'show']);
Route::put('/admin/tabletype/{IdType}', [TableTypeController::class, 'edit_put']);
Route::get('/admin/tabletype/delete/{IdType}', [TableTypeController::class, 'delete']);
Route::post('/admin/tabletype/delete/all', [TableTypeController::class, 'delete_all']);//xóa nhiều

//branchs - Cơ sở
Route::get('/admin/branchs/index', [BranchsController::class, 'index']);
Route::get('/admin/branchs/create', [BranchsController::class, 'create']);
Route::post('/admin/branchs/create', [BranchsController::class, 'create_post']);
Route::get('/admin/branchs/show/{IdType}-{TypeName}', [BranchsController::class, 'show']);
Route::put('/admin/branchs/{IdType}', [BranchsController::class, 'edit_put']);
Route::get('/admin/branchs/delete/{IdType}', [BranchsController::class, 'delete']);
Route::post('/admin/branchs/delete/all', [BranchsController::class, 'delete_all']);//xóa nhiều

//Area / Table - Khu vực và Bàn
Route::get('/admin/area/index', [AreaController::class, 'index']);
Route::get('/admin/area/create', [AreaController::class, 'create']);
Route::post('/admin/area/create', [AreaController::class, 'create_post']);
Route::get('/admin/area/show/{IdArea}', [AreaController::class, 'show']);
Route::post('/admin/area/{IdArea}', [AreaController::class, 'edit_post']);
Route::get('/admin/area/delete/{IdArea}', [AreaController::class, 'delete']);
Route::post('/admin/area/delete/all', [AreaController::class, 'delete_all']);//xóa nhiều

//Menuweb - Menu website cli
Route::get('/admin/menu/index', [MenuWebController::class, 'index']);
Route::get('/admin/menu/create', [MenuWebController::class, 'create']);
Route::post('/admin/menu/create', [MenuWebController::class, 'create_post']);
Route::get('/admin/menu/show/{IdMenu}-{MenuName}', [MenuWebController::class, 'show']);
Route::put('/admin/menu/{IdMenu}', [MenuWebController::class, 'edit_put']);
Route::get('/admin/menu/delete/{IdMenu}', [MenuWebController::class, 'delete']);
Route::post('/admin/menu/delete/all', [MenuWebController::class, 'delete_all']);//xóa nhiều

//Silde -
Route::get('/admin/slide/index', [SlideController::class, 'index']);
Route::get('/admin/slide/create', [SlideController::class, 'create']);
Route::post('/admin/slide/create', [SlideController::class, 'create_post']);
Route::get('/admin/slide/show/{IdSlide}', [SlideController::class, 'show']);
Route::put('/admin/slide/{IdSlide}', [SlideController::class, 'edit_put']);
Route::get('/admin/slide/delete/{IdSlide}', [SlideController::class, 'delete']);
Route::post('/admin/slide/delete/all', [SlideController::class, 'delete_all']);//xóa nhiều

//Booking - Đặt bàn
Route::get('/admin/booking/index', [BookingController::class, 'index'])->name('booking');
Route::get('/admin/booking/create', [BookingController::class, 'create'])->name('booking-create');
Route::post('/admin/booking/create', [BookingController::class, 'create_post'])->name('booking-create-post');
Route::get('/admin/booking/show/{IdBooking}', [BookingController::class, 'show'])->name('booking-show');
Route::get('/admin/booking/booking-history', [BookingController::class, 'booking_history']);
Route::get('/admin/booking/select-table/{IdBooking}', [BookingController::class, 'select_table'])->name('select-table');
Route::get('/admin/booking/selected-table/{IdBooking}/{IdTable}', [BookingController::class, 'selected_table'])->name('selected-table');
Route::get('/admin/booking/select-items/{IdBooking}', [BookingController::class, 'select_items'])->name('select-items');
Route::post('/admin/booking/selected-items/{IdBooking}', [BookingController::class, 'selected_items'])->name('selected-items');
Route::get('/admin/booking/receive/{IdBooking}', [BookingController::class, 'receive'])->name('booking-receive');
Route::get('/admin/booking/delete/{IdBooking}', [BookingController::class, 'delete']); //Hủy đơn

//Order - Hóa đơn
Route::get('/admin/orders/index', [OrdersController::class, 'index']);
Route::get('/admin/orders/create', [OrdersController::class, 'create'])->name('orders-create');
Route::post('/admin/orders/create', [OrdersController::class, 'create_post'])->name('orders-create-post');
Route::get('/admin/orders/orders-history', [OrdersController::class, 'orders_history']);
Route::get('/admin/orders/table-list', [OrdersController::class, 'table_list']);
Route::get('/admin/orders/show/{IdOrder}', [OrdersController::class, 'show'])->name('orders-show');
Route::get('/admin/orders/select-items/{IdOrder}', [OrdersController::class, 'select_items'])->name('orders-select-items');
Route::post('/admin/orders/selected-items/{IdOrder}', [OrdersController::class, 'selected_items'])->name('orders-selected-items');
Route::get('/admin/orders/payment/{IdOrder}', [OrdersController::class, 'handlePayment'])->name('orders-handle-payment');
Route::get('/admin/orders/select-table/{IdOrder}', [OrdersController::class, 'select_table'])->name('orders-select-table');
Route::get('/admin/orders/selected-table/{IdOrder}/{IdTable}', [OrdersController::class, 'selected_table'])->name('orders-selected-table');
Route::post('/admin/order/delete/{IdOrder}', [OrdersController::class, 'delete']); //Hủy đơn
Route::get('/admin/order/print/{IdOrder}', [OrdersController::class, 'print'])->name('orders-print'); //In đơn


// Client /* --------------------------------------------------------- */
Route::get('/', [HomeController::class, 'index'])->name('client.home');
Route::get('/index.html', [HomeController::class, 'index']);
Route::get('/login.html', [HomeController::class, 'login'])->name('client.login');
Route::post('/login', [HomeController::class, 'login_post'])->name('client.login.post');
Route::get('/logout', [HomeController::class, 'logout'])->name('client.logout');
Route::get('/menus.html', [HomeController::class, 'menus'])->name('show-menus');
Route::get('/about.html', [HomeController::class, 'about'])->name('show-about');
Route::get('/add-cart/{IdItems}', [CartController::class, 'add_cart']);
Route::get('/sub-cart/{IdItems}', [CartController::class, 'sub_cart']);
Route::get('/delete-cart/{IdItems}', [CartController::class, 'delete_cart']);
Route::get('/cart.html', [CartController::class, 'index'])->name('show-cart');
Route::post('/cart/booking', [CartController::class, 'booking'])->name('cart.booking');
Route::get('/cart/payment/{IdOrder}', [CartController::class, 'payment'])->name('cart-payment');
Route::post('/cart/checkout/{IdOrder}', [CartController::class, 'processVNPay']);
Route::get('/cart/checkout/result', [CartController::class, 'checkoutResult']);
Route::get('/search', [HomeController::class, 'searchItems'])->name('client.search');

Route::get('/register.html', [HomeController::class, 'register'])->name('client.register');
Route::post('/register', [HomeController::class, 'register_post'])->name('client.register.post');

//Quản lý đơn đặt bàn
Route::get('/user/booking', [ClientBookingController::class, 'index'])->name('client.booking.index');
Route::get('/user/booking/feedback&IdBooking={IdBooking}', [ClientBookingController::class, 'feedback'])->name('client.booking.feedback');
Route::post('/user/booking/feedback', [ClientBookingController::class, 'feedback_post'])->name('client.booking.feedback-post');

