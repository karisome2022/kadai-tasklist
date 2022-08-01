<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        //タスク一覧を取得
        $tasks = Task::all();
        
        //取得したタスクを一覧画面で表示
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    // getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        //フォームの入力項目のためにインスタンスを作成
        $task = new Task;
        
        //タスクの作成画面を表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    // postでtasks/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        //タスク作成
        $task = new Task;
        $task->content = $request->content;
        $task->save();
        
        //トップページへ
        return redirect('/');
    }

    // getでtasks/（任意のid）にアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        //idの値からタスクを検索し取得
        $task = Task::findOrFail($id);
        
        //取得したタスクを詳細画面で表示
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    // getでtasks/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        //idの値からタスクを検索し取得
        $task = Task::findOrFail($id);
        
        //取得したタスクを編集画面で表示
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    // putまたはpatchでtasks/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        //idの値からタスクを検索し取得
        $task = Task::findOrFail($id);
        //タスクを更新
        $task->content = $request->content;
        $task->save();
        
        //トップページへ
        return redirect('/');
    }

    // deleteでtasks/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        //idの値からタスクを検索し取得
        $task = Task::findOrFail($id);
        //タスクを削除
        $task->delete();
        
        //トップページへ
        return redirect('/');
    }
}