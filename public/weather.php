<?php
// 1. 気象庁のAPIのURL（例として「栃木県」の地域コードを指定）
// 090000 = 栃木県
$url = "https://www.jma.go.jp/bosai/forecast/data/forecast/090000.json";

// 2. APIからデータを取得する（インターネット上のファイルを開くイメージです）
$response = file_get_contents($url);

if ($response === FALSE) {
    die('データの取得に失敗しました。');
}

// 3. 届いたJSONデータを、PHPの「配列」に変換する
$weatherData = json_decode($response, true);

// 4. 配列から「今日の天気（文字）」をピンポイントで抽出する
// 気象庁のデータ構造は少し深いので、このように指定します
$todayWeather = $weatherData[0]['timeSeries'][0]['areas'][0]['weathers'][0];

// 5. 画面に表示する
echo "<h1>本日の栃木県の天気</h1>";
echo "<p>今日の天気は 【 " . htmlspecialchars($todayWeather, ENT_QUOTES, 'UTF-8') . " 】 です。</p>";
?>