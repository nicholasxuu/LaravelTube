<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/10
 * Time: 11:44
 */

namespace App\Http\Controllers;


class VideoManagerController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'user.level:100']);
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        return view('video-manager');
    }
}