<?php

$result = $conn->query("SELECT price FROM pricing");
$prices = [];

while ($row = $result->fetch_assoc()) {
    $price[] = $row["price"];
}

?>