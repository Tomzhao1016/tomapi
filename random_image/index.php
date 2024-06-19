<?php
// 设置链接列表文件路径
$linkFile = 'image_links.txt';

// 检查文件是否存在
if (!file_exists($linkFile)) {
    http_response_code(500);
    echo 'Link file not found';
    exit;
}

// 读取文件中的所有链接
$links = file($linkFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// 检查是否有链接
if ($links === false || count($links) == 0) {
    http_response_code(404);
    echo 'No image links found';
    exit;
}

// 随机选择一个链接
$randomLink = $links[array_rand($links)];

// 重定向到随机选择的链接
header('Location: ' . $randomLink);
exit;
?>