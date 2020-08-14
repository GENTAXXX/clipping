<?php

namespace App\Http\Controllers;

use App\Media;
use App\Project;
use App\Language;
use App\Category;
use App\Statuses;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getAllProjects()
    {
        $result = Project::all();
        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function getAllMedias()
    {
        $result = Media::all();
	    if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function getAllLanguages()
    {
        $result = Language::all();
        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function getAllCategories()
    {
        $result = Category::all();
        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function getAllNewsbyProjectAndStatus(Request $request){

        $project_id = $request->project_id;
        $status = $request->status;

        $result = Statuses::with('news')->whereHas('news', function($q) use($status, $project_id){
            $q->where('status', $status)->where("news.project_id", $project_id);
        })->get();

        if($request->count){
            if(!$result->isEmpty()){
                $result = $result->count();
            } else {
                $result = 0;
            }
        }

        if($request->count){
            $data['code'] = 200;
            $data['result'] = $result;
        } else if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }

        return response($data);
    }
    
}
