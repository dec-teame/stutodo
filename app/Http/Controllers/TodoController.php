<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $todos = [];
        $todos = Todo::getAllOrderByDeadline();
        // ddd($todos);
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            // 検証ルールを追加
            // between:a, b -> aからbまでの数字
            'task' => 'required | max:191',
            'deadline' => 'required',
            'importance' => 'required | integer | between:1,3',
            'description' => 'required',
        ]);
        // バリデーション:エラーの時
        if ($validator->fails()) {
            return redirect()
                ->route('todo.create')
                ->withInput()
                ->withErrors($validator);
        }
        // 作成されたTodoデータをDBに登録
        $result = Todo::create($request->all());

        // ルーティング「todo.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        return view('todo.show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::find($id);
        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Todo::find($id)->delete();
        return redirect()->route('todo.index');
    }
}
