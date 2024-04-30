// MENU BURGER
$(".hamburger").on("click", function () {
  $(".hamburger").toggleClass("is-active")
  $(".navbar__menu__mobile").toggleClass("navbar__menu__mobile--active")
})
// MENU BURGER CLOSE quand click sur "contact"
$(".navbar__menu__mobile")
  .find('a[href="#contact"]')
  .on("click", function () {
    $(".hamburger").toggleClass("is-active")
    $(".navbar__menu__mobile").toggleClass("navbar__menu__mobile--active")
  })

// MODAL OPEN
$('a[href="#contact"]').on("click", function () {
  $(".popup").show("fade")
})

// MODAL CLOSE
$(".close_modal").on("click", function () {
  $(".popup").hide("fade")
})
// MODAL OPEN Référence
$(".contact_photo").on("click", function () {
  mettreAJourValeurDansModal()
  $(".popup").show("fade")
})

// MISE A JOUR FORMULAIRE CONTACT AVEC REFERENCE
let valeurSurPage = document.getElementById("reference").innerText
// Récupérer l'input dans la modal
let inputModal = document.querySelector(
  '.modal__form input[name="your-subject"]'
)
// Mettre à jour la valeur de l'input lorsque la modal s'ouvre
function mettreAJourValeurDansModal() {
  inputModal.value = valeurSurPage
}

// FLECHES PETIT SLIDER PAGE SINGLE
jQuery(document).ready(function ($) {
  // Fonction pour afficher le thumbnail au survol du lien précédent
  $(".left_arrow").hover(
    function () {
      $(this).siblings(".prev-post-thumbnail").css("display", "inline-block")
    },
    function () {
      $(this).siblings(".prev-post-thumbnail").css("display", "none")
    }
  )

  // Fonction pour afficher le thumbnail au survol du lien suivant
  $(".right_arrow").hover(
    function () {
      $(this).siblings(".next-post-thumbnail").css("display", "inline-block")
    },
    function () {
      $(this).siblings(".next-post-thumbnail").css("display", "none")
    }
  )
})

// HOVER PHOTO
$(document).ready(function () {
  $("#overlay__photo").hide()

  $(".overlay__on").each(function () {
    var overlay = $(this).siblings("#overlay__photo")
    var timer

    $(this)
      .on("mouseenter", function () {
        clearTimeout(timer)
        overlay.css("display", "flex")
      })
      .on("mouseleave", function () {
        timer = setTimeout(function () {
          overlay.css("display", "none")
        }, 200)
      })

    overlay
      .on("mouseenter", function () {
        clearTimeout(timer)
      })
      .on("mouseleave", function () {
        overlay.css("display", "none")
      })
  })
})

// INIT SELECT
let dropdownCategory = document.getElementById("categorieDropdown")
let dropdownFormat = document.getElementById("categorieDropdown")
var dropdownDate = document.getElementById("categorieDropdown")
// SELECT Catégorie
function toggleDropdown() {
  const dropdown = document.getElementById("categorieDropdown")
  const arrow = document.querySelector(".arrow__cat")
  dropdown.style.display = dropdown.style.display === "none" ? "block" : "none"
  arrow.classList.toggle("rotation-180")
}

function selectOption(option) {
  var selectedOption = document.querySelector(".selected-option")
  selectedOption.textContent = option
  var dropdown = document.getElementById("categorieDropdown")
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
  var selectedOption = document.querySelector(".selected-option-format")
  selectedOption.textContent = option
  var dropdown = document.getElementById("formatDropdown")
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
  var selectedOption = document.querySelector(".selected-option-date")
  selectedOption.textContent = option
  var dropdown = document.getElementById("dateDropdown")
  dropdown.style.display = "none"

  toggleDropdownDate()
}
