<?php

namespace App\Http\Controllers;

use App\WifiPoint;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class WifiPointsController extends Controller
{
    protected $rules_store = [
        'bssid' => 'required',
    ];

    protected $rules_update = [
        'ssid' => '',
    ];

    private $wifi_point;

    public function __construct(WifiPoint $wifi_point)
    {
        $this->wifi_point = $wifi_point;
    }

    /**
     * @apiDefine WifiPointNotFoundError
     *
     * @apiError WifiPointNotFound The id of the WifiPoint was not found.
     *
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "error": "No query results for model [App\\WifiPoint] :id"
     *     }
     */

    /**
     * @apiDefine WifiPointApiParams
     * @apiParam {String}   bssid           MAC address.
     * @apiParam {String}   [ssid]          Name of Wi-Fi.
     * @apiParam {String}   [capabilities]  Capabilities of WiFi.
     * @apiParam {Integer}  [level]         Level.
     * @apiParam {Integer}  [frequency]     Frequency.
     * @apiParam {Integer}  [timestamp]     Timestamp.
     */

    /**
     * @api {get} /wifi-points List data of a WifiPoint
     * @apiVersion 0.0.1
     * @apiName GetWifiPoints
     * @apiGroup WifiPoints
     * @apiPermission none
     *
     * @apiDescription Get all WifiPoints
     *
     * @apiExample Example usage:
     * curl -i http://localhost/api/v1/wifi-point
     *
     * @apiSuccess {Object[]} wifi_points    List of wifi-points.
     * @apiSuccessExample {json} Success-Response (empty database):
     *      HTTP/1.1 200 OK
     *      []
     *
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *      [
     *          {
     *              "id": 1,
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
    public function index()
    {
        return response()->json($this->wifi_point->all());
    }

    /**
     * @api {post} /wifi-points Create a new WifiPoint
     * @apiVersion 0.0.1
     * @apiName PostWifiPoint
     * @apiGroup WifiPoints
     * @apiPermission none
     *
     * @apiDescription Please see <a href="https://developer.android.com/reference/android/net/wifi/ScanResult.html">ScanResult Android MAN</a>
     *
     * @apiUse WifiPointApiParams
     *
     * @apiParamExample {json} Request-Example:
     *   {
     *      "ssid": "Neo WiFi",
     *      "bssid": "11:40:05:A9:3f:28",
     *      "capabilities": "[BEND SPOON]",
     *      "level": -11,
     *      "frequency": 4589,
     *      "timestamp": "12319239148128"
     *  }
     *
     * @apiSuccess {Boolean}   created
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 201 Created
     *     {
     *       "created": true
     *     }
     *
     * @apiError (Error 422) {String} bssid The bssid field is required.
     *
     * @apiErrorExample {json} Error-response:
     *     HTTP/1.1 422 Unprocessable Entity
     *     {
     *       "bssid": ["The bssid field is required."]
     *     }
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules_store);
        $this->wifi_point->create($request->input());
        return response()->json(['created' => true], 201);
    }

    /**
     * @api {get} /wifi-points/:id Read data of a WifiPoint
     * @apiVersion 0.0.1
     * @apiName GetWifiPoint
     * @apiGroup WifiPoints
     * @apiPermission none
     *
     * @apiDescription Get certain WifiPoint by ID
     *
     *
     * @apiExample Example usage:
     * curl -i http://localhost/api/v1/wifi-points/1
     *
     * @apiSuccess {String}   bssid             MAC address.
     * @apiSuccess {String}   ssid              Name of Wi-Fi.
     * @apiSuccess {String}   capabilities      Capabilities of WiFi.
     * @apiSuccess {Integer}  level             Level.
     * @apiSuccess {Integer}  frequency         Frequency.
     * @apiSuccess {Integer}  timestamp         Timestamp.
     *
     * @apiUse WifiPointNotFoundError
     */
    public function show($id)
    {
        try {
            return response()->json($this->wifi_point->findOrFail($id));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @api {patch} /wifi-points/:id Change a WifiPoint
     * @apiVersion 0.0.1
     * @apiName PatchWifiPoint
     * @apiGroup WifiPoints
     * @apiPermission none
     *
     * @apiDescription Nothing yet
     *
     * @apiUse WifiPointApiParams
     *
     * @apiParamExample {json} Request-Example:
     *      {
     *          "ssid": "Morpheus WiFi",
     *          "bssid": "00:40:08:99:3f:22",
     *          "capabilities": "[WEAR GLASSES]",
     *          "level": -18,
     *          "frequency": 4500,
     *          "timestamp": "5836542254528"
     *      }
     *
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 200 OK
     *      {
     *          "id": 1,
     *          "bssid": "00:40:08:99:3f:22",
     *          "ssid": "Morpheus WiFi",
     *          "capabilities": "[WEAR GLASSES]",
     *          "level": -18,
     *          "frequency": 4500,
     *          "timestamp": "5836542254528",
     *          "created_at": "2016-11-21 14:14:44",
     *          "updated_at": "2016-11-21 20:41:49"
     *      }
     *
     * @apiUse WifiPointNotFoundError
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, $this->rules_update);

        try {
            $wifi_point = $this->wifi_point->findOrFail($id);
            $wifi_point->update($request->input());
            return response()->json($wifi_point, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    /**
     * @api {delete} /wifi-points/:id Delete a WifiPoint
     * @apiVersion 0.0.1
     * @apiName DeleteWifiPoint
     * @apiGroup WifiPoints
     * @apiPermission none
     *
     *
     * @apiSuccessExample {json} Success-Response:
     *      HTTP/1.1 204 No content
     *
     * @apiUse WifiPointNotFoundError
     */
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
