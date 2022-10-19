<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = User::query()
            ->find(Auth::user()->id)
            ->userTodos()
            ->where('finished', false)
            ->orderByDesc('deadline')
            ->paginate(5);

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
        // user_idをマージする
        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        $data = $request->merge(['finished' => 0])->all();
        // 作成されたTodoデータをDBに登録
        $result = Todo::create($data);

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
        //バリデーション
        $validator = Validator::make($request->all(), [
            'task' => 'required | max:191',
            'deadline' => 'required',
            'importance' => 'required | integer | between:1,3',
            'description' => 'required',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->route('todo.edit', $id)
                ->withInput()
                ->withErrors($validator);
        }

        // 要注意！！
        // データ更新処理ではuser_idはマージしない。
        // 同時に2つのユーザーでログインしているとアクティブ状態のユーザーのidが
        // Auth::user()となる。
        $result = Todo::find($id)->update($request->all());
        return redirect()->route('todo.index');
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


    public function finished(Request $request, $id)
    {
        // 完了の判定
        // $temp = $this->updateFinishedColumn($id);
        $update_finished = Todo::where('id', $id);      // Todoテーブルから$idのデータを取得
        $data = $update_finished->value('finished');    // get finished column value
        $update_finished->update(['finished'=>!$data]);
        return redirect()->route('todo.index');         // todo一覧画面へリダイレクト
    }


    public function unfinished(Request $request, $id)
    {
        // $temp = $this->updateFinishedColumn($id);
        $update_finished = Todo::where('id', $id);      // Todoテーブルから$idのデータを取得
        $data = $update_finished->value('finished');    // get finished column value
        $update_finished->update(['finished'=>!$data]);
        return redirect()->route('todo.finishedList');         // todo一覧画面へリダイレクト
    }


    // public function updateFinishedColumn($id)
    // {
    //     // finishedカラムの値を反転させる関数
    //     $update_finished = Todo::where('id', $id);      // Todoテーブルから$idのデータを取得
    //     $data = $update_finished->value('finished');    // get finished column value
    //     ddd($data);
    //     $update_finished->update(['finished'=>!$data]); // DBのfinishedカラムの値を更新
    //     return null;    // 何も返さない
    // }


    public function finishedList()
    {
        $todos = User::query()
            ->find(Auth::user()->id)
            ->userTodos()
            ->where('finished', true)
            ->orderByDesc('deadline')
            ->paginate(5);

        $id = Auth::user();
        $todo = Todo::find($id);

        // ddd($todos);
        return view('todo.index', compact('todos', 'todo'));
    }
}
