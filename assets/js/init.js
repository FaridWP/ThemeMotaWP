// Chargement de la gallerie de la page d'accueil
document.addEventListener("DOMContentLoaded", function () {
  $.ajax({
    url: mon_script_js.ajax_url,
    type: "POST",
    data: {
      action: "tri_date",
      sort: "DESC",
      posts_per_page: 8,
    },
    success: function (response) {
      $(".container__bottom").html(response)
    },
  })

  function loadMoreHome(sort) {
    $.ajax({
      url: mon_script_js.ajax_url,
      type: "POST",
      data: {
        action: "tri_date",
        sort: "ASC",
        posts_per_page: -1,
      },
      success: function (response) {
        $(".container__bottom").html(response)
        $(".button__home__btn").hide()
      },
    })
  }
})
