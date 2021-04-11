<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;

class DownloadController extends Controller
{
    public function index()
    {
        $url = request()->url;

        return inertia('Process', compact('url'));
    }

    public function download()
    {
        request()->validate([
            'url' => 'required|string|url',
        ]);

        $regex = [
            'ytb' => '/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/',
            'tw' => '/^https?:\/\/twitter\.com\/(?:#!\/)?(\w+)\/status(es)?\/(\d+)/',
        ];

        $check = 0;
        foreach ($regex as $key => $reg) {
            $check += preg_match($reg, request()->url);
        }
        if (! $check) {
            dd('error fréro');
        }

        $yt = new YoutubeDl();
        $yt->setBinPath('D:/laragon/bin/youtube-dl/youtube-dl.exe');

        $collection = $yt->download(
            Options::create()
                ->downloadPath(Storage::disk('public')->path('/'))
                ->url(request()->url)
        );

        foreach ($collection->getVideos() as $video) {
            if ($video->getError() !== null) {
                echo "Error downloading video: {$video->getError()}.";
            } else {
                return response()->json();
                // $video->getFile(); // \SplFileInfo instance of downloaded file
            }
        }
    }
}
