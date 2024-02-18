<?php

use App\Models\Lot;

//use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CamperController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\LotController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ToyyibpayController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\Camper\BookingController;

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

Route::get('/', function () {
    $lots = Lot::all();
    return view('welcome', compact('lots'));
})->name('welcome');

Route::get('contact', function () {
    return view('contact');
})->name('contact');

// Route::get('contact', 'contact')->name('contact');

Route::get('policy', function () {
    return view('policy');
})->name('policy');

// Route::get('payment', function () {
//     return view('camper.booking_payment');
// })->name('payment');

// Route::get('payment0', function () {
//     return view('camper.payment0');
// })->name('payment0');

// Route::get('payment1', function () {
//     return view('camper.payment1');
// })->name('payment1');

// Route::post('payment2', function () {
//     return view('camper.payment2');
// })->name('payment2');

// Route::get('payment3', function () {
//     return view('camper.payment3');
// })->name('payment3');

// Route::post('payment4', function () {
//     return view('camper.payment4');
// })->name('payment4');

// Route::post('payment5', function () {
//     return view('camper.payment5');
// })->name('payment5');

Auth::routes(); // "login, register, reset password"

Route::group(['prefix' => '/app', 'as' => 'app.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class,"dashboard"])->name('dashboard');
    Route::resource('booking', BookingController::class);
    Route::get('/booking/cancel/{booking}', [App\Http\Controllers\Camper\BookingController::class,"cancel"])->name('booking.cancel');
    Route::post('/booking/cancel/{booking}', [App\Http\Controllers\Camper\BookingController::class,"cancelprocess"])->name('booking.cancelprocess');
    // Route::get('/booking/payment', [App\Http\Controllers\Camper\BookingController::class,"payment"])->name('booking.payment');
    // Route::post('/booking/payment', [App\Http\Controllers\Camper\BookingController::class,"paymentprocess"])->name('booking.paymentprocess');
    Route::get('/booking/payment/{booking}', [App\Http\Controllers\Camper\BookingController::class,"payment"])->name('booking.payment');
    Route::get('/booking/payment0/{booking}', [App\Http\Controllers\Camper\BookingController::class,"payment0"])->name('booking.payment0');
    Route::get('/booking/payment1/{booking}', [App\Http\Controllers\Camper\BookingController::class,"payment1"])->name('booking.payment1');
    Route::post('/booking/payment2/{booking}', [App\Http\Controllers\Camper\BookingController::class,"payment2"])->name('booking.payment2');
    Route::get('/booking/payment3/{booking}', [App\Http\Controllers\Camper\BookingController::class,"payment3"])->name('booking.payment3');
    Route::post('/booking/payment4/{booking}', [App\Http\Controllers\Camper\BookingController::class,"payment4"])->name('booking.payment4');
    Route::post('/booking/payment5/{booking}', [App\Http\Controllers\Camper\BookingController::class,"payment5"])->name('booking.payment5');
    Route::post('/booking/process_card/{booking}', [App\Http\Controllers\Camper\BookingController::class,"process_card"])->name('booking.process_card');
    Route::resource('complaint', ComplaintController::class);
    Route::resource('profile', CamperController::class);
    Route::resource('description', DescriptionController::class);
    Route::resource('lot', LotController::class);
    
    // Route::get('/booking/createBill/{booking}', [App\Http\Controllers\Camper\BookingController::class,"createBill"])->name('booking.createBill');
    // Route::get('/booking/paymentStatus/{booking}', [App\Http\Controllers\Camper\BookingController::class,"paymentStatus"])->name('booking.paymentStatus');
    // Route::post('/booking/callback/{booking}', [App\Http\Controllers\Camper\BookingController::class,"callback"])->name('booking.callback');
    // Route::get('/booking/receipt/{billCode}', [App\Http\Controllers\Camper\BookingController::class, 'getBillTransactions'])->name('booking.getBillTransactions');

    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class,'index'])->name('logs');
    
    Route::group(['prefix' => '/admin', 'as' => 'admin.', 'middleware' => ['checkAdmin']], function () {
        Route::get('/booking/pdf', [App\Http\Controllers\Admin\BookingController::class,"pdf"])->name('booking.pdf');
        Route::get('/booking/pdf/camper/{booking}', [App\Http\Controllers\Admin\BookingController::class,"pdfcamper"])->name('booking.pdfcamper');
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class,"dashboard"])->name('dashboard');
        Route::resource('camper', AdminController::class);
        Route::resource('lot', LotController::class);
        Route::resource('complaint', App\Http\Controllers\Admin\ComplaintController::class);
        Route::resource('booking', App\Http\Controllers\Admin\BookingController::class);
        Route::get('/booking/receipt/{billCode}', [App\Http\Controllers\Admin\BookingController::class, 'getBillTransactions'])->name('booking.getBillTransactions');
        
        Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class,'index'])->name('logs');
    });
});