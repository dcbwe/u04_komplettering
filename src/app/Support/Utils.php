<?php

namespace App\Support;

class Utils {
    public static function interpolate(string $template, array $data): string {
        return preg_replace_callback(
            '/{(\w+)}/',
            fn($m) => $data[$m[1]] ?? '',
            $template
        );
    }

    public static function interpolateArray(array $template, array $data): array {
        return array_map(fn($v) =>
            is_string($v) ? self::interpolate($v, $data) : $v,
            $template
        );
    }

    public static function interpolateChains(array $chains, array $data): array {
        return collect($chains)->map(fn($step) => [
            'method' => $step['method'],
            'args' => collect($step['args'])->map(
                fn($arg) => is_string($arg) ? self::interpolate($arg, $data) : $arg
            )->all()
        ])->all();
    }
}
