// INIT SELECT
let dropdownCategory = document.getElementById("categorieDropdown")
let dropdownFormat = document.getElementById("categorieDropdown")
let dropdownDate = document.getElementById("categorieDropdown")
// SELECT Catégorie
function toggleDropdown() {
  const dropdown = document.getElementById("categorieDropdown")
  const arrow = document.querySelector(".arrow__cat")
  dropdown.style.display = dropdown.style.display === "none" ? "block" : "none"
  arrow.classList.toggle("rotation-180")
}

function selectOption(option) {
  const selectedOption = document.querySelector(".selected-option")
  selectedOption.textContent = option
  const dropdown = document.getElementById("categorieDropdown")
  dropdown.style.display = "none"

  toggleDropdown()
}

// SELECT Format
function toggleDropdownFormat() {
  const dropdown = document.getElementById("formatDropdown")
  const arrow = document.querySelector(".arrow__format")
  dropdown.style.display = dropdown.style.display === "none" ? "block" : "none"
  arrow.classList.toggle("rotation-180")
}

function selectOptionFormat(option) {
  const selectedOption = document.querySelector(".selected-option-format")
  selectedOption.textContent = option
  const dropdown = document.getElementById("formatDropdown")
  dropdown.style.display = "none"

  toggleDropdownFormat()
}

// SELECT Date
function toggleDropdownDate() {
  const dropdown = document.getElementById("dateDropdown")
  const arrow = document.querySelector(".arrow__date")
  dropdown.style.display = dropdown.style.display === "none" ? "block" : "none"
  arrow.classList.toggle("rotation-180")
}

function selectOptionDate(option) {
  const selectedOption = document.querySelector(".selected-option-date")
  selectedOption.textContent = option
  const dropdown = document.getElementById("dateDropdown")
  dropdown.style.display = "none"

  toggleDropdownDate()
}

//AJAX
/*
document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelector(".custom-select")
    .addEventListener("click", function () {
      let formData = new FormData()
      formData.append("action", "tri_categories")

      const categoryValue = document.querySelector(".selected-option")

      fetch(mon_script_js.ajax_url, {
        method: "POST",
        body: formData,
      })
        .then(function (response) {
          if (!response.ok) {
            throw new Error("Network response error.")
          }

          console.log(response.json())
          return response.json()
        })
        .then(function (data) {
          data.posts.forEach(function (post) {
            document
              .querySelector("#ajax")
              .insertAdjacentHTML(
                "beforeend",
                "<h1>" + post.post_title + "</h1>"
              )
          })
          console.log(categoryValue)
        })
        .catch(function (error) {
          console.error("There was a problem with the fetch operation: ", error)
        })
    })
})*/

// jQuery(document).ready(function ($) {
//   $.ajax({
//     url: ajax_test_params.ajax_url,
//     type: "POST",
//     data: {
//       action: "my_ajax_test",
//       security: ajax_test_params.nonce,
//     },
//     success: function (response) {
//       console.log(response)
//     },
//   })
// })

// Tri par Catégorie
jQuery(document).ready(function ($) {
  // AJAX call when sorting option is changed
  $(".option.cat").click(function () {
    let sort = $(this).html()
    console.log(sort)
    $.ajax({
      url: mon_script_js.ajax_url,
      type: "POST",
      data: {
        action: "tri_categories",
        sort: sort,
      },
      success: function (response) {
        $(".container__bottom").html(response)
      },
    })
  })
})

// Tri par Format
jQuery(document).ready(function ($) {
  // AJAX call when sorting option is changed
  $(".option.format").click(function () {
    let sort = $(this).html()
    console.log(sort)
    $.ajax({
      url: mon_script_js.ajax_url,
      type: "POST",
      data: {
        action: "tri_format",
        sort: sort,
      },
      success: function (response) {
        $(".container__bottom").html(response)
      },
    })
  })
})

// Tri par Date
jQuery(document).ready(function ($) {
  // AJAX call when sorting option is changed
  $(".option.date").click(function () {
    let sort
    if ($(this).html() == "à partir des plus récentes") {
      sort = "DESC"
    }
    if ($(this).html() == "à partir des plus anciennes") {
      sort = "ASC"
    }

    console.log(sort)
    $.ajax({
      url: mon_script_js.ajax_url,
      type: "POST",
      data: {
        action: "tri_date",
        sort: sort,
      },
      success: function (response) {
        $(".container__bottom").html(response)
      },
    })
  })
})
