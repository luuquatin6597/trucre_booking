<?php
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

if (!function_exists('format_usd')) {
    function format_usd($amount)
    {
        return '$' . number_format($amount, 0, '.', ',');
    }
}
if (!function_exists('format_currency')) {

    function getExchangeRate($fromCurrency, $toCurrency)
    {
        $cacheKey = "exchange_rate_{$fromCurrency}_{$toCurrency}";
        $rate = Cache::get($cacheKey);

        if (!$rate) {
            $client = new Client();
            $apiKey = env('EXCHANGE_RATE_API_KEY');
            $url = "https://api.exchangerate-api.com/v4/latest/{$fromCurrency}?apikey={$apiKey}";

            try {
                $response = $client->request('GET', $url);
                $data = json_decode($response->getBody(), true);
                if (isset($data['rates'][$toCurrency])) {
                    $rate = $data['rates'][$toCurrency];
                    Cache::put($cacheKey, $rate, now()->addHours(12)); // Cache for 12 hours
                    return $rate;
                }
                return 1;
            } catch (\Exception $e) {
                return 1;
            }
        }

        return $rate;
    }


    function format_currency($amount, $currency)
    {
        $symbol = '';
        $decimal = 0;
        switch ($currency) {
            case 'USD':
                $symbol = '$';
                $decimal = 0;
                break;
            case 'VND':
                $symbol = '₫';
                $decimal = 0;
                break;
            case 'EUR':
                $symbol = '€';
                $decimal = 2;
                break;
            case 'GBP':
                $symbol = '£';
                $decimal = 2;
                break;
            default:
                $symbol = '$';
                $decimal = 0;
        }

        return $symbol . number_format($amount, $decimal, '.', ',');
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
