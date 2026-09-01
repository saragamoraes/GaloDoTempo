<?php
require_once __DIR__ . '/config.php';

function fetchThingSpeakData(): ?array
{
    $url = THINGSPEAK_BASE_URL . rawurlencode(THINGSPEAK_CHANNEL_ID) . '/feeds/last.json';
    if (THINGSPEAK_READ_API_KEY !== '') {
        $url .= '?api_key=' . rawurlencode(THINGSPEAK_READ_API_KEY);
    }

    $response = false;
    if (function_exists('curl_init')) {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 6,
            CURLOPT_CONNECTTIMEOUT => 4,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERAGENT => 'GaloDoTempo/1.0',
        ]);
        $response = curl_exec($curl);
        $httpCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($response === false || $httpCode < 200 || $httpCode >= 300) {
            return null;
        }
    } else {
        $context = stream_context_create(['http' => ['timeout' => 6, 'ignore_errors' => true]]);
        $response = @file_get_contents($url, false, $context);
        if ($response === false) {
            return null;
        }
    }

    $data = json_decode($response, true);
    if (!is_array($data) || !isset($data['field1'])) {
        return null;
    }

    $temperature = filter_var($data['field1'], FILTER_VALIDATE_FLOAT);
    $humidity = isset($data['field2']) ? filter_var($data['field2'], FILTER_VALIDATE_FLOAT) : null;
    if ($temperature === false || $humidity === false) {
        return null;
    }

    return [
        'temperature' => (float) $temperature,
        'humidity' => (float) $humidity,
        'updated_at' => $data['created_at'] ?? null,
    ];
}

function getWeatherData(): array
{
    $demoHumidity = isset($_GET['demo_humidity']) ? (float) $_GET['demo_humidity'] : null;
    $sensor = $demoHumidity === null ? fetchThingSpeakData() : null;
    $temperature = $sensor['temperature'] ?? 20.0;
    $humidity = max(0, min(100, $demoHumidity ?? ($sensor['humidity'] ?? 50.0)));

    if ($humidity <= 39) {
        $condition = 'seco';
        $label = 'Seco';
        $description = 'Ar seco / tempo mais estável';
        $theme = 'dry';
        $accent = '#8fddff';
    } elseif ($humidity <= 69) {
        $condition = 'moderado';
        $label = 'Moderado';
        $description = 'Umidade moderada / mudança nas condições do tempo';
        $theme = 'moderate';
        $accent = '#c59bff';
    } else {
        $condition = 'muito-umido';
        $label = 'Muito úmido';
        $description = 'Ar muito úmido / possibilidade de chuva';
        $theme = 'very-humid';
        $accent = '#ff9fc5';
    }

    return [
        'condition' => $condition,
        'label' => $label,
        'temperature' => round($temperature, 1),
        'feels_like' => round($temperature, 1),
        'location' => 'Americana, SP',
        'description' => $description,
        'humidity' => round($humidity, 0),
        'theme' => $theme,
        'accent' => $accent,
        'updated_at' => $sensor['updated_at'] ?? null,
        'source' => $sensor ? 'ThingSpeak / DHT11' : 'Modo demonstrativo',
    ];
}

function weatherIcon(string $condition): string
{
    return match ($condition) {
        'seco' => '☼',
        'moderado' => '◌',
        default => '♥',
    };
}

function e(string|int|float|null $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
