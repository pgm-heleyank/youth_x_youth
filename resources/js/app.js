import "./bootstrap";

//api js for searching allergies

let $search_allergy = document.getElementById("search_allergy");
let $checkboxes = document.getElementById("checkboxes");

$search_allergy.addEventListener("keyup", (evt) => {
    var search_string = $search_allergy.value;
    if (search_string.length) {
        fetch("/api/allergens/" + search_string)
            .then((response) => response.json())
            .then((data) => {
                $checkboxes.innerHTML = "";
                data.forEach(($allergy) => {
                    $checkboxes.innerHTML +=
                        '<label><input class="extra-allergy" type="checkbox" name="allergies[]" value="' +
                        $allergy.id +
                        '"> ' +
                        $allergy.name +
                        "</label>";
                });
            });
    }
});
