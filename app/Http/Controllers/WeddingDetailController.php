<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use App\Models\WeddingDetail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class WeddingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $wedding = Wedding::find($request->id);
        if(!$wedding){
            return $this->sendError('Plan Not Found',Response::HTTP_NOT_FOUND);
        }
        $validator = Validator::make($request->all(),[
            'wedding_id' => 'required',
            'health_beauty' => 'required',
            'flower_decor' => 'required',
            'invitation'=> 'required',
            'attire' => 'required',
            'music' => 'required',
            'ceremony' => 'required',
            'jewelry' => 'required',
            'photo_video' => 'required',
            'catering' => 'required',
            'transportation' => 'required',
            'venue' => 'required',
            'souvenir' => 'required',

        ]);

        if ($validator->fails()) {
            $this->sendResponse("Missing Field",$validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY,false);
        }


        try {
            $data = WeddingDetail::create($validator->validated());
            return $this->sendResponse('Success Create',$validator->validated(),Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WeddingDetail  $weddingDetail
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $plan = WeddingDetail::find($id);
        return $this->sendResponse('Success',$plan,Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WeddingDetail  $weddingDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(WeddingDetail $weddingDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WeddingDetail  $weddingDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'wedding_id' => 'required',
            'health_beauty' => 'required',
            'flower_decor' => 'required',
            'invitation'=> 'required',
            'attire' => 'required',
            'music' => 'required',
            'ceremony' => 'required',
            'jewelry' => 'required',
            'photo_video' => 'required',
            'catering' => 'required',
            'transportation' => 'required',
            'venue' => 'required',
            'souvenir' => 'required',

        ]);
        $wedding = Wedding::find($request->wedding_id);
        $detail = WeddingDetail::find($id);
        if ($validator->fails()) {
            return $this->sendResponse("Missing Field",$validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY,false);
        }
        if(!$wedding || !$detail){
           return $this->sendError('Plan or Detail Plan Not Found',Response::HTTP_NOT_FOUND);
        }

        try {
            $data = $detail->update($validator->validated());
            return $this->sendResponse('Success Delete',$validator->validated(),Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->sendError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WeddingDetail  $weddingDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(WeddingDetail $weddingDetail)
    {
        //
    }
}
