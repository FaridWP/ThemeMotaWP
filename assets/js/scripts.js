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

jQuery(document).ready(function ($) {
  // Fonction pour afficher le thumbnail au survol du lien précédent
  $(".left_arrow").hover(
    function () {
      $(this).find(".prev-thumbnail").css("display", "inline-block")
    },
    function () {
      $(this).find(".prev-thumbnail").css("display", "none")
    }
  )

  // Fonction pour afficher le thumbnail au survol du lien suivant
  $(".right_arrow").hover(
    function () {
      $(this).find(".next-thumbnail").css("display", "inline-block")
    },
    function () {
      $(this).find(".next-thumbnail").css("display", "none")
    }
  )
})

// HOVER PHOTO LIGHTBOX
$(document).ready(function () {
  $("#overlay__photo").hide() // Initially hide all overlay elements

  $(".overlay__on").each(function () {
    $(this).hover(
      function () {
        $(this).siblings("#overlay__photo").css("display", "flex")
      },
      function () {
        $(this).siblings(".overlay").hide() // Hide the overlay specific to the hovered item
      }
    )
  })
})
