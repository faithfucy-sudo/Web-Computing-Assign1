<?php
/*
    BACKEND INTEGRATION (Faith):
    This page is the login interface only.
    Login processing, password checking and sessions
    are handled by the backend.

    Still to confirm with Faith:
    - Which PHP file processes the login (form "action" below).
    - The POST field names (the "name" attributes below are
      PROPOSED names only).
    - How login errors are sent back to this page
      (e.g. a message shown inside #form-message).
    - Where the user goes after a successful login.
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Paws &amp; Whiskers</title>

    <!-- Shared website styling -->
    <link rel="stylesheet" href="style.css">
    <!-- Reuse the booking form styling -->
    <link rel="stylesheet" href="booking.css">
    <!-- Login and register page styling -->
    <link rel="stylesheet" href="auth.css">
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar" aria-label="Main navigation">

        <div class="nav-brand">

            <a href="index.html" class="nav-image-logo">
                <img src="images/Paws & Whiskers.png" alt="Paws & Whiskers Logo">
            </a>

            <div class="nav-title">
                <a href="index.html">Paws &amp; Whiskers</a>
            </div>

        </div>

        <div class="nav-links">
            <a href="index.html">Home</a>
            <a href="service.html">Services</a>
            <a href="packages.html">Packages</a>
            <a href="groomers.html">Groomers</a>
            <a href="contact.html">Contact</a>
        </div>

        <a href="booking.html" class="button button-brown">
            Book Now
        </a>

    </nav>


    <!-- Main Login Page -->
    <main class="auth-page">

        <!-- Page Heading -->
        <header class="booking-header">
            <span class="booking-paw" aria-hidden="true">🐾</span>
            <div class="booking-heading-text">
                <h1>Welcome Back</h1>
                <p>
                    Log in to manage your pets and appointments.
                </p>
            </div>
        </header>


        <!-- Login Card -->
        <section class="booking-card">

            <h2 class="section-title">
                Customer Login
            </h2>
            <p class="booking-description">
                Enter the email and password you registered with.
            </p>


            <!-- Feedback message (errors / success) -->
            <!-- BACKEND INTEGRATION (Faith): server login errors can be shown here -->
            <div id="form-message" class="form-message" role="alert"></div>


            <!-- Login Form -->
            <!-- BACKEND INTEGRATION (Faith): set the action to the agreed PHP file -->
            <form id="loginForm" method="post" action="" novalidate>

                <div class="booking-form-grid">

                    <!-- Email -->
                    <div class="form-group full-width">
                        <label for="login-email">
                            Email Address *
                        </label>
                        <input
                            type="email"
                            id="login-email"
                            name="email"
                            placeholder="e.g. name@example.com"
                            autocomplete="email"
                        >
                        <p class="field-error" id="login-email-error"></p>
                    </div>


                    <!-- Password -->
                    <div class="form-group full-width">
                        <label for="login-password">
                            Password *
                        </label>
                        <input
                            type="password"
                            id="login-password"
                            name="password"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                        >
                        <p class="field-error" id="login-password-error"></p>
                    </div>

                </div>


                <!-- Submit Button -->
                <button type="submit" class="booking-submit">
                    Log In
                </button>

            </form>


            <!-- Link to Register -->
            <p class="auth-switch">
                Don't have an account?
                <a href="register.php">Register here</a>
            </p>

        </section>

    </main>


    <!-- Login form validation -->
    <script src="auth.js"></script>

</body>

</html>
