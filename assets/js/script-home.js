// INIT SELECT
let dropdownCategory = document.getElementById("categorieDropdown")
let dropdownFormat = document.getElementById("formatDropdown")
let dropdownDate = document.getElementById("dateDropdown")
// SELECT Catégorie
function toggleDropdown() {
  const arrow = document.querySelector(".arrow__cat")
  dropdownCategory.style.display =
    dropdownCategory.style.display === "none" ? "block" : "none"
  arrow.classList.toggle("rotation-180")
}

function selectOption(option) {
  const selectedOption = document.querySelector(".selected-option")
  selectedOption.textContent = option
  dropdownCategory.style.display = "none"

  toggleDropdown()
}

// SELECT Format
function toggleDropdownFormat() {
  const arrow = document.querySelector(".arrow__format")
  dropdownFormat.style.display =
    dropdownFormat.style.display === "none" ? "block" : "none"
  arrow.classList.toggle("rotation-180")
}

function selectOptionFormat(option) {
  const selectedOption = document.querySelector(".selected-option-format")
  selectedOption.textContent = option
  dropdownFormat.style.display = "none"

  toggleDropdownFormat()
}

// SELECT Date
function toggleDropdownDate() {
  const arrow = document.querySelector(".arrow__date")
  dropdownDate.style.display =
    dropdownDate.style.display === "none" ? "block" : "none"
  arrow.classList.toggle("rotation-180")
}

function selectOptionDate(option) {
  const selectedOption = document.querySelector(".selected-option-date")
  selectedOption.textContent = option
  dropdownDate.style.display = "none"

  toggleDropdownDate()
}

// RESET Tri
const catOption = document.querySelector(".selected-option")
const formatOption = document.querySelector(".selected-option-format")
const dateOption = document.querySelector(".selected-option-date")

catOption.addEventListener("click", function (event) {
  dropdownDate.style.display = "none"
  dropdownFormat.style.display = "none"
})

formatOption.addEventListener("click", function () {
  dropdownDate.style.display = "none"
  dropdownCategory.style.display = "none"
})
dateOption.addEventListener("click", function () {
  dropdownCategory.style.display = "none"
  dropdownFormat.style.display = "none"
})

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
/*
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
*/
/*
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
})*/
let sort
jQuery(document).ready(function ($) {
  // Fonction pour charger les posts supplémentaires
  function loadMorePosts(sort) {
    $.ajax({
      url: mon_script_js.ajax_url,
      type: "POST",
      data: {
        action: "tri_date",
        sort: sort,
        posts_per_page: 8,
      },
      success: function (response) {
        $(".container__bottom").html(response)
      },
    })
  }

  // Écouteur d'événement pour les clics sur l'élément .option.date
  $(".option.date").on("click", function () {
    if ($(this).html() == "à partir des plus récentes") {
      sort = "DESC"
    } else if ($(this).html() == "à partir des plus anciennes") {
      sort = "ASC"
    }
    loadMorePosts(sort)
  })
})

function loadMoreDate(sort) {
  $.ajax({
    url: mon_script_js.ajax_url,
    type: "POST",
    data: {
      action: "tri_date",
      sort: sort,
      posts_per_page: -1,
    },
    success: function (response) {
      $(".container__bottom").html(response)
      $(".button__home__btn").hide()
    },
  })
}

function loadMoreHome(sort) {
  $.ajax({
    url: mon_script_js.ajax_url,
    type: "POST",
    data: {
      action: "tri_home",
      sort: sort,
      posts_per_page: -1,
    },
    success: function (response) {
      $(".container__bottom").html(response)
      $(".button__home__btn").hide()
    },
  })
}
