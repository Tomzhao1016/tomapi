<?php
// 定义输入文件
include 'words.php';

// 设定JSON
header('Content-Type: application/json');

// 获取内容(不要要在意错误的英文)
$random_poem = $poems[array_rand($poems)];

// 返回JSON数据
echo json_encode([$random_poem]);
?>