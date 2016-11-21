<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PlacesController extends Controller
{
    private $rules_store = [
        'block' => 'required',
        'level' => 'required',
    ];

    private $rules_update = [
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
}
