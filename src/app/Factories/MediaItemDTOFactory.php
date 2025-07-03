<?php

namespace App\Factories;

use App\DTO\Contracts\MediaItemDTOInterface;
use App\DTO\{PersonDTO, TvShowDTO, MovieDTO};
use App\DTO\Nested\{CompanyCollection, CreditSet, GenreCollection, IndividualCreditSet, VideoCollection};

class MediaItemDTOFactory {
    public static function mapItem(array $data): MediaItemDTOInterface {
        if (!isset($data['media_type'])) {
            throw new \InvalidArgumentException("Missing media_type in TMDb item.");
        }
        return match ($data['media_type']) {
            'person' => new PersonDTO(
                $data['id'],
                $data['adult'],
                $data['name'],
                $data['profile_path'] ?? null,
                $data['biography'] ?? '',
                $data['known_for_department'] ?? '',
                IndividualCreditSet::individualCredits($data['combined_credits'] ?? []),
                $data['birthday'] ?? null,
                $data['place_of_birth'] ?? null,
                $data['deathday'] ?? null,
            ),
            'tv' => new TvShowDTO(
                $data['id'],
                $data['adult'],
                $data['name'],
                $data['poster_path'] ?? null,
                $data['overview'] ?? '',
                GenreCollection::fromArray($data['genres'] ?? []),
                $data['first_air_date'] ?? '',
                $data['tagline'] ?? '',
                $data['number_of_seasons'] ?? 0,
                $data['number_of_episodes'] ?? 0,
                CompanyCollection::fromArray($data['production_companies'] ?? []),
                CreditSet::fromCredits($data['credits'] ?? []),
                VideoCollection::fromArray($data['videos']['results'] ?? []),
            ),
            'movie' => new MovieDTO(
                $data['id'],
                $data['adult'],
                $data['title'],
                $data['poster_path'] ?? null,
                $data['overview'] ?? '',
                $data['release_date'] ?? '',
                $data['revenue'] ?? 0,
                $data['budget'] ?? 0,
                GenreCollection::fromArray($data['genres'] ?? []),
                $data['runtime'] ?? 0,
                $data['tagline'] ?? '',
                CompanyCollection::fromArray($data['production_companies'] ?? []),
                CreditSet::fromCredits($data['credits'] ?? []),
                VideoCollection::fromArray($data['videos']['results'] ?? []),
            ),
            default => throw new \InvalidArgumentException("Unsupported media type: {$data['media_type']}")
        };
    }
}