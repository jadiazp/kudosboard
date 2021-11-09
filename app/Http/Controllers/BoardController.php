<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$boards = Board::all();
      $results = DB::select('SELECT
      b.id,
      b.title,
      b.description,
      count(k.description) as count
      FROM kudosboard.boards b
      left join kudosboard.kudos k
      on k.idboard = b.id
      group by b.id;');
      return response()->json($results);
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

      try{
        $board->save();
        return response()->json($board);
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
      $results = DB::select("SELECT
      b.title,
      b.description as board_description,
      u.firstname,
      u.lastname,
      k.description,
      concat(u2.firstname, ' ', u2.lastname) as assigned
      FROM kudosboard.boards b
      left join kudosboard.kudos k
      on b.id = k.idboard
      left join kudosboard.users u
      on u.id = k.iduser
      left join kudosboard.users u2
      on u2.id = k.iduserto
      where b.id = " . $id . "
      order by k.created_at desc;");
      $result = [];
      $kudos = [];

      if($results && count($results) > 0){
        $board = array(
          'board_title' => $results[0]->title,
          'board_description' => $results[0]->board_description,
        );

        for($x=0;$x<count($results);$x++){
          if($results[$x]->firstname != null){
            $assigned = '';
            if($results[$x]->assigned != null){
              $assigned = $results[$x]->assigned;
            }
            $kudo = [
              'firstname' => $results[$x]->firstname,
              'lastname' => $results[$x]->lastname,
              'description' => $results[$x]->description,
              'assigned' => $assigned
            ];
            array_push($kudos, $kudo);
          }
        }

        $data = [
          'board' => $board,
          'kudos' => $kudos
        ];

        array_push($result, $data);
      }

      return response()->json($result);
    }

    public function getOne($id)
    {
      $results = DB::select("SELECT
      b.title,
      b.description as board_description,
      u.firstname,
      u.lastname,
      k.description,
      concat(u2.firstname, ' ', u2.lastname) as assigned
      FROM kudosboard.boards b
      left join kudosboard.kudos k
      on b.id = k.idboard
      left join kudosboard.users u
      on u.id = k.iduser
      left join kudosboard.users u2
      on u2.id = k.iduserto
      where b.id = " . $id . "
      order by k.created_at desc
      limit 1;");
      $result = [];
      $kudos = [];

      if($results && count($results) > 0){
        $board = array(
          'board_title' => $results[0]->title,
          'board_description' => $results[0]->board_description,
        );

        for($x=0;$x<count($results);$x++){
          if($results[$x]->firstname != null){
            $assigned = '';
            if($results[$x]->assigned != null){
              $assigned = $results[$x]->assigned;
            }
            $kudo = [
              'firstname' => $results[$x]->firstname,
              'lastname' => $results[$x]->lastname,
              'description' => $results[$x]->description,
              'assigned' => $assigned
            ];
            array_push($kudos, $kudo);
          }
        }

        $data = [
          'board' => $board,
          'kudos' => $kudos
        ];

        array_push($result, $data);
      }

      return $result;
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

      try{
        $board->save();
        return response()->json($board);
      }catch(Exception $e){
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
      $board = Board::findOrFail($id);
      try{
        $board->delete();
        return response()->json($board::all());
      }catch(Exception $e){
        return response()->json([
          'status' => 'error',
          'error' => $e->getMessage()
        ], 500);
      }
    }
}
