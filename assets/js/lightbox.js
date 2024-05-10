class Lightbox {
  // Récupération des données sous forme de tableau
  static init() {
    const items = Array.from(document.querySelectorAll(".block__photo__item"))
    const images = items.map(item =>
      item.querySelector(".overlay__on img").getAttribute("src")
    )
    const titles = items.map(item =>
      item.querySelector(".overlay__on img").getAttribute("alt")
    )
    const categories = items.map(item => {
      const categoryElement = item.querySelector(".categorie")
      return categoryElement ? categoryElement.textContent : ""
    })
    const references = items.map(item => {
      const referenceElement = item.querySelector(".reference")
      return referenceElement ? referenceElement.textContent : ""
    })

    items.forEach((item, index) => {
      item.addEventListener("click", function (event) {
        const overlayIconLightbox = event.target.closest(
          ".overlay__icon__lightbox"
        )
        if (overlayIconLightbox) {
          event.preventDefault()
          const overlayOnLink = item.querySelector(".overlay__on")
          if (overlayOnLink) {
            const imageSrc = overlayOnLink
              .querySelector("img")
              .getAttribute("src")
            new Lightbox(imageSrc, images, titles, categories, references)
          }
        }
      })
    })
  }

  //   Constructeur pour initialiser les propriétés et ajouter l'élément au DOM
  constructor(url, images, titles, categories, references) {
    this.element = this.buildDOM(
      url,
      titles[images.indexOf(url)],
      categories[images.indexOf(url)],
      references[images.indexOf(url)]
    )
    this.images = images
    this.titles = titles
    this.categories = categories
    this.references = references
    this.loadImage(
      url,
      categories[images.indexOf(url)],
      references[images.indexOf(url)]
    )
    document.body.appendChild(this.element)
    bodyScrollLock.disableBodyScroll(this.element)
  }

  //   Chargement et mise à jour de l'image
  loadImage(url, category, reference) {
    this.url = null
    const image = new Image()
    const container = this.element.querySelector(".lightbox__container")
    const info = this.element.querySelector(".lightbox__info")
    const loader = document.createElement("div")
    loader.classList.add("lightbox__loader")
    container.innerHTML = ""
    container.appendChild(loader)
    image.onload = () => {
      container.removeChild(loader)
      container.appendChild(image)
      this.url = url
      // Mettre à jour la catégorie et la référence dans lightbox__info
      info.querySelector(".lightbox__info--text p:nth-child(1)").textContent =
        reference
      info.querySelector(".lightbox__info--text p:nth-child(2)").textContent =
        category
    }
    image.src = url
  }

  //   Fermeture de la lightbox
  close(e) {
    e.preventDefault()
    this.element.classList.add("fadeOut")
    bodyScrollLock.enableBodyScroll(this.element)
    window.setTimeout(() => {
      this.element.remove()
    }, 500)
  }

  //   Photo suivante
  next(e) {
    e.preventDefault()
    let i = this.images.findIndex(image => image === this.url)
    if (i === this.images.length - 1) {
      i = -1
    }
    this.loadImage(
      this.images[i + 1],
      this.categories[i + 1],
      this.references[i + 1]
    )
  }

  //   Photo précédente
  prev(e) {
    e.preventDefault()
    let i = this.images.findIndex(image => image === this.url)
    if (i === 0) {
      i = this.images.length
    }
    this.loadImage(
      this.images[i - 1],
      this.categories[i - 1],
      this.references[i - 1]
    )
  }

  // Template de la lightbox
  buildDOM(url, title, category, reference) {
    const dom = document.createElement("div")
    dom.classList.add("lightbox")
    dom.innerHTML = `<button class="lightbox__close">Fermer</button>
          <button class="lightbox__next">Suivant</button>
          <button class="lightbox__prev">Précédent</button>
          <div class="lightbox__container">
              <img src="${url}" alt="${title}">
          </div>
          <div class="lightbox__info">
          <div class="lightbox__info--text">
              <p>${reference}</p>
              <p>${category}</p>
          </div>
          </div>`

    dom
      .querySelector(".lightbox__close")
      .addEventListener("click", () => this.close(event))
    dom
      .querySelector(".lightbox__next")
      .addEventListener("click", () => this.next(event))
    dom
      .querySelector(".lightbox__prev")
      .addEventListener("click", () => this.prev(event))

    return dom
  }
}

// Fonction pour réinitialiser Lightbox
function resetLightbox() {
  Lightbox.init()
}

// Mise à jour de la lightbox après chaque requetes Ajax
$(document).ajaxComplete(resetLightbox)
// Vérifie si la page est la page d'accueil
if (window.location.pathname === "/") {
  // Appel Lightbox.init() directement au chargement de la page
  document.addEventListener("DOMContentLoaded", function () {
    Lightbox.init()
  })

  // Surveiller les requêtes AJAX pour réinitialiser la lightbox
  $(document).ajaxComplete(resetLightbox)
} else {
  // Initialisation de la lightbox pour les autres pages
  Lightbox.init()
}
