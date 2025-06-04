<?php
header("Content-Type: text/plain");

if (isset($_GET['number'])) {
    $number = $_GET['number'];
    $apiUrl = "https://turecaller.pikaapis0.workers.dev/?number=" . urlencode($number);

    $response = @file_get_contents($apiUrl);
    if ($response === false) {
        echo "❌ API Error (possibly 502 Bad Gateway). Please try again later.";
        exit;
    }

    $data = json_decode($response, true);

    $truecallerName = $data['Truecaller'] ?? '';
    if (strtolower(trim($truecallerName)) === "no name found") {
        $name = $data['Unknown'] ?? 'Unknown';
    } else {
        $name = $truecallerName;
    }

    $carrier = $data['carrier'] ?? 'Unknown';
    $country = $data['country'] ?? 'Unknown';
    $international = $data['international_format'] ?? $number;

    $flags = [
        "Bangladesh" => "🇧🇩",
        "India" => "🇮🇳",
        "Kenya" => "🇰🇪",
        "Pakistan" => "🇵🇰",
        "United States" => "🇺🇸"
    ];
    $flag = $flags[$country] ?? '';

    echo "Number: $international\n";
    echo "Country: $country $flag\n";
    echo "🔍 TrueCaller Says:\n";
    echo "Name: $name\n";
    echo "Carrier: $carrier\n";
    echo "[Main Api Provider Cahnnel](https://t.me/treasure_king_tk) | [Join Our Vip Channel](https://t.me/+CZui8RQStGlkNGVl) | [Creadit : Md Tanvir Islam](https://t.me/IslamTanvir0)\n";
} else {
    echo "❗ Please provide a number like this: ?number=+8801717805472";
}
