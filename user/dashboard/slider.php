<?php

$query2 = "SELECT * FROM laundry_requests 
          WHERE status = 'processing' AND user_id = ?
          ORDER BY created_at DESC";

$stmt2 = $conn->prepare($query2);
$stmt2->bind_param("i", $id);
$stmt2->execute();
$result2 = $stmt2->get_result();

?><h2 class="dashboard-heading">Recent Orders</h2>
  <!-- REQUEST SLIDER -->
  <div class="request-slider">
    <div class="slider-wrapper">
      <button id="prevBtn" class="nav-btn left" onclick="prevSlide()">
        &#10094;
      </button>

      <!-- SLIDER -->
      <div class="slider">
        <div id="sliderTrack" class="slider-track">

          <?php if ($result2->num_rows > 0): ?>
            <?php while ($row = $result2->fetch_assoc()): ?>

              <div class="slide">
                <div class="order-card">

                  <div class="order-section">
                    <div class="wm-icon">
                      <i class="fa-solid fa-soap"></i>
                    </div>
                    <div class="order-info">
                      <h3>Order #<?= $row['request_id'] ?></h3>
                      <span class="badge">Processing</span>
                    </div>
                  </div>

                  <div class="order-section">
                    <div class="icon blue"><i class="fa-solid fa-calendar"></i></div>
                    <div>
                      <p class="label">Ordered On</p>
                      <p class="value"><?= date('d-F-Y', strtotime($row['created_at'])) ?></p>
                      <p class="sub"><?= date('h:i A', strtotime($row['created_at'])) ?></p>
                    </div>
                  </div>

                  <div class="order-section">
                    <div class="icon green"><i class="fa-solid fa-truck-fast"></i></div>
                    <div>
                      <p class="label">Pickup</p>
                      <p class="value"><?= date('d-F-Y', strtotime($row['pickup_date'])) ?></p>
                      <p class="sub"><?= ucfirst($row['pickup_time']) ?></p>
                    </div>
                  </div>

                  <div class="order-section">
                    <div class="icon purple">₹</div>
                    <div>
                      <p class="label">Amount</p>
                      <p class="amount">₹<?= $row['total'] ?></p>
                    </div>
                  </div>

                </div>
              </div>

            <?php endwhile; ?>

          <?php else: ?>

            <!-- EMPTY SLIDE -->
            <div class="slide empty-slide">
              <div class="order-card empty-card">
                <div class="empty-layout">
                  <div class="empty-left">
                    <div class="empty-icon">
                      <i class="fa-solid fa-basket-shopping"></i>
                    </div>
                  </div>

                  <div class="empty-center">
                    <h3>No laundry in progress</h3>
                    <p>Start a new request and we will take care of the rest</p>
                  </div>

                  <div class="empty-right">
                    <a href="user.php?page=request_laundry" class="empty-btn"><i
                        class="fa-solid fa-plus"></i>Create New Request</a>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <button id="nextBtn" class="nav-btn right" onclick="nextSlide()">
        &#10095;
      </button>
    </div>
    <p id="requestCounter" class="request-counter"></p>
  </div>