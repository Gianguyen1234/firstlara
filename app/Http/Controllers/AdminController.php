<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Mews\Purifier\Facades\Purifier;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all posts
        $posts = Post::with('category')->get();

        // Pass the posts to the view
        return view('admin.posts.index', compact('posts'));
    }
    public function showAnalytics()
    {
        // Fetch total user data (this is an example)
        $totalUsers = 1234;
        return view('admin.analytics', compact('totalUsers'));
    }


}
