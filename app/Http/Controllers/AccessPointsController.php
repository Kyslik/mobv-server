<?php

namespace App\Http\Controllers;

use App\AccessPoint;
use App\Exceptions\InvalidJsonException;
use Illuminate\Http\Request;

class AccessPointsController extends Controller
{
    protected $rules = [
        'location_id' => 'required|exists:locations,id',
        'device_id' => 'required',
        'bssid' => 'required|size:17',
    ];

    private $access_point;
    private $location_id;
    private $json;

    public function __construct(AccessPoint $access_point)
    {
        $this->access_point = $access_point;
        $this->location_id = null;
        $this->json = null;
    }

    /**
     * @apiDefine AccessPointNotFoundError
     *
     * @apiError AccessPointNotFound The id of the AccessPoint was not found.
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "No query results for model [App\\AccessPoint] :id"
     *     }
     */

    /**
     * @apiDefine AccessPointApiParams
     * @apiParam {String}   bssid           MAC address.
     * @apiParam {integer}  device_id       Unique device id.
     * @apiParam {String}   [ssid]          Name of Wi-Fi.
     * @apiParam {String}   [capabilities]  Capabilities of WiFi.
     * @apiParam {Integer}  [level]         Level.
     * @apiParam {Integer}  [frequency]     Frequency.
     * @apiParam {Integer}  [timestamp]     Timestamp.
     */

    /**
     * @api {get} /locations/:location_id/access-points List all access-points for location (:location_id)
     * @apiVersion 0.0.2
     * @apiName GetAccessPoints
     * @apiGroup AccessPoints
     *
     * @apiDescription Get all access-points for location (:location_id)
     *
     * @apiExample Example usage:
     * curl -i http://localhost/api/v1/locations/:location_id/access-points
     *
     * @apiSuccess {Array[json]} access_points List of wifi-points.
     * @apiSuccessExample {json} Success-Response (empty database):
     *      HTTP/1.1 200 OK
     *      []
     *
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *      [
     *          {
     *              "id": 1,
     *              "location_id": :location_id,
     *              "device_id": 1,
     *              "bssid": "0e:41:08:99:3f:22",
     *              "ssid": "Eduroam",
     *              "capabilities": "[WPA-EAP]",
     *              "level": -10,
     *              "frequency": 5426,
     *              "timestamp": "52369854752",
     *              "created_at": "2016-11-21 10:42:15",
     *              "updated_at": "2016-11-21 11:59:02"
     *          },
     *          {
     *              "id": 2,
     *              "location_id": :location_id
     *              "device_id": 1,
     *              "bssid": "0e:41:08:32:6f:22",
     *              "ssid": "Eduroam EXTENDED",
     *              "capabilities": "[WEP]",
     *              "level": -70,
     *              "frequency": 4589,
     *              "timestamp": "569352458152",
     *              "created_at": "2016-11-21 11:58:19",
     *              "updated_at": "2016-11-21 11:59:19"
     *          }
     *      ]
     *
     */
    public function index($location_id)
    {
        return response()->json($this->access_point->locationId($location_id)->get(), 200);
    }

    /**
     * @api {get} /locations/:location_id/access-points/:id Read data of a AccessPoint
     * @apiVersion 0.0.2
     * @apiName GetAccessPoint
     * @apiGroup AccessPoints
     * @apiPermission none
     *
     * @apiDescription Get certain AccessPoint by ID
     *
     *
     * @apiExample Example usage:
     * curl -i http://localhost/api/v1/location/:location_id/access-points/:id
     * @apiSuccess {Integer}  id
     * @apiSuccess {Integer}  location_id       Location id.
     * @apiSuccess {Integer}  device_id         Device id.
     * @apiSuccess {String}   bssid             MAC address.
     * @apiSuccess {String}   ssid              Name of Wi-Fi.
     * @apiSuccess {String}   capabilities      Capabilities of WiFi.
     * @apiSuccess {Integer}  level             Level.
     * @apiSuccess {Integer}  frequency         Frequency.
     * @apiSuccess {Integer}  timestamp         Timestamp.
     *
     * @apiUse AccessPointNotFoundError
     */
    public function show($location_id, $id)
    {
        return response()->json($this->access_point->locationId($location_id)->findOrFail($id));
    }

