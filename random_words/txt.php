<?php
// Include the poems array
include 'words.php';

// Get a random poem
$random_poem = $poems[array_rand($poems)];

// Display the random poem
echo $random_poem;
?>