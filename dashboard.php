<?php
/*
    BACKEND INTEGRATION (Faith):
    This page is the customer dashboard interface only.
    Checking that the customer is logged in, and loading the
    customer's profile, pets and appointments from the
    database, are handled by the backend.

    Every block between "SAMPLE DATA START" and
    "SAMPLE DATA END" is placeholder content for the visual
    preview. Replace each block with data from the database.

    Still to confirm with Faith:
    - Session details: how this page knows who is logged in,
      and where to send visitors who are not logged in.
    - Profile fields to display (currently name, email, phone).
    - Pet fields and how age is stored (whole years?).
    - The PHP file the Add Pet form posts to, and its POST
      field names (the "name" attributes below are PROPOSED).
    - Appointment ID format, status values, date/time format,
      and whether "Service Package" is one field or two.
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard | Paws &amp; Whiskers</title>

    <!-- Shared website styling -->
    <link rel="stylesheet" href="style.css">
    <!-- Reuse the booking form styling -->
    <link rel="stylesheet" href="booking.css">
    <!-- Reuse the field error and message styling -->
    <link rel="stylesheet" href="auth.css">
    <!-- Dashboard page styling -->
    <link rel="stylesheet" href="dashboard.css">
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


    <!-- Main Dashboard Page -->
    <main class="dashboard-page">

        <!-- Page Heading -->
        <header class="booking-header">
            <span class="booking-paw" aria-hidden="true">🐾</span>
            <div class="booking-heading-text">
                <!-- BACKEND INTEGRATION (Faith): show the customer's name here -->
                <h1>Welcome, Sample Customer</h1>
                <p>
                    Manage your profile, pets and grooming appointments.
                </p>
            </div>
        </header>


        <!-- Remove this notice once real data is connected -->
        <p class="sample-notice">
            Preview mode: the profile, pets and appointments below are
            sample data. They will be replaced with your real account data.
        </p>


        <div class="dashboard-grid">

            <!-- ==========================================
                 CUSTOMER PROFILE
                 ========================================== -->
            <section class="booking-card dashboard-profile">

                <h2 class="section-title">
                    My Profile
                </h2>

                <!-- BACKEND INTEGRATION (Faith): replace with the logged-in customer's details -->
                <!-- SAMPLE DATA START -->
                <dl class="profile-details">
                    <div>
                        <dt>Full Name</dt>
                        <dd>Sample Customer</dd>
                    </div>
                    <div>
                        <dt>Email</dt>
                        <dd>sample.customer@example.com</dd>
                    </div>
                    <div>
                        <dt>Phone</dt>
                        <dd>012-3456789</dd>
                    </div>
                </dl>
                <!-- SAMPLE DATA END -->

            </section>


            <!-- ==========================================
                 MY PETS
                 ========================================== -->
            <section class="booking-card dashboard-pets">

                <h2 class="section-title">
                    My Pets
                </h2>
                <p class="booking-description">
                    The pets registered to your account.
                </p>

                <!--
                    BACKEND INTEGRATION (Faith):
                    Create one "pet-card" for each of the customer's pets.
                    If the customer has no pets, show this instead:
                    <p class="empty-message">You have not registered any pets yet.</p>
                -->
                <div class="pet-list" id="petList">

                    <!-- SAMPLE DATA START -->
                    <article class="pet-card">
                        <div class="pet-card-top">
                            <h3>Buddy</h3>
                            <span class="pet-type-tag">Dog</span>
                        </div>
                        <p><span class="pet-label">Breed:</span> Golden Retriever</p>
                        <p><span class="pet-label">Age:</span> 3 years</p>
                        <p><span class="pet-label">Medical Notes:</span> Allergic to chicken-based shampoo.</p>
                    </article>

                    <article class="pet-card">
                        <div class="pet-card-top">
                            <h3>Milo</h3>
                            <span class="pet-type-tag">Cat</span>
                        </div>
                        <p><span class="pet-label">Breed:</span> Persian</p>
                        <p><span class="pet-label">Age:</span> 2 years</p>
                        <p><span class="pet-label">Medical Notes:</span> None</p>
                    </article>

                    <article class="pet-card">
                        <div class="pet-card-top">
                            <h3>Snowy</h3>
                            <span class="pet-type-tag">Rabbit</span>
                        </div>
                        <p><span class="pet-label">Breed:</span> Holland Lop</p>
                        <p><span class="pet-label">Age:</span> 1 year</p>
                        <p><span class="pet-label">Medical Notes:</span> Nervous during nail trimming.</p>
                    </article>
                    <!-- SAMPLE DATA END -->

                </div>

            </section>


            <!-- ==========================================
                 ADD PET FORM
                 ========================================== -->
            <section class="booking-card dashboard-add-pet">

                <h2 class="section-title">
                    Add a Pet
                </h2>
                <p class="booking-description">
                    Fields marked * are required.
                </p>

                <!-- Feedback message (errors / success) -->
                <!-- BACKEND INTEGRATION (Faith): server errors can be shown here -->
                <div id="form-message" class="form-message" role="alert"></div>

                <!-- Add Pet Form -->
                <!-- BACKEND INTEGRATION (Faith): set the action to the agreed PHP file -->
                <form id="addPetForm" method="post" action="" novalidate>

                    <div class="booking-form-grid">

                        <!-- Pet Name -->
                        <div class="form-group full-width">
                            <label for="pet-name">
                                Pet Name *
                            </label>
                            <input
                                type="text"
                                id="pet-name"
                                name="pet_name"
                                placeholder="e.g. Buddy"
                            >
                            <p class="field-error" id="pet-name-error"></p>
                        </div>


                        <!-- Animal Type -->
                        <div class="form-group">
                            <label for="pet-type">
                                Animal Type *
                            </label>
                            <select id="pet-type" name="pet_type">
                                <option value="">Select type</option>
                                <option value="Dog">Dog</option>
                                <option value="Cat">Cat</option>
                                <option value="Rabbit">Rabbit</option>
                            </select>
                            <p class="field-error" id="pet-type-error"></p>
                        </div>


                        <!-- Age -->
                        <div class="form-group">
                            <label for="pet-age">
                                Age (years) *
                            </label>
                            <input
                                type="number"
                                id="pet-age"
                                name="age"
                                placeholder="e.g. 3"
                                min="0"
                                max="30"
                                step="1"
                            >
                            <p class="field-error" id="pet-age-error"></p>
                        </div>


                        <!-- Breed -->
                        <div class="form-group full-width">
                            <label for="pet-breed">
                                Breed *
                            </label>
                            <input
                                type="text"
                                id="pet-breed"
                                name="breed"
                                placeholder="e.g. Golden Retriever, or Mixed"
                            >
                            <p class="field-error" id="pet-breed-error"></p>
                        </div>


                        <!-- Medical Notes / Allergies -->
                        <div class="form-group full-width">
                            <label for="pet-notes">
                                Medical Notes / Allergies
                            </label>
                            <textarea
                                id="pet-notes"
                                name="medical_notes"
                                rows="3"
                                placeholder="e.g. Allergic to certain shampoos (optional)"
                            ></textarea>
                            <p class="field-error" id="pet-notes-error"></p>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="booking-submit">
                        Add Pet
                    </button>

                </form>

            </section>

        </div>


        <!-- ==========================================
             APPOINTMENT HISTORY
             ========================================== -->
        <section class="booking-card dashboard-history">

            <h2 class="section-title">
                Appointment History
            </h2>
            <p class="booking-description">
                Your past and upcoming grooming appointments.
            </p>

            <div class="table-scroll">
                <table class="history-table">

                    <thead>
                        <tr>
                            <th>Appointment ID</th>
                            <th>Pet Name</th>
                            <th>Service Package</th>
                            <th>Date &amp; Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <!--
                        BACKEND INTEGRATION (Faith):
                        Create one table row for each of the customer's appointments.
                        Status badge class: status-pending, status-confirmed,
                        status-completed or status-cancelled.
                        If there are no appointments, show one row:
                        <tr><td colspan="5">You have no appointments yet.</td></tr>
                    -->
                    <tbody>

                        <!-- SAMPLE DATA START -->
                        <tr>
                            <td>#1004</td>
                            <td>Buddy</td>
                            <td>Gold Package</td>
                            <td>28 Nov 2026, 10:00 AM</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                        </tr>
                        <tr>
                            <td>#1003</td>
                            <td>Snowy</td>
                            <td>Bronze Package</td>
                            <td>22 Nov 2026, 02:00 PM</td>
                            <td><span class="status-badge status-confirmed">Confirmed</span></td>
                        </tr>
                        <tr>
                            <td>#1002</td>
                            <td>Milo</td>
                            <td>Silver Package</td>
                            <td>05 Nov 2026, 11:00 AM</td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                        </tr>
                        <tr>
                            <td>#1001</td>
                            <td>Buddy</td>
                            <td>Silver Package</td>
                            <td>20 Oct 2026, 09:00 AM</td>
                            <td><span class="status-badge status-cancelled">Cancelled</span></td>
                        </tr>
                        <!-- SAMPLE DATA END -->

                    </tbody>

                </table>
            </div>

        </section>

    </main>


    <!-- Shared form helpers (showError, clearError, showFormMessage) -->
    <script src="auth.js"></script>
    <!-- Add Pet form validation -->
    <script src="dashboard.js"></script>

</body>

</html>
