
let swiper = new Swiper(".js-main-banner", {
	slidesPerView: 1,
	loop: false,
	init: false,
	spaceBetween: 20,
  navigation: {
    nextEl: ".js-main-banner__next",
    prevEl: ".js-main-banner__prev",
  },
	
});

swiper.on("slideChange afterInit init", function () {
		let currentSlide = this.activeIndex + 1;
		document.querySelector('.counter').innerHTML = `
		<span class="counter__current">
		${currentSlide}
		</span> 
		<span>/</span>
		<span class="counter__total">
			${this.slides.length}
		</span>`;
});

swiper.init();