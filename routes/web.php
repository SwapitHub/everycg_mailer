<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SmtpController;
use App\Http\Controllers\MailController;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/send-test-mail', function () {
    Mail::to('shubham.swapit@gmail.com')->send(new TestMail("This is a test email message."));
    return 'Test email sent!';
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/groups', [GroupController::class, 'index'])->name('groups');
    Route::post('/groups', [GroupController::class, 'store'])->name('group.create');
    Route::post('/groups/edit/{id}', [GroupController::class, 'update'])->name('group.update');
    Route::delete('/groups/delete/{id}', [GroupController::class, 'destroy'])->name('group.delete');

    Route::post('/contacts/import', [ContactController::class, 'importContacts'])->name('contacts.import');
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contact.create');
    Route::get('/contacts/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
    Route::post('/contacts/edit/{id}', [ContactController::class, 'update'])->name('contact.update');
    Route::delete('/contacts/delete/{id}', [ContactController::class, 'destroy'])->name('contact.delete');
    Route::get('/get-contacts-by-group/{groupId}', [ContactController::class, 'getContactsByGroup'])->name('contact.get');


    Route::get('/smtp', [SmtpController::class, 'index'])->name('smtp');
    Route::post('/smtp', [SmtpController::class, 'update'])->name('smtp.update');

    Route::get('/email/inbox', [MailController::class, 'index'])->name('inbox');
    Route::get('/email/compose', [MailController::class, 'compose'])->name('compose');
    Route::post('/email/compose', [MailController::class, 'send'])->name('send.email');

    Route::get('/email/drafts', [MailController::class, 'drafts'])->name('drafts');
    Route::post('/email/drafts/{id}', [MailController::class, 'draftSent'])->name('drafts.sent');
    Route::get('/email/edit/{id}', [MailController::class, 'edit'])->name('drafts.edit');
    Route::post('/email/edit/{id}', [MailController::class, 'edit'])->name('drafts.update');
    Route::delete('/email/delete/{id}', [MailController::class, 'removeEmail'])->name('email.remove');
    Route::get('/email/sent', [MailController::class, 'sent'])->name('sent');
});
