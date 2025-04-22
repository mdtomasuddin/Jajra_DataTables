<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query();
            return DataTables::eloquent($users)
                ->addIndexColumn()
                ->addColumn('created_at', function ($user) {
                    return Carbon::parse($user->created_at)->format('y-m-d');
                })
                ->addColumn('updated_at', function ($users) {
                    return Carbon::parse($users->updated_at)->format('y-m-d');
                })

                ->addColumn('action', function ($user) {
                    return  '
                        <a href="' . route('users.edit', $user->id) . '" class="btn btn-primary btn-sm">Edit</a>
                        <a data-id="' . $user->id . '" href="' . route('users.destroy', $user->id) . '"  class="btn btn-danger btn-sm  ">Delete</a>
                    ';
                })

                ->rawColumns(['action'])
                ->make(true);
        };
        return view('user');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        dd($user);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
            return response()->json(['status'=>'success','message' => 'User deleted successfully.']);
        } else {
            return response()->json(['status'=>'failed','message' => 'User not found.'], 404);
        }
    }
}
