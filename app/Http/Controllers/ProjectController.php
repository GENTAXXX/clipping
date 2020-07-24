<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
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

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        //This function is used to store a news
        $request->validate([
            'project_name' => 'required',
            'project_year' => 'required',
            'role_id' => 'required'
            
        ]);

        $project = Project::create($request->all());

        if ($project) {
            $data['code'] = 200;
            $data['result'] = $project;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function show($id)
    {
        //This function is used to get a news by id
        $result = Project::find($id);

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function edit(Project $project)
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

        $project = Project::where('project_id', $id)->first();
        // $news->news_id              = $request->news_id;
        $project->project_name          = $request->news_title;
        $project->project_year          = $request->news_desc;
        $project->role_id               = $request->news_extract;
        $project->save();

        if ($project) {
            $data['code'] = 200;
            $data['result'] = $project;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function destroy($id)
    {
        //This function is used to delete a news by id
        $result = Project::find($id);
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
