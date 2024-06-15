<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Bid;
use Carbon\Carbon;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageSliderController;
use App\Http\Controllers\SetTimerController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\GalleryController;

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

//home route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

//backend home route
Route::get('/dashboard', function () {
    // Get total number of users
    $totalUsers = User::count();

    // Get total number of categories
    $totalCategories = Category::count();

    // Get total number of products
    $totalProducts = Product::count();

    // Get total number of bids
    $totalBids = Bid::count();

    // Get current year's bids per month
    $currentYear = Carbon::now()->year;
    $bidsPerMonth = Bid::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                        ->whereYear('created_at', $currentYear)
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();

    return view('backend.home', compact('totalUsers', 'totalCategories', 'totalProducts', 'totalBids', 'bidsPerMonth'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//all resources routes
Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
    'categories' => CategoryController::class,
    'settimers' => SetTimerController::class,
    'galleries' => GalleryController::class,
]);

//categories softdeletes routes
Route::get('/category/trashed', [App\Http\Controllers\CategoryController::class, 'trashed'])->name('categories.trashed');
Route::get('/category/trashed/restore/{category}', [App\Http\Controllers\CategoryController::class, 'restore'])->name('categories.trashed.restore');
Route::delete('/category/trashed/delete/{category}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('categories.trashed.delete');

//products softdeletes routes
Route::resource('products','App\Http\Controllers\ProductController');
Route::get('/product/trashed', [App\Http\Controllers\ProductController::class, 'trashed'])->name('products.trashed');
Route::get('/product/trashed/restore/{product}', [App\Http\Controllers\ProductController::class, 'restore'])->name('products.trashed.restore');
Route::delete('/product/trashed/delete/{product}', [App\Http\Controllers\ProductController::class, 'delete'])->name('products.trashed.delete');

//galleries softdeletes routes
Route::get('/gallery/trashed', [App\Http\Controllers\GalleryController::class, 'trashed'])->name('galleries.trashed');
Route::get('/gallery/trashed/restore/{gallery}', [App\Http\Controllers\GalleryController::class, 'restore'])->name('galleries.trashed.restore');
Route::delete('/gallery/trashed/delete/{gallery}', [App\Http\Controllers\GalleryController::class, 'delete'])->name('galleries.trashed.delete');


//profiles routes
Route::group(['middleware' => ['auth']], function() {
    Route::get('/profile/edit/{user_id}', [ProfileController::class, 'profileEdit'])->name('profiles.edit');
    Route::post('profile/passwordChange/{user_id}',[ProfileController::class,'passwordChange'])->name('profiles.password.change');
    Route::post('/update-profile/{user_id}', [ProfileController::class,'updateProfile'])->name('updateProfile');


    //bids routes
    Route::get('/bid/{id}/{user}', [App\Http\Controllers\BidController::class, 'index'])->name('bids.index');
    Route::post('/submit_bid', [BidController::class, 'store'])->name('submit_bid');


    Route::resource('bids','App\Http\Controllers\BidTableController');
    Route::get('/bid/status', [App\Http\Controllers\BidTableController::class, 'status'])->name('bids.status');
});


// Image slider
Route::get('/imageslider', [ImageSliderController::class, 'index'])->name('imageslider.list');
Route::get('/imageslider/creates',[ImageSliderController::class, 'create'])->name('imageslider.create');
Route::post('/imageslider/create',[ImageSliderController::class, 'store'])->name('imageslider.store');
Route::get('/admin/image_sliders/{image_slider}',[ImageSliderController::class, 'show'])->name('imagesliders.show');
Route::get('/admin/imagesliders/edit/{image_slider}',[ImageSliderController::class, 'edit'])->name('imagesliders.edit');
Route::delete('/admin/imagesliders/{image_slider}', [ImageSliderController::class, 'destroy'])->name('imagesliders.destroy');
Route::get('/admin/trash-image_slider',[ImageSliderController::class, 'trash'])->name('imagesliders.trashed');
Route::patch('/admin/imagesliders/{image_slider}/update',[ImageSliderController::class, 'update'])->name('imagesliders.update');
Route::get('/admin/trash-products/{image_slider}',[ImageSliderController::class, 'restore'])->name('image_slider.restore');
Route::delete('/admin/trash-products/{image_slider}/delete',[ImageSliderController::class, 'delete'])->name('image_slider.delete');
Route::get('/frontend/carosel',[homeController::class, 'index'])->name('carosel.list');





//routes for the frontend
Route::get('/productDetails', [App\Http\Controllers\HomeController::class, 'productDetails'])->name('productDetails');
Route::get('/aboutUs', [App\Http\Controllers\HomeController::class, 'aboutUs'])->name('aboutUs');
Route::get('/contactUs', [App\Http\Controllers\HomeController::class, 'contactUs'])->name('contactUs');





//routes for notifications
Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('backend.notifications.index');
Route::get('/notifications/unread', [SetTimerController::class, 'getUnreadNotifications'])->name('notifications.unread');
Route::get('/notifications/{notifiableId}/approve', [App\Http\Controllers\NotificationController::class, 'approveNotification'])->name('notifications.approve');
Route::post('/notifications/{notifiableId}/reject', [App\Http\Controllers\NotificationController::class, 'rejectNotification'])->name('notifications.reject');


//routes for payment
Route::get('/invoice/{bidId}', [App\Http\Controllers\PaymentController::class, 'invoice']);
