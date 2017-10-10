<?php


namespace App\Http\Controllers;


class UserManagerController extends Controller
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
        return view('user-manager');
    }
    
    public function editor($id)
    {
        return view('user-editor', ['id' => $id]);
    }
}
