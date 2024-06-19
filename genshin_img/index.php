<?php

// 数据库连接配置
$servername = "localhost";
$username = "genshinimg";
$password = "A123";
$dbname = "genshinimg";

// 创建数据库连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接是否成功
if ($conn->connect_error) {
    http_response_code(500);
    exit("Database connection failed: " . $conn->connect_error);
}

// 生成缓存键（使用时间戳作为唯一标识）
$cacheKey = time();

// 查询数据库获取缓存数据
$sql = "SELECT cache_data FROM cache_table WHERE cache_key = '$cacheKey'";
$result = $conn->query($sql);

// 如果缓存数据存在，则直接重定向
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $randomImage = $row["cache_data"];
    if (strpos($randomImage, 'http') === false) {
        // 如果缓存数据中不包含完整的图片路径，则补全路径
        $randomImage = 'img/' . $randomImage;
    }
    header("Location: $randomImage");
    exit();
}

// 如果缓存数据不存在，则重新生成缓存
$imageFolder = dirname(__FILE__) . '/img/';
$files = array_values(array_filter(scandir($imageFolder), function($file) {
    return !in_array($file, ['.', '..']);
}));

// 从文件数组中随机选择一个图片文件
$randomImage = $files[array_rand($files)];

// 插入缓存数据到数据库
$sql = "INSERT INTO cache_table (cache_key, cache_data) VALUES ('$cacheKey', '$randomImage')";
if ($conn->query($sql) !== TRUE) {
    http_response_code(500);
    exit("Failed to insert cache data into database: " . $conn->error);
}

// 构建随机图片的完整路径
$imageUrl = 'img/' . $randomImage;

// 执行重定向到随机图片链接
header("Location: $imageUrl");
exit();
