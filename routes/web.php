<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


use Zizaco\Entrust\Entrust;

Auth::routes();

//Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
/*
 *
 *ADMIN
 *
 */
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['prefix' => 'admin','middleware' => ['role:admin|editor|kho|staff|user|company','auth', 'authorize']], function () {

    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardAdminController@index');
    //Tin tức
    Route::resource('news', 'NewController');
    Route::get('news/data/json', 'NewController@data');

    // Thông tin cần mua từ các Công ty
    Route::resource('newscompany', 'NewsCompanyController');
    Route::get('newscompany/data/json', 'NewsCompanyController@data');

    //Nhóm tin tức
    Route::resource('category', 'CategoryController');
    Route::get('category/data/json', 'CategoryController@data');

    //permisson
    Route::resource('role', 'RolesController');
    Route::get('role/data/json', 'RolesController@data');

    //permisson
    Route::resource('permission', 'PermissionsController');
    Route::get('permission/data/json', 'PermissionsController@data');


    //Trang
    Route::resource('pages', 'PageController');
    Route::get('pages/data/json', 'PageController@data');

    //Sản phẩm
    Route::resource('products', 'ProductController');
    Route::post('products/AjaxGetProduct', 'ProductController@AjaxGetProduct');

    //Nhóm sp
    Route::resource('categoryProducts', 'CategoryProductController');
    Route::post('categoryProducts/createAjax', 'CategoryProductController@createAjax');
    Route::post('categoryProducts/updateAjax', 'CategoryProductController@updateAjax');
 
    //Đơn hàng
    Route::resource('orders', 'OrderController');
    Route::get('orders/getOrderByStatus/{id}', 'OrderController@getOrderByStatus');
    Route::post('orders/AjaxGetDistrictByProvince', 'OrderController@AjaxGetDistrictByProvince');
    //ql kho
    Route::resource('inventory', 'InventoryController');
    //ql sỗ quỹ
    Route::resource('money', 'MoneyController');
    //ql lịch sữ giao dịch
    Route::resource('historyInput', 'HistoryInputController');
    Route::resource('company', 'CompanyController');

    //Quản lý kho
    Route::resource('warehouse', 'WarehouseController');

//    Route::post('warehouse/AjaxInfo', 'WarehouseController@AjaxInfo');
    Route::post('warehouse/AjaxBank', 'WarehouseController@AjaxBank');
    Route::post('warehouse/AjaxEditBank', 'WarehouseController@AjaxEditBank');
    Route::post('warehouse/AjaxEditLevel', 'WarehouseController@AjaxEditLevel');
    Route::post('warehouse/AjaxInfo', 'WarehouseController@AjaxInfo');
    Route::post('warehouse/AjaxChangePass', 'WarehouseController@AjaxChangePass');
    Route::post('warehouse/AjaxSendRequestUpdateLevelKho', 'WarehouseController@AjaxSendRequestUpdateLevelKho');
    Route::post('warehouse/AjaxReQuestConfirmKho', 'WarehouseController@AjaxReQuestConfirmKho');
    Route::post('warehouse/AjaxReQuestQuangCao', 'WarehouseController@AjaxReQuestQuangCao');
    Route::post('warehouse/AjaxConfirmKho', 'WarehouseController@AjaxConfirmKho');
    Route::post('warehouse/AjaxQuangCao', 'WarehouseController@AjaxQuangCao');
    Route::post('warehouse/AjaxReQuestTraphi', 'WarehouseController@AjaxReQuestTraphi');

    Route::post('company/AjaxBank', 'CompanyController@AjaxBank');
    Route::post('company/AjaxEditBank', 'CompanyController@AjaxEditBank');
    // Route::post('company/AjaxEditLevel', 'WarehouseController@AjaxEditLevel');
    Route::post('company/AjaxInfo', 'CompanyController@AjaxInfo');
    Route::post('company/AjaxChangePass', 'CompanyController@AjaxChangePass');
    // Route::post('company/AjaxSendRequestUpdateLevelKho', 'WarehouseController@AjaxSendRequestUpdateLevelKho');
    Route::post('company/AjaxReQuestConfirmKho', 'CompanyController@AjaxReQuestConfirmKho');
    Route::post('company/AjaxReQuestQuangCao', 'CompanyController@AjaxReQuestQuangCao');
    Route::post('company/AjaxConfirmKho', 'CompanyController@AjaxConfirmKho');
    Route::post('company/AjaxQuangCao', 'CompanyController@AjaxQuangCao');
    Route::post('company/AjaxReQuestTraphi', 'CompanyController@AjaxReQuestTraphi');

    //Khách hàng
    Route::resource('customers', 'customerController');
    //Users
    Route::resource('users', 'UserController');
    Route::post('users/AjaxCreateCustomer', 'UserController@AjaxCreateCustomer');
    Route::post('users/AjaxGetDataCustomer', 'UserController@AjaxGetDataCustomer');


    //Nhân sự
    Route::resource('staffs', 'StaffController'); 
    // Vận chuyển
    Route::resource('driver', 'DriverController'); 
    Route::get('driver/data/json', 'DriverController@data');
    Route::post('driver/AjaxCreateTransport', 'DriverController@AjaxCreateTransport');
    Route::post('driver/AjaxGetDataTransport', 'DriverController@AjaxGetDataTransport');
    //Cài đặt
    Route::resource('setting', 'SettingController');
    //Menu
    Route::resource('menu', 'MenuController');
    Route::post('menu/AjaxSave', 'MenuController@AjaxSave');

    //Giao diện
    Route::resource('display', 'DisplayController');
    //Ngôn ngữ
    Route::resource('languages', 'LanguageController');
    //Thống kê truy cập
    Route::resource('statistics', 'StatisticController');
    //Thông báo
    Route::resource('notification', 'NotificationController');

    //Mã giới thiệu
    Route::resource('sharingreferralcode', 'ReferralCodeController');

    
});
//Maps
    Route::get('/mapsgetmap', 'LocationCotroller@getMap');
    Route::get('/mapsadd', 'LocationCotroller@getAdd');
    Route::post('/mapsadd', 'LocationCotroller@postAdd');
