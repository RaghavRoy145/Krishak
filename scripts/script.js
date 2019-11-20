
var imageleft = 0;
var imagemain = 1;
var imageright = 2;

var imageObject = {
	0: './images/homeimage1.jpg',
	1: './images/homeimage2.jpg',
	2: './images/homeimage3.jpg',
	3: './images/newfarmer.jpg'
}

// document.getElementsByClassName('leftImageCarousel')[0].setAttribute("src", imageObject[imageleft]);
// document.getElementsByClassName('mainImageCarousel')[0].setAttribute("src", imageObject[imagemain]);
// document.getElementsByClassName('rightImageCarousel')[0].setAttribute("src", imageObject[imageright]);

// setInterval(function () {
//   imageleft += 1;
//   imageleft = imageleft % 4;
//   imagemain += 1;
//   imagemain = imagemain % 4;
//   imageright += 1;
//   imageright = imageright % 4;
//   document.getElementsByClassName('leftImageCarousel')[0].setAttribute("src", imageObject[imageleft]);
//   document.getElementsByClassName('mainImageCarousel')[0].setAttribute("src", imageObject[imagemain]);
//   document.getElementsByClassName('rightImageCarousel')[0].setAttribute("src", imageObject[imageright]);
// }, 2000);

let title = document.getElementsByClassName("title")[0];
$(".title").animate({ left: "0" }, 2000);
// $(".mainContent").hide();

setTimeout(function () {
	$(".titleText").animate({ opacity: "1" }, 1000);
}, 2000);
setTimeout(function () {
	$(".title").animate({ backgroundColor: 'transparent' }, 1000);
	$(".farmerImage").animate({ top: '15%' }, 1000);
	$('.continueButton').animate({ opacity: "1" }, 1000);
	// $(".titleText").css("box-shadow","0 0 0 white");
}, 3000);
setTimeout(function () {
	$(".mainContent").show();
}, 4000);

let cookies = document.cookie;
console.log(cookies);
user = ((cookies.split(';')[0]).split('='))[1];
// alert(user);
if (user != undefined) {
	var e = document.getElementsByClassName('nav-right')[0];
	var child = e.lastElementChild;
	while (child) {
		e.removeChild(child);
		child = e.lastElementChild;
	}
	let a = document.createElement('a');
	a.innerText = user;
	a.addEventListener('click', logout);
	document.getElementsByClassName('nav-right')[0].appendChild(a);
}

function logout() {
	if (confirm("Do you want to logout?")) {
		document.cookie = "currentUser=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
		window.location.reload();
	}
}
