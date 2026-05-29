<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function frontendIndex()
    {
        // Ambil 1 video yang di-Pin (jika ada)
        $pinnedVideo = Video::where('statusVideo', 'Pinned')->first();

        // Ambil semua video yang berstatus Published, urutkan dari yang terbaru
        $otherVideos = Video::where('statusVideo', 'Published')
                            ->orderBy('idVideo', 'desc')
                            ->get();

        return view('frontend.seputar_prodi.video', compact('pinnedVideo', 'otherVideos'));
    }
    public function index()
    {
        // Mengurutkan agar video yang Pinned berada di paling atas, disusul video terbaru
        $videos = Video::orderByRaw("FIELD(statusVideo, 'Pinned', 'Published', 'Draft') ASC")
                       ->orderBy('idVideo', 'desc')
                       ->get();

        return view('admin.seputar_prodi.video', compact('videos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judulVideo'  => 'required|string|max:255',
            'statusVideo' => 'required|in:Published,Draft,Pinned',
            'urlYoutube'  => 'required|url'
        ]);

        // Jika status yang dipilih adalah 'Pinned', ubah video Pinned sebelumnya menjadi 'Published'
        if ($request->statusVideo == 'Pinned') {
            Video::where('statusVideo', 'Pinned')->update(['statusVideo' => 'Published']);
        }

        Video::create($request->all());

        return back()->with('success', 'Data video berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'judulVideo'  => 'required|string|max:255',
            'statusVideo' => 'required|in:Published,Draft,Pinned',
            'urlYoutube'  => 'required|url|max:255'
        ]);

        // Jika status yang diupdate adalah 'Pinned', ubah video Pinned lain menjadi 'Published'
        if ($request->statusVideo == 'Pinned') {
            Video::where('idVideo', '!=', $id)
                 ->where('statusVideo', 'Pinned')
                 ->update(['statusVideo' => 'Published']);
        }

        $video->update($request->all());

        return back()->with('success', 'Data video berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return back()->with('success', 'Data video berhasil dihapus.');
    }
}
