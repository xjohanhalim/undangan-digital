<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $event = Event::first();
        $photos = Gallery::latest()->get();
        $guestName = $request->query('to');

        // 👉 INI INTINYA
        $theme = $event->theme ?? 'islamic-gold';

        return view('frontend.home', compact(
            'event',
            'photos',
            'guestName',
            'theme'
        ));
    }
}
