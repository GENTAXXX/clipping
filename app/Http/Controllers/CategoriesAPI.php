<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesAPI extends Controller
{

    public function index()
    {
        //This function is used to get aall news
        $result = Category::all();
        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return view('categoties.index');
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        //This function is used to store a news
        $request->validate([
            'name' => 'required',
            'parent' => 'required'
        ]);

        $cat = Category::create($request->all());

        if ($cat) {
            $data['code'] = 200;
            $data['result'] = $cat;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function show($id)
    {
        //This function is used to get a news by id
        $result = Category::find($id);

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function edit(Category $cat)
    {
        return view('categories.edit', compact('categories'));
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

        $cat = Category::where('id', $id)->first();
        // $news->news_id              = $request->news_id;
        $cat->name             = $request->name;
        $cat->parent           = $request->parent;
        $cat->save();

        if ($cat) {
            $data['code'] = 200;
            $data['result'] = $cat;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function destroy($id)
    {
        //This function is used to delete a news by id
        $result = Category::find($id);
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
}
