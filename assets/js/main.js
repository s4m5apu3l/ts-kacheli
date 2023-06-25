
let swiper = new Swiper(".js-main-banner", {
	slidesPerView: 1,
	loop: false,
	init: false,
  navigation: {
    nextEl: ".js-main-banner__next",
    prevEl: ".js-main-banner__prev",
  },
  breakpoints: {
    '0': {
      spaceBetween: 8,
    },
    '768':{
      spaceBetween: 20,
    }
  }
	
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

  navigation: {
    nextEl: ".js-swiper-news__next",
    prevEl: ".js-swiper-news__prev ",
  },
	breakpoints: {
    '0':{
      slidesPerView: 1,
      spaceBetween: 8,
    },
    '680':{
      slidesPerView: 2,
      spaceBetween: 0,
    },
    '950':{
      slidesPerView: 3,
      spaceBetween: 0,
    },
  }
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

// Burger
const burgerMenu = document.querySelector(".l-burger__btn");
const menuItems = document.querySelector(".l-header__body");
const closeBtn = document.querySelector(".l-close__btn");
const header = document.querySelector(".l-header");

burgerMenu.addEventListener("click", () => {
  burgerMenu.classList.toggle("active");
  menuItems.classList.toggle("active");
  header.classList.toggle("active-header");
});

closeBtn.addEventListener("click", () => {
  menuItems.classList.remove("active");
});


document.addEventListener("click", (event) => {
  const target = event.target;
  const isClickInsideHeader = header.contains(target);

  if (!isClickInsideHeader) {
    // Код для закрытия шапки
    burgerMenu.classList.remove("active");
    menuItems.classList.remove("active");
    header.classList.remove("active-header");
  }
});