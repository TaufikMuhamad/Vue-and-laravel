<?php

namespace App\Http\Controllers\Api;

use App\Models\Hobi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HobiController extends Controller
{
        public function index()
        {
            $hobis = Hobi::all();
            return response()->json($hobis);
        }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $hobi = Hobi::create($validated);

        return response()->json($hobi, 201);
    }
}
