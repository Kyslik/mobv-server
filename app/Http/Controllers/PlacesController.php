<?php

namespace App\Http\Controllers;

use App\Place;
use App\WifiPoint;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    protected $rules_store = [
        'block' => 'required',
        'level' => 'required',
    ];

    protected $rules_update = [
        'block' => '',
        'level' => '',
    ];

    private $place;

    public function __construct(Place $place)
    {
        $this->place = $place;
    }

    public function index()
    {
        return response()->json($this->place->all());
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules_store);
        $this->place->create($request->input());
        return response()->json(['created' => true], 201);
    }

    public function show($id)
    {
        try {
            return response()->json($this->place->findOrFail($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules_update);

        try {
            $place = $this->place->findOrFail($id);
            $place->update($request->input());
            return response()->json($place, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $place = $this->place->findOrFail($id);
            $place->delete();
            return response()->json([], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function sync(Request $request, WifiPoint $wifi_point, $id)
    {
        try {
            $place = $this->place->findOrFail($id);
            $wifi_points = $wifi_point->findMany($request->input());
            $place->wifiPoints()->sync($wifi_points->pluck('id')->toArray());
            return response()->json($place->load('wifiPoints'), 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
