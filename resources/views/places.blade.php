<!DOCTYPE html>
<html>
<head>
    <title>Wifi Points</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>

<div class="container" id="manage-vue">
    <br><br>
    <br><br>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-header">
                <div class="pull-left">
                    <h2>Wifi Points</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-12"><h3>Blocks</h3>

            <!-- tabs left -->
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    @foreach($result as $block => $floors)
                        <li>
                            <a href="#block_{{$block}}" data-toggle="tab">{{$block}}</a>
                        </li>
                    @endforeach
                    {{--<li><a href="#a" data-toggle="tab">One</a></li>--}}
                    {{--<li class="active"><a href="#b" data-toggle="tab">Two</a></li>--}}
                    {{--<li><a href="#c" data-toggle="tab">Twee</a></li>--}}
                </ul>
                <div class="tab-content">
                    @foreach($result as $block => $places_by_floor)
                        <div class="tab-pane" id="block_{{$block}}">
                            @if($places_by_floor)
                                <div class="tabbable" style="margin-top: 10px;">
                                    <ul class="nav nav-tabs">
                                        @foreach($places_by_floor as $floor => $places)
                                            <li>
                                                <a href="#floor_{{$block.'_'.$floor}}" data-toggle="tab">{{$floor}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach($places_by_floor as $floor => $places)
                                            <div class="tab-pane" id="floor_{{$block.'_'.$floor}}">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <ul class="list-group">
                                                            <h4>Wifi Points:</h4>
                                                            @foreach(collect($places)->pluck('wifi_points')->collapse() as $wifi_point)

                                                                <table class="table table-bordered">
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>SSID</th>
                                                                        <th>BSSID</th>
                                                                        <th>CAPABILITIES</th>
                                                                        <th>LEVEL</th>
                                                                        <th>FREQUENCY</th>
                                                                        <th>TIMESTAMP</th>
                                                                        <th>DISTANCE</th>
                                                                        <th>DISTANCE_SD</th>
                                                                    </tr>
                                                                    <tr v-for="wifi_point in wifi_points">
                                                                        <td>{{ $wifi_point->id }}</td>
                                                                        <td>{{ $wifi_point->ssid }}</td>
                                                                        <td>{{ $wifi_point->bssid }}</td>
                                                                        <td>{{ $wifi_point->capabilities }}</td>
                                                                        <td>{{ $wifi_point->level }}</td>
                                                                        <td>{{ $wifi_point->frequency }}</td>
                                                                        <td>{{ $wifi_point->timestamp }}</td>
                                                                        <td>{{ $wifi_point->distance }}</td>
                                                                        <td>{{ $wifi_point->distanceSd }}</td>
                                                                    </tr>
                                                                </table>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /tabs -->

        </div>

    </div>
{{--<div class="row">--}}
{{--<div class="col-lg-12">--}}
{{--<div class="pull-right">--}}
{{--<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-wifi_point">--}}
{{--Create Item--}}
{{--</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

<!-- Item Listing -->
{{--<div class="row">--}}
{{--<div class="col-sm-12">--}}
{{--<table class="table table-bordered">--}}
{{--<tr>--}}
{{--<th>ID</th>--}}
{{--<th>SSID</th>--}}
{{--<th>BSSID</th>--}}
{{--<th>CAPABILITIES</th>--}}
{{--<th>LEVEL</th>--}}
{{--<th>FREQUENCY</th>--}}
{{--<th>TIMESTAMP</th>--}}
{{--<th>DISTANCE</th>--}}
{{--<th>DISTANCE_SD</th>--}}
{{--<th width="200px">Action</th>--}}
{{--</tr>--}}
{{--<tr v-for="wifi_point in wifi_points">--}}
{{--<td>@{{ wifi_point.id }}</td>--}}
{{--<td>@{{ wifi_point.ssid }}</td>--}}
{{--<td>@{{ wifi_point.bssid }}</td>--}}
{{--<td>@{{ wifi_point.capabilities }}</td>--}}
{{--<td>@{{ wifi_point.level }}</td>--}}
{{--<td>@{{ wifi_point.frequency }}</td>--}}
{{--<td>@{{ wifi_point.timestamp }}</td>--}}
{{--<td>@{{ wifi_point.distance }}</td>--}}
{{--<td>@{{ wifi_point.distanceSd }}</td>--}}
{{--<td>--}}
{{--<button class="btn btn-primary" @click.prevent="editItem(wifi_point)">Edit</button>--}}
{{--<button class="btn btn-danger" @click.prevent="deleteItem(wifi_point)">Delete</button>--}}
{{--</td>--}}
{{--</tr>--}}
{{--</table>--}}
{{--</div>--}}
{{--</div>--}}

{{--<!-- Pagination -->--}}
{{--<div class="row">--}}
{{--<div class="col-sm-12">--}}
{{--<nav>--}}
{{--<ul class="pagination">--}}
{{--<li v-if="pagination.current_page > 1">--}}
{{--<a href="#" aria-label="Previous"--}}
{{--@click.prevent="changePage(pagination.current_page - 1)">--}}
{{--<span aria-hidden="true">«</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--<li v-for="page in pagesNumber"--}}
{{--v-bind:class="[ page == isActived ? 'active' : '']">--}}
{{--<a href="#"--}}
{{--@click.prevent="changePage(page)">@{{ page }}</a>--}}
{{--</li>--}}
{{--<li v-if="pagination.current_page < pagination.last_page">--}}
{{--<a href="#" aria-label="Next"--}}
{{--@click.prevent="changePage(pagination.current_page + 1)">--}}
{{--<span aria-hidden="true">»</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</nav>--}}
{{--</div>--}}
{{--</div>--}}

<!-- Create Item Modal -->
{{--<div class="modal fade" id="create-wifi_point" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
{{--<div class="modal-dialog" role="document">--}}
{{--<div class="modal-content">--}}
{{--<div class="modal-header">--}}
{{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>--}}
{{--<h4 class="modal-title" id="myModalLabel">Create Item</h4>--}}
{{--</div>--}}
{{--<div class="modal-body">--}}

{{--<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createItem">--}}

{{--<div class="form-group">--}}
{{--<label for="ssid">SSID:</label>--}}
{{--<input type="text" id="ssid" name="ssid" class="form-control" v-model="newItem.ssid" />--}}
{{--<span v-if="formErrors['ssid']" class="error text-danger">@{{ formErrors['ssid'] }}</span>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<label for="bssid">BSSID:</label>--}}
{{--<input type="text" id="bssid" name="bssid" class="form-control" v-model="newItem.bssid" />--}}
{{--<span v-if="formErrors['bssid']" class="error text-danger">@{{ formErrors['bssid'] }}</span>--}}
{{--</div>--}}
{{----}}
{{--<div class="form-group">--}}
{{--<label for="capabilities">CAPABILITIES:</label>--}}
{{--<input type="text" id="capabilities" name="capabilities" class="form-control" v-model="newItem.capabilities" />--}}
{{--<span v-if="formErrors['capabilities']" class="error text-danger">@{{ formErrors['capabilities'] }}</span>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<label for="level">LEVEL:</label>--}}
{{--<input type="text" id="level" name="level" class="form-control" v-model="newItem.level" />--}}
{{--<span v-if="formErrors['level']" class="error text-danger">@{{ formErrors['level'] }}</span>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<label for="frequency">FREQUENCY:</label>--}}
{{--<input type="text" id="frequency" name="frequency" class="form-control" v-model="newItem.frequency" />--}}
{{--<span v-if="formErrors['frequency']" class="error text-danger">@{{ formErrors['frequency'] }}</span>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<label for="timestamp">TIMESTAMP:</label>--}}
{{--<input type="text" id="timestamp" name="timestamp" class="form-control" v-model="newItem.timestamp" />--}}
{{--<span v-if="formErrors['timestamp']" class="error text-danger">@{{ formErrors['timestamp'] }}</span>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<label for="distance">DISTANCE:</label>--}}
{{--<input type="text" id="distance" name="distance" class="form-control" v-model="newItem.distance" />--}}
{{--<span v-if="formErrors['distance']" class="error text-danger">@{{ formErrors['distance'] }}</span>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<label for="distanceSd">DISTANCE_SD:</label>--}}
{{--<input type="text" id="distanceSd" name="distanceSd" class="form-control" v-model="newItem.distanceSd" />--}}
{{--<span v-if="formErrors['distanceSd']" class="error text-danger">@{{ formErrors['distanceSd'] }}</span>--}}
{{--</div>--}}
{{----}}
{{--<div class="form-group">--}}
{{--<button type="submit" class="btn btn-success">Submit</button>--}}
{{--</div>--}}

{{--</form>--}}


{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}

<!-- Edit Item Modal -->
    {{--<div class="modal fade" id="edit-wifi_point" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
    {{--<div class="modal-dialog" role="document">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>--}}
    {{--<h4 class="modal-title" id="myModalLabel">Edit Item</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}

    {{--<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">--}}

    {{--<div class="form-group">--}}
    {{--<label for="ssid">SSID:</label>--}}
    {{--<input type="text" id="ssid" name="ssid" class="form-control" v-model="fillItem.ssid" />--}}
    {{--<span v-if="formErrorsUpdate['ssid']" class="error text-danger">@{{ formErrorsUpdate['ssid'] }}</span>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label for="bssid">BSSID:</label>--}}
    {{--<input type="text" id="bssid" name="bssid" class="form-control" v-model="fillItem.bssid" />--}}
    {{--<span v-if="formErrorsUpdate['bssid']" class="error text-danger">@{{ formErrorsUpdate['bssid'] }}</span>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label for="capabilities">CAPABILITIES:</label>--}}
    {{--<input type="text" id="capabilities" name="capabilities" class="form-control" v-model="fillItem.capabilities" />--}}
    {{--<span v-if="formErrorsUpdate['capabilities']" class="error text-danger">@{{ formErrorsUpdate['capabilities'] }}</span>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label for="level">LEVEL:</label>--}}
    {{--<input type="text" id="level" name="level" class="form-control" v-model="fillItem.level" />--}}
    {{--<span v-if="formErrorsUpdate['level']" class="error text-danger">@{{ formErrorsUpdate['level'] }}</span>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label for="frequency">FREQUENCY:</label>--}}
    {{--<input type="text" id="frequency" name="frequency" class="form-control" v-model="fillItem.frequency" />--}}
    {{--<span v-if="formErrorsUpdate['frequency']" class="error text-danger">@{{ formErrorsUpdate['frequency'] }}</span>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label for="timestamp">TIMESTAMP:</label>--}}
    {{--<input type="text" id="timestamp" name="timestamp" class="form-control" v-model="fillItem.timestamp" />--}}
    {{--<span v-if="formErrorsUpdate['timestamp']" class="error text-danger">@{{ formErrorsUpdate['timestamp'] }}</span>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label for="distance">DISTANCE:</label>--}}
    {{--<input type="text" id="distance" name="distance" class="form-control" v-model="fillItem.distance" />--}}
    {{--<span v-if="formErrorsUpdate['distance']" class="error text-danger">@{{ formErrorsUpdate['distance'] }}</span>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<label for="distanceSd">DISTANCE_SD:</label>--}}
    {{--<input type="text" id="distanceSd" name="distanceSd" class="form-control" v-model="fillItem.distanceSd" />--}}
    {{--<span v-if="formErrorsUpdate['distanceSd']" class="error text-danger">@{{ formErrorsUpdate['distanceSd'] }}</span>--}}
    {{--</div>--}}

    {{--<div class="form-group">--}}
    {{--<button type="submit" class="btn btn-success">Submit</button>--}}
    {{--</div>--}}

    {{--</form>--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript"
        src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


{{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>--}}
{{--<script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>--}}

{{--<script src="https://unpkg.com/vue@2.0.3/dist/vue.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.0.3/vue-resource.min.js"></script>--}}

<script type="text/javascript" src="/js/places.js"></script>

</body>
</html>