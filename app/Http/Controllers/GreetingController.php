<?php

namespace App\Http\Controllers;

use App\Models\Greeting;
use Illuminate\Http\Request;

class GreetingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'attendance' => 'required|in:hadir,tidak_hadir,masih_menunggu',
            'message' => 'required|string|max:500',
        ]);

        $greeting = Greeting::create($validated);

        return response()->json([
            'success' => true,
            'greeting' => $greeting,
        ]);
    }

    public function index()
    {
        return response()->json(Greeting::latest()->get());
    }
}
