<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use App\WifiPoint;
use Carbon;
use Illuminate\Http\Request;

class WifiPointsController extends Controller
{

    public function manageVue()
    {
//        dd(WifiPoint::all()->toArray());
        return view('manage-vue');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = WifiPoint::latest()->paginate(5);

        $response = [
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
            'data' => $items
        ];

        return response()->json($response);
    }

}
