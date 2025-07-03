<?php

namespace App\Http\Controllers;

use App\DTO\MediaItemDTO;
use Illuminate\Http\Request;
use App\Managers\MediaManager;
use App\Services\MediaRatingService;
use App\Services\ReviewService;
use App\Support\MediaViewLogger;

class MediaController extends Controller {
    public function __construct(
        protected MediaManager $fetcher,
        protected MediaRatingService $ratings,
        protected ReviewService $reviews,
        protected MediaViewLogger $logger
    ) {}

    public function search(Request $request) {
        $query = $request->input('q');
        $type = $request->input('type');
        $results = $this->ratings->injectRatings($this->fetcher->fetchSearch($type,$query));

        return view('media.search', compact('query', 'type', 'results'));
    }

    public function showMovie(int $id) {
        return view('media.movie', array_merge([
            'movie' => $this->load('movie', $id)
            ], 
            $this->getReviews('movie', $id)
        ));
    }

    public function showTv(int $id) {
        return view('media.tv', array_merge([
            'tv' => $this->load('tv', $id)
            ], 
            $this->getReviews('tv', $id)
        ));
    }

    public function showPerson(int $id) {
        $person = $this->fetcher->fetch('person', $id);
        $this->logger->log($person);
        return view('media.person', compact('person'));
    }

    protected function getReviews(string $type, int $id): array {
        return [
            'reviews' => $this->reviews->fetchForMedia($type, $id),
            'userReview' => $this->reviews->fetchUserReview($type, $id),
        ];
    }

    protected function load(string $type, int $id): MediaItemDTO {
        $media = $this->fetcher->fetch($type, $id);
        $this->logger->log($media);
        return $this->ratings->injectRatings([$media])[0];
    }
    
}
