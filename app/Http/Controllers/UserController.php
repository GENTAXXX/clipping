<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //This function is used to get aall news
        $result = User::all();
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
        return view('user.create');
    }

    public function store(Request $request)
    {
        //This function is used to store a news
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'organization' => 'required',
            'phone' => 'required'
        ]);

        $image = $request->file('image');
        $name = time() . "_" . $image->getClientOriginalName();
        $destination = 'user_file';
        $image->move($destination, $name);
        $request = new Request($request->all());
        $request->merge([
            'image' => $name
        ]);

        $user = User::create($request->all());

        if ($user) {
            $data['code'] = 200;
            $data['result'] = $user;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function show($id)
    {
        //This function is used to get a news by id
        $result = User::find($id);

        if ($result) {
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
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
        //     'user' => 'required',
        //     'keywords' => 'required',
        //     'lang_id' => 'required',
        //     'verificator_id' => 'required',
        //     'creator_id' => 'required',
        //     'image' => 'required',
        // ]);

        // $result = News::update($request->all());

        $user = User::where('id', $id)->first();
        // $news->news_id              = $request->news_id;
        $user->name             = $request->name;
        $user->email            = $request->email;
        $user->password         = $request->password;
        $user->image            = $request->image;
        $user->role             = $request->role;
        $user->organization     = $request->organization;
        $user->phone            = $request->phone;
        $user->save();

        if ($user) {
            $data['code'] = 200;
            $data['result'] = $user;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function destroy($id)
    {
        //This function is used to delete a news by id
        $result = User::find($id);
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
