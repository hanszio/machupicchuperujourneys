console.log('Hola Zio');

console.log("Hola Zio");

document.addEventListener("DOMContentLoaded", function () {
	var menuItems = document.querySelectorAll(
		".header__menu .menu-item-has-children > a"
	);

	for (var i = 0; i < menuItems.length; i++) {
		menuItems[i].addEventListener("click", function (e) {
			if (window.innerWidth < 1200) {
				// Cambia el valor si deseas un punto de corte diferente para dispositivos móviles
				e.preventDefault();
				var parentItem = this.parentNode;
				var submenu = parentItem.querySelector(".sub-menu");

				if (submenu.style.display === "block") {
					submenu.style.display = "none";
					parentItem.classList.remove("active");
				} else {
					submenu.style.display = "block";
					parentItem.classList.add("active");
				}
			}
		});
	}
});

jQuery(document).ready(function ($) {
	if ($("main").hasClass("itinerarios__box")) {
		// Inicializar el slider usando Tiny Slider
		var slider__itinerario = tns({
			container: ".slider__itinerario",
			items: 1,
			controls: false,
			nav: false,
			slideBy: "page",
			autoplay: true,
			autoplayButtonOutput: false,
			autoHeight: false,
			speed: 200,
			animateIn: "fadeInDown",
			animateOut: "fadeOutDown",
			// Opciones adicionales de Tiny Slider
		});
	}
});