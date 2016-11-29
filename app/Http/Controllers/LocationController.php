<?php

namespace App\Http\Controllers;

use App\AccessPoint;
use App\Location;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    protected $rules_store = [
        'block' => 'required',
        'level' => 'required',
    ];

    protected $rules_update = [
        'block' => '',
        'level' => '',
    ];

    private $location;

    private $limit = 5;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }
    /**
     * @apiDefine LocationNotFoundError
     *
     * @apiError LocationNotFound The id of the Place was not found.
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "Location not found."
     *     }
     */

    /**
     * @api {get} /locations List data of a Locations
     * @apiVersion 0.0.2
     * @apiName GetLocations
     * @apiGroup Locations
     * @apiPermission none
     *
     * @apiDescription Get all Locations
     *
     * @apiExample Example usage:
     * curl -i http://localhost/api/v1/locations
     *
     * @apiSuccess {Object[]} places    List of locations.
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
     *          },
     *          {
     *              "id": 2,
     *              "block": "A",
     *              "level": 5,
     *          }
     *      ]
     *
     */
    public function index()
    {
        return response()->json($this->location->all());
    }

    /**
     * @api {get} /locations/:id Read data of a Location
     * @apiVersion 0.0.2
     * @apiName GetLocation
     * @apiGroup Locations
     * @apiPermission none
     *
     * @apiDescription Get certain Location by ID
     *
     *
     * @apiExample Example usage:
     * curl -i http://localhost/api/v1/locations/1
     *
     * @apiSuccess {String}   block         Block (A-E;T).
     * @apiSuccess {Integer}  level         Level (floor).
     * @apiSuccess {Date}     created_at    Creation Date.
     * @apiSuccess {Date}     updated_at    Latest update Date.
     *
     * @apiUse LocationNotFoundError
     */
    public function show($id)
    {
        try {
            return response()->json($this->location->with('accessPoints')->findOrFail($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function find(Request $request)
    {
        if (!$request->isJson()) {
            return response()->json(['error' => 'Unsupported Media Type'], 415);
        }

        try {
            $access_points = AccessPoint::findByBssids($request->input('bssids'))
                ->get();

            $sorted_by_access_points_count = $access_points->groupBy('location.id')->sortByDesc(function ($accessPoints) {
                return $accessPoints->count();
            });

            $suggestions_temp = [];
            foreach ($sorted_by_access_points_count as $id => $location) {
                $suggestions_temp[$id] = $location->count();
            }
            $location_ids = array_keys($suggestions_temp);
            $locations = Location::with([
                'accessPoints' => function($query){
                    $query->select(['id', 'ssid', 'bssid', 'location_id']);
                }
            ])
                ->whereIn('id', $location_ids)->limit($this->limit)->get();

            $suggestions = [];
            foreach ($locations as $location) {
                $suggestions[] = [
                    'location' => $location,
                    'match_count' => $suggestions_temp[$location->id]
                ];
            }
            $suggestions = collect($suggestions)
                ->sortByDesc(function($suggestion){
                    return $suggestion['match_count'];
                })->values();

            return response()->json(
                ['suggestions' => $suggestions
                ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
