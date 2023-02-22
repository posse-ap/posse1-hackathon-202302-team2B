<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homeController extends Controller
{
    /**
     * 一覧ページ
     */
    public function index()
    {
        return view('admin.index');
    }
}
