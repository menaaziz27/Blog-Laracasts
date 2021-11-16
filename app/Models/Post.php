<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $data, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $data;
        $this->body = $body;
        $this->slug = $slug;
    }

    public function all()
    {
        return cache()->rememberForever("posts.all", function () {
            return collect(File::files(resource_path('posts')))->map(function($file) {
                return YamlFrontMatter::parseFile($file);
            })-> map(function ($document) {
                return new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                );
            });
        });
    }

    public function find($slug)
    {
        return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug)
    {
        $post =  static::find($slug);

        if(!$post)
        {
            throw new ModelNotFoundException();
        }

        return $post;
    }
}
