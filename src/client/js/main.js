window.bootstrap = require('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js');
var myCarousel = document.querySelector('#myCarousel')
var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 2000,
  wrap: false
})