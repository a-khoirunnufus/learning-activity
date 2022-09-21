<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Method;
use App\Models\Activity;
use Carbon\Carbon;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $methods = Method::all();

        return view('dashboard', [
            'methods' => $methods,
        ]);
    }

    public function table() {
        $result = DB::select("
            WITH CTE AS
            (
                SELECT 
                    m.name as metode,
                    CASE 
                        WHEN date_part('month', a.start) = '01' 
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END januari,
                    CASE 
                        WHEN date_part('month', a.start) = '02' 
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END februari,
                    CASE 
                        WHEN date_part('month', a.start) = '03' 
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END maret,
                    CASE 
                        WHEN date_part('month', a.start) = '04' 
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END april,
                    CASE 
                        WHEN date_part('month', a.start) = '05' 
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END mei,
                    CASE 
                        WHEN date_part('month', a.start) = '06' 
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END juni,
                    m.order as urutan
                FROM ref_methods m
                    LEFT JOIN activities a on a.method_id = m.id
            )
            SELECT
                metode,
                string_agg(januari, '|') as januari,
                string_agg(februari, '|') as februari,
                string_agg(maret, '|') as maret,
                string_agg(april, '|') as april,
                string_agg(mei, '|') as mei,
                string_agg(juni, '|') as juni
            FROM CTE
            GROUP BY metode, urutan
            ORDER BY urutan
        ");

        $data = array_map(function ($item) {
            $arr = [];
            foreach($item as $key => $value) {
                if($key != 'metode') {
                    $itemb = explode('|', $value);
                    $arrb = [];
                    if($itemb[0] != null) {
                        foreach($itemb as $valueb) {
                            $itemc = explode(',', $valueb);
                            $arrc['activity_id'] = $itemc[0];
                            $arrc['title'] = $itemc[1];
                            $arrc['start'] = $itemc[2];
                            $arrc['finish'] = $itemc[3];
                            $arrb[] = $arrc;
                        }
                        // Sort the array 
                        usort($arrb, function ($element1, $element2) {
                            $datetime1 = strtotime($element1['start']);
                            $datetime2 = strtotime($element2['start']);
                            return $datetime1 - $datetime2;
                        });
                    }
                    $arr[$key] = $arrb;
                } else {
                    $arr['metode'] = $value;
                }
            }
            return $arr;
        }, $result);

        $methods = Method::all();

        return view('partials.activity_table', [
            'data' => $data,
            'methods' => $methods,
        ]);
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
        // TODO: validate request

        $activity = new Activity;
        $activity->session_id = 1;
        $activity->method_id = $request->input('method_id');
        $activity->title = $request->input('title');
        $activity->start = Carbon::createFromFormat('Y-m-d', $request->input('start'));
        $activity->finish = Carbon::createFromFormat('Y-m-d', $request->input('finish'));
        $activity->save();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan data',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::find($id);

        return response()->json([
            'id' => $activity->id,
            'method_id' => $activity->method_id,
            'title' => $activity->title,
            'start' => $activity->start->format('Y-m-d'),
            'finish' => $activity->finish->format('Y-m-d'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $activity = Activity::find($id);
        $activity->update($request->except('id'));

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengupdate data',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activity::find($id);
        $activity->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus data',
        ]);
    }
}
