// Services Page - Category Filter
// Used by service.html
//
// Each service card lists the animals it is for using
// <span class="pet-tag">Dog</span> labels.
// When a filter button is clicked, a card is shown only if
// one of its pet tags matches the chosen animal.


const filterButtons = document.querySelectorAll(".filter-button");
const serviceCards = document.querySelectorAll(".service-card");
const noServicesMessage = document.getElementById("noServicesMessage");


// Check whether a card has a pet tag for the chosen animal.
function cardMatchesFilter(card, chosenAnimal) {
    if (chosenAnimal === "All") {
        return true;
    }

    const petTags = card.querySelectorAll(".pet-tag");

    for (let i = 0; i < petTags.length; i++) {
        if (petTags[i].textContent.trim() === chosenAnimal) {
            return true;
        }
    }

    return false;
}


// Show the matching cards and hide the others.
function filterServices(chosenAnimal) {
    let visibleCount = 0;

    serviceCards.forEach(function (card) {
        if (cardMatchesFilter(card, chosenAnimal)) {
            card.hidden = false;
            visibleCount++;
        } else {
            card.hidden = true;
        }
    });

    // Show a message if no service matches.
    noServicesMessage.hidden = visibleCount > 0;
}


// Highlight the clicked button and remove the highlight from the others.
function setActiveButton(clickedButton) {
    filterButtons.forEach(function (button) {
        button.classList.remove("active-filter");
        button.setAttribute("aria-pressed", "false");
    });

    clickedButton.classList.add("active-filter");
    clickedButton.setAttribute("aria-pressed", "true");
}


filterButtons.forEach(function (button) {
    button.addEventListener("click", function () {
        setActiveButton(button);
        filterServices(button.dataset.filter);
    });
});
