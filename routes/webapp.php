<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\webapp\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\webapp\RegistrationController;
use App\Http\Controllers\webapp\NewsletterController;
/*
|--------------------------------------------------------------------------
| Public Coach Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('/',[PageController::class,'index'])->name('webapp.home');
Route::get('/about-us',[PageController::class,'aboutUs'])->name('webapp.about-us');
Route::get('/blogs',[PageController::class,'blogs'])->name('webapp.blogs');
Route::get('/blog/{slug}',[PageController::class,'blogDetail'])->name('blog-detail');
// Route::get('/contact',[PageController::class,'contact'])->name('webapp.contact');
Route::get('/rank',[PageController::class,'rank'])->name('webapp.rank');
Route::post('/coach-registration',[RegistrationController::class,'coachRegistration'])->name('webapp.coach-registration');
Route::post('/seeker-registration',[RegistrationController::class,'seekerRegistration'])->name('webapp.seeker-registration');
Route::get('/find-coach',[PageController::class,'findCoach'])->name('webapp.find-coach');
Route::get('/view-profile/{id}',[PageController::class,'viewProfile'])->name('view-profile');
Route::get('/search-coaches',[PageController::class,'searchCoaches'])->name('webapp.searchCoaches');
Route::post('/subscribe-newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [PageController::class, 'termsAndConditions'])->name('terms-and-conditions');
Route::get('/sitemap.xml', [PageController::class, 'sitemap']);
// Frontend Routes
Route::get('/contact-us', [ContactController::class, 'index'])->name('webapp.contact');
Route::post('/contact-inquiry', [ContactController::class, 'storeInquiry'])->name('contact.inquiry.store');
