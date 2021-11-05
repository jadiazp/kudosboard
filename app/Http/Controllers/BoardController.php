<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $boards = Board::all();
      return response()->json($boards);
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
        'title' => 'required|max:255',
        'description' => 'required'
      ]);

      $board = new Board([
        'title' => $request->get('title'),
        'description' => $request->get('description'),
        'photo' => $request->get('photo')
      ]);

      $board->save();
      return response()->json($board);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $board = Board::findOrFail($id);
      return response()->json($board);
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
      $board = Board::findOrFail($id);

      $request->validate([
        'title' => 'required|max:255',
        'description' => 'required'
      ]);

      $board->title = $request->get('title');
      $board->description = $request->get('description');

      $board->save();

      return response()->json($board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $board = Board::findOrFail($id);
      $board->delete();

      return response()->json($board::all());
    }
}
