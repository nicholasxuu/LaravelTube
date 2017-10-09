<?php


namespace App\Http\Controllers;


class CategoryManagerController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('category-manager');
    }

    public function editor($id)
    {
        return view('category-editor', ['id' => $id]);
    }
}