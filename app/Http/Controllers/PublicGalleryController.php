<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostImage;

class PublicGalleryController extends Controller
{
    public function gallery()
    {
        $images = PostImage::with('post')
            ->latest()
            ->paginate(24);

        return view('public.gallery', compact('images'));
    }
}
