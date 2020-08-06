<?php

namespace App\Http\Controllers;

use App\News;
use App\Statuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsAPI extends Controller
{
    
    public function index()
    {
        //This function is used to get aall news
        $result = News::all();
        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }
    
    public function create()
    {
        return view('news.create');
    }
    
    public function store(Request $request)
    {
        //This function is used to store a news
        $request->validate([
            'news_title' => 'required',
            'news_desc' => 'required',
            'news_extract' => 'required',
            'news_status' => 'required',
            'news_area' => 'required',
            'news_approval' => 'required',
            'news_approval_date' => 'required',
            'news_created' => 'required',
            'media_id' => 'required',
            'news_date' => 'required',
            'categories' => 'required',
            'keywords' => 'required',
            'lang_id' => 'required',
            'verificator_id' => 'required',
            'creator_id' => 'required',
            'project_id' => 'required',
            'image' => 'required'
        ]);

        $news = News::create($request->all());

        if($news){
            $data['code'] = 200;
            $data['result'] = $news;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    
    }
    
    public function show($id)
    {
        //This function is used to get a news by id
        $result = News::find($id);

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }
    
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }
    
    public function update(Request $request, $id)
    {
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

        $news = News::where('news_id',$id)->first();
        // $news->news_id              = $request->news_id;
        $news->news_title           = $request->news_title;
        $news->news_desc            = $request->news_desc;
        $news->news_extract         = $request->news_extract;
        $news->news_status          = $request->news_status;
        $news->news_area            = $request->news_area;
        $news->news_approval        = $request->news_approval;
        $news->news_approval_date   = $request->news_approval_date;
        $news->news_created         = $request->news_created;
        $news->media_id             = $request->media_id;
        $news->news_date            = $request->news_date;
        $news->categories           = $request->categories;
        $news->keywords             = $request->keywords;
        $news->lang_id              = $request->lang_id;
        $news->verificator_id       = $request->verificator_id;
        $news->creator_id           = $request->creator_id;
        $news->project_id           = $request->project_id;
        $news->image                = $request->image;
        $news->save();

        if($news){
            $data['code'] = 200;
            $data['result'] = $news;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }
    
    public function destroy($id)
    {
        //This function is used to delete a news by id
        $result = News::find($id);
        $result->delete();

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function getAllProjectbyStatus(Request $request){

        $project_id = $request->project_id;
        $status_id = $request->status_id;

        $result = Statuses::with('news')->whereHas('news', function($q) use($status_id, $project_id){
            $q->where('news_id', $status_id)->where("news.project_id", $project_id);
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