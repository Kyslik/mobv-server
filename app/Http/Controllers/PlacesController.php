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
    /**
     * @apiDefine PlaceNotFoundError
     *
     * @apiError PlaceNotFound The id of the Place was not found.
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "No query results for model [App\\Place] :id"
     *     }
     */

    /**
     * @api {get} /places List data of a Places
     * @apiVersion 0.0.1
     * @apiName GetPlaces
     * @apiGroup Places
     * @apiPermission none
     *
     * @apiDescription Get all Places
     *
     * @apiExample Example usage:
     * curl -i http://localhost/api/v1/places
     *
     * @apiSuccess {Object[]} places    List of places.
     * @apiSuccessExample {json} Success-Response (empty database):
     *      HTTP/1.1 200 OK
     *      []
     *
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *      [
     *          {
     *              "id": 1,
     *              "block": "A",
     *              "level": 3,
     *              "created_at": "2016-11-21 10:42:15",
     *              "updated_at": "2016-11-21 11:59:02"
     *          },
     *          {
     *              "id": 2,
     *              "block": "A",
     *              "level": 5,
     *              "created_at": "2016-11-21 11:58:19",
     *              "updated_at": "2016-11-21 11:59:19"
     *          }
     *      ]
     *
     */
    public function index()
    {
        return response()->json($this->place->all());
    }

    /**
     * @api {post} /places Create a new Place
     * @apiVersion 0.0.1
     * @apiName PostPlace
     * @apiGroup Places
     * @apiPermission none
     *
     * @apiParam {String}   block         Block (A-E;T).
     * @apiParam {Number}   level         Level (floor).
     *
     * @apiSuccess {Boolean}   created
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 201 Created
     *     {
     *       "created": true
     *     }
     *
     * @apiError (Error 422) {String} block The block field is required.
     * @apiError (Error 422) {Number} level The level field is required.
     *
     * @apiErrorExample {json} Error-response:
     *     HTTP/1.1 422 Unprocessable Entity
     *     {
     *       "block": ["The block field is required."],
     *       "level": ["The level field is required."]
     *     }
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules_store);
        $this->place->create($request->input());
        return response()->json(['created' => true], 201);
    }

    /**
     * @api {get} /places/:id Read data of a Place
     * @apiVersion 0.0.1
     * @apiName GetPlace
     * @apiGroup Places
     * @apiPermission none
     *
     * @apiDescription Get certain Place by ID
     *
     *
     * @apiExample Example usage:
     * curl -i http://localhost/api/v1/places/1
     *
     * @apiSuccess {String}   block         Block (A-E;T).
     * @apiSuccess {Integer}  level         Level (floor).
     * @apiSuccess {Date}     created_at    Creation Date.
     * @apiSuccess {Date}     updated_at    Latest update Date.
     *
     * @apiUse PlaceNotFoundError
     */
    public function show($id)
    {
        try {
            return response()->json($this->place->findOrFail($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @api {patch} /places/:id Change a Place
     * @apiVersion 0.0.1
     * @apiName PatchPlace
     * @apiGroup Places
     * @apiPermission none
     *
     * @apiDescription Nothing yet
     *
     * @apiParam {String}   [block]         Block (A-E;T).
     * @apiParam {Integer}   [level]         Level (floor).
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *          "block": "D",
     *          "level": "6"
     *      }
     *
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *      {
     *          "id": 1,
     *          "block": "D",
     *          "level": "6",
     *          "created_at": "2016-11-21 14:14:44",
     *          "updated_at": "2016-11-21 20:41:49"
     *      }
     * @apiUse PlaceNotFoundError
     */
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

    /**
     * @api {delete} /places/:id Delete a Place
     * @apiVersion 0.0.1
     * @apiName DeletePlace
     * @apiGroup Places
     * @apiPermission none
     *
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No content
     *
     * @apiUse PlaceNotFoundError
     */
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

    /**
     * @api {post} /places/:id/sync Sync Place with WifiPoints
     * @apiVersion 0.0.1
     * @apiName SyncPlaceWithWifiPoints
     * @apiGroup Places
     * @apiPermission none
     *
     * @apiDescription API checks for all posted IDs and syncs only those that exist.
     *
     * @apiParamExample {json} Request-Example:
     *      [1,2,3]
     *
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *      {
     *          "id": 1,
     *          "block": "A",
     *          "level": 1,
     *          "created_at": "2016-11-21 13:16:26",
     *          "updated_at": "2016-11-21 13:16:26",
     *          "wifi_points": [
     *              {
     *                  "id": 1,
     *                  "bssid": "00:40:08:99:3f:22",
     *                  "ssid": null,
     *                  "capabilities": null,
     *                  "level": null,
     *                  "frequency": null,
     *                  "timestamp": null,
     *                  "created_at": "2016-11-21 14:14:44",
     *                  "updated_at": "2016-11-21 14:14:44",
     *                  "pivot": {
     *                      "place_id": 1,
     *                      "wifi_point_id": 10,
     *                      "created_at": "2016-11-21 20:58:24",
     *                      "updated_at": "2016-11-21 20:58:24"
     *              },
     *              {
     *                  "id": 2,
     *                  .
     *                  .
     *              }
     *          ]
     *      }
     *
     * @apiUse PlaceNotFoundError
     */
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
