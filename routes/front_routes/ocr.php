<?php


Route::get('resume-ocr', 'OCRController@ResumeOCR')->name('resume-ocr');
Route::post('resume-ocr', 'OCRController@ResumeOCRPost')->name('resume-ocr-post');
Route::post('resume-ocr-update', 'OCRController@ResumeOCRUpdate')->name('resume-ocr-update');