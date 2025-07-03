<?php

namespace App\Services;

use Illuminate\Support\Arr;

class ConfigService {
    protected static array $config;

    protected static function load(): void {
        if (!isset(self::$config)) {
            self::$config = config('media');
        }
    }

    public static function baseUrl(): string {
        self::load();
        return rtrim(self::$config['default']['url'], '/') . '/';
    }

    public static function headers(): array {
        self::load();
        return self::$config['default']['headers'];
    }

    public static function get(string $path): mixed {
        self::load();
        return Arr::get(self::$config, $path);
    }

    public static function getTitle(string $source, string $identifier): string {
        self::load();
        return self::$config[$source][$identifier]['label'];
    }

    public static function getSubtitle(string $source, string $identifier): string {
        self::load();
        return self::$config[$source][$identifier]['subtitle'];
    }

    public static function tmdbDefinition(string $identifier): array {
        self::load();
        return self::$config['tmdb'][$identifier];
    }

    public static function tmdbMediaType(string $identifier): string {
        self::load();
        return self::$config['tmdb'][$identifier]['media_type'];
    }

    public static function localDefinition(string $identifier): array {
        self::load();
        return self::$config['local'][$identifier] ?? null;
    }

    public static function pagelists(string $page): array {
        self::load();
        return self::$config['list_page'][$page];
    }
}
