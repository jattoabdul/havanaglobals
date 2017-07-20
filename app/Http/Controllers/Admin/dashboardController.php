<?php

/**
 * Created by PhpStorm.
 * User: mage
 * Date: 11/07/2017
 * Time: 12:46 PM
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class dashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}