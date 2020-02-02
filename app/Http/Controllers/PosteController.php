<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Poste;
use App\Http\Resources\Poste as PosteResource;

class PosteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get postes
        $postes = Poste::orderBy('created_at', 'desc')->paginate(5);

        // Return collection of postes as a resource
        return PosteResource::collection($postes);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $poste = $request->isMethod('put') ? Poste::findOrFail($request->poste_id) : new Poste;

        $poste->id = $request->input('poste_id');
        $poste->title = $request->input('title');
        $poste->body = $request->input('body');

        if($poste->save()) {
            return new PosteResource($poste);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get poste
        $poste = Poste::findOrFail($id);

        // Return single poste as a resource
        return new PosteResource($poste);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get poste
        $poste = Poste::findOrFail($id);

        if($poste->delete()) {
            return new PosteResource($poste);
        }    
    }
}
