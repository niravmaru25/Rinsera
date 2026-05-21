<!-- Greeting -->
<?php

$hour = date("H");
if ($hour < 12) {
    $greet = 'Good Morning';
} elseif ($hour < 17) {
    $greet = 'Good Afternoon';
} else {
    $greet = 'Good Evening';
}

?>