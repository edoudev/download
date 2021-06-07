<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;

class MainController extends Controller
{
    public function index()
    {
        request()->validate([
            'url' => 'required|string|url',
        ], [
            'url.url' => 'Veuillez entrer une URL valide.',
        ]);

        $errors = [];

        $yt = new YoutubeDl();
        $yt->setBinPath(config('download.youtubedl_binpath'));

        $yt = $yt->download(
        Options::create()
            ->downloadPath(Storage::disk('local')->path('/'))
            ->url(request()->url)
            ->skipDownload(true)
            ->output(time())
        );

        $video = $yt->getVideos()[0];

        if ($video->getError() !== null) {
            $errors += [
                'scraper' => 'Une erreur s\'est produite',
            ];
        } else {
            $video = $video->toArray();

            switch ($video['extractor']) {
                case 'twitter':
                    $video['formats'] = array_filter($video['formats'], function ($format) {
                        return $format['protocol'] === 'https';
                    });

                    $content = [
                        'formats' => $video['formats'],
                        'title' => $video['uploader'],
                        'author' => '@' . $video['uploader_id'],
                        'author_url' => $video['uploader_url'],
                    ];
                    break;
                case 'youtube':
                    $video['formats'] = array_filter($video['formats'], function ($format) {
                        if ($format['acodec'] != 'none' && $format['protocol'] == 'https') {
                            return $format;
                        }
                    });

                    $content = [
                        'formats' => $video['formats'],
                        'title' => $video['title'],
                        'author' => $video['channel'],
                        'author_url' => $video['channel_url'],
                    ];
                break;
                case 'soundcloud':
                    $video['formats'] = array_filter($video['formats'], function ($format) {
                        return $format['protocol'] === 'http';
                    });

                    $content = [
                        'formats' => $video['formats'],
                        'title' => $video['title'],
                        'author' => $video['uploader'],
                        'author_url' => $video['uploader_url'],
                    ];
                    break;
                default:
                    $errors += [
                        'scraper' => 'Cette plateforme n\'est pas supportée',
                    ];

                    break;
            }
        }

        if ($errors) {
            return redirect()->back()->withErrors($errors);
        } else {
            $content += [
                'thumbnail' => $video['thumbnail'],
                'duration' => $video['duration'],
                'url' => $video['webpage_url'],
            ];

            return inertia('Process', compact('content'));
        }
    }
}
