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

jQuery(document).ready(function ($) {
  // Fonction pour afficher le thumbnail au survol du lien précédent
  $(".prev-post-link").hover(
    function () {
      $(this).siblings(".prev-post-thumbnail").css("display", "inline-block")
    },
    function () {
      $(this).siblings(".prev-post-thumbnail").css("display", "none")
    }
  )

  // Fonction pour afficher le thumbnail au survol du lien suivant
  $(".next-post-link").hover(
    function () {
      $(this).siblings(".next-post-thumbnail").css("display", "inline-block")
    },
    function () {
      $(this).siblings(".next-post-thumbnail").css("display", "none")
    }
  )
})
