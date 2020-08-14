<?php

namespace App\Http\Controllers;

use App\Category;
use App\Language;
use App\Media;
use App\Project;
use App\Statuses;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{

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

        if ($request->count) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }

        return response($data);
    }
    
    public function addNews(Request $request){
        //This function is used to store a news
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'content' => 'required',
            'area' => 'required',
            'scan' => 'required',
            'created' => 'required',
            'media_id' => 'required',
            'date' => 'required',
            'categories' => 'required',
            'keywords' => 'required',
            'lang_id' => 'required',
            'project_id' => 'required',
            'image' => 'required'
        ]);

        $news = News::create($request->all());

        if ($news) {
            $data['code'] = 200;
            $data['result'] = $news;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function updateNews(Request $request, $id){
        //This function is used to update a news by id

        // $request->validate([
        //     'news_title' => 'required',
        //     'news_desc' => 'required',
        //     'news_extract' => 'required',
        //     'news_status' => 'required',
        //     'news_area' => 'required',
        //     'news_approval' => 'required',
        //     'news_approval_date' => 'required',
        //     'news_created' => 'required',
        //     'media_id' => 'required',
        //     'news_date' => 'required',
        //     'categories' => 'required',
        //     'keywords' => 'required',
        //     'lang_id' => 'required',
        //     'verificator_id' => 'required',
        //     'creator_id' => 'required',
        //     'image' => 'required',
        // ]);

        // $result = News::update($request->all());

        $news = News::where('news_id', $id)->first();
        // $news->news_id              = $request->news_id;
        $news->title           = $request->title;
        $news->desc            = $request->desc;
        $news->content         = $request->content;
        $news->area            = $request->area;
        $news->scan            = $request->scan;
        $news->created         = $request->created;
        $news->media_id        = $request->media_id;
        $news->date            = $request->date;
        $news->categories      = $request->categories;
        $news->lang_id         = $request->lang_id;
        $news->project_id      = $request->project_id;
        $news->image           = $request->image;
        $news->save();

        if ($news) {
            $data['code'] = 200;
            $data['result'] = $news;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function deleteNewsById($id){
        $result = News::find($id);
        $result->delete();

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function searchNewsByTitle(Request $request){

        $project_id = $request->project_id;
        $status = $request->status;
        $search = $request->search;
        $result = Statuses::with('news')->whereHas('news', function($q) use($status, $project_id, $search){
            $q->where('status', $status)->where("news.project_id", $project_id)->where('news.title','like',"%".$search."%");
        })->get();

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function getNewsById(){
        
        $result = News::all()->where('news_id', 'news.id');

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function getListProjects(){

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

    public function getListMedias(){
        $result = Media::all();

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function getListCategories(){

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

    public function getListLanguages(){

        $result = Language::all();

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }
}
