/*========== LOGOUT ==========*/
function openlogout() {
  document.querySelector("#logout").style.display = "flex";
}

function closelogout() {
  document.querySelector("#logout").style.display = "none";
}

/*========== CUSTOMER DETAIL MODAL ==========*/
function openCustomerModal(
  date,
  time,
  p_address,
  d_address,
  additional_details,
  payment,
) {
  document.querySelector("#customerModal").style.display = "flex";

  document.querySelector("#date").innerHTML = date;
  document.querySelector("#time").innerHTML = time;
  document.querySelector("#p_address").innerHTML = p_address;
  document.querySelector("#d_address").innerHTML = d_address;
  document.querySelector("#additional_details").innerHTML = additional_details;
  document.querySelector("#payment").innerHTML = payment;
}

function closeCustomerModal() {
  document.querySelector("#customerModal").style.display = "none";
}

/*========== LAUNDRY SUMMARY MODAL ==========*/
function openLaundryModal(id, total) {
  fetch("../components/view_summary.php?laundry_id=" + id)
    .then((res) => res.text())
    .then((data) => {
      document.querySelector("#laundrytablebody").innerHTML = data;
      document.querySelector("#totalRow").innerText = "Total ₹" + total;
    });

    document.querySelector("#laundryModal").style.display = "flex";
}

function closeLaundryModal() {
  document.querySelector("#laundryModal").style.display = "none";
}

/*========== SIDEBAR TOGGLE BUTTON ==========*/
const sidebar = document.querySelector(".sidebar");
const menuToggle = document.getElementById("menuToggle");
const closeSidebar = document.getElementById("closeSidebar");

menuToggle.addEventListener("click", function () {
  sidebar.classList.add("active");
});

closeSidebar.addEventListener("click", function () {
  sidebar.classList.remove("active");
});

document.addEventListener("click", function (e) {
  if (
    sidebar.classList.contains("active") &&
    !sidebar.contains(e.target) &&
    e.target !== menuToggle
  ) {
    sidebar.classList.remove("active");
  }
});
