<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();
            return response()->json([
                'status' => 200,
                'message' => 'Lista de usuarios obtenida',
                'data' => $users
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error al obtener la lista de usuarios: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $user = User::create($request->all());
            return response()->json([
                'status' => 201,
                'message' => 'Usuario creado',
                'data' => $user
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error al crear el usuario: ' . $e->getMessage(),
                'data' => null
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'status' => 200,
                'message' => 'Usuario encontrado',
                'data' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuario no encontrado o error: ' . $e->getMessage(),
                'data' => null
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->all());
            return response()->json([
                'status' => 200,
                'message' => 'Usuario actualizado',
                'data' => $user
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuario no encontrado o error al actualizar: ' . $e->getMessage(),
                'data' => null
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Usuario eliminado',
                'data' => null
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Usuario no encontrado o error al eliminar: ' . $e->getMessage(),
                'data' => null
            ], 404);
        }
    }
}