<?php

namespace App\Http\Controllers;

use App\Project;
use App\Users_Roles;
use Illuminate\Http\Request;

class ProjectAPI extends Controller
{
    public function addContributorAndEditor(Request $request){

        $request->validate([
            'name' => 'required'
        ]);

        $role = Users_Roles::create($request->all());

        $UserRole = new Users_Roles();
        $UserRole->project_id = $request->project_id;
        $UserRole->user_id = $request->user_id;
        $UserRole->role_id = $request->role_id;
        $UserRole->save();

        if ($role) {
            $data['code'] = 200;
            $data['result'] = $role;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

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
        return view('project.index');
    }

    public function create()
    {
        $result = Users_Roles::create();
        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return view('project.create');
    }

    public function store(Request $request)
    {
        //This function is used to store a news
        $request->validate([
            'name' => 'required',
            'desc' => 'required'
            
        ]);

        $project = Project::create($request->all());

        $UserRole = new Users_Roles();
        $UserRole->project_id = $project->id;
        $UserRole->user_id = $request->user_id;
        $UserRole->role_id = $request->role_id;
        $UserRole->save();

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
        return view('project.edit', compact('news'));
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

        $project = Project::where('id', $id)->first();
        // $news->news_id              = $request->news_id;
        $project->name          = $request->name;
        $project->desc          = $request->desc;
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
