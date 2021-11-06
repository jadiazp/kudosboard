<?php

namespace App\Http\Controllers;

use App\Models\Kudo;
use Exception;
use Illuminate\Http\Request;

class KudoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $kudos = Kudo::all();
      return response()->json($kudos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'iduser' => 'required',
        'idboard' => 'required',
        'description' => 'required'
      ]);

      $kudo = new Kudo([
        'iduser' => $request->get('iduser'),
        'idboard' => $request->get('idboard'),
        'description' => $request->get('description'),
      ]);

      try{
        $kudo->save();
        return response()->json($kudo);
      }catch(Exception $e){
        return response()->json([
          'status' => 'error',
          'error' => $e->getMessage()
        ], 500);
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
      $kudo = Kudo::findOrFail($id);
      return response()->json($kudo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $kudo = Kudo::findOrFail($id);

      $request->validate([
        'iduser' => 'required',
        'idboard' => 'required',
        'description' => 'required'
      ]);

      $kudo->iduser = $request->get('iduser');
      $kudo->idboard = $request->get('idboard');
      $kudo->description = $request->get('description');

      try{
        $kudo->save();
        return response()->json($kudo);
      }
      catch(Exception $e){
        return response()->json([
          'status' => 'error',
          'error' => $e->getMessage()
        ], 500);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $kudo = Kudo::findOrFail($id);
      try{
        $kudo->delete();
        return response()->json($kudo::all());
      }
      catch(Exception $e){
        return response()->json([
          'status' => 'error',
          'error' => $e->getMessage()
        ], 500);
      }
    }
}
