<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Review;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // Cache de habitaciones destacadas (15 minutos) - datos que cambian poco
        $featuredRooms = Cache::remember('home.featured_rooms', 900, function () {
            return Room::where('is_available', true)
                ->orderBy('sort_order')
                ->with(['primaryImage', 'images'])
                ->take(3)
                ->get();
        });

        // Cache de reseñas destacadas (30 minutos) - datos que cambian poco
        $featuredReviews = Cache::remember('home.featured_reviews', 1800, function () {
            return Review::where('is_featured', true)
                ->where('is_approved', true)
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        });

        // Cache de galería (1 hora) - datos que cambian muy poco
        $gallery = Cache::remember('home.gallery', 3600, function () {
            return Gallery::where('is_active', true)
                ->orderBy('sort_order')
                ->take(8)
                ->get();
        });

        return view('home', compact('featuredRooms', 'featuredReviews', 'gallery'));
    }
}
