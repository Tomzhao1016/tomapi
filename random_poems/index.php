<?php
// Include the poems array
include 'poems.php';

// Set the Content-Type to application/json
header('Content-Type: application/json');

// Get a random poem
$random_poem = $poems[array_rand($poems)];

// Return the poem as a JSON response
echo json_encode(['poem' => $random_poem]);
?>