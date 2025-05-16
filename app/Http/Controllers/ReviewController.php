<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index(): View
    {
        $reviews = Review::with('user')->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create(): View
    {
        return view('admin.reviews.create');
    }

    public function store(StoreReviewRequest $request): RedirectResponse
    {
        $this->reviewService->create($request->validated());
        return redirect()->route('reviews.index')->with('success', 'Review added successfully!');
    }

    public function edit(Review $review): View
    {
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(StoreReviewRequest $request, Review $review): RedirectResponse
    {
        $this->reviewService->update($review, $request->validated());
        return redirect()->route('reviews.index')->with('success', 'Review updated successfully!');
    }

    public function destroy(Review $review): RedirectResponse
    {
        $this->reviewService->delete($review);
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully!');
    }
}
