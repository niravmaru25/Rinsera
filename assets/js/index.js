function openModal() {
  document.getElementById("form-container").style.display = "flex";
  openlogin();
}

function closeModal() {
  document.getElementById("form-container").style.display = "none";
}

function openlogin() {
  document.querySelector(".login").style.display = "block";
  document.querySelector(".signup").style.display = "none";

  document.querySelector(".log-in").classList.add("active");
  document.querySelector(".sign-in").classList.remove("active");
}

function opensignup() {
  document.querySelector(".signup").style.display = "block";
  document.querySelector(".login").style.display = "none";

  document.querySelector(".sign-in").classList.add("active");
  document.querySelector(".log-in").classList.remove("active");
}

/*========== TOGGLE ==========*/
function toggleMenu() {
  document.querySelector(".navbar").classList.toggle("active");
}

const navbar = document.querySelector(".navbar");
const menuToggle = document.querySelector(".menu-toggle");

// close when clicking outside
document.addEventListener("click", function (e) {
  if (
    !navbar.contains(e.target) &&
    !menuToggle.contains(e.target)
  ) {
    navbar.classList.remove("active");
  }
});

// close when clicking any nav link
document.querySelectorAll(".nav-links a").forEach(link => {
  link.addEventListener("click", () => {
    navbar.classList.remove("active");
  });
});