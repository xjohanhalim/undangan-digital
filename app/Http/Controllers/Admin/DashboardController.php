<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rsvp;
use App\Models\Event;
use App\Models\Gallery;
use App\Exports\RsvpExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $event = Event::latest()->get();
        $rsvps = Rsvp::latest()->get();
        return view('admin.dashboard', compact('event', 'rsvps'));
    }

    public function editEvent()
    {
        $event = Event::first();
        return view('admin.event-edit', compact('event'));
    }

    public function updateEvent(Request $request)
    {
        $request->validate([
            'bride_name' => 'required',
            'groom_name' => 'required',
            'event_date' => 'required|date',
            'location'   => 'required',
            'map_link'   => 'required',
        ]);

        $event = Event::first();

        if (!$event) {
            $event = \App\Models\Event::create($request->all());
        } else {
            $event->update($request->all());
        }

        return back()->with('success', 'Data event berhasil diperbarui');
    }

    public function gallery()
    {
        $photos = Gallery::latest()->get();
        return view('admin.gallery', compact('photos'));
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('gallery', 'public');

        Gallery::create([
            'image' => $path
        ]);

        return back()->with('success', 'Foto berhasil ditambahkan');
    }

    public function deleteGallery($id)
    {
        Gallery::findOrFail($id)->delete();
        return back()->with('success', 'Foto berhasil dihapus');
    }

    public function exportExcel()
    {
        return Excel::download(new RsvpExport, 'rsvp.xlsx');
    }

    public function exportPdf()
    {
        $rsvps = \App\Models\Rsvp::all();
        $pdf = Pdf::loadView('admin.rsvp-pdf', compact('rsvps'));
        return $pdf->download('rsvp.pdf');
    }
}
