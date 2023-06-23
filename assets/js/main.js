
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



let swiperNewsMainPage = new Swiper(".js-swiper-news", {
	slidesPerView: 3,
	spaceBetween: 0,
  navigation: {
    nextEl: ".js-swiper-news__next",
    prevEl: ".js-swiper-news__prev ",
  },
	
});


const myModal = new HystModal({
	linkAttributeName: "data-hystmodal",
	
});


// file uplaod
const fileInput = document.getElementById("file-upload");
const fileNameSpan = document.querySelector(".file-name");

if (document.getElementById("file-upload")) {
  fileInput.addEventListener("change", () => {
    const file = fileInput.files[0];

    if (file) {
      fileNameSpan.textContent = file.name;
    } else {
      fileNameSpan.textContent = "Прикрепите файл";
    }
  });
}