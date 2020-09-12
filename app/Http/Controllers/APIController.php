<?php

namespace App\Http\Controllers;

use App\Category;
use App\Keyword;
use App\Language;
use App\Media;
use App\Project;
use App\Statuses;
use App\News;
use App\News_Categories;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{

    public function getAllNewsbyProjectAndStatus(Request $request)
    {

        $project_id = $request->project_id;
        $status = $request->status;

        if ($status) {
            $result = News::join('statuses', 'news.id', '=', 'statuses.news_id')
            ->join('medias', 'news.media_id', '=', 'medias.id')
            ->where('status', $status)
            ->where('project_id', $project_id)
            ->get()
            ->map(function ($result){
                $result->image = url('data_file/'.$result->image);
                return $result;
            });
        } else {
            $result = News::join('statuses', 'news.id', '=', 'statuses.news_id')
            ->join('medias', 'news.media_id', '=', 'medias.id')
            ->where('project_id', $project_id)
            ->get()
            ->map(function ($result){
                $result->image = url('data_file/'.$result->image);
                return $result;
            });
        }

//	$result['image'] = url('data_file/'.$result['image']);

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
        ->where('status', $status)
        ->where('project_id', $project_id)
        ->count();
    }

    public function countNews(Request $request)
    {
        $project_id = $request->project_id;

        $result['all'] = News::where('project_id', $project_id)
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

    public function addNews(Request $request)
    {
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
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $image = $request->file('image');
        $name = time()."_".$image->getClientOriginalName();
        $destination = 'data_file';
        $image->move($destination, $name);
        $request = new Request($request->all());
        $request->merge([
            'image' => $name
        ]);

        $news = News::create($request->all());
        
        $categories = "";
        $categoriesId = str_replace("[","",$request->categories); //menghilangkan [
        $categoriesId = str_replace("]","",$categoriesId); //menghilangkan ]
        $categoriesId = explode(",", $categoriesId); //memecah string jadi array of ids
        foreach ($categoriesId as $key => $category) {
            $cat = Category::find($category); //mencari kategori berdasar id nya
            $categories = $categories.$cat->name.","; //memasukkan kategori ke var categories supaya hasilnya "politik, ekonomi,"

            $ncat = new News_Categories(); //membuat obj ncat
            $ncat->news_id = $news->id; 
            $ncat->cat_id = $cat->id;
            $ncat->save(); //menyimpan data category di table news categories
        }
        $newsUpdate = News::where('id', $news->id)->first();
        $newsUpdate->categories = $categories; //mengupdate data categories pada table news
        $newsUpdate->save();

        $statuses = new Statuses();
        $statuses->status = "Draft";
        $statuses->news_id = $news->id;
        $statuses->user_id = $request->user_id;
        $statuses->save();

        $keyword = new Keyword();
        $keyword->news_id = $news->id;
        $keyword->name = $request->keywords;
        $keyword->save();

        if ($news) {
            $data['code'] = 200;
            $data['result'] = $news;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

	public function getKeywordsByNewsId($id){
		$result = Keyword::where("news_id",$id)->first();
		if($result){
			$data['code'] = 200;
			$data['result'] = $result;
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

        $news = News::where('id', $id)->first();
        // $news->news_id              = $request->news_id;
        $news->title           = $request->title;
        $news->desc            = $request->desc;
        $news->content         = $request->content;
        $news->area            = $request->area;
        $news->content         = $request->content;
        $news->scan            = $request->scan;
        $news->created         = $request->created;
        $news->date            = $request->date;
        $news->media_id        = $request->media_id;
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

    public function updateStatus(Request $request, $id){

        $result = Statuses::where('news_id', $id)->update([
            'status' => $request->status,
            'user_id' => $request->user_id
        ]);

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);

    }

    public function deleteNewsById($id){

        $result = News::where('id', $id)->delete();

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function searchNewsByTitle(Request $request)
    {

        $project_id = $request->project_id;
        $status = $request->status;
        $search = $request->search;

        if ($status) {
            $result = News::join('statuses', 'news.id', '=', 'statuses.news_id')
            ->join('medias', 'news.media_id', '=', 'medias.id')
            ->where('status', $status)
                ->where('project_id', $project_id)
                ->where('title', 'like', "%" . $search . "%")
                ->get()
                ->map(function ($result){
                    $result->image = url('data_file/'.$result->image);
                    return $result;
                });
        } else {
            $result = News::join('statuses', 'news.id', '=', 'statuses.news_id')
            ->join('medias', 'news.media_id', '=', 'medias.id')
            ->where('project_id', $project_id)
                ->where('title', 'like', "%" . $search . "%")
                ->get()
                ->map(function ($result){
                    $result->image = url('data_file/'.$result->image);
                    return $result;
                });
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

    public function getLanguage($id)
    {

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

    public function login(Request $request)
    {
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

    public function upload(){
        $result = News::get();
        return view('upload',['news' => $result]);
    }

    // public function uploadProses(Request $request){
    //     $this->validate($request, [
    //         'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
    //     ]);

    //     $image = $request->file('image');
    //     $name = time()."_".$image->getClientOriginalName();
    //     $destination = 'data_file';
    //     $image->move($destination, $name);

    //     // News::create([
    //     //     'image' => $name
    //     // ]);

    //     return redirect()->back();
    // } 
}
