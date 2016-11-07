<?php

namespace App\Http\Controllers;

use App\Place;
use Carbon;
use Exception;
use Illuminate\Http\Request;

class PlacesController extends Controller
{

    private $rules = [
        'block'      => 'required',
        'floor'      => 'required',
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $objects = Place::
            get();

            return ['success' => true, 'data' => $objects];
        }
        catch(Exception $e){
            return ['success' => false, 'error' => $e->getMessage()];
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->input();

        try {

            $validator = Validator::make($inputs, $this->rules);

            if ($validator->fails()) {

                return ['success' => false, 'error' => $validator->messages()->all()];
            }


            $model = Place::create($inputs);

            return [
                'success' => true,
                'data'    => Place::find($model->id)
            ];

        } catch (Exception $ex) {
            return ['success' => false, 'error' => $ex->getMessage()];
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Place::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->input();

        try {

            $validator = Validator::make($inputs, $this->rules);

            if ($validator->fails()) {

                return ['success' => false, 'error' => $validator->messages()->all()];
            }

            $model = Place::find($id);
            $model->update($inputs);

            return
                [
                    'success' => true,
                    'data'    => Place::find($model->id)
                ];
        } catch (Exception $e) {
            return
                [
                    'success' => false,
                    'error'   => $e->getMessage()
                ];
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Place::find($id);

        try {
            return
                [
                    'success' => $model->delete(),
                ];
        } catch (Exception $e) {
            return
                [
                    'success' => false,
                    'error'   => $e->getMessage()
                ];
        }


    }
}
