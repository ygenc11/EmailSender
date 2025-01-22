<?php

 //use Illuminate\Support\Facades\Route;

use App\Mail\DenemeMail;
use App\Http\Controllers\MailingListController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('/maileclipse/mailables/', 301);
});

Route::get('/mail', function () {
    Mail::to('ygenc1536@gmail.com')->send(new DenemeMail());
    return "Mail Send!!";     
});

Route::get('/maileclipse/mailing-list', [MailingListController::class, 'index'])->name('mailingList');
Route::post('/maileclipse/mailing-list/store', [MailingListController::class, 'store'])->name('storeMailingList');
Route::post('/maileclipse/mailing-list/update', [MailingListController::class, 'update'])->name('updateMailingList');
Route::delete('/maileclipse/mailing-list/{id}', [MailingListController::class, 'destroy'])->name('deleteMailingList');
Route::post('/maileclipse/mailing-list/delete', [MailingListController::class, 'destroy'])->name('deleteMailingList');


