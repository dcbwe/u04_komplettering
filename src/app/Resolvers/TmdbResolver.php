<?php

namespace App\Resolvers;

use App\Services\ConfigService;
use App\Support\Utils;

class TmdbResolver {
    public function resolveHeaders(): array {
        return ConfigService::headers();
    }

    public function resolveEndpoint(string $identifier, array $context): string {
        return ConfigService::baseUrl().Utils::interpolate(
            ConfigService::get(ltrim(ConfigService::tmdbDefinition($identifier)['endpoint'], '.')),
            array_merge([
                'media_type' => ConfigService::tmdbDefinition($identifier)['media_type'] ?? null], 
                $context
            )
        );
    }

    public function resolveParams(string $identifier, array $context): array {
        return Utils::interpolateArray(
            $this->resolveCarbonSettings(
                array_merge(
                    ConfigService::get('default.params.default') ?? [],
                    is_string($p = ConfigService::tmdbDefinition($identifier)['params'] ?? [])
                        ? ConfigService::get(ltrim($p, '.'))
                        : $p
                )
            ),
            $context
        );
    }

    protected function resolveCarbonSettings(array $params): array {
        return collect($params)->map(function ($val) {
            return match (true) {
                is_array($val) && isset($val['now']) =>
                    now()->addDays($val['now'])->toDateString(),
                default => $val
            };
        })->all();
    }
}

