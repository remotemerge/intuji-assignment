<?php

declare(strict_types=1);

if (!function_exists('formatDate')) {
    /**
     * Format date string to human-readable format
     */
    function formatDate(string $strDate): string
    {
        try {
            $date = new DateTime($strDate);
            return $date->format('d/m/Y h:i A');
        } catch (Exception) {
            return '';
        }
    }
}
