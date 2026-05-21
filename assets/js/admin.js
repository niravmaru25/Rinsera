/*========== REGISTERED USERS MODAL ==========*/
function openRegUser(id, name, mobile, email, role, status) {
  document.getElementById("update_profile").style.display = "flex";

  document.getElementById("id").value = id;
  document.getElementById("name").value = name;
  document.getElementById("mobile").value = mobile;
  document.getElementById("email").value = email;
  document.getElementById("role").value = role;
  document.getElementById("status").value = status;
}

function closeRegUser() {
  document.getElementById("update_profile").style.display = "none";
}

/*========== STATUS MODAL ==========*/
function openStatusModal(id, status) {
  document.getElementById("statusModal").style.display = "flex";

  document.querySelector("#id").value = id;
  document.querySelector("#status").value = status;
}

function closeStatusModal() {
  document.getElementById("statusModal").style.display = "none";
}

/*========== PRICE MODAL ==========*/
function openPriceModal(id, cloth_type, price) {
  document.getElementById("update_price").style.display = "flex";

  document.getElementById("id").value = id;
  document.getElementById("cloth_type").innerHTML = cloth_type;
  document.getElementById("price").value = price;
}

function closePriceModal() {
  document.getElementById("update_price").style.display = "none";
}

const price = document.getElementById("price");
if (price) {
  price.addEventListener("wheel", function (e) {
    e.preventDefault();
  });
}

/*========== NOTIFICATION ==========*/
const wrapper = document.querySelector(".notification-wrapper");
const box = document.getElementById("notifBox");

wrapper.addEventListener("click", function (e) {
  e.stopPropagation();
  box.style.display = box.style.display === "block" ? "none" : "block";
});

box.addEventListener("click", function (e) {
  e.stopPropagation();
});

document.addEventListener("click", function () {
  box.style.display = "none";
});