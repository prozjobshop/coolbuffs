<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
 public function index()
 {
    return view('packages');
 }



}
