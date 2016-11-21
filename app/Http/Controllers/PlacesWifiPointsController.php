<?php

namespace App\Http\Controllers;

use App\Place;
use App\WifiPoint;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PlacesWifiPointsController extends Controller
{
    protected $rules_store = [
        'bssid' => 'required',
    ];

    protected $rules_update = [
        'ssid' => '',
    ];

    private $place;
    private $wifi_point;

    public function __construct(Place $place, WifiPoint $wifi_point)
    {
        $this->place = $place;
        $this->wifi_point = $wifi_point;
    }

    public function index($place_id)
    {
        try {
            return response()->json($this->place->with('wifiPoints')->findOrFail($place_id)->wifiPoints);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function store(Request $request, $place_id)
    {
        $this->validate($request, $this->rules_store);

        try {
            $place = $this->place->findOrFail($place_id);
            $wifi_point = $this->wifi_point->create($request->input());
            $place->wifiPoints()->attach($wifi_point);
            return response()->json(['created' => true], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function show($place_id, $wifi_point_id)
    {
        try {
            $place = $this->place->findOrFail($place_id);
            return response()->json($place->wifiPoints()->findOrFail($wifi_point_id));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $place_id, $wifi_point_id)
    {
        $this->validate($request, $this->rules_update);

        try {
            $place = $this->place->findOrFail($place_id);
            $wifi_point = $place->wifiPoints()->findOrFail($wifi_point_id);
            $wifi_point->update($request->input());
            return response()->json($wifi_point, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function destroy($place_id, $wifi_point_id)
    {
        try {
            $place = $this->place->findOrFail($place_id);
            $wifi_point = $place->wifiPoints()->findOrFail($wifi_point_id);
            $wifi_point->delete();
            return response()->json([], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
