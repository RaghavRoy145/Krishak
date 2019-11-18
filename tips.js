function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getStateCode);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function getStateCode(position) {
    console.log(position.coords.latitude + " and " + position.coords.longitude);
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    var url = 'https://api.darksky.net/forecast/032cb3132b9c440de5990c8388cf62ef/' + lat + ',' + lon;
    $.ajax({
        url,
        success: function (res) {
            console.log(res);
        },
        dataType: 'jsonp',
    });
}

function changeState(value){
    console.log(value);

}

let stateInfo = {
    AP:{
        name:"Andhra Pradesh",
        summerCrops:""
    }
}