/*========== USER DASHBOARD ==========*/
let index = 0;
const track = document.getElementById("sliderTrack");
const total = track ? track.children.length : 0;

const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");
const counter = document.getElementById("requestCounter");

function updateSlider() {
  if (!track) return;

  track.style.transform = `translateX(-${index * 100}%)`;

  // Normal case
  counter.innerText = `Request ${index + 1} of ${total}`;

  prevBtn.disabled = (index === 0);
  nextBtn.disabled = (index === total - 1);
}

function nextSlide() {
  if (index < total - 1) {
    index++;
    updateSlider();
  }
}

function prevSlide() {
  if (index > 0) {
    index--;
    updateSlider();
  }
}

updateSlider();

/*========== REQUEST LAUNDRY ==========*/
document.querySelectorAll(".cloth-card").forEach((card) => {
  const checkbox = card.querySelector(".cloth-check");
  const qtyInput = card.querySelector('input[type="number"]');

  card.addEventListener("click", function (e) {
    if (e.target.tagName === "INPUT") return;

    checkbox.checked = !checkbox.checked;

    checkbox.dispatchEvent(new Event("change"));
  });

  checkbox.addEventListener("change", function () {
    if (checkbox.checked) {
      qtyInput.disabled = false;
      qtyInput.focus();
      card.classList.add("active");
    } else {
      qtyInput.disabled = true;
      qtyInput.value = "";
      card.classList.remove("active");
    }
  });
});

const sameaddress = document.getElementById("sameAddress");

if(sameaddress) {
sameaddress.addEventListener("change", function() {
  const pickup = document.querySelector('[name="pickup_address"]');
  const delivery = document.querySelector('[name="delivery_address"]');

  if (this.checked) {
    delivery.value = pickup.value;
  } else {
    delivery.value = "";
  }
});
}

function resetAll() {
    document.querySelector('form').reset();
    window.location.href = "user.php?page=request_laundry&reset=1";
}

/*========== UPDATE PROFILE ==========*/
function openUpdate(name, mobile, email) {
  document.getElementById("update_profile").style.display = "flex";

  document.getElementById("name").value = name;
  document.getElementById("mobile").value = mobile;
  document.getElementById("email").value = email;
}

function closeUpdate() {
  document.getElementById("update_profile").style.display = "none";
}