<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    //construct
    public function __construct()
    {
        //add auth middleware
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //todo item for single_user
        $result = Auth::user()->todo()->get();
        if(!$result->isEmpty()){
            return view('todo.dashboard',['todos'=>$results,'images'=>Auth::user()->single_userimage]);
        }else{
            return view('todo.dashboard',['todos'=>false,'images'=>Auth::user()->single_userimage]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return form add new item
        return view('todo.addtodo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store todo new items after add
        //check empty ?
        $this->validator($request->all())->validate();
        //if not = store
        if(Auth::user()->todo()->Create($request->all())){
            return $this->index();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //show single todo items
        return view('todo.todo',['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        // show form edit todo
        return view('todo.edittodo',['todo' => $todo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //update DB
        //validate first
        $this->validator($request->all())->validate();
        if($todo->fill($request->all())->save()){
            return $this->show($todo);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //delete list
        if($todo->delete()){
            return back();
        }
    }

    /**
     * Protected Function
     */

    /**
    * Get a validator for an incoming Todo request.
    *
    * @param  array  $request
    * @return \Illuminate\Contracts\Validation\Validator
    */
    // make sure fields not empty
    Protected function validator(array $request)
    {
        return Validator::make($request, [
            'todo'          => 'required',
            'description'   => 'required',
            'category'      => 'required' 
        ])
    }
}