    /**
     * @api {post} /location/:location_id/access-points    Create new access-point(s).
     * @apiVersion 0.0.2
     * @apiName PostAccessPoint
     * @apiGroup AccessPoints
     *
     * @apiDescription Please see <a href="https://developer.android.com/reference/android/net/wifi/ScanResult.html">ScanResult Android MAN</a>, if AP for certain device_id exists it still returns created array.
     *
     * @apiUse AccessPointApiParams
     *
     * @apiParamExample {json} Request-Example (single):
     *   {
     *      "device_id": 1,
     *      "ssid": "Neo WiFi",
     *      "bssid": "11:40:05:A9:3f:28",
     *      "capabilities": "[BEND SPOON]",
     *      "level": -11,
     *      "frequency": 4589,
     *      "timestamp": "12319239148128"
     *  }
     *
     * @apiParamExample {json} Request-Example (array):
     *  [
     *      {
     *          "device_id": 1,
     *          "ssid": "Morpheus WiFi",
     *          "bssid": "0e:40:08:99:3f:22",
     *          "capabilities": "[WEAR-GLASSES]",
     *          "level": -50,
     *          "frequency": 4521,
     *          "timestamp": "12319239148128"
     *      },
     *      {
     *          "device_id": 1,
     *          "ssid": "Trinity WiFi",
     *          "bssid": "0d:40:08:99:3f:55",
     *          "capabilities": "[KICK-ASS]",
     *          "level": -11,
     *          "frequency": 2536,
     *          "timestamp": "56321524525663"
     *      }
     *  ]
     *
     * @apiSuccess {Array} created Array of created IDs
     *
     * @apiSuccessExample {json} Success-Response (single):
     *      HTTP/1.1 201 Created
     *      {
     *          "created": [
     *              1
     *          ]
     *      }
     *
     * @apiSuccessExample {json} Success-Response (array):
     *      HTTP/1.1 201 Created
     *      {
     *          "created": [
     *              2,
     *              3
     *          ]
     *      }
     *
     * @apiError (Error 415) {String} error  Unsupported Media Type.
     * @apiError (Error 422) {String} bssid  Bssid field is required.
     * @apiError (Error 422) {String} bssid  Bssid must be exactly 17 characters long.
     * @apiError (Error 422) {String} error  Invalid JSON.
     *
     * @apiErrorExample {json} Error-response:
     *     HTTP/1.1 422 Unprocessable Entity
     *     {
     *       "bssid": ["The bssid field is required."]
     *     }
     */
    public function store(Request $request, $location_id)
    {
        if (!$request->isJson()) {
            return response()->json(['error' => 'Unsupported Media Type'], 415);
        }
        $this->setJson($request->json()->all());
        $this->location($location_id)->validateStore($request, $this->rules);

        $created = [];
        foreach ($this->json as $access_point) {
            $ap = $this->access_point->findByBssidAndDeviceId($access_point['device_id'], $access_point['bssid']);
            if (is_null($ap)) {
                $ap = $this->access_point->create(array_merge($access_point,
                    ['location_id' => $this->location_id]));
            }

            array_push($created, $ap->id);
        }

        return response()->json(['created' => $created], 201);
    }

    /**
     * @api {delete} /locations/:location_id/access-points/:id Delete a AccessPoint
     * @apiVersion 0.0.2
     * @apiName DeleteAccessPoint
     * @apiGroup AccessPoints
     * @apiPermission none
     *
     *
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No content
     *
     * @apiUse AccessPointNotFoundError
     */
    public function destroy($location_id, $id)
    {
        $access_point = $this->access_point->locationId($location_id)->findOrFail($id);
        $access_point->delete();
        return response()->json([], 204);
    }

    private function setJson($json)
    {
        $this->validateJson($json);

        if (count($json) === count($json, COUNT_RECURSIVE)) {
            $json = [$json];
        }

        $this->json = $json;
    }

    private function validateJson($json)
    {
        if (empty($json)) {
            throw new InvalidJsonException();
        }
    }

    private function validateStore(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        foreach ($this->json as $key => $access_point) {
            $messages = $this->formMessages($key);
            $validator = $this->getValidationFactory()->make(array_merge($access_point,
                ['location_id' => $this->location_id]), $rules, $messages, $customAttributes);
            if ($validator->fails()) {
                $this->throwValidationException($request, $validator);
            }
        }
    }

    private function formMessages($key)
    {
        $messages = [
            'bssid.size' => 'For [' . $key . ']: Bssid must be exactly 17 characters long.',
            'bssid.required' => 'For [' . $key . ']: Bssid is required field.',
            'device_id.required' => 'For [' . $key . ']: Device identifier is required field.',
        ];
        return $messages;
    }

    private function location($location_id)
    {
        $this->location_id = $location_id;
        return $this;
    }
}
