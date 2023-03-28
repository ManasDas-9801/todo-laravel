<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TodoController extends Controller
{
    public function index(Request $request) {
        $search = '';
        if($request->has('search')) {
            $search = $request->search;
        }
        $user_id = Auth::user()->id;
        $data['todos'] = Todo::whereUserId($user_id)
                        ->where('title', 'LIKE', '%'.$search.'%')
                        ->orWhere('desc', 'LIKE', '%'.$search.'%')
                        ->orderBy('created_at', 'desc')->get();
        return view('dashboard', $data);
    }

    public function store(Request $request) {
       try {
            $this->validate($request,[
                'desc'=>'required',
            ]);
            $user_id = Auth::user()->id;
            $todo = new Todo;
            $todo->user_id = $user_id;
            $todo->title = $request->title;
            $todo->desc = $request->desc;
            $todo->status = $request->status;
            $todo->save();
            return redirect('todo')->with('success', 'Todo Taks Created Successfully !!');
       } catch (Exception $e) {
            return redirect('todo')->with('error', $e->getMessage());
       }
    }
    public function update(Request $request) {
       try {
            $this->validate($request,[
                'desc'=>'required',
            ]);
            $todo = Todo::find($request->todo_id);
            $todo->title = $request->title;
            $todo->desc = $request->desc;
            $todo->status = $request->status;
            $todo->save();
            return redirect('todo')->with('success', 'Todo Taks updatedjn Successfully !!');
       } catch (Exception $e) {
            return redirect('todo')->with('error', $e->getMessage());
       }
    }
    public function changeStatus(Request $request) {
       try {
            $user = Auth::user();
            $todo = Todo::find($request->todo_id);
            if($request->has('todo')) {
                $todo->is_priority = $request->is_priority;
                
            }
            else{
                $todo->is_priority = '0';
                
            }
            $todo->save();
            $new = Todo::whereId($request->todo)->first();
            $email = $user->email;
            Mail::send('email_view', ['todo' => $new], function ($message) use ($email) {
                $message->to($email)
                    ->subject('New Priority Taks');
            });
            return redirect('todo')->with('success', 'Todo Taks added to priority Successfully !!');
       } catch (Exception $e) {
            return redirect('todo')->with('error', $e->getMessage());
       }
    }

    public function edit($id) {
        $data['item'] = Todo::whereId($id)->first();
        return view('edit_model', $data);
    }

    public function show($id) {
        $data['item'] = Todo::whereId($id)->first();
        return view('view_model', $data);
    }
    public function destroy($id) {
        $item = Todo::whereId($id)->first();
        $item->delete();
        return redirect('todo')->with('success', 'Todo Taks deleted Successfully !!');
    }
}
