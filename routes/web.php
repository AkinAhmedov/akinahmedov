<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminMainController;

Route::get('/', [MainController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/search/category/{categoryId}', [MainController::class, 'searchCategory']);
Route::get('/search/tag/{tag}', [MainController::class, 'searchTag']);
Route::get('/search/date/{date_}', [MainController::class, 'searchDate']);
Route::get('/post/detail/{postId}', [MainController::class, 'postDetail']);
Route::post('/post/detail/{postId}', [MainController::class, 'postComment'])->name('postComment');
Route::post('/search/keyword', [MainController::class, 'searchKeyword']);
Route::post('/subscribe', [MainController::class, 'subscribe']);
Route::post('/contact', [ContactController::class, 'contact']);

Route::get('/downloadCV', [AboutController::class, 'downloadCV']);


Route::get('/admin/settings', [AdminMainController::class, 'getSettings']);
Route::post('/admin/settings', [AdminMainController::class, 'saveSettings']);

Route::get('/admin/posts', [AdminMainController::class, 'getPosts'])->name('adminPosts');
Route::get('/admin/addpost', [AdminMainController::class, 'getAddPost'])->name('adminAddPost');
Route::post('/admin/addpost', [AdminMainController::class, 'savePost'])->name('adminSavePost');
Route::post('/admin/remove/{id}', [AdminMainController::class, 'removePost']);

Route::get('/admin/edit/{id}', [AdminMainController::class, 'editPost']);

Route::get('/admin/getSubCatWithAjax', [AdminMainController::class, 'getSubCatWithAjax']);


Route::get('/admin/categories', [AdminMainController::class, 'getCategories'])->name('adminCats');
Route::post('/admin/categories', [AdminMainController::class, 'actionCats'])->name('adminActionCats');

Route::get('/admin/subcategories', [AdminMainController::class, 'getSubCategories'])->name('adminSubCats');
Route::post('/admin/subcategories', [AdminMainController::class, 'actionSubCats'])->name('adminActionSubCats');

Route::get('/admin/comments', [AdminMainController::class, 'getComments'])->name('adminComments');
Route::post('/admin/comment/remove/{id}', [AdminMainController::class, 'deleteComment'])->name('adminDeleteComment');


Route::get('/admin/subscribes', [AdminMainController::class, 'getSubscribes'])->name('adminSubscribes');
Route::post('/admin/subscribe/remove/{id}', [AdminMainController::class, 'deleteSubscribe'])->name('adminDeleteSubscribe');

Route::get('/admin/contacts', [AdminMainController::class, 'getContacts'])->name('adminContacts');
Route::post('/admin/contact/remove/{id}', [AdminMainController::class, 'deleteContact'])->name('adminDeleteContact');



Auth::routes();
Route::get('/admin', [AdminMainController::class, 'index'])->name('home');



Route::get('/optimize', function() {
    Artisan::call('optimize');

});
Route::get('/clear2', function() {
    Artisan::call('route:clear');
});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    echo "Cache temizlendi!";
});
