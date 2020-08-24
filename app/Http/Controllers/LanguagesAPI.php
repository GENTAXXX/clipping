<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class LanguagesAPI extends Controller
{
    
    public function index()
    {
        //This function is used to get aall news
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
    
    public function create()
    {
        return view('news.create');
    }
    
    public function store(Request $request)
    {
        //This function is used to store a news
        $request->validate([
            'lang_name' => 'required',
            'lang_code' => 'required'
        ]);

        $lang = Language::create($request->all());

        if($lang){
            $data['code'] = 200;
            $data['result'] = $lang;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    
    }
    
    public function show($id)
    {
        //This function is used to get a news by id
        $result = Language::find($id);

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }
    
    public function edit(Language $lang)
    {
        return view('news.edit', compact('languages'));
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

        $lang = Language::where('id',$id)->first();
        // $news->news_id              = $request->news_id;
        $lang->name           = $request->name;
        $lang->code            = $request->code;
        $lang->save();

        if($lang){
            $data['code'] = 200;
            $data['result'] = $lang;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }
    
    public function destroy($id)
    {
        //This function is used to delete a news by id
        $result = Language::find($id);
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
}