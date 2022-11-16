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
let csrfMeta = document.querySelector('meta[name="csrf-token"]');
$campusFilter?.addEventListener("change", (evt) => {
    let setCampus = evt.target.value;
    let setDate = $dateFilter.value;
    filter(setCampus, setDate);
});
$dateFilter?.addEventListener("change", (evt) => {
    let setDate = evt.target.value;
    let setCampus = $campusFilter ? $campusFilter.value : 0;
    filter(setCampus, setDate);
});

const filter = (setCampus, setDate) => {
    if (setCampus || setDate) {
        fetch(`/api/campus/${setCampus}/${setDate}`)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                if (data[0].length === 0) {
                    $filterDonations.innerHTML = "<p>no donations</p>";
                }

                if (data[0].length !== 0) {
                    $filterDonations.innerHTML = data[1].map((donation) => {
                        let icons = donation.allergen_icons.split(",");
                        return `<li class="meal-card">
                        <button class="meal-card__btn btn-primary claim" data-id="${
                            donation.id
                        }">Claim</button>
                        <div class="meal-card__info">
                            <p class="meal-card__info-description">${
                                donation.description
                            }</p>
                            <div class="meal-card__info-group">
                                <h3>${donation.name}</h3>
                                <ul class="request-card__allergies">
                                    ${icons
                                        .map((icon) => {
                                            return `<li class="request-card__icon">
                                                <img src="storage/images/food_allergy_icons/${icon}"
                                                    alt="">
                                            </li>`;
                                        })
                                        .join("")}
                                </ul>
                            </div>
                        </div>
                        <img src="storage/meals/${donation.image}" alt="${
                            donation.name
                        }"
                            class="meal-card__image">
                    </li>`;
                    });
                }
            });
    }
};

// Options for the observer (which mutations to observe)
const config = { attributes: true, childList: true, subtree: true };

// Callback function to execute when mutations are observed
const callback = (mutationList, observer) => {
    for (const mutation of mutationList) {
        if (mutation.type === "childList") {
            //claim
            let $claimBtn = document.getElementsByClassName("claim");
            for (let i = 0; i < $claimBtn.length; i++) {
                $claimBtn[i].addEventListener("click", (evt) => {
                    let $claimId = evt.target.dataset.id;

                    if ($claimId) {
                        fetch(`/api/claim/${$claimId}`)
                            .then((response) => response.json())
                            .then((data) => {
                                window.location.reload();
                            });
                    }
                });
            }
            //donate button
            let $donateButtons =
                document.getElementsByClassName("donate-button");
            for (let i = 0; i < $donateButtons.length; i++) {
                $donateButtons[i].addEventListener("click", (evt) => {
                    let $orderId = evt.target.dataset.id;
                    let $date = evt.target.dataset.date;
                    let $campus = document.getElementById("campus");
                    let $campusId = $campus ? $campus.value : 0;
                    let $form = document.getElementById(`${$orderId}-form`);
                    $form.innerHTML = `
        <div>

            <input id="campus_filter" type="text" class="form__input" name="campus_id" value="${$campusId}" hidden />
            <input type="" value =${$orderId} name="order_id" hidden>
            <div class="form__group">
                <div class="form__item">
                    <div class="form__file">
                        <input type="file" name="image" id="image-input" class="form__file-input">
                        <img src="storage/images/icons/add.svg" alt="add your food picture" class="form__file-icon"
                            id="food-img">
                        <label for="image" class="form__file-label"> add food picture</label>
                    </div>
                </div>
                <div class="form__sub-group">
                    <div class="form__item">
                        <input type="date" name="date" class="form__input" value=${$date} hidden>
                        <label for="date"class="form__label">${$date}</label>
                    </div>
                    <div class="form__item">
                        <input type="text" name="name" class="form__input" required>
                        <label for="name" class="form__label">Dish</label>
                    </div>
                </div>
            </div>

            <div class="form__item form__item--textarea">
                <label for="description"class="form__label">Description</label>
                <textarea name="description" class="form__input" required> </textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-primary--blue">Donate</button>
    </div>`;
                });
            }
        }
    }
};

// Create an observer instance linked to the callback function
const observer = new MutationObserver(callback);

// Start observing the target node for configured mutations

if ($filterDonations || $filterRequests) {
    observer.observe($filterDonations, config);
    observer.observe($filterRequests, config);
}

// delete user order

let $deleteUserOrder = document.getElementsByClassName("delete-userOrder");

