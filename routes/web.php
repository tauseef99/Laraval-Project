<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\AuthenticatedSessionController;

use Illuminate\Http\Request;
use App\Http\Controller\uploadImageController;
use App\Http\Controllers\ImageController;
// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
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
    $users = DB::table('users')->get();
    return view('signIn', ['users' => $users]);
});
// Route::get('/home', function () {
//     return view('home');
// });
Route::get('/create', function () {
    // $users = DB::table('users')->get();
    return view('UserEntry');
});
Route::get('/signIn', function () {
    return view('signIn');
});
Route::post('/', [ImageController::class, 'index']);

Route::post('/user/login', [ImageController::class, 'store']);

// Route::post('/user/login', function (Request $request) {
    // $image = $request->image ?? '';

    // DB::table('users')->insert(
    //     [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'image' => $image,
    //     ],);
    // return redirect("/");
// });
Route::post('/user/delete' ,  function (Request $request) {
    DB::table('users')->where('id', $request->userid)->delete();
    $users = DB::table('users')->get();
    return redirect("/user");
});

// Route to show the update form
Route::get('/user/update/{id}', function ($id) {
    $user = DB::table('users')->where('id', $id)->first();
    return view('update_user', ['user' => $user]);
});

// Route to handle the update request
Route::post('/user/update', function (Request $request) {
    DB::table('users')->where('id', $request->id)->update(
        [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]
    );
    return redirect("/user");
});

// Route to handle the sign-up request

Route::post('/user/signIn', function (Request $request) {
    $existingUser = DB::table('users')
        ->where('name', $request->username)
        ->where('email', $request->email)
        ->where('password', $request->password)
        ->first();

    if ($existingUser) {
        session(['username' => $existingUser->name, 'userType' => $existingUser->type]);
        return redirect('/user')->with('success', 'Login successful!');
    } else {
        return redirect('/signIn')->with('error', 'User does not exist. Please create a user.');
    }
});


Route::get('/user', function () {
    $users = DB::table('users')->get();
    return view('user', ['users' => $users]);
});

Route::get('/adminDashboard', function () {
    return view('adminDashboard');
});


// logout session here
Route::get('/logout', function () {
    session()->forget('username');
    return redirect('/signIn'); 
});

// Route::post('signIn', [AuthenticatedSessionController::class, 'customLogin']);


/**General user routes **/
Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'generalUserDashboard'])->name('dashboard');

/**Admin routes **/
Route::middleware('adminAuth')->prefix('admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('adminDashboardShow');
});

/**Super Admin routes **/
Route::middleware('superAdminAuth')->prefix('superAdmin')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'superAdminDashboard'])->name('superAdminDashboardShow');
});