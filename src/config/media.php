<?php

return [
    
    //--------------------------------------------------------------------------
    // TMDB default
    //--------------------------------------------------------------------------
    'default' => [
        'url' => 'https://api.themoviedb.org/3/',
        'headers' => [
            'Authorization' => 'Bearer ' . env('TMDB_TOKEN'),
            'Accept'        => 'application/json',
        ],
        'endpoints' => [
            'search' => 'search/{media_type}',
            'list' => 'discover/{media_type}',
            'media' => '{media_type}/{media_id}',
        ],
        'params' => [
            'person' => ['append_to_response' => 'combined_credits'],
            'media' => ['append_to_response' => 'credits,videos'],
            'search' => ['query' => '{search_query}'],
            'default' => ['language' => 'en-US|sv'],
        ],
    ],
    //--------------------------------------------------------------------------
    // TMDB Media
    //--------------------------------------------------------------------------
    'tmdb' => [
        'search' => [
            'endpoint' => 'default.endpoints.search',
            'params' => '.default.params.search',
        ],
        'person' => [
            'endpoint' => 'default.endpoints.media',
            'params' => '.default.params.person',
        ],
        'tv' => [
            'endpoint' => 'default.endpoints.media',
            'params' => '.default.params.media',
        ],
        'movie' => [
            'endpoint' => 'default.endpoints.media',
            'params' => '.default.params.media',
        ],
        //--------------------------------------------------------------------------
        // TMDB lists
        //--------------------------------------------------------------------------
        'trailer' => [
            'label' => 'Upcoming Trailers',
            'subtitle' => 'Upcoming movie trailers',
            'endpoint' => 'default.endpoints.list',
            'media_type' => 'movie',
            'params' => [
                'region' => '2',
                'with_original_language' => 'en',
                'sort_by' => 'popularity.desc',
                'primary_release_date.gte' =>  ['now' => 0],
            ],
        ],
        'upcoming' => [
            'label' => 'Upcoming Movies',
            'subtitle' => 'Movies to watch out for this summer',
            'endpoint' => 'default.endpoints.list',
            'media_type' => 'movie',
            'params' => [
                'region' => '2',
                'with_original_language' => 'en',
                'sort_by' => 'popularity.desc',
                'primary_release_date.gte' =>  ['now' => 0],
            ],
        ],
        'cinema' => [
            'label' => 'Showing In Theatres',
            'subtitle' => 'High rated movies available in cinemas',
            'endpoint' => 'default.endpoints.list',
            'media_type' => 'movie',
            'params' => [
                'region' => '2',
                'with_original_language' => 'en|sv',
                'sort_by' => 'revenue.desc',
                'primary_release_date.gte' =>  ['now' => -90],
                'primary_release_date.lte' =>  ['now' => 0],
            ],
        ],
        'revenue' => [
            'label' => 'Top Box Office',
            'subtitle' => 'Previous months',
            'endpoint' => 'default.endpoints.list',
            'media_type' => 'movie',
            'params' => [
                'region' => '2',
                'with_original_language' => 'en',
                'sort_by' => 'revenue.desc',
                'primary_release_date.gte' =>  ['now' => -30],
                'primary_release_date.lte' => ['now' => 0],
            ],
        ],
        'tvshows' => [
            'label' => 'TV Shows This Week',
            'subtitle' => 'Upcoming shows to watch during the next 7 days',
            'endpoint' => 'default.endpoints.list',
            'media_type' => 'tv',
            'params' => [
                'region' => '2',
                'with_original_language' => 'en|sv',
                'sort_by' => 'popularity.desc',
                'air_date.gte' =>  ['now' => 0],
                'air_date.lte' =>  ['now' => 7],
            ],
        ],
    ],
    //--------------------------------------------------------------------------
    // local lists | GLOBAL | depending on user interactions
    //--------------------------------------------------------------------------
    'local' => [
        // global ratings
        'rating' => [
            'label' => 'NPMDb Top Rated',
            'subtitle' => 'Exclusive ranking list by NPMDb users',
            'media_types' => ['movie', 'tv'],
            'isAuth' => false,
            'key' => 'rating',
        ],
        // global views
        'popular' => [
            'label' => 'NPMDb Most Popular',
            'subtitle' => 'What this community finds most interesting',
            'media_types' => ['movie', 'tv'],
            'isAuth' => false,
            'key' => 'popular_views'
        ],
        // global views
        'celebrities' => [
            'label' => 'Popular Celebrities',
            'subtitle' => 'Most watched actors and actresses',
            'media_types' => ['person'],
            'isAuth' => false,
            'key' => 'popular_views',
        ],
        // global views
        'trending' => [
            'label' => 'Trending',
            'subtitle' => 'Recently visisted among all users',
            'media_types' => ['movie', 'tv'],
            'isAuth' => false,
            'key' => 'recent_views',
        ],
        //--------------------------------------------------------------------------
        // local lists | USER | unique to user
        //--------------------------------------------------------------------------
        'favorites' => [
            'label' => 'Favorites',
            'subtitle' => 'My personal favorites',
            'media_types' => ['movie', 'tv'],
            'isAuth' => true,
            'key' => 'userlists',
        ],
        'watchlist' => [
            'label' => 'Watchlist',
            'subtitle' => 'Shows and movies to watch',
            'media_types' => ['movie', 'tv'],
            'isAuth' => true,
            'key' => 'userlists',
        ],
        'recent' => [
            'label' => 'Recently Viewed',
            'subtitle' => 'Last seen by me',
            'media_types' => ['movie', 'tv'],
            'isAuth' => true,
            'key' => 'recent_views',
        ],
        'rated' => [
            'label' => 'My Top Rated',
            'subtitle' => 'The truth is out there',
            'media_types' => ['movie', 'tv'],
            'isAuth' => true,
            'key' => 'rating',
        ],
        'custom' => [
            'label' => 'Custom Lists',
            'subtitle' => 'My personal choice',
            'media_types' => ['movie', 'tv'],
            'isAuth' => true,
            'key' => 'userlists',
        ],
    ],
    //--------------------------------------------------------------------------
    // list of lists to render
    //--------------------------------------------------------------------------
    'list_page' => [
        // order to render lists
        'home' => [
            'trailer'     => 'tmdb',
            'rating'      => 'local',
            'cinema'      => 'tmdb',
            'watchlist'   => 'local',
            'celebrities' => 'local',
            'trending'    => 'local',
            'upcoming'    => 'tmdb',
            'revenue'     => 'tmdb',
            'popular'     => 'local',
            'tvshows'     => 'tmdb',
        ],
        'profile' => [
            //'favorites' => 'local',
            'watchlist' => 'local',
            'recent'    => 'local',
            'rated'     => 'local',
            //'custom'    => 'local',
        ],
    ],
];