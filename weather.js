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
  var currentTemp = Math.floor((res.currently.temperature-32)*(5/9));
  var summary = res.currently.summary;
  var humidity = res.currently.humidity;
  var precProb = res.currently.precipProbability;
  var cloudCover = res.currently.cloudCover;
  document.getElementsByClassName('currentTemperature')[0].innerHTML = currentTemp + " °C";
  document.getElementsByClassName('currentSummary')[0].innerHTML = summary;
  document.getElementById('humidity').innerText = humidity;
  document.getElementById('precip').innerText = precProb;
  document.getElementById('cloud').innerText = cloudCover;
  for(i=1;i<8;i++){
    var h4 = document.createElement('h4');
    h4.innerText = "Day "+i;
    var p1 = document.createElement('p');
    p1.innerText = "High Temperature : " + Math.floor((res.daily.data[i].temperatureHigh - 32) * (5 / 9)) + " °C";
    var p2 = document.createElement('p');
    p2.innerText = "Low Temperature : " + Math.floor((res.daily.data[i].temperatureLow - 32) * (5 / 9)) + " °C";
    var p3 = document.createElement('p');
    p3.innerText = "Humidity : " + res.daily.data[i].humidity;
    var p4 = document.createElement('p');
    p4.innerText = "Precipitation Probability : " + res.daily.data[i].precipProbability;
    var div = document.createElement('div');
    div.setAttribute('class', 'futureContainer')
    div.appendChild(h4);
    div.appendChild(p1);
    div.appendChild(p2);
    div.appendChild(p3);
    div.appendChild(p4);
    document.getElementById('futurePredictions').appendChild(div);
  }
}
