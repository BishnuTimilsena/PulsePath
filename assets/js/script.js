'use strict';



/**
 * navbar toggle
 */

const overlay = document.querySelector("[data-overlay]");
const navOpenBtn = document.querySelector("[data-nav-open-btn]");
const navbar = document.querySelector("[data-navbar]");
const navCloseBtn = document.querySelector("[data-nav-close-btn]");

const navElems = [overlay, navOpenBtn, navCloseBtn];

for (let i = 0; i < navElems.length; i++) {
  navElems[i].addEventListener("click", function () {
    navbar.classList.toggle("active");
    overlay.classList.toggle("active");
  });
}

// Doctor section

function showDoctorInfo(name, designation, hospital, phoneNumber, email, description) {
  document.getElementById('doctorName').innerText = 'Name : ' + name;
  document.getElementById('doctorDesignation').innerText = 'Designation : ' + designation;
  document.getElementById('doctorHospital').innerText = 'Hospital : ' + hospital;
  document.getElementById('doctorPhoneNumber').innerText = 'Phone Number : ' + phoneNumber;
  document.getElementById('doctorEmail').innerText = 'Email : ' + email;
  document.getElementById('doctorDescription').innerText = description;

  document.getElementById('doctorInfoBox').classList.add('active');
}

function hideDoctorInfo() {
  document.getElementById('doctorInfoBox').classList.remove('active');
}
/**
 * header & go top btn active on page scroll
 */

// const header = document.querySelector("[data-header]");
// const goTopBtn = document.querySelector("[data-go-top]");

// window.addEventListener("scroll", function () {
//   if (window.scrollY >= 80) {
//     header.classList.add("active");
//     goTopBtn.classList.add("active");
//   } else {
//     header.classList.remove("active");
//     goTopBtn.classList.remove("active");
//   }
// });