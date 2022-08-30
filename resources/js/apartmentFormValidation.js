const form = document.querySelector('form');
//campi della form
const title = document.getElementById('title');
const price = document.getElementById('price');
const description = document.getElementById('description');
const rooms_number = document.getElementById('rooms_number');
const bathrooms_number = document.getElementById('bathrooms_number');
const beds_number = document.getElementById('beds_number');
const mqs = document.getElementById('mqs');
const address = document.getElementById('address');
const imageCover = document.getElementById('image-cover');
const visibility = document.getElementById('visibility');
const extraServices = document.querySelectorAll('.extra_services');

const formBtn = document.querySelector('form a.btn');

formBtn.addEventListener('click', function(event){
  
  console.log('submit');
});
