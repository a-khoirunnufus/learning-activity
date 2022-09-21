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
                        WHEN a.deleted_at is not NULL THEN NULL
                        WHEN date_part('month', a.start) = '07'  
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END juli,
                    CASE 
                        WHEN a.deleted_at is not NULL THEN NULL
                        WHEN date_part('month', a.start) = '08' 
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END agustus,
                    CASE 
                        WHEN a.deleted_at is not NULL THEN NULL
                        WHEN date_part('month', a.start) = '09' 
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END september,
                    CASE 
                        WHEN a.deleted_at is not NULL THEN NULL
                        WHEN date_part('month', a.start) = '10' 
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END oktober,
                    CASE 
                        WHEN a.deleted_at is not NULL THEN NULL
                        WHEN date_part('month', a.start) = '11' 
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END november,
                    CASE 
                        WHEN a.deleted_at is not NULL THEN NULL
                        WHEN date_part('month', a.start) = '12' 
                            THEN concat_ws(',', a.id, a.title, a.start, a.finish)
                    END desember,
                    m.order as urutan
                FROM ref_methods m
                    LEFT JOIN activities a on a.method_id = m.id
            )
            SELECT
                metode,
                string_agg(juli, '|') as juli,
                string_agg(agustus, '|') as agustus,
                string_agg(september, '|') as september,
                string_agg(oktober, '|') as oktober,
                string_agg(november, '|') as november,
                string_agg(desember, '|') as desember
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
