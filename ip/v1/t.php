<?php
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

// 获取地理位置信息
function getLocationInfo($ip = null) {
    // 如果未提供IP，则获取用户IP地址
    if ($ip === null) {
        // 优先从HTTP头中获取
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }

    // 获取地理位置信息
    $location = getGeolocation($ip);

    if ($location['code'] == 0 && isset($location['data'][$ip])) {
        $data = $location['data'][$ip];
        $nation = $data['nation'] ?? '未知国家';
        $countryCode = $data['nation_code'] ?? '未知国家代码';
        $province = $data['province'] ?? '未知省份';
        $city = $data['city'] ?? '未知城市';
        $latitude = $data['latitude'] ?? '未知纬度';
        $longitude = $data['longitude'] ?? '未知经度';
        $isp = $data['isp'] ?? '未知ISP';

        return "$nation $province$city";
    } else {
        return "无法获取IP地址的地理位置信息。";
    }
}

// 使用传入的IP地址查询地理位置信息
$userIP = isset($_GET['ip']) ? $_GET['ip'] : null;
echo getLocationInfo($userIP);
?>
