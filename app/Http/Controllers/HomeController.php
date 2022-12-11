<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Models\Comment;
use App\Models\post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=post::with(['comments'=> function($q){
            $q->select('id','post_id','comment');
        }])->get();
        return view('home',compact('posts'));
    }
    public function SaveComment(Request $request){
        Comment::create([
           'post_id'=>$request->post_id,
           'user_id'=>auth()->id(),
           'comment'=>$request->post_content,
        ]);
        $data=[
            'post_id'=>$request->post_id,
            'user_id'=>auth()->id(),
            'comment'=>$request->post_content,
        ];
        event(new  NewNotification($data));
        return redirect()->back()->with(['success'=>'تم اضافه التعليق ']);
    }
}
