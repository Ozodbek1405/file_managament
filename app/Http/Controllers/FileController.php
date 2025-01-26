<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function upload(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file('file');
        $hash = md5_file($file->getRealPath());

        $existingFile = File::where('hash', $hash)->first();
        if ($existingFile) {
            return response()->json(['message' => 'File already exists']);
        }

        $path = $file->store('files');

        File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'hash' => $hash,
            'user_id' => auth()->id(),
        ]);

        return response()->json(['message' => 'File uploaded successfully']);
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->can('view_all_files')) {
            $files = File::all();
        } elseif ($user->can('view_own_files')) {
            $files = File::where('user_id', $user->id)->get();
        } else {
            return response()->json(['error' => 'Fayllarni ko‘rishga ruxsat yo‘q'], 403);
        }

        return response()->json($files);
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $file = File::findOrFail($id);

        if ($user->can('delete_all_files')) {
            $file->delete();
        } elseif ($user->can('delete_user_files')) {
            if ($file->user->hasRole('admin')) {
                return response()->json(['error' => 'Adminning fayllarini o‘chirish taqiqlangan'], 403);
            }
            $file->delete();
        } elseif ($user->can('delete_own_files') && $file->user_id === $user->id) {
            $file->delete();
        } else {
            return response()->json(['error' => 'Faylni o‘chirishga ruxsat yo‘q'], 403);
        }

        return response()->json(['success' => 'Fayl muvaffaqiyatli o‘chirildi']);
    }

}
