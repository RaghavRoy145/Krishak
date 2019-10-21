var lat,lon;
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  console.log(position.coords.latitude + " and " + position.coords.longitude);
  lat = position.coords.latitude;
  lon = position.coords.longitude;
  var url = 'https://api.darksky.net/forecast/032cb3132b9c440de5990c8388cf62ef/'+lat+','+lon;
  $.ajax({
    url,
    success: function(res){
      PrintDetails(res)
    },
    dataType: 'jsonp',  
  });
}
getLocation();

function PrintDetails(res) {
  console.log(res);
  var x = document.createElement("h1");
  x.innerText = "The current weather is " + Math.floor((res.currently.temperature-32)*5/9)+" C"
  document.getElementsByClassName('weather')[0].appendChild(x);

  var y = document.createElement("h3");
  y.innerText = "Today's Forecast : " + res.currently.summary;
  document.getElementsByClassName('weather')[0].appendChild(y);
  for(i=0;i<7;i++){
    var thatDay = res.daily.data[i].precipProbability;
    var y = document.createElement("h5");
    y.innerText = "Day "+i+"'s Precipitation : " +thatDay;
    document.getElementsByClassName('weather')[0].appendChild(y);
  }
}
