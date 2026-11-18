<?php
/*
    BACKEND INTEGRATION (Faith):
    This page is the administrator interface only.
    Checking that the visitor is a logged-in administrator,
    loading appointments with their customer and pet details,
    updating statuses and cancelling appointments are all
    handled by the backend.

    Every block between "SAMPLE DATA START" and
    "SAMPLE DATA END" is placeholder content for the visual
    preview. Replace it with data from the database.

    Still to confirm with Faith:
    - How administrators are identified (session / role) and
      where non-admin visitors are sent.
    - The PHP file the status forms post to, and the POST
      field names (the "name" attributes below are PROPOSED:
      appointment_id, status).
    - Whether cancelling uses the same status form
      (status = Cancelled) or a separate cancel action.
    - The list of status values.
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Paws &amp; Whiskers</title>

    <!-- Shared website styling -->
    <link rel="stylesheet" href="style.css">
    <!-- Reuse the booking page cards and header -->
    <link rel="stylesheet" href="booking.css">
    <!-- Reuse the message box styling -->
    <link rel="stylesheet" href="auth.css">
    <!-- Reuse the table, status badges and details styling -->
    <link rel="stylesheet" href="dashboard.css">
    <!-- Admin page styling -->
    <link rel="stylesheet" href="admin.css">
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


    <!-- Main Admin Page -->
    <main class="dashboard-page">

        <!-- Page Heading -->
        <header class="booking-header">
            <span class="booking-paw" aria-hidden="true">🐾</span>
            <div class="booking-heading-text">
                <h1>Admin Dashboard</h1>
                <p>
                    View and manage all grooming appointments.
                </p>
            </div>
        </header>


        <!-- Remove this notice once real data is connected -->
        <p class="sample-notice">
            Preview mode: the appointments below are sample data.
            Status changes and cancellations are shown on this page only
            and are not saved.
        </p>


        <!-- ==========================================
             APPOINTMENT OVERVIEW
             (counted by admin.js from the table below)
             ========================================== -->
        <section class="overview-grid" aria-label="Appointment overview">

            <div class="overview-card">
                <h2>Total</h2>
                <p id="count-total">0</p>
            </div>

            <div class="overview-card">
                <h2>Pending</h2>
                <p id="count-pending">0</p>
            </div>

            <div class="overview-card">
                <h2>Confirmed</h2>
                <p id="count-confirmed">0</p>
            </div>

            <div class="overview-card">
                <h2>Completed</h2>
                <p id="count-completed">0</p>
            </div>

            <div class="overview-card">
                <h2>Cancelled</h2>
                <p id="count-cancelled">0</p>
            </div>

        </section>


        <!-- ==========================================
             ALL APPOINTMENTS
             ========================================== -->
        <section class="booking-card">

            <h2 class="section-title">
                All Appointments
            </h2>
            <p class="booking-description">
                Use View to see customer and pet details. Change a status
                with the dropdown and Update, or cancel an appointment.
            </p>

            <!-- Feedback message (status updates / cancellations) -->
            <!-- BACKEND INTEGRATION (Faith): server results can be shown here -->
            <div id="form-message" class="form-message" role="alert"></div>

            <div class="table-scroll">
                <table class="history-table admin-table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Pet</th>
                            <th>Service</th>
                            <th>Groomer</th>
                            <th>Date &amp; Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <!--
                        BACKEND INTEGRATION (Faith):
                        Create one row for each appointment, newest first.
                        The data- attributes on each <tr> are read by admin.js
                        to fill the Appointment Details panel.
                        Status badge class: status-pending, status-confirmed,
                        status-completed or status-cancelled.
                        Each status form posts appointment_id and status
                        (PROPOSED names) to the agreed PHP file.
                    -->
                    <tbody id="appointmentRows">

                        <!-- SAMPLE DATA START -->
                        <tr
                            data-id="#1006"
                            data-customer="Jason Lee"
                            data-email="jason.lee@example.com"
                            data-phone="013-4567890"
                            data-pet="Coco"
                            data-pet-type="Cat"
                            data-breed="British Shorthair"
                            data-age="4 years"
                            data-notes="None"
                            data-service="Full Grooming"
                            data-groomer="Sophie Wong"
                            data-datetime="02 Dec 2026, 11:00 AM"
                        >
                            <td>#1006</td>
                            <td>Jason Lee</td>
                            <td>Coco<span class="cell-subtext">Cat</span></td>
                            <td>Full Grooming</td>
                            <td>Sophie Wong</td>
                            <td>02 Dec 2026<span class="cell-subtext">11:00 AM</span></td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <form class="status-form" method="post" action="">
                                    <input type="hidden" name="appointment_id" value="1006">
                                    <select name="status" aria-label="New status for appointment #1006">
                                        <option value="Pending" selected>Pending</option>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                    <button type="submit" class="admin-button">Update</button>
                                </form>
                                <div class="row-buttons">
                                    <button type="button" class="admin-button admin-button-light view-button">View</button>
                                    <button type="button" class="admin-button admin-button-cancel cancel-button">Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <tr
                            data-id="#1005"
                            data-customer="Priya Nair"
                            data-email="priya.nair@example.com"
                            data-phone="016-7788990"
                            data-pet="Snowy"
                            data-pet-type="Rabbit"
                            data-breed="Holland Lop"
                            data-age="1 year"
                            data-notes="Nervous during nail trimming."
                            data-service="Nail Clipping"
                            data-groomer="Daniel Ng"
                            data-datetime="30 Nov 2026, 09:00 AM"
                        >
                            <td>#1005</td>
                            <td>Priya Nair</td>
                            <td>Snowy<span class="cell-subtext">Rabbit</span></td>
                            <td>Nail Clipping</td>
                            <td>Daniel Ng</td>
                            <td>30 Nov 2026<span class="cell-subtext">09:00 AM</span></td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <form class="status-form" method="post" action="">
                                    <input type="hidden" name="appointment_id" value="1005">
                                    <select name="status" aria-label="New status for appointment #1005">
                                        <option value="Pending" selected>Pending</option>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                    <button type="submit" class="admin-button">Update</button>
                                </form>
                                <div class="row-buttons">
                                    <button type="button" class="admin-button admin-button-light view-button">View</button>
                                    <button type="button" class="admin-button admin-button-cancel cancel-button">Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <tr
                            data-id="#1004"
                            data-customer="Aisyah Rahman"
                            data-email="aisyah.rahman@example.com"
                            data-phone="012-3456789"
                            data-pet="Buddy"
                            data-pet-type="Dog"
                            data-breed="Golden Retriever"
                            data-age="3 years"
                            data-notes="Allergic to chicken-based shampoo."
                            data-service="Gold Package"
                            data-groomer="Ryan Lim"
                            data-datetime="28 Nov 2026, 10:00 AM"
                        >
                            <td>#1004</td>
                            <td>Aisyah Rahman</td>
                            <td>Buddy<span class="cell-subtext">Dog</span></td>
                            <td>Gold Package</td>
                            <td>Ryan Lim</td>
                            <td>28 Nov 2026<span class="cell-subtext">10:00 AM</span></td>
                            <td><span class="status-badge status-confirmed">Confirmed</span></td>
                            <td>
                                <form class="status-form" method="post" action="">
                                    <input type="hidden" name="appointment_id" value="1004">
                                    <select name="status" aria-label="New status for appointment #1004">
                                        <option value="Pending">Pending</option>
                                        <option value="Confirmed" selected>Confirmed</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                    <button type="submit" class="admin-button">Update</button>
                                </form>
                                <div class="row-buttons">
                                    <button type="button" class="admin-button admin-button-light view-button">View</button>
                                    <button type="button" class="admin-button admin-button-cancel cancel-button">Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <tr
                            data-id="#1003"
                            data-customer="Jason Lee"
                            data-email="jason.lee@example.com"
                            data-phone="013-4567890"
                            data-pet="Max"
                            data-pet-type="Dog"
                            data-breed="Shih Tzu"
                            data-age="6 years"
                            data-notes="Sensitive skin."
                            data-service="Silver Package"
                            data-groomer="Alice Tan"
                            data-datetime="22 Nov 2026, 02:00 PM"
                        >
                            <td>#1003</td>
                            <td>Jason Lee</td>
                            <td>Max<span class="cell-subtext">Dog</span></td>
                            <td>Silver Package</td>
                            <td>Alice Tan</td>
                            <td>22 Nov 2026<span class="cell-subtext">02:00 PM</span></td>
                            <td><span class="status-badge status-confirmed">Confirmed</span></td>
                            <td>
                                <form class="status-form" method="post" action="">
                                    <input type="hidden" name="appointment_id" value="1003">
                                    <select name="status" aria-label="New status for appointment #1003">
                                        <option value="Pending">Pending</option>
                                        <option value="Confirmed" selected>Confirmed</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                    <button type="submit" class="admin-button">Update</button>
                                </form>
                                <div class="row-buttons">
                                    <button type="button" class="admin-button admin-button-light view-button">View</button>
                                    <button type="button" class="admin-button admin-button-cancel cancel-button">Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <tr
                            data-id="#1002"
                            data-customer="Aisyah Rahman"
                            data-email="aisyah.rahman@example.com"
                            data-phone="012-3456789"
                            data-pet="Milo"
                            data-pet-type="Cat"
                            data-breed="Persian"
                            data-age="2 years"
                            data-notes="None"
                            data-service="Basic Bath"
                            data-groomer="Sophie Wong"
                            data-datetime="05 Nov 2026, 11:00 AM"
                        >
                            <td>#1002</td>
                            <td>Aisyah Rahman</td>
                            <td>Milo<span class="cell-subtext">Cat</span></td>
                            <td>Basic Bath</td>
                            <td>Sophie Wong</td>
                            <td>05 Nov 2026<span class="cell-subtext">11:00 AM</span></td>
                            <td><span class="status-badge status-completed">Completed</span></td>
                            <td>
                                <form class="status-form" method="post" action="">
                                    <input type="hidden" name="appointment_id" value="1002">
                                    <select name="status" aria-label="New status for appointment #1002">
                                        <option value="Pending">Pending</option>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Completed" selected>Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                    <button type="submit" class="admin-button">Update</button>
                                </form>
                                <div class="row-buttons">
                                    <button type="button" class="admin-button admin-button-light view-button">View</button>
                                    <button type="button" class="admin-button admin-button-cancel cancel-button" hidden>Cancel</button>
                                </div>
                            </td>
                        </tr>

                        <tr
                            data-id="#1001"
                            data-customer="Priya Nair"
                            data-email="priya.nair@example.com"
                            data-phone="016-7788990"
                            data-pet="Snowy"
                            data-pet-type="Rabbit"
                            data-breed="Holland Lop"
                            data-age="1 year"
                            data-notes="Nervous during nail trimming."
                            data-service="Spa Treatment"
                            data-groomer="Daniel Ng"
                            data-datetime="20 Oct 2026, 03:00 PM"
                        >
                            <td>#1001</td>
                            <td>Priya Nair</td>
                            <td>Snowy<span class="cell-subtext">Rabbit</span></td>
                            <td>Spa Treatment</td>
                            <td>Daniel Ng</td>
                            <td>20 Oct 2026<span class="cell-subtext">03:00 PM</span></td>
                            <td><span class="status-badge status-cancelled">Cancelled</span></td>
                            <td>
                                <form class="status-form" method="post" action="">
                                    <input type="hidden" name="appointment_id" value="1001">
                                    <select name="status" aria-label="New status for appointment #1001">
                                        <option value="Pending">Pending</option>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled" selected>Cancelled</option>
                                    </select>
                                    <button type="submit" class="admin-button">Update</button>
                                </form>
                                <div class="row-buttons">
                                    <button type="button" class="admin-button admin-button-light view-button">View</button>
                                    <button type="button" class="admin-button admin-button-cancel cancel-button" hidden>Cancel</button>
                                </div>
                            </td>
                        </tr>
                        <!-- SAMPLE DATA END -->

                    </tbody>

                </table>
            </div>

        </section>


        <!-- ==========================================
             APPOINTMENT DETAILS
             (filled in by admin.js when View is clicked)
             ========================================== -->
        <section class="booking-card details-panel" id="detailsPanel">

            <h2 class="section-title">
                Appointment Details
            </h2>

            <p class="empty-message" id="detailsEmpty">
                Select View on an appointment to see its details.
            </p>

            <div class="details-grid" id="detailsContent" hidden>

                <div>
                    <h3>Appointment</h3>
                    <dl class="profile-details">
                        <div>
                            <dt>Appointment ID</dt>
                            <dd id="detail-id"></dd>
                        </div>
                        <div>
                            <dt>Status</dt>
                            <dd id="detail-status"></dd>
                        </div>
                        <div>
                            <dt>Service</dt>
                            <dd id="detail-service"></dd>
                        </div>
                        <div>
                            <dt>Groomer</dt>
                            <dd id="detail-groomer"></dd>
                        </div>
                        <div>
                            <dt>Date &amp; Time</dt>
                            <dd id="detail-datetime"></dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3>Customer</h3>
                    <dl class="profile-details">
                        <div>
                            <dt>Full Name</dt>
                            <dd id="detail-customer"></dd>
                        </div>
                        <div>
                            <dt>Email</dt>
                            <dd id="detail-email"></dd>
                        </div>
                        <div>
                            <dt>Phone</dt>
                            <dd id="detail-phone"></dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3>Pet</h3>
                    <dl class="profile-details">
                        <div>
                            <dt>Name</dt>
                            <dd id="detail-pet"></dd>
                        </div>
                        <div>
                            <dt>Animal Type</dt>
                            <dd id="detail-pet-type"></dd>
                        </div>
                        <div>
                            <dt>Breed</dt>
                            <dd id="detail-breed"></dd>
                        </div>
                        <div>
                            <dt>Age</dt>
                            <dd id="detail-age"></dd>
                        </div>
                        <div>
                            <dt>Medical Notes</dt>
                            <dd id="detail-notes"></dd>
                        </div>
                    </dl>
                </div>

            </div>

        </section>

    </main>


    <!-- Shared form helpers (showFormMessage, hideFormMessage) -->
    <script src="auth.js"></script>
    <!-- Admin dashboard functions -->
    <script src="admin.js"></script>

</body>

</html>
