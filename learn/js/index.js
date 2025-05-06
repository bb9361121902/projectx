const modal = document.getElementById("modal");
const login_btn = document.getElementById("login_btn");
const closeModal = document.getElementById("closeModal");

login_btn.onclick = () => {
  modal.style.display = "block";
  modal.classList.remove("register-active");
};

closeModal.onclick = () => {
  modal.style.display = "none";
};

document.getElementById("switchToRegister").onclick = () => {
  modal.classList.add("register-active");
};

document.getElementById("switchToLogin").onclick = () => {
  modal.classList.remove("register-active");
};
// nav links
function toggleMenu() {
  const navLinks = document.querySelector(".nav-links");
  navLinks.classList.toggle("show");
}

// Handle Login Form Submission
document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch("../php/login.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        alert(data.message);
        window.location.href = "../html/index.php"; // Redirect to welcome page
      } else {
        alert(data.message);
      }
    })
    .catch((error) => console.error("Error:", error));
});

// Handle Registration Form Submission
document
  .getElementById("registerForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch("../php/register.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        alert(data.message);
        if (data.status === "success") {
          document.getElementById("switchToLogin").click(); // Switch to login form
        }
      })
      .catch((error) => console.error("Error:", error));
  });

const form = document.getElementById("loginForm"); // Replace with your form ID
const formData = new FormData(form);

// Iterate over FormData and log key-value pairs
for (let [key, value] of formData.entries()) {
  console.log(key, value);
}

