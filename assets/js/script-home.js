// INIT SELECT
const dropdownCategory = document.getElementById("categorieDropdown")
const dropdownFormat = document.getElementById("formatDropdown")
const dropdownDate = document.getElementById("dateDropdown")

const arrowCat = document.querySelector(".arrow__cat")
const arrowFormat = document.querySelector(".arrow__format")
const arrowDate = document.querySelector(".arrow__date")

const catOption = document.querySelector(".selected-option")
const formatOption = document.querySelector(".selected-option-format")
const dateOption = document.querySelector(".selected-option-date")

// SELECT Catégorie
function toggleDropdown() {
  dropdownCategory.style.display =
    dropdownCategory.style.display === "none" ? "block" : "none"
  arrowCat.classList.toggle("rotation-180")
}

function selectOption(option) {
  catOption.textContent = option
  dropdownCategory.style.display = "none"

  toggleDropdown()
}

// SELECT Format
function toggleDropdownFormat() {
  dropdownFormat.style.display =
    dropdownFormat.style.display === "none" ? "block" : "none"
  arrowFormat.classList.toggle("rotation-180")
}

function selectOptionFormat(option) {
  formatOption.textContent = option
  dropdownFormat.style.display = "none"

  toggleDropdownFormat()
}

// SELECT Date
function toggleDropdownDate() {
  dropdownDate.style.display =
    dropdownDate.style.display === "none" ? "block" : "none"
  arrowDate.classList.toggle("rotation-180")
}

function selectOptionDate(option) {
  dateOption.textContent = option
  dropdownDate.style.display = "none"

  toggleDropdownDate()
}

// RESET Tri
dropdownCategory.addEventListener("click", function () {
  arrowCat.classList.toggle("rotation-180")
  formatOption.textContent = "Formats"
  dateOption.textContent = "Trier par"
  if (dropdownFormat.style.display !== "none") {
    dropdownFormat.style.display = "none"
    arrowFormat.classList.toggle("rotation-180")
  }
  if (dropdownDate.style.display !== "none") {
    dropdownDate.style.display = "none"
    arrowDate.classList.toggle("rotation-180")
  }
})
catOption.addEventListener("click", function () {
  if (dropdownFormat.style.display !== "none") {
    dropdownFormat.style.display = "none"
    arrowFormat.classList.toggle("rotation-180")
  }
  if (dropdownDate.style.display !== "none") {
    dropdownDate.style.display = "none"
    arrowDate.classList.toggle("rotation-180")
  }
})

dropdownFormat.addEventListener("click", function () {
  arrowFormat.classList.toggle("rotation-180")
  catOption.textContent = "Catégories"
  dateOption.textContent = "Trier par"
  if (dropdownCategory.style.display !== "none") {
    dropdownCategory.style.display = "none"
    arrowCat.classList.toggle("rotation-180")
  }
  if (dropdownDate.style.display !== "none") {
    dropdownDate.style.display = "none"
    arrowDate.classList.toggle("rotation-180")
  }
})
formatOption.addEventListener("click", function () {
  if (dropdownCategory.style.display !== "none") {
    dropdownCategory.style.display = "none"
    arrowCat.classList.toggle("rotation-180")
  }
  if (dropdownDate.style.display !== "none") {
    dropdownDate.style.display = "none"
    arrowDate.classList.toggle("rotation-180")
  }
})
dropdownDate.addEventListener("click", function () {
  arrowDate.classList.toggle("rotation-180")
  catOption.textContent = "Catégories"
  formatOption.textContent = "Formats"
  if (dropdownCategory.style.display !== "none") {
    dropdownCategory.style.display = "none"
    arrowCat.classList.toggle("rotation-180")
  }
  if (dropdownFormat.style.display !== "none") {
    dropdownFormat.style.display = "none"
    arrowFormat.classList.toggle("rotation-180")
  }
})
dateOption.addEventListener("click", function () {
  if (dropdownCategory.style.display !== "none") {
    dropdownCategory.style.display = "none"
    arrowCat.classList.toggle("rotation-180")
  }
  if (dropdownFormat.style.display !== "none") {
    dropdownFormat.style.display = "none"
    arrowFormat.classList.toggle("rotation-180")
  }
})

// Fermeture des Tris lorsqu'on clic sur le DOM
document.addEventListener("click", function (event) {
  const elementsToAvoid = [
    ".custom-select",
    ".selected-option",
    ".selected-option-format",
    ".selected-option-date",
    ".arrow__cat",
    ".arrow__format",
    ".arrow__date",
  ]

  if (!elementsToAvoid.some(selector => event.target.matches(selector))) {
    if (dropdownCategory.style.display !== "none") {
      dropdownCategory.style.display = "none"
      arrowCat.classList.toggle("rotation-180")
      catOption.textContent = "Catégories"
    }
    if (dropdownFormat.style.display !== "none") {
      dropdownFormat.style.display = "none"
      arrowFormat.classList.toggle("rotation-180")
      formatOption.textContent = "Formats"
    }
    if (dropdownDate.style.display !== "none") {
      dropdownDate.style.display = "none"
      arrowDate.classList.toggle("rotation-180")
      dateOption.textContent = "Trier par"
    }
  }
})

//AJAX

// Tri par Catégories
let sortCat
jQuery(document).ready(function ($) {
  function loadMorePostsCat(sort) {
    $.ajax({
      url: mon_script_js.ajax_url,
      type: "POST",
      data: {
        action: "tri_categories",
        sort: sort,
        posts_per_page: 8,
      },
      success: function (response) {
        $(".container__bottom").html(response)
      },
    })
  }

  $(".option.cat").on("click", function () {
    sortCat = $(this).html()
    loadMorePostsCat(sortCat)
  })
})
// Bouton Tri Catégories
function loadMoreCat(sort) {
  $.ajax({
    url: mon_script_js.ajax_url,
    type: "POST",
    data: {
      action: "tri_categories",
      sort: sort,
      posts_per_page: -1,
    },
    success: function (response) {
      $(".container__bottom").html(response)
      $(".button__home__btn").hide()
    },
  })
}

// Tri par Format
let sortFormat
jQuery(document).ready(function ($) {
  function loadMorePostsFormat(sort) {
    $.ajax({
      url: mon_script_js.ajax_url,
      type: "POST",
      data: {
        action: "tri_format",
        sort: sort,
        posts_per_page: 8,
      },
      success: function (response) {
        $(".container__bottom").html(response)
      },
    })
  }

  $(".option.format").on("click", function () {
    sortFormat = $(this).html()
    loadMorePostsFormat(sortFormat)
  })
})
// Bouton Tri Format
function loadMoreFormat(sort) {
  $.ajax({
    url: mon_script_js.ajax_url,
    type: "POST",
    data: {
      action: "tri_format",
      sort: sort,
      posts_per_page: -1,
    },
    success: function (response) {
      $(".container__bottom").html(response)
      $(".button__home__btn").hide()
    },
  })
}

// Tri par Date
let sortDate
jQuery(document).ready(function ($) {
  function loadMorePostsDate(sort) {
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

  $(".option.date").on("click", function () {
    if ($(this).html() == "à partir des plus récentes") {
      sortDate = "DESC"
    } else if ($(this).html() == "à partir des plus anciennes") {
      sortDate = "ASC"
    }
    loadMorePostsDate(sortDate)
  })
})
// Bouton Tri Date
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
