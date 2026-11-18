// Booking Page - Validation and Booking Summary
// Used by booking.html
// Uses showError, clearError, showFormMessage, hideFormMessage
// and clearErrorWhenTyping from auth.js (loaded before this file).


// BACKEND INTEGRATION (Faith):
// Keep this as false until the PHP booking processing is ready.
// While it is false, a valid booking only shows a message and
// is NOT sent to the server.
// Change it to true to let the valid form submit normally.
const bookingBackendConnected = false;


const bookingForm = document.getElementById("bookingForm");
const petSelect = document.getElementById("booking-pet");
const serviceSelect = document.getElementById("booking-service");
const groomerSelect = document.getElementById("booking-groomer");
const dateInput = document.getElementById("booking-date");
const timeSelect = document.getElementById("booking-time");


// Today's date as "YYYY-MM-DD" (the format used by date inputs).
function getTodayText() {
    const today = new Date();

    return today.getFullYear() + "-" +
        String(today.getMonth() + 1).padStart(2, "0") + "-" +
        String(today.getDate()).padStart(2, "0");
}


// The current time as "HH:MM", e.g. "14:05".
function getCurrentTimeText() {
    const now = new Date();

    return String(now.getHours()).padStart(2, "0") + ":" +
        String(now.getMinutes()).padStart(2, "0");
}


// Turn "2026-11-20" into "Fri, 20 Nov 2026".
function formatDate(dateText) {
    const parts = dateText.split("-");
    const date = new Date(parts[0], parts[1] - 1, parts[2]);

    return date.toLocaleDateString("en-GB", {
        weekday: "short",
        day: "2-digit",
        month: "short",
        year: "numeric"
    });
}


// The visible text of the chosen option in a dropdown.
function getSelectedText(selectElement) {
    return selectElement.options[selectElement.selectedIndex].text;
}


// Check whether the chosen service is offered for the chosen pet.
// Each service option lists its animals, e.g. data-pets="Dog Cat".
function serviceSuitsPet() {
    const petOption = petSelect.options[petSelect.selectedIndex];
    const serviceOption = serviceSelect.options[serviceSelect.selectedIndex];

    const petType = petOption.dataset.type;
    const allowedPets = serviceOption.dataset.pets.split(" ");

    return allowedPets.includes(petType);
}


// Fill in the Booking Summary card from the current choices.
function updateSummary() {
    const notSelected = "Not selected";

    document.getElementById("summary-pet").textContent =
        petSelect.value === "" ? notSelected : getSelectedText(petSelect);

    document.getElementById("summary-service").textContent =
        serviceSelect.value === "" ? notSelected : serviceSelect.value;

    document.getElementById("summary-groomer").textContent =
        groomerSelect.value === "" ? notSelected : groomerSelect.value;

    document.getElementById("summary-date").textContent =
        dateInput.value === "" ? notSelected : formatDate(dateInput.value);

    document.getElementById("summary-time").textContent =
        timeSelect.value === "" ? notSelected : getSelectedText(timeSelect);

    document.getElementById("summary-price").textContent =
        serviceSelect.value === ""
            ? "-"
            : "RM" + serviceSelect.options[serviceSelect.selectedIndex].dataset.price;
}


// Check every field. Returns true if the booking is valid.
function validateBooking() {
    let isValid = true;
    const todayText = getTodayText();

    // Pet
    if (petSelect.value === "") {
        showError("booking-pet", "Please select one of your registered pets.");
        isValid = false;
    } else {
        clearError("booking-pet");
    }

    // Service (and whether it suits the pet)
    if (serviceSelect.value === "") {
        showError("booking-service", "Please select a service or package.");
        isValid = false;
    } else if (petSelect.value !== "" && !serviceSuitsPet()) {
        const petType = petSelect.options[petSelect.selectedIndex].dataset.type;
        showError(
            "booking-service",
            serviceSelect.value + " is not available for a " + petType + ". Please choose another service."
        );
        isValid = false;
    } else {
        clearError("booking-service");
    }

    // Groomer
    if (groomerSelect.value === "") {
        showError("booking-groomer", "Please select a groomer.");
        isValid = false;
    } else {
        clearError("booking-groomer");
    }

    // Date: today or later
    // ("YYYY-MM-DD" text can be compared directly)
    if (dateInput.value === "") {
        showError("booking-date", "Please choose a date.");
        isValid = false;
    } else if (dateInput.value < todayText) {
        showError("booking-date", "Please choose today or a future date.");
        isValid = false;
    } else {
        clearError("booking-date");
    }

    // Time: if the booking is for today, the time must not have passed
    if (timeSelect.value === "") {
        showError("booking-time", "Please choose a time slot.");
        isValid = false;
    } else if (dateInput.value === todayText && timeSelect.value <= getCurrentTimeText()) {
        showError("booking-time", "This time has already passed today. Please choose a later time.");
        isValid = false;
    } else {
        clearError("booking-time");
    }

    return isValid;
}


if (bookingForm) {

    // Prevent users from picking a past date in the calendar.
    dateInput.min = getTodayText();


    // Automatically select the groomer passed from groomers.html.
    const urlParams = new URLSearchParams(window.location.search);
    const selectedGroomer = urlParams.get("groomer");

    // Only allow the four existing groomers.
    const groomerMap = {
        sophie: "Sophie Wong",
        alice: "Alice Tan",
        ryan: "Ryan Lim",
        daniel: "Daniel Ng"
    };

    if (
        selectedGroomer &&
        Object.prototype.hasOwnProperty.call(groomerMap, selectedGroomer)
    ) {
        const groomerName = groomerMap[selectedGroomer];

        const matchingOption = Array.from(groomerSelect.options).find(
            function (option) {
                return option.value === groomerName;
            }
        );

        if (matchingOption) {
            groomerSelect.value = matchingOption.value;
        }
    }

    // Update the booking summary immediately.
    updateSummary();

    clearErrorWhenTyping([
        "booking-pet",
        "booking-service",
        "booking-groomer",
        "booking-date",
        "booking-time"
    ]);

    // Update the summary whenever a choice changes.
    [petSelect, serviceSelect, groomerSelect, dateInput, timeSelect].forEach(function (field) {
        field.addEventListener("change", updateSummary);
    });

    bookingForm.addEventListener("submit", function (event) {
        event.preventDefault();
        hideFormMessage();

        if (!validateBooking()) {
            showFormMessage("Please fix the highlighted fields.", "error");
            return;
        }

        if (bookingBackendConnected) {
            bookingForm.submit();
            return;
        }

        const petName = getSelectedText(petSelect);
        const message =
            "Booking request ready: " + petName + " - " + serviceSelect.value +
            " with " + groomerSelect.value + " on " + formatDate(dateInput.value) +
            " at " + getSelectedText(timeSelect) + ". " +
            "This has not been sent to the server yet.";

        bookingForm.reset();
        updateSummary();
        showFormMessage(message, "success");

        // Make sure the message is visible on small screens.
        document.getElementById("form-message").scrollIntoView({ block: "center" });
    });
}
