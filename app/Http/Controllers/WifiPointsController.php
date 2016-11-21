<?php

namespace App\Http\Controllers;

use App\WifiPoint;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class WifiPointsController extends Controller
{
    private $rules_store = [
        'ssid' => 'required',
    ];

    private $rules_update = [
        'ssid' => '',
    ];

    private $wifi_point;

    public function __construct(WifiPoint $wifi_point)
    {
        $this->wifi_point = $wifi_point;
    }

    public function index()
    {
        return response()->json($this->wifi_point->all());
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules_store);
        $this->wifi_point->create($request->only(['block', 'level']));
        return response()->json(['created' => true], 201);
    }

    public function show($id)
    {
        try {
            return response()->json($this->wifi_point->findOrFail($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules_update);

        try {
            $wifi_point = $this->wifi_point->findOrFail($id);
            $wifi_point->update($request->only(['block', 'level']));
            return response()->json($wifi_point, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $wifi_point = $this->wifi_point->findOrFail($id);
            $wifi_point->delete();
            return response()->json([], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
