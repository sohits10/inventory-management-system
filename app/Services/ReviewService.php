<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public function create(array $data): Review
    {
        $data['user_id'] = Auth::id();
        return Review::create($data);
    }

    public function update(Review $review, array $data): Review
    {
        $review->update($data);
        return $review;
    }

    public function delete(Review $review): bool
    {
        return $review->delete();
    }
}
