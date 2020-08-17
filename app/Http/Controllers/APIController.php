<?php

namespace App\Http\Controllers;

use App\Category;
use App\Language;
use App\Media;
use App\Project;
use App\Statuses;
use App\News;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{

    public function getAllNewsbyProjectAndStatus(Request $request){

        $project_id = $request->project_id;
        $status = $request->status;

        if($status){
            $result = News::join('statuses', 'news.id','=','statuses.news_id')
            ->join('medias', 'news.media_id','=','medias.id')
            ->where('status', $status)
            ->where('project_id', $project_id)
            ->get();
        } else {
            $result = News::join('statuses', 'news.id','=','statuses.news_id')
            ->join('medias', 'news.media_id','=','medias.id')
            ->where('project_id', $project_id)
            ->get();
        }

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }

        return response($data);
    }
    
    public function getCount($project_id, $status){
        return News::join('statuses', 'news.id','=','statuses.news_id')
        ->join('medias', 'news.media_id','=','medias.id')
        ->where('status', $status)
        ->where('project_id', $project_id)
        ->count();
    }

    public function countNews(Request $request){
        $project_id = $request->project_id;

        $result['all'] = News::join('statuses', 'news.id','=','statuses.news_id')
        ->join('medias', 'news.media_id','=','medias.id')
        ->where('project_id', $project_id)
        ->count();

        $result['draft'] = $this->getCount($project_id, 'Draft');
        $result['proposed'] = $this->getCount($project_id, 'Diajukan');
        $result['approved'] = $this->getCount($project_id, 'Disetujui');
        $result['rejected'] = $this->getCount($project_id, 'Ditolak');

        if ($result) {
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
            'created' => 'required',
            'media_id' => 'required',
            'date' => 'required',
            'categories' => 'required',
            'lang_id' => 'required',
            'project_id' => 'required',
            'image' => 'required'
        ]);

        $news = News::create($request->all());

        $statuses = new Statuses();
        $statuses->status = "Draft";
        $statuses->news_id = $news->id;
        $statuses->user_id = 1;
        $statuses->save();
	
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

        if($status){
            $result = News::join('statuses', 'news.id','=','statuses.news_id')
            ->join('medias', 'news.media_id','=','medias.id')
            ->where('status', $status)
            ->where('project_id', $project_id)
            ->where('title','like',"%".$search."%")
            ->get();
        } else {
            $result = News::join('statuses', 'news.id','=','statuses.news_id')
            ->join('medias', 'news.media_id','=','medias.id')
            ->where('project_id', $project_id)
            ->where('title','like',"%".$search."%")
            ->get(); 
        }
        // $result = Statuses::with('news')->whereHas('news', function($q) use($status, $project_id, $search){
        //     $q->where('status', $status)->where("news.project_id", $project_id)->where('news.title','like',"%".$search."%");
        // })->get();

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

    public function getLanguage($id){

        $result = Language::find($id);

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->input('password');

        $result = Auth::attempt(array('email' => $email, 'password' => $password));

        if ($result) {
            $result = User::where('email', $email)->first();
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }
}