for (let i = 0; i < $deleteUserOrder.length; i++) {
    $deleteUserOrder[i].addEventListener("click", (evt) => {
        let mealId = evt.target.dataset.id;
        if (mealId) {
            fetch(`/api/userOrder/delete/${mealId}`)
                .then((response) => response.json())
                .then((data) => {
                    window.location.reload();
                });
        }
    });
}

// delete user donation
let $deleteUserDonation = document.getElementsByClassName(
    "delete-userDonation"
);
for (let i = 0; i < $deleteUserDonation.length; i++) {
    $deleteUserDonation[i].addEventListener("click", (evt) => {
        let mealId = evt.target.dataset.id;
        if (mealId) {
            fetch(`/api/userDonation/delete/${mealId}`)
                .then((response) => response.json())
                .then((data) => {
                    window.location.reload();
                });
        }
    });
}

// delete user match
let $deleteUserMatch = document.getElementsByClassName("delete-userMatch");
for (let i = 0; i < $deleteUserMatch.length; i++) {
    $deleteUserMatch[i].addEventListener("click", (evt) => {
        let mealId = evt.target.dataset.id;
        if (mealId) {
            fetch(`/api/userMatch/delete/${mealId}`)
                .then((response) => response.json())
                .then((data) => {
                    window.location.reload();
                });
        }
    });
}
// delete user request
let $deleteUserRequest = document.getElementsByClassName("delete-userRequest");
for (let i = 0; i < $deleteUserRequest.length; i++) {
    $deleteUserRequest[i].addEventListener("click", (evt) => {
        let orderId = evt.target.dataset.id;
        if (orderId) {
            fetch(`/api/userRequest/delete/${orderId}`)
                .then((response) => response.json())
                .then((data) => {
                    window.location.reload();
                });
        }
    });
}

// donate button
let $donateButtons = document.getElementsByClassName("donate-button");
for (let i = 0; i < $donateButtons.length; i++) {
    $donateButtons[i].addEventListener("click", (evt) => {
        let $orderId = evt.target.dataset.id;
        let $date = evt.target.dataset.date;
        let $campus = document.getElementById("campus");

        let $campusId = $campus ? $campus.value : 0;
        let $form = document.getElementById(`${$orderId}-form`);
        $form.innerHTML = `
        <div>

            <input id="campus_filter" type="text" class="form__input" name="campus_id" value="${$campusId}" hidden />
            <input type="" value =${$orderId} name="order_id" hidden>
            <div class="form__group">
                <div class="form__item">
                    <div class="form__file">
                        <input type="file" name="image" id="image-input" class="form__file-input">
                        <img src="storage/images/icons/add.svg" alt="add your food picture" class="form__file-icon"
                            id="food-img">
                        <label for="image" class="form__file-label"> add food picture</label>
                    </div>
                </div>
                <div class="form__sub-group">
                    <div class="form__item">
                        <input type="date" name="date" class="form__input" value=${$date} hidden>
                        <label for="date"class="form__label">${$date}</label>
                    </div>
                    <div class="form__item">
                        <input type="text" name="name" class="form__input" required>
                        <label for="name" class="form__label">Dish</label>
                    </div>
                </div>
            </div>

            <div class="form__item form__item--textarea">
                <label for="description"class="form__label">Description</label>
                <textarea name="description" class="form__input" required> </textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-primary--blue">Donate</button>
    </div>`;
    });
}

// claim meal
let $claimBtn = document.getElementsByClassName("claim");
for (let i = 0; i < $claimBtn.length; i++) {
    $claimBtn[i].addEventListener("click", (evt) => {
        let $claimId = evt.target.dataset.id;
        if ($claimId) {
            fetch(`/api/claim/${$claimId}`)
                .then((response) => response.json())
                .then((data) => {
                    console.log(data);
                    //window.location.reload();
                });
        }
    });
}

// drop meal
let $dropBtn = document.getElementsByClassName("drop-btn");
for (let i = 0; i < $dropBtn.length; i++) {
    $dropBtn[i].addEventListener("click", (evt) => {
        let $dropId = evt.target.dataset.id;
        if ($dropId) {
            fetch(`/api/drop/${$dropId}`)
                .then((response) => response.json())
                .then((data) => {
                    window.location.reload();
                });
        }
    });
}
// collect meal
let $collectBtn = document.getElementsByClassName("collect-btn");
for (let i = 0; i < $collectBtn.length; i++) {
    $collectBtn[i].addEventListener("click", (evt) => {
        let $collectId = evt.target.dataset.id;
        if ($collectId) {
            fetch(`/api/collect/${$collectId}`)
                .then((response) => response.json())
                .then((data) => {
                    window.location.reload();
                });
        }
    });
}
