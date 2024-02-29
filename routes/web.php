<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);
Route::get('/', function () {
        return (auth()->check()) ?  redirect()->route('home') : view('auth/login');
});
Route::get('/dec/{id}', function ($id) {
       echo myDecrypt($id);
});

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['namespace' => 'App\Http\Controllers'], function(){
        // get file
        Route::get('loginasuser/{id}', 'Auth\LoginController@loginAs')->name('loginAs');
        Route::get('/getfile/{sub}/{sub1?}/{sub2?}{sub3?}', 'App\Http\Controllers\FileAccessController@serve')->name('getfile');

        Route::get('/swtich-lang/{lang}', 'LanguageController@switchLang')->name('language.change');
        Route::get('/greeting/create-en', [App\Http\Controllers\LanguageController::class, 'createGreeting'])->name('language.greeting_create_en');
        Route::post('/greeting/save/en', [App\Http\Controllers\LanguageController::class, 'greetingEn'])->name('language.greeting_en');
        Route::get('/greeting/kh', [App\Http\Controllers\LanguageController::class, 'greetingKh'])->name('language.greeting_kh');
        Route::post('/greeting/kh/save', [App\Http\Controllers\LanguageController::class, 'greetingkhSave'])->name('language.greeting_kh_save');


        Route::group(['middleware' => ['auth', 'checkrole']], function(){

                Route::get('/home', 'DashboardController@home')->name('home');

                //Trainner
                Route::get('/trainner', 'TrainnerController@index')->name('trainner.index');
                Route::get('/trainner/data', 'TrainnerController@data')->name('trainner.data');
                Route::post('/trainner/save', 'TrainnerController@save')->name('trainner.save');
                Route::get('/trainner/edit', 'TrainnerController@edit')->name('trainner.edit');
                Route::get('/trainner/deatil', 'TrainnerController@deatil')->name('trainner.deatil');
                Route::post('/trainner/update', 'TrainnerController@update')->name('trainner.update');
                Route::post('/trainner/hidden', 'TrainnerController@hidden')->name('trainner.hidden');
                Route::post('/trainner/show', 'TrainnerController@show')->name('trainner.show');
                Route::delete('/trainner/trush', 'TrainnerController@trush')->name('trainner.trush');
                Route::post('/trainner/restore', 'TrainnerController@restore')->name('trainner.restore');
                Route::delete('/trainner/delete', 'TrainnerController@delete')->name('trainner.delete');

                 //Video
                Route::get('/video', 'CourseVideoController@index')->name('video.index');
                Route::get('/video/data', 'CourseVideoController@data')->name('video.data');
                Route::post('/video/save', 'CourseVideoController@save')->name('video.save');
                Route::get('/video/edit', 'CourseVideoController@edit')->name('video.edit');
                Route::get('/video/deatil', 'CourseVideoController@deatil')->name('video.deatil');
                Route::post('/video/update', 'CourseVideoController@update')->name('video.update');
                Route::post('/video/hidden', 'CourseVideoController@hidden')->name('video.hidden');
                Route::post('/video/show', 'CourseVideoController@show')->name('video.show');
                Route::delete('/video/trush', 'CourseVideoController@trush')->name('video.trush');
                Route::post('/video/restore', 'CourseVideoController@restore')->name('video.restore');
                Route::delete('/video/delete', 'CourseVideoController@delete')->name('video.delete');

                //Course
                Route::get('/course/list', 'CourseController@index')->name('course.index');
                Route::get('/course/data', 'CourseController@data')->name('course.data');
                Route::get('/course/deatils/{details_id?}', 'CourseController@details')->name('course.details');
                Route::get('/course/get_video_details/{details_id?}', 'CourseController@getVideoData')->name('course.get_video_details');
                Route::post('/course/save', 'CourseController@save')->name('course.save');
                Route::get('/course/edit', 'CourseController@edit')->name('course.edit');
                Route::post('/course/update', 'CourseController@update')->name('course.update');
                Route::post('/course/hidden', 'CourseController@hidden')->name('course.hidden');
                Route::post('/course/show', 'CourseController@show')->name('course.show');
                Route::delete('/course/trush', 'CourseController@trush')->name('course.trush');
                Route::post('/course/restore', 'CourseController@restore')->name('course.restore');
                Route::delete('/course/delete', 'CourseController@delete')->name('course.delete');


                Route::group(['prefix'=>'setting', 'as' => 'setting.'], function(){
                    Route::get('/', function(){
                            return view('settings.index');
                    })->name('settings');

                    //course category
                    Route::get('/course-category-list', 'Setting\CourseCategoryController@index')->name('course_category.index');
                    Route::get('/course-category-list/data', 'Setting\CourseCategoryController@data')->name('course_category.data');
                    Route::post('/course-category/save', 'Setting\CourseCategoryController@save')->name('course_category.save');
                    Route::get('/course-category/edit', 'Setting\CourseCategoryController@edit')->name('course_category.edit');
                    Route::post('/course-category/update', 'Setting\CourseCategoryController@update')->name('course_category.update');
                    Route::post('/course-category/hidden', 'Setting\CourseCategoryController@hidden')->name('course_category.hidden');
                    Route::post('/course-category/show', 'Setting\CourseCategoryController@show')->name('course_category.show');
                    Route::delete('/course-category/trush', 'Setting\CourseCategoryController@trush')->name('course_category.trush');
                    Route::post('/course-category/restore', 'Setting\CourseCategoryController@restore')->name('course_category.restore');
                    Route::delete('/course-category/delete', 'Setting\CourseCategoryController@delete')->name('course_category.delete');

                    // group
                    Route::get('/group-list', 'Setting\GroupController@index')->name('group.index');
                    Route::post('/group/save', 'Setting\GroupController@save')->name('group.save');
                    Route::get('/group/edit', 'Setting\GroupController@edit')->name('group.edit');
                    Route::post('/group/update', 'Setting\GroupController@update')->name('group.update');
                    Route::post('/group/delete', 'Setting\GroupController@delete')->name('group.delete');

                        // user
                    Route::get('/user', 'Setting\UserController@index')->name('user.index');
                    Route::post('/user/save', 'Setting\UserController@save')->name('user.save');
                    Route::get('/user/edit', 'Setting\UserController@edit')->name('user.edit');
                    Route::post('/user/update', 'Setting\UserController@update')->name('user.update');
                    Route::post('/user/delete', 'Setting\UserController@delete')->name('user.delete');

                    Route::get('/user-fc-branch-by/{id}', 'Setting\UserFactoryBranchController@index')->name('user_factory_branch.index');
                    Route::post('/user-fc-branch/save', 'Setting\UserFactoryBranchController@save')->name('user_factory_branch.save');
                    Route::get('/user-fc-branch/edit', 'Setting\UserFactoryBranchController@edit')->name('user_factory_branch.edit');
                    Route::post('/user-fc-branch/update', 'Setting\UserFactoryBranchController@update')->name('user_factory_branch.update');
                    Route::post('/user-fc-branch/delete', 'Setting\UserFactoryBranchController@delete')->name('user_factory_branch.delete');
                });

                // system settings
                Route::group(['prefix'=>'settings', 'as' => 'setting.'], function(){
                        //// system
                        Route::get('/system', 'Setting\SystemController@index')->name('system.index');
                        Route::post('/system/save', 'Setting\SystemController@save')->name('system.save');
                        Route::get('/system/edit', 'Setting\SystemController@edit')->name('system.edit');
                        Route::post('/system/update', 'Setting\SystemController@update')->name('system.update');
                        Route::post('/system/delete', 'Setting\SystemController@delete')->name('system.delete');
                        // system-module
                        Route::get('/system-module', 'Setting\SystemModuleController@index')->name('system_module.index');
                        Route::get('/system-module', 'Setting\SystemModuleController@index')->name('system_module.index');
                        Route::post('/system-module/save', 'Setting\SystemModuleController@save')->name('system_module.save');
                        Route::get('/system-module-edit', 'Setting\SystemModuleController@edit')->name('system_module.edit');
                        Route::post('/system-module/update', 'Setting\SystemModuleController@update')->name('system_module.update');
                        Route::post('/system-module/delete', 'Setting\SystemModuleController@delete')->name('system_module.delete');
                        // system-feature
                        Route::get('/system-feature/{id}', 'Setting\SystemFeatureController@index')->name('system_feature.index');
                        Route::post('/system-feature/save', 'Setting\SystemFeatureController@save')->name('system_feature.save');
                        Route::get('/system-feature-edit', 'Setting\SystemFeatureController@edit')->name('system_feature.edit');
                        Route::post('/system-feature/update', 'Setting\SystemFeatureController@update')->name('system_feature.update');
                        Route::post('/system-feature/delete', 'Setting\SystemFeatureController@delete')->name('system_feature.delete');
                        // system-feature-link
                        Route::get('/system-feature-link/{id}', 'Setting\FeatureLinkController@index')->name('feature_link.index');
                        Route::post('/system-feature-link/save', 'Setting\FeatureLinkController@save')->name('feature_link.save');
                        Route::get('/system-feature-link-edit', 'Setting\FeatureLinkController@edit')->name('feature_link.edit');
                        Route::post('/system-feature-link/update', 'Setting\FeatureLinkController@update')->name('feature_link.update');
                        Route::post('/system-feature-link/delete', 'Setting\FeatureLinkController@delete')->name('feature_link.delete');
                        // Role
                        Route::get('/role', 'Setting\RoleController@index')->name('role.index');
                        Route::post('/role/save', 'Setting\RoleController@save')->name('role.save');
                        Route::get('/role-edit', 'Setting\RoleController@edit')->name('role.edit');
                        Route::post('/role/update', 'Setting\RoleController@update')->name('role.update');
                        Route::post('/role/delete', 'Setting\RoleController@delete')->name('role.delete');
                        // role permission
                        Route::get('/role-permission/{id}', 'Setting\RoleController@permission')->name('role_permission.index');
                        Route::post('/role-permission/save', 'Setting\RoleController@savePermission')->name('role_permission.save');
                });

        });


        Route::group(['prefix' => 'mobile'], function(){
                Route::get('/resume/{id}', 'MobileScreenController@resume');
        });


});


