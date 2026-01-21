<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'attendance' => 'required',
            'message' => 'nullable|string'
        ]);

        Rsvp::create([
            'name' => $request->name,
            'attendance' => $request->attendance,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Terima kasih atas konfirmasi kehadirannya');
    }
}