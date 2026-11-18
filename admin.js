// Admin Dashboard - Overview, Details, Status Update and Cancel
// Used by admin.php
// Uses showFormMessage and hideFormMessage from auth.js
// (loaded before this file).


// BACKEND INTEGRATION (Faith):
// Keep this as false until the PHP status update / cancel
// processing is ready. While it is false, changes are only
// shown on this page and are NOT saved.
// Change it to true to let the status forms submit normally.
const adminBackendConnected = false;


const appointmentRows = document.querySelectorAll("#appointmentRows tr");
let selectedRow = null;


// Count the appointments for each status and show the totals
// in the overview cards at the top of the page.
function updateOverview() {
    const counts = {
        Pending: 0,
        Confirmed: 0,
        Completed: 0,
        Cancelled: 0
    };

    appointmentRows.forEach(function (row) {
        const status = row.querySelector(".status-badge").textContent.trim();

        if (counts[status] !== undefined) {
            counts[status]++;
        }
    });

    document.getElementById("count-total").textContent = appointmentRows.length;
    document.getElementById("count-pending").textContent = counts.Pending;
    document.getElementById("count-confirmed").textContent = counts.Confirmed;
    document.getElementById("count-completed").textContent = counts.Completed;
    document.getElementById("count-cancelled").textContent = counts.Cancelled;
}


// Fill the Appointment Details panel using the data- attributes
// stored on the table row.
function showDetails(row) {
    const status = row.querySelector(".status-badge").textContent.trim();

    document.getElementById("detail-id").textContent = row.dataset.id;
    document.getElementById("detail-status").textContent = status;
    document.getElementById("detail-service").textContent = row.dataset.service;
    document.getElementById("detail-groomer").textContent = row.dataset.groomer;
    document.getElementById("detail-datetime").textContent = row.dataset.datetime;

    document.getElementById("detail-customer").textContent = row.dataset.customer;
    document.getElementById("detail-email").textContent = row.dataset.email;
    document.getElementById("detail-phone").textContent = row.dataset.phone;

    document.getElementById("detail-pet").textContent = row.dataset.pet;
    document.getElementById("detail-pet-type").textContent = row.dataset.petType;
    document.getElementById("detail-breed").textContent = row.dataset.breed;
    document.getElementById("detail-age").textContent = row.dataset.age;
    document.getElementById("detail-notes").textContent = row.dataset.notes;

    document.getElementById("detailsEmpty").hidden = true;
    document.getElementById("detailsContent").hidden = false;

    // Highlight the chosen row.
    if (selectedRow) {
        selectedRow.classList.remove("selected-row");
    }
    row.classList.add("selected-row");
    selectedRow = row;
}


// Change the status shown in a row (badge, dropdown and Cancel button).
function setRowStatus(row, newStatus) {
    const badge = row.querySelector(".status-badge");

    badge.textContent = newStatus;
    badge.className = "status-badge status-" + newStatus.toLowerCase();

    row.querySelector(".status-form select").value = newStatus;

    // Completed or cancelled appointments cannot be cancelled again.
    const cancelButton = row.querySelector(".cancel-button");
    cancelButton.hidden = (newStatus === "Cancelled" || newStatus === "Completed");

    updateOverview();

    // Keep the details panel up to date if this row is being viewed.
    if (row === selectedRow) {
        showDetails(row);
    }
}


appointmentRows.forEach(function (row) {

    // View button
    row.querySelector(".view-button").addEventListener("click", function () {
        showDetails(row);
        document.getElementById("detailsPanel").scrollIntoView({ behavior: "smooth" });
    });


    // Status update form
    const statusForm = row.querySelector(".status-form");

    statusForm.addEventListener("submit", function (event) {
        event.preventDefault();
        hideFormMessage();

        const currentStatus = row.querySelector(".status-badge").textContent.trim();
        const newStatus = statusForm.querySelector("select").value;

        if (newStatus === currentStatus) {
            showFormMessage(
                "Appointment " + row.dataset.id + " is already " + newStatus + ".",
                "error"
            );
            return;
        }

        if (adminBackendConnected) {
            statusForm.submit();
            return;
        }

        setRowStatus(row, newStatus);
        showFormMessage(
            "Appointment " + row.dataset.id + " changed to " + newStatus +
            " (preview only - not saved).",
            "success"
        );
    });


    // Cancel button
    row.querySelector(".cancel-button").addEventListener("click", function () {
        hideFormMessage();

        const confirmed = confirm(
            "Cancel appointment " + row.dataset.id + " for " +
            row.dataset.pet + " (" + row.dataset.customer + ")?"
        );

        if (!confirmed) {
            return;
        }

        if (adminBackendConnected) {
            // BACKEND INTEGRATION (Faith): cancelling currently
            // re-uses the status form with the status "Cancelled".
            statusForm.querySelector("select").value = "Cancelled";
            statusForm.submit();
            return;
        }

        setRowStatus(row, "Cancelled");
        showFormMessage(
            "Appointment " + row.dataset.id + " has been cancelled (preview only - not saved).",
            "success"
        );
    });
});


updateOverview();
