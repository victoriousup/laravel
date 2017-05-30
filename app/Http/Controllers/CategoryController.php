<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Paginator;
use Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->isMethod('POST'))
        {
            $request->flash();
            $sort = $request->input('price');
            $category = $request->input('category');
            $categories = DB::table('product')->select('property_rating','property_id','plan_id', 'property_name','price_per_night','property_sku', 'address_city','property_lat','property_long','property_category','property_subcat')
                                            ->whereRaw('property_category like "%'.$category.'%"')
                                            ->orderBy('price_per_night',$sort)
                                            ->paginate(15);
            $countries = DB::table('product')->select('property_category')
                                            ->groupBy('property_category')
                                            ->get();

            // dd($categories[0]);
            return view('category', ['categories'=>$categories, 'countries'=>$countries,]);
            
        }
        else{
            $categories = DB::table('product')->select('property_rating','property_id','plan_id', 'property_name','price_per_night','property_sku', 'address_city','property_lat','property_long','property_category','property_subcat')
                                            ->orderBy('price_per_night','desc')
                                            ->paginate(15);

            $countries = DB::table('product')->select('property_category')
                                            ->groupBy('property_category')
                                            ->get();

            // dd($categories[0]);
            return view('category', ['categories'=>$categories, 'countries'=>$countries,]);
        }
    }

    /**
     * Show Detail Page
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request, $id)
    {
        //
        $category = DB::table('product')->where('plan_id',$id)->get();
        $unavailable_dates = json_decode($category[0]->unavailable_dates)->period;
        $rentals = DB::table('rental')->where('plan_id',$id)->get();
        $ret_rental = [];
        $checkin = array();
        $checkout = array();
        
        // $checkout = array();
        foreach ($rentals as $rt)
        {
            $day_prices = json_decode($rt->day_prices,true);
            $ret_rental = array_merge($ret_rental, $day_prices);
            if (json_decode($rt->checkin_out_dates)->checkin_only !=null) $checkin[] = json_decode($rt->checkin_out_dates)->checkin_only;
            if (json_decode($rt->checkin_out_dates)->checkout_only !=null) $checkout[] = json_decode($rt->checkin_out_dates)->checkout_only;
        }
        ksort($ret_rental);
        $category = $category[0];
        
        return view('detail',compact('category','ret_rental','checkin','checkout','unavailable_dates'));
    }


}
