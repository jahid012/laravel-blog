<?php

namespace App\Http\Controllers\Admin;

use App\Facades\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year   = $request->input('year');
        $month  = $request->input('month');

        if( $year == null){
            return redirect()->route('media.index', ['year' => date("Y")]);
        }
        if($month == null){
            return redirect()->route('media.index', [
                'year' => $year,
                'month' => date("m")
            ]);
        }

        $files = Media::where($year, $month)->get();
        $directories =  Media::allDirectories();

        if($request->ajax()){
            return response()->json([
                'files'         => $files,
                'directories'   => $directories,
                'message'       => 'Data get Successfully'
            ], 200);
        }

        $q = urldecode($_SERVER['QUERY_STRING']);
        $q = str_replace('year=', '', $q);
        $q = str_replace('&month=', '/', $q);

        return view('media.index', compact('files', 'directories', 'q'));
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
            '*.*' => ['mimes:jpeg,png,jpg,gif,svg,mp4,ogx,oga,ogv,ogg,webm', 'max:40096']
        ]);
        //upload all files
        foreach ($request->files as $files) {
            if(!Media::uploads($files)){
                if($request->ajax()){
                    return response()->json([
                        'message' => "The Files Uploads Fails",
                        'alert-type' => 'error',
                    ], 422);
                }
                return back()->with('error', "The Files Uploads Fails");
            }
        }

        if($request->ajax()){
            return response()->json([
                'message' => "The Files Uploads Successfully",
                'alert-type' => 'success'
            ], 201);
        }

        return back()->withSuccess("The Files Uploads Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($year, $month, $filename)
    {
        $media = Media::find($path = "{$year}/{$month}/{$filename}");

        if($media != null){
            $media->delete();
        }
        return back()->with(['message' => "The File delete Complete", 'alert-type' => 'success']);
    }
}
