<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['room', 'user']);

        if ($request->has('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'pending') {
                $query->where('is_approved', false);
            } elseif ($request->status === 'featured') {
                $query->where('is_featured', true);
            }
        }

        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('guest_name', 'like', '%' . $request->search . '%')
                    ->orWhere('guest_email', 'like', '%' . $request->search . '%')
                    ->orWhere('comment', 'like', '%' . $request->search . '%')
                    ->orWhereHas('room', function($roomQuery) use ($request) {
                        $roomQuery->where('name', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $reviews = $query->orderBy('created_at', 'desc')->paginate(20);

        // Estadísticas
        $stats = [
            'total' => Review::count(),
            'approved' => Review::where('is_approved', true)->count(),
            'pending' => Review::where('is_approved', false)->count(),
            'featured' => Review::where('is_featured', true)->count(),
            'avg_rating' => Review::where('is_approved', true)->avg('rating') ?? 0,
        ];

        return view('admin.reviews.index', compact('reviews', 'stats'));
    }

    public function show($id)
    {
        $review = Review::with(['room', 'user'])->findOrFail($id);
        return view('admin.reviews.show', compact('review'));
    }

    public function edit($id)
    {
        $review = Review::with(['room', 'user'])->findOrFail($id);
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => $request->has('is_approved'),
            'is_featured' => $request->has('is_featured'),
        ]);

        // Limpiar cache relacionado
        if ($review->room) {
            Cache::forget("room.{$review->room->slug}");
            Cache::forget("room.{$review->room->slug}.reviews.approved");
            Cache::forget("room.{$review->room->slug}.related");
        }
        Cache::forget('home.featured_reviews');
        Cache::forget('reviews.average_rating');

        return redirect()->route('admin.reviews.index')->with('success', 'Reseña actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $room = $review->room;
        
        $review->delete();

        // Limpiar cache relacionado
        if ($room) {
            Cache::forget("room.{$room->slug}");
            Cache::forget("room.{$room->slug}.reviews.approved");
            Cache::forget("room.{$room->slug}.related");
        }
        Cache::forget('home.featured_reviews');
        Cache::forget('reviews.average_rating');

        return redirect()->route('admin.reviews.index')->with('success', 'Reseña eliminada exitosamente.');
    }
}
