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
$("#overlay").on("click", function () {
  $(".popup").hide("fade")
})
// MODAL OPEN Référence
$(".contact_photo").on("click", function () {
  mettreAJourValeurDansModal()
  $(".popup").show("fade")
})

// MISE A JOUR FORMULAIRE CONTACT AVEC REFERENCE
const referenceElement = document.querySelector("#reference")
  ? document.querySelector("#reference")
  : "ref"
let valeurSurPage, inputModal

if (referenceElement) {
  valeurSurPage = referenceElement.innerText
} else {
  console.warn("Element #reference not found.")
}
// Récupérer l'input dans la modal
inputModal = document.querySelector('.modal__form input[name="your-subject"]')
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
// HOVER PHOTO AJAX
$(document).ajaxComplete(function () {
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
