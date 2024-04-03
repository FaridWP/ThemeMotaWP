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
  $(".popup").show()
})
// MODAL CLOSE
$("#overlay").on("click", function () {
  $(".popup").hide()
})
