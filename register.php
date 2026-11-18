<?php
/*
    BACKEND INTEGRATION (Faith):
    This page is the registration interface only.
    Saving the customer, password hashing and checking
    for an existing email are handled by the backend.

    Still to confirm with Faith:
    - Which PHP file processes the registration (form "action" below).
    - The POST field names (the "name" attributes below are
      PROPOSED names only).
    - Whether "confirm_password" should be sent to the server.
    - How errors (e.g. "email already registered") are sent
      back to this page (e.g. a message inside #form-message).
    - Where the user goes after registering (e.g. login.php).
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Paws &amp; Whiskers</title>

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


    <!-- Main Register Page -->
    <main class="auth-page auth-page-wide">

        <!-- Page Heading -->
        <header class="booking-header">
            <span class="booking-paw" aria-hidden="true">🐾</span>
            <div class="booking-heading-text">
                <h1>Create an Account</h1>
                <p>
                    Register to add your pets and book grooming appointments.
                </p>
            </div>
        </header>


        <!-- Register Card -->
        <section class="booking-card">

            <h2 class="section-title">
                Your Details
            </h2>
            <p class="booking-description">
                All fields are required.
            </p>


            <!-- Feedback message (errors / success) -->
            <!-- BACKEND INTEGRATION (Faith): server registration errors can be shown here -->
            <div id="form-message" class="form-message" role="alert"></div>


            <!-- Register Form -->
            <!-- BACKEND INTEGRATION (Faith): set the action to the agreed PHP file -->
            <form id="registerForm" method="post" action="" novalidate>

                <div class="booking-form-grid">

                    <!-- Full Name -->
                    <div class="form-group full-width">
                        <label for="register-name">
                            Full Name *
                        </label>
                        <input
                            type="text"
                            id="register-name"
                            name="full_name"
                            placeholder="Enter your full name"
                            autocomplete="name"
                        >
                        <p class="field-error" id="register-name-error"></p>
                    </div>


                    <!-- Email -->
                    <div class="form-group">
                        <label for="register-email">
                            Email Address *
                        </label>
                        <input
                            type="email"
                            id="register-email"
                            name="email"
                            placeholder="e.g. name@example.com"
                            autocomplete="email"
                        >
                        <p class="field-error" id="register-email-error"></p>
                    </div>


                    <!-- Phone -->
                    <div class="form-group">
                        <label for="register-phone">
                            Phone Number *
                        </label>
                        <input
                            type="tel"
                            id="register-phone"
                            name="phone"
                            placeholder="e.g. 012-3456789"
                            autocomplete="tel"
                        >
                        <p class="field-error" id="register-phone-error"></p>
                    </div>


                    <!-- Password -->
                    <div class="form-group">
                        <label for="register-password">
                            Password *
                        </label>
                        <input
                            type="password"
                            id="register-password"
                            name="password"
                            placeholder="At least 8 characters"
                            autocomplete="new-password"
                        >
                        <p class="field-error" id="register-password-error"></p>
                    </div>


                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="register-confirm">
                            Confirm Password *
                        </label>
                        <input
                            type="password"
                            id="register-confirm"
                            name="confirm_password"
                            placeholder="Re-enter your password"
                            autocomplete="new-password"
                        >
                        <p class="field-error" id="register-confirm-error"></p>
                    </div>

                </div>


                <!-- Submit Button -->
                <button type="submit" class="booking-submit">
                    Create Account
                </button>

            </form>


            <!-- Link to Login -->
            <p class="auth-switch">
                Already have an account?
                <a href="login.php">Log in here</a>
            </p>

        </section>

    </main>


    <!-- Register form validation -->
    <script src="auth.js"></script>

</body>

</html>
