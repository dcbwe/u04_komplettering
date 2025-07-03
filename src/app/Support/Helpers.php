<?php

if (!function_exists('colorShadow')) {
    function colorShadow(): string {
        $colors = [
            'border-sky-400',
            'border-rose-500',
            'border-green-400',
            'border-pink-400',
            'border-cyan-400',
            'border-fuchsia-500',
            'border-teal-400',
            'border-violet-500',
            'border-yellow-400',
            'border-purple-400',
        ];
        return $colors[array_rand($colors)];
    }
}
