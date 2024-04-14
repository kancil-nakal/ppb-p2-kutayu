<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('search');

            $query = User::query();

            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%');
                });
            }
            $data = $query->get();

            return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('level', function($row){
                $level = $row->role == 'admin' ? '<span class="badge bg-success">admin</span>' : '<span class="badge bg-info">user</span>';
                return $level;
            })
            ->addColumn('opsi', function($row){
                $editUrl = route('users.edit', $row->uuid);
                $deleteUrl = route('users.destroy', $row->uuid);
                $editBtn = '<a href="'.$editUrl.'" class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i></a>';
                $deleteBtn = '<form action="'. $deleteUrl .'" method="POST" style="display: inline-block;">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Anda yakin ingin menghapus user ini?\')"><i class="bi bi-trash"></i></button>
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                    </form>';
                $btn = '';

                if(Auth::user()->role == 'admin') {
                    $btn = Auth::user()->id !== $row->id ? $editBtn . ' ' . $deleteBtn : $editBtn;
                } else {
                    $btn = $editBtn;
                }
                return $btn;
            })
            ->rawColumns(['opsi','level'])
            ->make(true);
        }

        $data = [
            'title' => 'Penarik',
            'users' => User::paginate(5)
        ];
        return view('admin.pages.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Penarik',

        ];
        return view('admin.pages.users.add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
                'role' => 'required|in:user,admin',
            ]);

            $splitEmail = explode('@', $request->email);
            $username = str_replace(['.','-'], '', $splitEmail[0]);

            $validatedData['username'] = $username;


            User::create($validatedData);


            return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');

        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan user: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $data =[
            'title' => 'Penarik',
        ];
        $user = User::where('uuid',$id)->first();
        return view('admin.pages.users.edit', compact('user','data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         try {
            // Validasi input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:8|confirmed',
                'role' => 'required|in:user,admin',
            ]);

            // Cari user yang akan diupdate
            $user = User::findOrFail($id);

            // Update data user
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            if ($request->filled('password')) {
                $user->password = Hash::make($validatedData['password']);
            }
            $user->role = $validatedData['role'];
            $user->save();

            // Redirect ke halaman users dengan pesan sukses
            return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui.');
        } catch (\Exception $e) {
            // Tangani kesalahan
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui data user: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $user = User::where('uuid', $id)->firstOrFail();

        $user->delete();

        return redirect('/users')->with('success', 'User berhasil dihapus.');
    }
}
