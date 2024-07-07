// javascript.js

document.addEventListener('DOMContentLoaded', () => {
  // Slider functionality
  let index = 0;
  const slides = document.querySelectorAll('.slide');
  const totalSlides = slides.length;

  document.querySelector('.next').addEventListener('click', () => {
    changeSlide(1);
  });

  document.querySelector('.prev').addEventListener('click', () => {
    changeSlide(-1);
  });

  function changeSlide(direction) {
    slides[index].classList.remove('active');
    index = (index + direction + totalSlides) % totalSlides;
    slides[index].classList.add('active');
    document.querySelector('.slides').style.transform = `translateX(${-index * 100}%)`;
  }
});

/* Existing script logic */

const showMenu = (toggleId, navId) => {
  const toggle = document.getElementById(toggleId);
  const nav = document.getElementById(navId);

  if (toggle && nav) {
      toggle.addEventListener('click', () => {
          nav.classList.toggle('show-menu');
      });
  }
}
showMenu('nav-toggle', 'nav-menu');

/* Remove menu on mobile */
const navLinks = document.querySelectorAll('.nav__link');

function linkAction() {
  const navMenu = document.getElementById('nav-menu');
  navMenu.classList.remove('show-menu');
}

navLinks.forEach(link => link.addEventListener('click', linkAction));

/* Scroll sections active link */
const sections = document.querySelectorAll('section[id]');

function scrollActive() {
  const scrollY = window.pageYOffset;

  sections.forEach(current => {
      const sectionHeight = current.offsetHeight;
      const sectionTop = current.offsetTop - 50;
      const sectionId = current.getAttribute('id');

      if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
          document.querySelector(`.nav__menu a[href*=${sectionId}]`).classList.add('active-link');
      } else {
          document.querySelector(`.nav__menu a[href*=${sectionId}]`).classList.remove('active-link');
      }
  });
}

window.addEventListener('scroll', scrollActive);

/* Change background header */
function scrollHeader() {
  const nav = document.getElementById('header');
  if (this.scrollY >= 200) {
      nav.classList.add('scroll-header');
  } else {
      nav.classList.remove('scroll-header');
  }
}

window.addEventListener('scroll', scrollHeader);

/* Show scroll top */
function scrollTop() {
  const scrollTop = document.getElementById('scroll-top');
  if (this.scrollY >= 560) {
      scrollTop.classList.add('show-scroll');
  } else {
      scrollTop.classList.remove('show-scroll');
  }
}

window.addEventListener('scroll', scrollTop);

/* Dark light theme */
const themeButton = document.getElementById('theme-button');
const darkTheme = 'dark-theme';
const iconTheme = 'bx-sun';

const selectedTheme = localStorage.getItem('selected-theme');
const selectedIcon = localStorage.getItem('selected-icon');

const getCurrentTheme = () => document.body.classList.contains(darkTheme) ? 'dark' : 'light';
const getCurrentIcon = () => themeButton.classList.contains(iconTheme) ? 'bx-moon' : 'bx-sun';

if (selectedTheme) {
  document.body.classList[selectedTheme === 'dark' ? 'add' : 'remove'](darkTheme);
  themeButton.classList[selectedIcon === 'bx-moon' ? 'add' : 'remove'](iconTheme);
}

themeButton.addEventListener('click', () => {
  document.body.classList.toggle(darkTheme);
  themeButton.classList.toggle(iconTheme);

  localStorage.setItem('selected-theme', getCurrentTheme());
  localStorage.setItem('selected-icon', getCurrentIcon());
});

/* Scroll reveal animation */
const sr = ScrollReveal({
  origin: 'top',
  distance: '30px',
  duration: 2000,
  reset: true
});

sr.reveal(`
  .home__data, .home__img,
  .about__data, .about__img,
  .services__content, .donor__content,
  .app__data, .app__img,
  .contact__data, .contact__button,
  .footer__content
`, {
  interval: 200
});

/* Splitview mode */
document.addEventListener("DOMContentLoaded", function () {
  const parent = document.querySelector(".splitview");
  const topPanel = parent.querySelector(".top");
  const handle = parent.querySelector(".handle");
  let skewHack = 0;
  let delta = 0;

  if (parent.classList.contains("skewed")) {
      skewHack = 1000;
  }

  parent.addEventListener("mousemove", function (event) {
      delta = (event.clientX - window.innerWidth / 2) * 0.5;
      handle.style.left = event.clientX + delta + "px";
      topPanel.style.width = event.clientX + skewHack + delta + "px";
  });
});

