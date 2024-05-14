<?php

/* * ******  Package Start ********** */
Route::get('list-packages', array_merge(['uses' => 'Admin\PackageController@indexPackages'], $all_users))->name('list.packages');
Route::get('create-package', array_merge(['uses' => 'Admin\PackageController@createPackage'], $all_users))->name('create.package');
Route::post('store-package', array_merge(['uses' => 'Admin\PackageController@storePackage'], $all_users))->name('store.package');
Route::get('edit-package/{id}', array_merge(['uses' => 'Admin\PackageController@editPackage'], $all_users))->name('edit.package');
Route::put('update-package/{id}', array_merge(['uses' => 'Admin\PackageController@updatePackage'], $all_users))->name('update.package');
Route::delete('delete-package', array_merge(['uses' => 'Admin\PackageController@deletePackage'], $all_users))->name('delete.package');
Route::get('fetch-packages', array_merge(['uses' => 'Admin\PackageController@fetchPackagesData'], $all_users))->name('fetch.data.packages');
Route::get('list-payment-historys', array_merge(['uses' => 'Admin\PackageController@indexUserHistory']))->name('list.payment.historys');
Route::get('fetch-payment-historys', array_merge(['uses' => 'Admin\PackageController@fetchUserHistory'], $all_users))->name('fetch.data.usersHistory');
/* * ****** End Package ********** */