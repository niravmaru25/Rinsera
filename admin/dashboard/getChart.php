<?php

$sql = "SELECT 
            DATE(created_at) AS date,
            SUM(total) AS revenue
        FROM laundry_requests
        WHERE created_at >= DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%Y-%m-01')
          AND created_at < DATE_FORMAT(CURDATE(), '%Y-%m-01')
        GROUP BY DATE(created_at)
        ORDER BY date";

$result = $conn->query($sql);

$dates = [];
$revenues = [];

while ($row = $result->fetch_assoc()) {
    $dates[] = date('d M', strtotime($row['date']));
    $revenues[] = $row['revenue'];
}

?>