/**
 * ajax
 */

Route::post('users/changeAvata', 'UserController@AjaxChangeImage');
Route::post('product/checkProductAjax', 'ProductController@checkProductAjax');
Route::post('product/updateProductAjax', 'ProductController@UpdateProductAjax');
Route::post('product/UpdateProductHistoryInput', 'ProductController@UpdateProductHistoryInput');
Route::post('product/deleteDetailImage', 'ProductController@deleteDetailImage');
Route::post('admin/getdashboard', 'DashboardAdminController@getdashboard');
Route::post('admin/dashboardctrl', 'DashboardController@dashboard');
Route::post('admin/dashboard/Approval', 'DashboardController@Approval');
Route::get('admin/notify/AjaxUpdateIsReadNotify', 'NotificationController@AjaxUpdateIsReadNotify');
Route::post('warehouse/AjaxDetail', 'WarehouseController@AjaxDetail');
Route::post('warehouse/deleteDetailImage', 'WarehouseController@deleteDetailImage');
Route::post('warehouse/UploadImgDetail', 'WarehouseController@UploadImgDetail');
Route::post('company/UploadImgDetail', 'CompanyController@UploadImgDetail');
Route::post('company/AjaxDetail', 'CompanyController@AjaxDetail');
Route::post('company/deleteDetailImage', 'CompanyController@deleteDetailImage');




/*
 *
 *APP
 *
 */


Route::get('/', 'HomeController@index');

//product
Route::get('/category-product/{cateSlug}','Frontend\ProductController@CateProduct');
Route::get('/products', 'Frontend\ProductController@index');
Route::get('/product/{cateSlug}/{productSlug}', 'Frontend\ProductController@SingleProduct');
Route::get('/check-order', 'Frontend\ProductController@CheckOrder');
//Route::post('/check-order', 'Frontend\ProductController@PostCheckOrder');
Route::post('/single-order', 'Frontend\ProductController@singleOrder');

Route::get('/company-business', 'Frontend\ProductController@GetAllCompany');
Route::get('/warehouse-business', 'Frontend\ProductController@GetAllWareHouse');
Route::get('/productview', 'Frontend\ProductController@GetAllProduct');
Route::get('/company/{company_id}', 'Frontend\PageController@DetailCompany');
Route::get('/company/{company_id}/{newscompanySlug}/{newscompany_id}', 'Frontend\PageController@DetailNewsCompany');



//blog
Route::get('/category-blog/{cateSlug}','Frontend\BlogController@CateBlog');
Route::get('/blogs', 'Frontend\BlogController@index');
Route::get('/blog/{cateSlug}/{productSlug}', 'Frontend\BlogController@SingleBlog');

Route::get('/contact','Frontend\PageController@Contact');
Route::Post('/contact','Frontend\PageController@PostContact');

//thông tin chủ kho
Route::get('/shop/{warehousr_id}', 'Frontend\PageController@DetailWarehouse');
Route::get('/xac-thuc-kho', 'Frontend\PageController@ConfirmKho');
Route::get('/quang-cao', 'Frontend\PageController@QuangCao');
Route::get('/tra-phi', 'Frontend\PageController@TraPhi');
Route::get('/nang-cap-kho', 'Frontend\PageController@UpgradeKho');

Route::get('/infoconfirmkho', 'Frontend\PageController@InfoConfirmKho');
Route::get('/infoquangcao', 'Frontend\PageController@InfoQuangCao');

Route::get('/resisterWareHouse','Frontend\PageController@GetResisterWareHouse');
Route::post('/resisterWareHouse','Frontend\PageController@PostResisterWareHouse');

Route::get('/about','Frontend\PageController@About');
Route::get('/{slug}','Frontend\PageController@CustomPage');

Route::post('/customer-rate','Frontend\ProductController@customerRate');

// maps
/*Route::get('/', ['as' => 'getLocation', 'uses' => 'LocationCotroller@getLocation']);*/

Route::get('/xac-thuc-kho', 'HomeController@testmap');


////cart
//Route::get('/cart', 'CartController@index');
//Route::get('/cart/empty', 'CartController@emptyCart');
//Route::get('/cart/{id}', 'CartController@store');
//Route::get('/cart/remove/{id}', 'CartController@destroy');








