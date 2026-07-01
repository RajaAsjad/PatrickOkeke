<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\BookPurchaseController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BookController;
use App\Http\Controllers\admin\HomeSliderController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\ContactUsController;
use App\Http\Controllers\admin\VideoController;
use App\Http\Controllers\admin\AudioController;
use App\Http\Controllers\admin\PhotoGalleryController;
use App\Http\Controllers\admin\ShopContactController;
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
Route::get('/route-clear', function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    $cache = 'Route cache cleared <br /> View cache cleared <br /> Cache cleared <br /> Config cleared <br /> Config cache cleared';
    return $cache;
});

Route::get('admin/login', 'admin\AdminController@login')->name('admin.login');
Route::post('admin/authenticate', 'admin\AdminController@authenticate')->name('admin.authenticate');


Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/admin/profile/edit', 'admin\AdminController@editProfile')->name('admin.profile.edit');
Route::post('/admin/profile/update', 'admin\AdminController@updateProfile')->name('admin.profile.update');
Route::post('admin/logout', 'admin\AdminController@logOut')->name('admin.logout');


// Frontend routes
Route::get('/', [WebController::class, 'Index'])->name('index'); 
Route::get('about', [WebController::class, 'About'])->name('about');
Route::get('books', [WebController::class, 'Books'])->name('books');
Route::get('books/purchase/success', [BookPurchaseController::class, 'success'])->name('books.purchase.success');
Route::get('book-download/{token}', [BookPurchaseController::class, 'download'])->name('book.download')->where('token', '[A-Za-z0-9]+');
Route::get('books/download/{token}', [BookPurchaseController::class, 'legacyDownloadRedirect'])->name('books.download')->where('token', '[A-Za-z0-9]+');
Route::get('books/{slug}/checkout', [BookPurchaseController::class, 'checkout'])->name('books.checkout');
Route::post('books/{slug}/payment-intent', [BookPurchaseController::class, 'paymentIntent'])->name('books.payment-intent');
Route::get('books/{slug}', [WebController::class, 'BookShow'])->name('books.show');
Route::get('contact', [WebController::class, 'Contact'])->name('contact');
Route::post('contact', [WebController::class, 'submitContact'])->name('contact.submit');


// Redirect /login to admin login (session expired or user types /login in URL)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//ContactUs
Route::resource('contactus', ContactUsController::class);
Route::resource('shopcontact', ShopContactController::class);
Route::group(['middleware' => ['auth']], function () {

    //Roles
    Route::resource('role', 'admin\RoleController');

    //permissions
    Route::resource('permission', 'admin\PermissionController');

    //Setting
    Route::resource('page', 'admin\SettingController');

    //pages settings
    Route::resource('page', 'admin\PageController');
    Route::resource('page_setting', 'admin\PageSettingController');

    //Banner
    Route::resource('banner', BannerController::class);
    
    //Home Slider
    Route::resource('homeslider', HomeSliderController::class);

    //testimonial
    Route::resource('testimonial', TestimonialController::class);

    //Video
    Route::resource('video', VideoController::class);

    //Books
    Route::resource('book', BookController::class);
    
    //Audios
    Route::resource('audio', AudioController::class);

    //Photo Gallery
    Route::resource('photogallery', PhotoGalleryController::class);
});
