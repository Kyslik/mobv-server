define({ "api": [  {    "type": "delete",    "url": "/locations/:location_id/access-points/:id",    "title": "Delete a AccessPoint",    "version": "0.0.2",    "name": "DeleteAccessPoint",    "group": "AccessPoints",    "permission": [      {        "name": "none"      }    ],    "success": {      "examples": [        {          "title": "Success-Response:",          "content": "HTTP/1.1 204 No content",          "type": "json"        }      ]    },    "filename": "app/Http/Controllers/AccessPointsController.php",    "groupTitle": "AccessPoints",    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "AccessPointNotFound",            "description": "<p>The id of the AccessPoint was not found.</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"No query results for model [App\\\\AccessPoint] :id\"\n}",          "type": "json"        }      ]    }  },  {    "type": "get",    "url": "/locations/:location_id/access-points/:id",    "title": "Read data of a AccessPoint",    "version": "0.0.2",    "name": "GetAccessPoint",    "group": "AccessPoints",    "permission": [      {        "name": "none"      }    ],    "description": "<p>Get certain AccessPoint by ID</p>",    "examples": [      {        "title": "Example usage:",        "content": "curl -i http://localhost/api/v1/locations/:location_id/access-points/:id",        "type": "json"      }    ],    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Integer",            "optional": false,            "field": "id",            "description": ""          },          {            "group": "Success 200",            "type": "Integer",            "optional": false,            "field": "location_id",            "description": "<p>Location id.</p>"          },          {            "group": "Success 200",            "type": "Integer",            "optional": false,            "field": "device_id",            "description": "<p>Device id.</p>"          },          {            "group": "Success 200",            "type": "String",            "optional": false,            "field": "bssid",            "description": "<p>MAC address.</p>"          },          {            "group": "Success 200",            "type": "String",            "optional": false,            "field": "ssid",            "description": "<p>Name of Wi-Fi.</p>"          },          {            "group": "Success 200",            "type": "String",            "optional": false,            "field": "capabilities",            "description": "<p>Capabilities of WiFi.</p>"          },          {            "group": "Success 200",            "type": "Integer",            "optional": false,            "field": "level",            "description": "<p>Level.</p>"          },          {            "group": "Success 200",            "type": "Integer",            "optional": false,            "field": "frequency",            "description": "<p>Frequency.</p>"          },          {            "group": "Success 200",            "type": "Integer",            "optional": false,            "field": "timestamp",            "description": "<p>Timestamp.</p>"          }        ]      }    },    "filename": "app/Http/Controllers/AccessPointsController.php",    "groupTitle": "AccessPoints",    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "AccessPointNotFound",            "description": "<p>The id of the AccessPoint was not found.</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"No query results for model [App\\\\AccessPoint] :id\"\n}",          "type": "json"        }      ]    }  },  {    "type": "get",    "url": "/locations/:location_id/access-points",    "title": "List all access-points for location (:location_id)",    "version": "0.0.2",    "name": "GetAccessPoints",    "group": "AccessPoints",    "description": "<p>Get all access-points for location (:location_id)</p>",    "examples": [      {        "title": "Example usage:",        "content": "curl -i http://localhost/api/v1/locations/:location_id/access-points",        "type": "json"      }    ],    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Array[json]",            "optional": false,            "field": "access_points",            "description": "<p>List of wifi-points.</p>"          }        ]      },      "examples": [        {          "title": "Success-Response (empty database):",          "content": "HTTP/1.1 200 OK\n[]",          "type": "json"        },        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n[\n    {\n        \"id\": 1,\n        \"location_id\": :location_id,\n        \"device_id\": 1,\n        \"bssid\": \"0e:41:08:99:3f:22\",\n        \"ssid\": \"Eduroam\",\n        \"capabilities\": \"[WPA-EAP]\",\n        \"level\": -10,\n        \"frequency\": 5426,\n        \"timestamp\": \"52369854752\",\n        \"created_at\": \"2016-11-21 10:42:15\",\n        \"updated_at\": \"2016-11-21 11:59:02\"\n    },\n    {\n        \"id\": 2,\n        \"location_id\": :location_id\n        \"device_id\": 1,\n        \"bssid\": \"0e:41:08:32:6f:22\",\n        \"ssid\": \"Eduroam EXTENDED\",\n        \"capabilities\": \"[WEP]\",\n        \"level\": -70,\n        \"frequency\": 4589,\n        \"timestamp\": \"569352458152\",\n        \"created_at\": \"2016-11-21 11:58:19\",\n        \"updated_at\": \"2016-11-21 11:59:19\"\n    }\n]",          "type": "json"        }      ]    },    "filename": "app/Http/Controllers/AccessPointsController.php",    "groupTitle": "AccessPoints"  },  {    "type": "post",    "url": "/locations/:location_id/access-points",    "title": "Create new access-point(s).",    "version": "0.0.2",    "name": "PostAccessPoint",    "group": "AccessPoints",    "description": "<p>Please see <a href=\"https://developer.android.com/reference/android/net/wifi/ScanResult.html\">ScanResult Android MAN</a>, if AP for certain device_id exists it still returns created array.</p>",    "parameter": {      "examples": [        {          "title": "Request-Example (single):",          "content": " {\n    \"device_id\": 1,\n    \"ssid\": \"Neo WiFi\",\n    \"bssid\": \"11:40:05:A9:3f:28\",\n    \"capabilities\": \"[BEND SPOON]\",\n    \"level\": -11,\n    \"frequency\": 4589,\n    \"timestamp\": \"12319239148128\"\n}",          "type": "json"        },        {          "title": "Request-Example (array):",          "content": "[\n    {\n        \"device_id\": 1,\n        \"ssid\": \"Morpheus WiFi\",\n        \"bssid\": \"0e:40:08:99:3f:22\",\n        \"capabilities\": \"[WEAR-GLASSES]\",\n        \"level\": -50,\n        \"frequency\": 4521,\n        \"timestamp\": \"12319239148128\"\n    },\n    {\n        \"device_id\": 1,\n        \"ssid\": \"Trinity WiFi\",\n        \"bssid\": \"0d:40:08:99:3f:55\",\n        \"capabilities\": \"[KICK-ASS]\",\n        \"level\": -11,\n        \"frequency\": 2536,\n        \"timestamp\": \"56321524525663\"\n    }\n]",          "type": "json"        }      ],      "fields": {        "Parameter": [          {            "group": "Parameter",            "type": "String",            "optional": false,            "field": "bssid",            "description": "<p>MAC address.</p>"          },          {            "group": "Parameter",            "type": "integer",            "optional": false,            "field": "device_id",            "description": "<p>Unique device id.</p>"          },          {            "group": "Parameter",            "type": "String",            "optional": true,            "field": "ssid",            "description": "<p>Name of Wi-Fi.</p>"          },          {            "group": "Parameter",            "type": "String",            "optional": true,            "field": "capabilities",            "description": "<p>Capabilities of WiFi.</p>"          },          {            "group": "Parameter",            "type": "Integer",            "optional": true,            "field": "level",            "description": "<p>Level.</p>"          },          {            "group": "Parameter",            "type": "Integer",            "optional": true,            "field": "frequency",            "description": "<p>Frequency.</p>"          },          {            "group": "Parameter",            "type": "Integer",            "optional": true,            "field": "timestamp",            "description": "<p>Timestamp.</p>"          }        ]      }    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Array",            "optional": false,            "field": "created",            "description": "<p>Array of created IDs</p>"          }        ]      },      "examples": [        {          "title": "Success-Response (single):",          "content": "HTTP/1.1 201 Created\n{\n    \"created\": [\n        1\n    ]\n}",          "type": "json"        },        {          "title": "Success-Response (array):",          "content": "HTTP/1.1 201 Created\n{\n    \"created\": [\n        2,\n        3\n    ]\n}",          "type": "json"        }      ]    },    "error": {      "fields": {        "Error 415": [          {            "group": "Error 415",            "type": "String",            "optional": false,            "field": "error",            "description": "<p>Unsupported Media Type.</p>"          }        ],        "Error 422": [          {            "group": "Error 422",            "type": "String",            "optional": false,            "field": "bssid",            "description": "<p>Bssid field is required.</p>"          },          {            "group": "Error 422",            "type": "String",            "optional": false,            "field": "error",            "description": "<p>Invalid Json or sent data are empty &quot;[]&quot;.</p>"          }        ]      },      "examples": [        {          "title": "Error-response:",          "content": "HTTP/1.1 422 Unprocessable Entity\n{\n  \"bssid\": [\"The bssid field is required.\"]\n}",          "type": "json"        }      ]    },    "filename": "app/Http/Controllers/AccessPointsController.php",    "groupTitle": "AccessPoints"  },  {    "type": "get",    "url": "/locations/:id",    "title": "Read data of a Location",    "version": "0.0.2",    "name": "GetLocation",    "group": "Locations",    "permission": [      {        "name": "none"      }    ],    "description": "<p>Get certain Location by ID</p>",    "examples": [      {        "title": "Example usage:",        "content": "curl -i http://localhost/api/v1/locations/1",        "type": "json"      }    ],    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "String",            "optional": false,            "field": "block",            "description": "<p>Block (A-E;T).</p>"          },          {            "group": "Success 200",            "type": "Integer",            "optional": false,            "field": "level",            "description": "<p>Level (floor).</p>"          },          {            "group": "Success 200",            "type": "Date",            "optional": false,            "field": "created_at",            "description": "<p>Creation Date.</p>"          },          {            "group": "Success 200",            "type": "Date",            "optional": false,            "field": "updated_at",            "description": "<p>Latest update Date.</p>"          }        ]      }    },    "filename": "app/Http/Controllers/LocationController.php",    "groupTitle": "Locations",    "error": {      "fields": {        "Error 4xx": [          {            "group": "Error 4xx",            "optional": false,            "field": "LocationNotFound",            "description": "<p>The id of the Place was not found.</p>"          }        ]      },      "examples": [        {          "title": "Error-Response:",          "content": "HTTP/1.1 404 Not Found\n{\n  \"error\": \"Location not found.\"\n}",          "type": "json"        }      ]    }  },  {    "type": "get",    "url": "/locations",    "title": "List data of a Locations",    "version": "0.0.2",    "name": "GetLocations",    "group": "Locations",    "permission": [      {        "name": "none"      }    ],    "description": "<p>Get all Locations</p>",    "examples": [      {        "title": "Example usage:",        "content": "curl -i http://localhost/api/v1/locations",        "type": "json"      }    ],    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Object[]",            "optional": false,            "field": "places",            "description": "<p>List of locations.</p>"          }        ]      },      "examples": [        {          "title": "Success-Response (empty database):",          "content": "HTTP/1.1 200 OK\n[]",          "type": "json"        },        {          "title": "Success-Response:",          "content": "HTTP/1.1 200 OK\n[\n    {\n        \"id\": 1,\n        \"block\": \"A\",\n        \"level\": 3,\n    },\n    {\n        \"id\": 2,\n        \"block\": \"A\",\n        \"level\": 5,\n    }\n]",          "type": "json"        }      ]    },    "filename": "app/Http/Controllers/LocationController.php",    "groupTitle": "Locations"  },  {    "type": "post",    "url": "/locations/find",    "title": "Get location suggestion by BSSID",    "version": "0.0.2",    "name": "PostFindLocation",    "group": "Locations",    "permission": [      {        "name": "none"      }    ],    "description": "<p>Get suggestions of Location by BSSID</p>",    "parameter": {      "examples": [        {          "title": "Request-Example (single):",          "content": "\"0e:40:08:99:3f:22\"",          "type": "json"        },        {          "title": "Request-Example (array):",          "content": "[\"11:40:05:A9:3f:28\", \"0e:40:08:99:3f:22\"]",          "type": "json"        }      ]    },    "success": {      "fields": {        "Success 200": [          {            "group": "Success 200",            "type": "Array",            "optional": false,            "field": "suggestions",            "description": "<p>Array of suggested locations</p>"          }        ]      },      "examples": [        {          "title": "Success-Response:",          "content": "{\n    \"suggestions\": [\n        {\n            \"location\": {\n                \"id\": 1,\n                \"block\": \"E\",\n                \"level\": -2,\n                \"access_points\": [\n                    {\n                        \"id\": 1,\n                        \"ssid\": \"Morpheus WiFi\",\n                        \"bssid\": \"0e:40:08:99:3f:22\",\n                        \"location_id\": 1\n                    },\n                    {\n                        \"id\": 2,\n                        \"ssid\": \"Trinity WiFi\",\n                        \"bssid\": \"0d:40:08:99:3f:55\",\n                        \"location_id\": 1\n                    }\n                ]\n            },\n            \"match_count\": 2\n        }\n    ]\n}",          "type": "json"        }      ]    },    "error": {      "fields": {        "Error 415": [          {            "group": "Error 415",            "type": "String",            "optional": false,            "field": "error",            "description": "<p>Unsupported Media Type.</p>"          }        ],        "Error 422": [          {            "group": "Error 422",            "type": "String",            "optional": false,            "field": "error",            "description": "<p>Invalid Json or sent data are empty &quot;[]&quot;.</p>"          }        ]      }    },    "filename": "app/Http/Controllers/LocationController.php",    "groupTitle": "Locations"  }] });
