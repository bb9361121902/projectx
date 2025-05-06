<?php
session_start();
$user = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travel Tracker</title>
  <link rel="stylesheet" href="../css/index.css" />
  <link rel="icon" type="image/x-icon" href="../img/website_logo.jpg" />

</head>

<body>
  <div class="container1">
    <nav class="navbar">
      <div class="logo">Track Your Bus</div>
      <div> 
        <h2><i>SCAD POLYTECHNIC COLLEGE</i></h2>
      </div>
      <ul class="nav-links">
        <li><a href="#help">Help</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="#profile">Profile</a></li>
        <li id="nav-auth-btn">
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <a href="../php/logout.php" class="logout_btns">Logout</a>
          <?php else: ?>
            <button class="login_btns" id="login_btn">Login</button>
          <?php endif; ?>
        </li>
        <!-- <button class="login_btns" id="login_btn">Login</button> -->
      </ul>
      <!-- <a href="../php/logout.php">Logout</a> -->
    </nav>

    <!-- login form  -->
    <div class="modal-content" id="modal">
      <span class="close" id="closeModal">&times;</span>
      <div class="modal-inner" id="modalInner">
        <!-- Login Form -->
        <div class="form-container" id="form-container-loginForm">
          <?php if (!isset($_SESSION['logged_in'])): ?>
            <form id="loginForm" action="../php/login.php" method="POST">
              <h3>Login</h3>
              <input type="hidden" name="action" value="login" />
              <input type="email" id="loginEmail" name="email" placeholder="Email" required />
              <input type="password" id="loginPassword" name="password" placeholder="Password" required />
              <div class="extra-options">
                <label><input type="checkbox" id="remember" /> Remember Me</label>
                <a href="#">Forgot Password?</a>
              </div>
              <input class="btn" type="submit" value="Login" id="login_button">
              <p>
                Don't have an account?
                <a class="switch-form" id="switchToRegister"> Sign up</a>
              </p>
            </form>
          <?php endif; ?>
        </div>

        <!-- Register Form -->
        <div class="form-container" id="form-container-registerForm">
          <form id="registerForm" action="../php/register.php" method="POST">
            <h3>Register</h3>
            <input type="hidden" name="action" value="register" />
            <input type="text" id="registerName" name="name" placeholder="Full Name" required />
            <input type="email" id="registerEmail" name="email" placeholder="Email" required />
            <input type="password" id="registerPassword" name="password" placeholder="Password" required />
            <div class="terms">
              <input type="checkbox" id="agree" required />
              <label for="agree">I agree to the <a href="#">Terms & Conditions</a></label>
            </div>
            <input class="btn" type="submit" value="Register" />
            <p>
              already have an account?
              <a class="switch-form" id="switchToLogin"> Sign in</a>
            </p>
          </form>
        </div>
      </div>
    </div>

    <section style="text-align: center; padding: 60px 20px; height: 28rem">
      <h1 style="font-size: 36px; font-weight: bold; color: #ffffff">
        Welcome, <?php echo $user; ?>!
      </h1>
      <p
        style="
            font-size: 18px;
            line-height: 1.6;
            color: #ffffff;
            max-width: 800px;
            margin: 20px auto;
          ">
        Experience the ease of real-time school bus tracking with
        <strong>Track Your Bus</strong>. Our platform ensures safety and reliability
        for students and peace of mind for parents. From knowing the exact location
        of your bus to receiving timely updates about delays or route changes, we bring
        transparency and efficiency to transportation. Join our mission to
        make school travel smarter, safer, and stress-free for everyone.
      </p>
      <a
        href="#main"
        class="track_btn"
        style="
            display: inline-block;
            margin-top: 20px;
            padding: 12px 60px;
            font-size: 20px;
            color: white;
            background-color: #1abc9c;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
            text-decoration: none;
          ">Track</a>
    </section>
  </div>

  <div class="main" id="main">
    <div class="search-container">
      <form action="../php/cards.php" method="post" class="search-form">
        <h2 style="text-transform: uppercase; color: #ffffff;">Track Your Bus</h2>
        <input
          type="text"
          placeholder="From"
          class="input-box"
          id="from"
          name="from"
          required />
        <input
          type="text"
          placeholder="To"
          class="input-box"
          id="to"
          name="to"
          required />
        <input type="submit" value="Search" class="search-button" />
      </form>
    </div>
  </div>

  <footer>
    <div
      style="
          max-width: 1200px;
          margin: 0 auto;
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
          align-items: flex-start;
        ">
      <!-- About Section -->
      <div
        style="
            flex: 1;
            min-width: 250px;
            margin-bottom: 20px;
            margin-right: 70px;
          ">
        <h3>About Me</h3>
        <p>
          Track Your Bus is a cutting-edge platform designed to simplify and
          secure school transportation through real-time GPS tracking. Our
          mission is to provide parents, schools, and transport operators with
          a reliable and efficient way to monitor school buses, ensuring
          safety, convenience, and peace of mind.
        </p>
      </div>

      <!-- Contact Info Section -->
      <div style="flex: 1; min-width: 250px; margin-bottom: 20px">
        <h3>Get in Touch</h3>
        <p>
          Email: <a href="mailto:balaji@example.com">balaji@example.com</a>
        </p>
        <p>Phone: <a href="tel:+1234567890">+123 456 7890</a></p>
        <div class="social-links">
          <a href="https://linkedin.com/in/balaji" target="_blank">LinkedIn</a>
          <a href="https://github.com/balaji" target="_blank">GitHub</a>
          <a href="https://instagram.com/balaji" target="_blank">Instagram</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">© 2024 SCAD. All rights reserved.</div>
  </footer>
  <script src="../js/index.js"></script>
</body>

</html>