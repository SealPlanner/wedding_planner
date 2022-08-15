<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class WeddingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Wedding::get();
        return $this->sendResponse('Success',$data,Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'location' => 'required',
            'date' => 'required',
            'total_budget' => 'required',
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            $this->sendResponse("Missing Field",$validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY,false);
        }

        try {
            $data = Wedding::create($validator->validated());
            return $this->sendResponse('Success Create',$validator->validated(),Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wedding  $wedding
     * @return \Illuminate\Http\Response
     */
    public function show(Wedding $wedding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wedding  $wedding
     * @return \Illuminate\Http\Response
     */
    public function edit(Wedding $wedding)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wedding  $wedding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {

        $plan = Wedding::find($id);
        if(!$plan){
            $this->sendError("Data Not Found",Response::HTTP_NOT_FOUND);
        }
        $validator = Validator::make($request->all(),[
            'location' => 'required',
            'date' => 'required',
            'total_budget' => 'required',
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            $this->sendResponse("Missing Field",$validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY,false);
        }

        try {
            $data = $plan->update($validator->validated());
            return $this->sendResponse('Success Update',$validator->validated(),Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wedding  $wedding
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {

        $plan = Wedding::find($id);
        if(!$plan){
            $this->sendError("Data Not Found",Response::HTTP_NOT_FOUND);
        }
        try {
            $data = $plan->delete();
            return $this->sendResponse('Success Delete',$data,Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage());
        }
    }
}
