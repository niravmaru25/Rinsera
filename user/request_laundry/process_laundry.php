<?php

include '../components/getPrice.php';

$showForm = true;
$showSummary = false;

/*========== RESET ALL VALUES ==========*/
if (isset($_GET['reset'])) {
    unset($_SESSION['form']);
    unset($_SESSION['summary']);
    unset($_SESSION['total']);

    header("Location: user.php?page=request_laundry");
    exit;
}

/*========== GO TO SUMMARY PAGE ==========*/
if (isset($_GET['step']) && $_GET['step'] === 'summary') {
    $showForm = false;
    $showSummary = true;
}

/*========== PREVIEW ORDER ==========*/
if (isset($_POST["preview"])) {

    if (!isset($_POST['items']) || !is_array($_POST['items'])) {
        $_SESSION['msg'] = "<div class='msg error'>Select at least one cloth item!</div>";
        header("Location: user.php?page=request_laundry");
        exit();
    }

    $requiredFields = [
        'pickup_date',
        'pickup_time',
        'pickup_address',
        'delivery_address',
        'payment'
    ];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['msg'] = "<div class='msg error'>Please fill all required fields!</div>";
            header("Location: user.php?page=request_laundry");
            exit();
        }
    }

    $validQty = false;
    foreach ($_POST['items'] as $qty) {
        if (is_numeric($qty) && (int)$qty > 0) {
            $validQty = true;
            break;
        }
    }

    if (!$validQty) {
        $_SESSION['msg'] = "<div class='msg error'>Enter quantity for at least one item!</div>";
        header("Location: user.php?page=request_laundry");
        exit();
    }

        $summary = [];
        $total = 0;
        $priceMap = [
            "topwear" => 0,
            "bottomwear" => 1,
            "outerwear" => 2,
            "traditional_wear" => 3,
            "bedding" => 4,
            "accessories" => 5
        ];

        foreach ($_POST['items'] as $item => $qty) {
            if ($qty > 0) {
                $qty = (int) $qty;
                $itemPrice = $price[$priceMap[$item]] ?? 0;
                $itemTotal = $qty * $itemPrice;

                $summary[] = [
                    "name" => ucfirst(str_replace("_", " ", $item)),
                    "itemPrice" => $itemPrice,
                    "qty" => $qty,
                    "itemTotal" => $itemTotal
                ];
                $total += $itemTotal;
            }
        }
        $_SESSION['form'] = $_POST;
        $_SESSION['summary'] = $summary;
        $_SESSION['total'] = $total;

        header("Location: user.php?page=request_laundry&step=summary");
        exit();
}

$form = $_SESSION['form'] ?? [];
$summary = $_SESSION['summary'] ?? [];
$total = $_SESSION['total'] ?? 0;


/*========== EDIT BUTTON ==========*/
if (isset($_POST["edit"])) {
   header("Location: user.php?page=request_laundry");
   exit();
}

?>