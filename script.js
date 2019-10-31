$(document).ready(function () {
  $('.dropdown-trigger').dropdown();
  $('.carousel').carousel();  
});

var imageleft = 0;
var imagemain = 1;
var imageright = 2;

var imageObject = {
  0 : './images/homeimage1.jpg',
  1: './images/homeimage2.jpg',
  2: './images/homeimage3.jpg',
  3:'./images/newfarmer.jpg'
}

document.getElementsByClassName('leftImageCarousel')[0].setAttribute("src", imageObject[imageleft]);
document.getElementsByClassName('mainImageCarousel')[0].setAttribute("src", imageObject[imagemain]);
document.getElementsByClassName('rightImageCarousel')[0].setAttribute("src", imageObject[imageright]);

setInterval(function(){
  imageleft +=1;
  imageleft = imageleft%4;
  imagemain += 1;
  imagemain = imagemain%4;
  imageright += 1;
  imageright = imageright%4;
  document.getElementsByClassName('leftImageCarousel')[0].setAttribute("src", imageObject[imageleft]);
  document.getElementsByClassName('mainImageCarousel')[0].setAttribute("src", imageObject[imagemain]);
  document.getElementsByClassName('rightImageCarousel')[0].setAttribute("src", imageObject[imageright ]);
},2000);
