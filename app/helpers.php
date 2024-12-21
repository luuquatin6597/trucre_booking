<?php
if (!function_exists('format_usd')) {
    function format_usd($amount)
    {
        return '$' . number_format($amount, 0, '.', ',');
    }
}
if (!function_exists('calculate_discount')) {
    function calculate_discount($price, $comparePrice)
    {
        if ($comparePrice <= 0 || $price <= 0 || $comparePrice <= $price) {
            return 0; // Không giảm giá hoặc giá trị không hợp lệ
        }
        return '-' . round((($comparePrice - $price) / $comparePrice) * 100, 2) . '%';
    }
}

?>