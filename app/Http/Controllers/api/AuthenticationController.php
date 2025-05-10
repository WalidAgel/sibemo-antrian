<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthenticationController extends Controller {

    public function login(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|min:4',
                'password' => 'required|string',
            ], [
                'name.required' => 'Nama harus diisi!',
                'name.min' => 'Nama minimal 4 karakter',
            ]);

            $credentials = $request->only('name', 'password');

            if ($token = Auth::attempt($credentials)) {
                $user = User::where('name', $request->name)->first();
                $token = $user->createToken('token')->plainTextToken;

                // Include roles in response
                $roles = $user->getRoleNames();

                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil login',
                    'data' => $token,
                    'user' => $user,
                    'roles' => $roles
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Pengguna tidak diketahui'
            ], 401);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function me(Request $request)
    {
        try {
            $user = $request->user();
            // Include roles in response
            $roles = $user->getRoleNames();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil mendapatkan data pengguna',
                'data' => $user,
                'roles' => $roles
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string|min:4|unique:users,name',
                'password' => 'required|string|min:6',
                'email' => 'required|email|unique:users,email',
                'role' => 'nullable|string|in:admin,pelanggan'
            ]);

            $username = $request->username;
            $password = Hash::make($request->password);
            $email = $request->email;
            // Default role is 'pelanggan' if not specified
            $role = $request->role ?? 'pelanggan';

            $user = User::create([
                'name' => $username,
                'password' => $password,
                'email' => $email
            ]);

            // Assign role
            $user->assignRole($role);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil register pengguna',
                'data' => $user,
                'role' => $role
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        try {
            // Revoke all tokens
            $request->user()->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil logout'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
