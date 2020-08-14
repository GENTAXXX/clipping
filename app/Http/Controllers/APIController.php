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
    public function index()
    {
        //This function is used to get aall news
        $result = News::all();
        if ($result) {
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

    public function show($id)
    {
        //This function is used to get a news by id
        $result = News::find($id);

        if ($result) {
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

    public function destroy($id)
    {
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

    public function search(Request $request){

        $search = $request->search;
        $result = News::where('title','like',"%".$search."%")->paginate(2);
        return view('index',compact('news'));

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function getListProject(){

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

    public function getListMedia()
    {

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

    public function getListCategories()
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

    public function getListLanguage()
    {

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

    public function getAllProjectbyStatus(Request $request)
    {

        $project_id = $request->project_id;
        $status_id = $request->status_id;

        $result = Statuses::with('news')->whereHas('news', function ($q) use ($status_id, $project_id) {
            $q->where('news_id', $status_id)->where("news.project_id", $project_id);
        })->get();

        if ($request->count) {
            if (!$result->isEmpty()) {
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

    public function getAllProjectbyStatusAndUser(Request $request){

        $project_id = $request->project_id;
        $status_id = $request->status_id;
        $user_id = $request->user_id;

        $result = Statuses::with('news')->whereHas('news', function ($q) use ($status_id, $project_id, $user_id) {
            $q->where('news_id', $status_id)->where("news.project_id", $project_id)->where("news.user_id", $user_id);
        })->get();

        if ($request->count) {
            if (!$result->isEmpty()) {
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
}