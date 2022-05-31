<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $posts = PostService::getPosts();

        return view('dashboard', compact('posts'));
    }
}
