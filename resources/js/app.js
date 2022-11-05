import { add } from "lodash";
import "./bootstrap";

//expand all allergies

let $more = document.getElementById("more");
let $moreContainer = document.getElementById("more-container");

$more?.addEventListener("click", (evt) => {
    fetch("/api/allergens")
        .then((response) => response.json())
        .then((data) => {
            $moreContainer.innerHTML = "";
            data.forEach(($allergy) => {
                $moreContainer.innerHTML += `
                <div class="tile">
                    <img src="storage/images/food_allergy_icons/${$allergy.icon}" alt="${$allergy.name}"
                        class="tile__image">
                    <label class="tile__text" for="${$allergy.name}">${$allergy.name}
                        <input type="checkbox" id="${$allergy.name}" name="allergies[]" value="${$allergy.id}"
                            selected>
                        <div class="tile__custom_checkbox"></div>
                    </label>
                </div>
                `;
                '<label><input class="extra-allergy" type="checkbox" name="allergies[]" value="' +
                    $allergy.id +
                    '"> ' +
                    $allergy.name +
                    "</label>";
            });
        });
});

// empty form
let $reset = document.getElementById("reset");
let $resetBtn = document.getElementById("reset-btn");
let $form = document.getElementById("form-allergy");

$resetBtn?.addEventListener("click", (evt) => {
    $form.reset();
    $reset.innerHTML = ``;
});

// open menu
let $menuBtn = document.getElementById("menu-btn");
$menuBtn?.addEventListener("click", (evt) => {
    $menu.classList.remove("closed");
});

// close btn hamburger menu
let $closeBtn = document.getElementById("close-btn");
let $menu = document.getElementById("hamburger-menu");

$closeBtn?.addEventListener("click", (evt) => {
    $menu.classList.add("closed");
});

// donate page file preview
let $img = document.getElementById("image-input");
let $imgPreview = document.getElementById("food-img");

$img?.addEventListener("change", (evt) => {
    let [file] = $img.files;
    if (file) {
        $imgPreview.src = URL.createObjectURL(file);
    }
});

// filters for community page

let $campusFilter = document.getElementById("campus_filter");
let $dateFilter = document.getElementById("date_filter");
let $filterRequests = document.getElementById("filter-requests");
let $filterDonations = document.getElementById("filter-donations");

$campusFilter?.addEventListener("change", (evt) => {
    let setCampus = evt.target.value;
    let setDate = $dateFilter.value;
    filter(setCampus, setDate);
});
$dateFilter?.addEventListener("change", (evt) => {
    let setDate = evt.target.value;
    let setCampus = $campusFilter.value;
    filter(setCampus, setDate);
});

const filter = (setCampus, setDate) => {
    if (setCampus && setDate) {
        fetch(`/api/campus/${setCampus}/${setDate}`)
            .then((response) => response.json())
            .then((data) => {
                if (data[0].length === 0) {
                    $filterRequests.innerHTML = "<p>no requests</p>";
                }

                if (data[0].length !== 0) {
                    $filterRequests.innerHTML = data[0].map((request) => {
                        return `<li class="request-card">
                        <img src="storage/images/icons/delete.svg" alt="delete meal" class="request-card__delete">
                        <div class="request-card__allergies-container">
                            <p>Allergies</p>
                            <ul class="request-card__allergies">
                                    ${request.id}
                            </ul>
                        </div>
                        <p>Donate</p>
                    </li>`;
                    });
                }

                if (data[1].length === 0) {
                    $filterDonations.innerHTML = "<p>no donations</p>";
                    console.log("no data");
                }

                if (data[1].length !== 0) {
                    $filterDonations.innerHTML = data[1].map((donation) => {
                        return `<li class="meal-card">
                        <img src="storage/images/icons/delete.svg" alt="delete meal" class="meal-card__delete">
                        <button class="meal-card__btn btn-primary">Claim</button>
                        <div class="meal-card__info">
                            <p class="meal-card__info-description">${donation.description}</p>
                            <div class="meal-card__info-group">
                                <h3>${donation.name}</h3>
                                <ul>
                                    <li>food contains</li>
                                </ul>
                            </div>
                        </div>
                        <img src="storage/meals/${donation.image}" alt="${donation.name}"
                            class="meal-card__image">
                    </li>`;
                    });
                }
            });
    }
};
