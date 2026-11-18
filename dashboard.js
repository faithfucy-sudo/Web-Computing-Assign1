// Customer Dashboard - Add Pet Form
// Used by dashboard.php
// Uses showError, clearError, showFormMessage, hideFormMessage
// and clearErrorWhenTyping from auth.js (loaded before this file).


// BACKEND INTEGRATION (Faith):
// Keep this as false until the PHP "add pet" processing is ready.
// While it is false, a valid pet is only shown on the page as a
// preview card and is NOT saved.
// Change it to true to let the valid form submit normally.
const petBackendConnected = false;

const maximumPetAge = 30;
const maximumNotesLength = 500;


// Create a pet card on the page so the customer can preview
// what their new pet will look like in "My Pets".
// textContent is used so typed text is never treated as HTML.
function addPreviewPetCard(petName, petType, breed, age, notes) {
    const petList = document.getElementById("petList");

    const card = document.createElement("article");
    card.className = "pet-card";

    const topRow = document.createElement("div");
    topRow.className = "pet-card-top";

    const nameHeading = document.createElement("h3");
    nameHeading.textContent = petName;

    const typeTag = document.createElement("span");
    typeTag.className = "pet-type-tag";
    typeTag.textContent = petType;

    topRow.appendChild(nameHeading);
    topRow.appendChild(typeTag);
    card.appendChild(topRow);

    card.appendChild(createPetDetail("Breed:", breed));
    card.appendChild(createPetDetail("Age:", age + (age === 1 ? " year" : " years")));
    card.appendChild(createPetDetail("Medical Notes:", notes === "" ? "None" : notes));

    const previewLabel = document.createElement("p");
    previewLabel.className = "preview-label";
    previewLabel.textContent = "Preview only - not saved yet.";
    card.appendChild(previewLabel);

    petList.prepend(card);
}


// Create one "Label: value" line for a pet card.
function createPetDetail(labelText, valueText) {
    const line = document.createElement("p");

    const label = document.createElement("span");
    label.className = "pet-label";
    label.textContent = labelText;

    line.appendChild(label);
    line.appendChild(document.createTextNode(" " + valueText));

    return line;
}


const addPetForm = document.getElementById("addPetForm");

if (addPetForm) {

    clearErrorWhenTyping([
        "pet-name",
        "pet-type",
        "pet-age",
        "pet-breed",
        "pet-notes"
    ]);

    addPetForm.addEventListener("submit", function (event) {
        event.preventDefault();
        hideFormMessage();

        const petName = document.getElementById("pet-name").value.trim();
        const petType = document.getElementById("pet-type").value;
        const ageText = document.getElementById("pet-age").value.trim();
        const breed = document.getElementById("pet-breed").value.trim();
        const notes = document.getElementById("pet-notes").value.trim();

        const allowedTypes = ["Dog", "Cat", "Rabbit"];
        const age = Number(ageText);
        let isValid = true;

        // Pet name
        if (petName === "") {
            showError("pet-name", "Please enter your pet's name.");
            isValid = false;
        } else {
            clearError("pet-name");
        }

        // Animal type
        if (!allowedTypes.includes(petType)) {
            showError("pet-type", "Please choose Dog, Cat or Rabbit.");
            isValid = false;
        } else {
            clearError("pet-type");
        }

        // Age: a whole number from 0 to 30
        if (ageText === "") {
            showError("pet-age", "Please enter your pet's age.");
            isValid = false;
        } else if (!Number.isInteger(age) || age < 0 || age > maximumPetAge) {
            showError("pet-age", "Age must be a whole number from 0 to " + maximumPetAge + ".");
            isValid = false;
        } else {
            clearError("pet-age");
        }

        // Breed
        if (breed === "") {
            showError("pet-breed", "Please enter the breed, or \"Mixed\" if unsure.");
            isValid = false;
        } else {
            clearError("pet-breed");
        }

        // Medical notes (optional, but not too long)
        if (notes.length > maximumNotesLength) {
            showError("pet-notes", "Medical notes must be " + maximumNotesLength + " characters or fewer.");
            isValid = false;
        } else {
            clearError("pet-notes");
        }

        if (!isValid) {
            showFormMessage("Please fix the highlighted fields.", "error");
            return;
        }

        if (petBackendConnected) {
            addPetForm.submit();
            return;
        }

        addPreviewPetCard(petName, petType, breed, age, notes);
        addPetForm.reset();
        showFormMessage(
            petName + " has been added to My Pets as a preview. " +
            "Pets are not saved to the server yet.",
            "success"
        );
    });
}
