<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = DB::table('product')->select(DB::raw('count(ID) as properties_cnt, property_category as category, property_subcat as subcategory'))
                                        ->groupBy('property_category', 'property_subcat')
                                        ->orderBy('properties_cnt','desc')
                                        ->get();
        return view('home', ['categories' => $category]);
    }
}
