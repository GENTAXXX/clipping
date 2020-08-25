<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;

class MediasAPI extends Controller
{

    public function index()
    {
        $result = Media::all();
        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return view('media.index');
    }

    public function create()
    {
        return view('media.create');
    }

    public function store(Request $request)
    {
        //This function is used to store a news
        $request->validate([
            'name' => 'required',
            'proviences_id' => 'required',
            'regencies_id' => 'required'

        ]);

        $media = Media::create($request->all());

        if ($media) {
            $data['code'] = 200;
            $data['result'] = $media;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function show($id)
    {
        //This function is used to get a news by id
        $result = Media::find($id);

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function edit(Media $media)
    {
        return view('media.edit', compact('medias'));
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

        $media = Media::where('id', $id)->first();
        // $news->news_id              = $request->news_id;
        $media->name              = $request->name;
        $media->proviences_id     = $request->proviences_id;
        $media->regencies_id      = $request->regencies_id;
        $media->save();

        if ($media) {
            $data['code'] = 200;
            $data['result'] = $media;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function destroy($id)
    {
        //This function is used to delete a news by id
        $result = Media::find($id);
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
