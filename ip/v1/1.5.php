<?php
// 获取用户IP地址
function getUserIP() {
    // 优先从HTTP头中获取
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// 通过外部API获取地理位置信息
function getGeolocation($ip) {
    $url = "https://webapi-pc.meitu.com/common/ip_location?ip={$ip}";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// 获取用户IP地址
$userIP = getUserIP();

// 获取地理位置信息
$location = getGeolocation($userIP);

if ($location['code'] == 0 && isset($location['data'][$userIP])) {
    $data = $location['data'][$userIP];
    $nation = $data['nation'] ?? '未知国家';
    $countryCode = $data['nation_code'] ?? '未知国家代码';
    $province = $data['province'] ?? '未知省份';
    $city = $data['city'] ?? '未知城市';
    $latitude = $data['latitude'] ?? '未知纬度';
    $longitude = $data['longitude'] ?? '未知经度';
    $isp = $data['isp'] ?? '未知ISP';

    echo "您的IP地址是：[$userIP] ";
    echo "来自：$nation($countryCode) $province$city ";
    echo "坐标：($latitude, $longitude) ";
    echo "ISP：$isp";
} else {
    echo "无法获取IP地址的地理位置信息。";
}
?>