/* Swiper */

// const swiper = new Swiper(".slide-content", {
//   slidesPerView: 3,
//   spaceBetween: 25,
//   loop: true,
//   centerSlide: "true",
//   fade: "true",
//   grabCursor: "true",
//   pagination: {
//       el: ".swiper-pagination",
//       clickable: true,
//       dynamicBullets: true
//   },
//   navigation: {
//       nextEl: ".swiper-button-next",
//       prevEl: ".swiper-button-prev"
//   },
//   breakpoints: {
//       0: { slidesPerView: 1 },
//       520: { slidesPerView: 2 },
//       950: { slidesPerView: 3 }
//   }
// });

/*form donate form*/
document.getElementById('donationForm').addEventListener('submit', function(event) {
  event.preventDefault();
  
  const formData = new FormData(this);
  fetch('/send-donation-email', {
      method: 'POST',
      body: formData
  })
  .then(response => response.json())
  .then(data => {
      if (data.success) {
          alert('Thank you for your donation! A confirmation email has been sent.');
      } else {
          alert('There was an error sending the confirmation email.');
      }
  })
  .catch(error => {
      console.error('Error:', error);
      alert('There was an error processing your request.');
  });
});

/*Form donate form page */
document.addEventListener("DOMContentLoaded", function () {
  const customAmountInput = document.getElementById('customAmount');

  customAmountInput.addEventListener('input', function () {
      const amount = parseFloat(customAmountInput.value);
      setDonationAmount(amount);
  });

  function setDonationAmount(amount) {
      const amountInput = document.querySelector('input[name="amount"]');
      if (amountInput) {
          amountInput.value = amount.toFixed(2);
      }
  }
});

/* Donation modal-content */
var btn1 = document.getElementById("openModalBtn1");
var btn2 = document.getElementById("openModalBtn2");
var btn3 = document.getElementById("openModalBtn1");
var btn4 = document.getElementById("openModalBtn2");

btn1.onclick = function() {
  modal.style.display = "block";
}

btn2.onclick = function() {
  modal.style.display = "block";
}

btn3.onclick = function() {
  modal.style.display = "block";
}

btn4.onclick = function() {
  modal.style.display = "block";
}

var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

document.getElementById("myForm").addEventListener("submit", function(event){
    event.preventDefault(); 
    console.log("Form submitted!");
    modal.style.display = "none";
});

document.addEventListener('click', function(event) {
  if (event.target.classList.contains('openModalBtn')) {
      modal.style.display = "block"; 
  }
});

//Donation Page//
function showImage() {
  var img = new Image();
  img.src = "path/to/image.jpg";
  img.alt = "Thank you for your donation!";
  img.width = 400;
  img.height = 300;
  var imgWindow = window.open("", "imgWindow", "width=400,height=300");
  imgWindow.document.write("<html><body><center>");
  imgWindow.document.write(img.outerHTML);
  imgWindow.document.write("</center></body></html>");
  imgWindow.document.close();
}

/* Admin Login Page*/
class Login {
  constructor(form, fields) {
      this.form = form;
      this.fields = fields;
      this.validateonSubmit();
  }

  validateonSubmit() {
      let self = this;

      this.form.addEventListener("submit", (e) => {
          e.preventDefault();
          var error = 0;

          self.fields.forEach((field) => {
              const input = document.querySelector(`#${field}`);
              if (self.validateFields(input) == false) {
                  error++;
              }
          });

          if (error == 0) {
              // do login API here or in this case, just submit the form and set a localStorage item
              localStorage.setItem("auth", 1);
              this.form.submit();
          }
      });
  }

  validateFields(field) {
      if (field.value.trim() === "") {
          this.setStatus(field, `${field.previousElementSibling.innerText} cannot be blank`, "error");
          return false;
      } else {
          if (field.type == "password") {
              // add password validation logic here
          }
          return true;
      }
  }

  setStatus(field, message, status) {
      const errorMessage = field.parentElement.querySelector(".error-message");

      if (status == "success") {
          if (errorMessage) {
              errorMessage.innerText = "";
          }
          field.classList.remove("input-error");
      } else if (status == "error") {
          errorMessage.innerText = message;
          field.classList.add("input-error");
      }
  }
}

const form = document.querySelector(".loginForm");
const fields = ["username", "password"];
const validator = new Login(form, fields);


