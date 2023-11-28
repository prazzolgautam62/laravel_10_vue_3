<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_by = $request->sort_by ?? 'id';
        $sort_direction = $request->sort_direction ?? 'asc';
        $search_query = $request->search_query;
        $users =  User::orderBy($sort_by, $sort_direction)
        ->when($search_query, function ($query) use ($search_query) {
            return $query->where('name', 'like', '%' . $search_query . '%')->orWhere('email', 'like', '%' . $search_query . '%');
        })
        ->paginate(10);
        return response()->json(['status'=>true,'message'=>'Users retrived successfully','data'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        // Create a new user
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Set a dummy password (you may want to generate a secure password in a real scenario)
        $user->password = Hash::make('password');

        // Save the user
        $user->save();

        // You can also return a response or redirect as needed
        return response()->json(['status'=>true, 'message' => 'User created successfully', 'data'=>$user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          // Find the user by the custom identifier
          $user = User::find($id);

          if (!$user) {
              // Handle the case where the user is not found
              return response()->json(['status'=>false,'message' => 'User not found'], 404);
          }
  
          // Validate the incoming request data
          $validatedData = $request->validate([
              'name' => 'required|string|max:255',
              'email' => 'required|email|max:255',
          ]);
  
          // Update the user with the validated data
          $user->update($validatedData);
  
          // Optionally, you can return a response or redirect
          return response()->json(['status'=>true,'message' => 'User updated successfully','data'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
