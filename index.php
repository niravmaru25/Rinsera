<?php
session_start();
require_once 'db.php';
include 'auth/loginAuth.php';
include 'auth/signupAuth.php';
include 'components/getPrice.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <?php include 'auth/authModal.php'; ?>

    <header>
        <div class="heading">
            <img src="assets/images/logo.png" alt="logo" id="logo">
            <h2>Rinsera</h2>
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>

        <nav class="navbar">
            <div class="nav-links">
                <a href="#home">Home</a>
                <a href="#service">Services</a>
                <a href="#pricing">Pricing</a>
                <a href="#about">About</a>
            </div>

            <div class="nav-auth">
                <a onclick="openModal()" id="btn">Log in / Sign up</a>
            </div>
        </nav>
    </header>

    <main>
        <section id="home">
            <div class="home-content">
                <h1>Laundry Made Simple</h1>
                <p>Fast, reliable, and eco-friendly laundry service at your doorstep.</p>

                <div class="features">
                    <span>✔ Free Pickup</span>
                    <span>✔ Affordable Pricing</span>
                    <span>✔ 20+ Years Experience</span>
                </div>
            </div>
        </section>

        <section id="service">
            <h2>Our Services</h2>
            <div id="container">
                <div class="service">
                    <img src="assets/images/service1.png" alt="service-1">
                    <h1>Wash & Fold</h1>
                    <p>Professional washing, drying, and neat folding for your daily clothes, towels, and bedding.
                    </p>
                </div>

                <div class="service">
                    <img src="assets/images/service2.png" alt="service-2">
                    <h1>Dry & Cold</h1>
                    <p>Specialist eco-friendly cleaning and cold-press finishing for suits, silks, and woolens to
                        preserve texture and fit.</p>
                </div>

                <div class="service">
                    <img src="assets/images/service3.png" alt="service-2">
                    <h1>Commercial Services</h1>
                    <p>Reliable, high-volume laundry management for hotels, gyms, and restaurants with scheduled
                        pickups and deliveries.</p>
                </div>
            </div>
        </section>

        <section id="pricing">
            <h2>See our affordable pricing</h2>
            <div class="price-container">
                <div class="card">
                    <img src="assets/images/topwear.png" alt="topwear">
                    <div class="price">
                        <h3>Topwear</h3>
                        <p>₹ <?php echo $price[0]; ?></p>
                    </div>
                </div>

                <div class="card">
                    <img src="assets/images/bottomwear.png" alt="bottomwear">
                    <div class="price">
                        <h3>Bottomwear</h3>
                        <p>₹ <?php echo $price[1]; ?></p>
                    </div>
                </div>

                <div class="card">
                    <img src="assets/images/outerwear.png" alt="outerwear">
                    <div class="price">
                        <h3>OuterWear</h3>
                        <p>₹ <?php echo $price[2]; ?></p>
                    </div>
                </div>

                <div class="card">
                    <img src="assets/images/traditional_wear.png" alt="traditional_wear">
                    <div class="price">
                        <h3>Traditional Wear</h3>
                        <p>₹ <?php echo $price[3]; ?></p>
                    </div>
                </div>

                <div class="card">
                    <img src="assets/images/bedding.png" alt="bedding">
                    <div class="price">
                        <h3>Bedding</h3>
                        <p>₹ <?php echo $price[4]; ?></p>
                    </div>
                </div>

                <div class="card">
                    <img src="assets/images/accessories.png" alt="accessories">
                    <div class="price">
                        <h3>Accessories</h3>
                        <p>₹ <?php echo $price[5]; ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section id="about">
            <h2>About Us</h2>
            <p>Rinsera Laundry Services is dedicated to making your life easier by providing fast, reliable, and
                high-quality laundry and dry-cleaning solutions. We understand how busy life can get, and we are here to
                take the hassle out of cleaning your clothes, bedding, and household fabrics. Our team uses modern
                equipment, eco-friendly detergents, and proven techniques to ensure your garments and fabrics are
                treated with care. From everyday clothing to delicate fabrics like silk and wool, we guarantee a
                thorough, gentle, and professional cleaning service every time. We believe in transparency and
                affordability. With clear pricing and no hidden charges, you always know exactly what you are paying
                for. Customer satisfaction is our top priority, and we strive to deliver your clothes fresh, clean, and
                perfectly folded—right on time. <br>
                <strong>Our Mission:</strong> To make laundry stress-free while providing exceptional care for your
                fabrics.<br>
                <strong>Our Vision:</strong> A community where clean clothes and happy customers go hand in hand.
            </p>
        </section>

    </main>

    <footer>
        <div class="upper-content">
            <div class="left-content">
                <h3>Contact us</h3>
                <div class="contact-item">
                    <a><i class="fa-solid fa-phone icon phone"></i>+91 8758644365</a>
                    <a href="mailto:rinsera.support@gmail.com?subject=Rinsera%20Support%20Query"><i class="fa-solid fa-envelope icon email"></i>rinsera.support@gmail.com</a>
                </div>
            </div>

            <div class="right-content">
                <h3>Follow us</h3>
                <div class="social-icon">
                    <a href="#" class="yt"><i class="fa-brands fa-youtube"></i>Youtube</a>
                    <a href="#" class="wa"><i class="fa-brands fa-whatsapp"></i>Whatsapp</a>
                </div>
            </div>
        </div>

        <div class="center-content">
            <p>&copy; All rights reserved <?php echo date('Y'); ?> | Developed by Nirav Maru</p>
        </div>
    </footer>

    <script src="assets/js/index.js"></script>

    <script>
        window.addEventListener("DOMContentLoaded", () => {
            <?php if (isset($_SESSION["showModal"])): ?>
                openModal();
                <?php
                if ($_SESSION["showModal"] == "signup")
                    echo "opensignup();";
                if ($_SESSION["showModal"] == "login")
                    echo "openlogin();";
                unset($_SESSION["showModal"]);
                ?>
            <?php endif; ?>
        });
    </script>
</body>

</html>