<?php

Route::post('filter-default-cities-dropdown', 'AjaxController@filterDefaultCities')->name('filter.default.cities.dropdown');
Route::post('filter-default-cities-dropdown-job', 'AjaxController@filterDefaultCitiesJob')->name('filter.default.cities.dropdown.job');
Route::post('filter-default-states-dropdown', 'AjaxController@filterDefaultStates')->name('filter.default.states.dropdown');
Route::post('filter-default-states-dropdown-job', 'AjaxController@filterDefaultStatesJob')->name('filter.default.states.dropdown.job');
Route::post('filter-lang-cities-dropdown', 'AjaxController@filterLangCities')->name('filter.lang.cities.dropdown');
Route::post('filter-lang-cities-dropdown-job', 'AjaxController@filterLangCitiesJob')->name('filter.lang.cities.dropdown.job');
Route::post('filter-lang-cities-dropdown-job-ad', 'AjaxController@filterLangCitiesJobAd')->name('filter.lang.cities.dropdown.job.ad');
Route::post('filter-lang-states-dropdown', 'AjaxController@filterLangStates')->name('filter.lang.states.dropdown');
Route::post('filter-lang-states-dropdown-job', 'AjaxController@filterLangStatesJob')->name('filter.lang.states.dropdown.job');
Route::post('filter-lang-states-dropdown-job-ad', 'AjaxController@filterLangStatesJobAd')->name('filter.lang.states.dropdown.job.ad');
Route::post('filter-cities-dropdown', 'AjaxController@filterCities')->name('filter.cities.dropdown');
Route::post('filter-states-dropdown', 'AjaxController@filterStates')->name('filter.states.dropdown');
Route::post('filter-degree-types-dropdown', 'AjaxController@filterDegreeTypes')->name('filter.degree.types.dropdown');
Route::get('filter-job-title/{q?}','AjaxController@filterJobTitle')->name('filter.job.title');
Route::get('filter-company-name/{q?}','AjaxController@filterCompanyName')->name('filter.company.name');
Route::get('filter-user-name/{q?}','AjaxController@filterUserName')->name('filter.user.name');
Route::get('filter-functional/{q?}','AjaxController@filterFunctionalArea')->name('filter.functional');
Route::post('filter-default-subject-dropdown-job', 'AjaxController@filterDefaultSubjectJob')->name('filter.default.subject.dropdown.job');
Route::post('filter-default-subject-dropdown-job-profile', 'AjaxController@filterDefaultSubjectJobProfile')->name('filter.default.subject.dropdown.job.profile');