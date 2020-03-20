<?php

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

Auth::routes([
    'register' => false,
    'verify' => false,
    'reset' => false
  ]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'UserController@index');

    Route::resource('faculties', 'FacultyController');
    Route::put('/faculties/{id}/restore', 'FacultyController@restore')->name('faculties.restore');

    Route::resource('departments', 'DepartmentController');
    Route::put('/departments/{id}/restore', 'DepartmentController@restore')->name('departments.restore');

    Route::resource('users', 'UserController');
    Route::put('/users/{id}/restore', 'UserController@restore')->name('users.restore');
    Route::get('/users/{id}/restore', 'UserController@confirm_restore')->name('users.restore');

    Route::resource('courses', 'CourseController');
    Route::put('/courses/{id}/restore', 'CourseController@restore')->name('courses.restore');

    Route::resource('roles', 'RoleController');

    Route::get('/user_roles/{user}/create', 'UserRoleController@create')->name('user_roles.create');
    Route::post('/user_roles/{user}', 'UserRoleController@store')->name('user_roles.store');
    Route::delete('/user_roles/{user}/{role}', 'UserRoleController@destroy')->name('user_roles.destroy');

    Route::get('/identities/{identity}/edit', 'IdentityController@edit')->name('identities.edit');
    Route::put('/identities/{identity}', 'IdentityController@update')->name('identities.update');

    Route::get('/student_courses/{user}/create', 'StudentCourseController@create')
        ->name('student_courses.create');
    Route::post('/student_courses/{user}', 'StudentCourseController@store')
        ->name('student_courses.store');
    Route::delete('/student_courses/{student_course}', 'StudentCourseController@destroy')
        ->name('student_courses.destroy');
});
