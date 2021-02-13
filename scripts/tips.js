function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getStateCode);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
let cookies = document.cookie;
console.log(cookies);
for (i = 0; i < 2; i++) {
    var temp = ((cookies.split(';')[0]).split('='))[0];
    if (temp == "currentUser") {
        user = ((cookies.split(';')[0]).split('='))[1];
        break;
    }
    else {
        user = undefined;
    }
}
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
function getStateCode(position) {
    console.log(position.coords.latitude + " and " + position.coords.longitude);
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    $.ajax({
        url: 'https://reverse.geocoder.api.here.com/6.2/reversegeocode.json',
        type: 'GET',
        dataType: 'jsonp',
        jsonp: 'jsoncallback',
        data: {
            prox: lat+','+lon,
            mode: 'retrieveAddresses',
            maxresults: '1',
            gen: '9',
            app_id: '1vBroA1KtBNZK2eJ6IVZ',
            app_code: 'Q0Cnnq4iC6ZfwWcPZzGrYw'
        },
        success: function (data) {
            console.log(data);
            let code = data.Response.View[0].Result[0].Location.Address.State;
            changeState(code);
        }
    });
}

function changeState(value){
    console.log(value);
    // alert(stateInfo[value].name);
    document.getElementsByClassName('stateImage')[0].setAttribute("src", stateInfo[value].image);
    document.getElementsByClassName('stateName')[0].innerHTML= stateInfo[value].name;
    var crops = (stateInfo[value].Crops).split(",");
    console.log(crops);
    var ul = document.getElementsByClassName('cropsGrown')[0];
    var child = ul.lastElementChild;
    while (child) {
        ul.removeChild(child);
        child = ul.lastElementChild;
    }
    crops.forEach(element => {
        var li = document.createElement("li");
        li.innerHTML=element;
        li.style.padding="5px";
        ul.appendChild(li);
    });
    var soilType = (stateInfo[value].Soil_type).split(",");
    console.log(soilType);
    var ul = document.getElementsByClassName('soilTypes')[0];
    var child = ul.lastElementChild;
    while (child) {
        ul.removeChild(child);
        child = ul.lastElementChild;
    }
    soilType.forEach(element => {
        var li = document.createElement("li");
        li.innerHTML = element;
        li.style.padding = "5px";
        ul.appendChild(li);
    });
}

let stateInfo = {
    PB: {
        name: "Punjab",
        Crops: "Wheat, Rice, Maize, Barley, Pulses, Rapeseed and Mustard, Sunflower, Oil Seeds, Sugarcane, Cotton, Fruits, Vegetables",
        Soil_type: "Flood plain soil, Loamy soil, Sandy soil, Desert soil, Kandi Soil, Sierozems, Sodic and Saline soil",
        image: "./images/states/IND_punjab.png"
    },
    HR: {
        name: "Haryana",
        Crops: "Sugarcane, Barley, Jowar, Bajra, Gram, Rice, Wheat, Mustard, Cotton",
        Soil_type: "Salt Affected soil, Alkali Soil, Saline soil",
        image: "./images/states/haryana.jpg"
    },
    RJ: {
        name: "Rajasthan",
        Crops: "Wheat, Sugarcane, Bajra, Baley, Jowar, Maize, Chili, Cotton, Mango, Rice, Vegetables, Groundnut, Oil seeds, Pulses",
        Soil_type: "Sandy soil, Saline soil, Alkaline soil, Chalky soil, Clay soil, Loamy soil, Black Lava soil, Nitrogenous soil",
        image: "./images/states/IND_rajasthan.png"
    },
    UP: {
        name: "Uttar Pradesh",
        Crops: "Fruits, Vegetables, Spices, Floriculture, Medicinal/aromatic plants, others like Betel vine, Mushroom, Honey ",
        Soil_type: "Alluvium soil, Sandy soil, Clayey Soil, Red & Black soil",
        image: "./images/states/up.png"
    },

    BR: {
        name: "Bihar",
        Crops: "Rice, Wheat, Maize, Pulses, Vegetables, Fruits, Sugarcane, Jute",
        Soil_type: "Sandy soil, Loam soil, Clay soil, Clay Loam soil",
        image: "./images/states/IND_bihar.png"
    },
    GJ: {
        name: "Gujarat",
        Crops: "Rice, Wheat, Jowar, Bajra, Maize, tur, Gram, Cotton, Groundnuts, Dates, Sugarcane",
        Soil_type: "Black soil, Alluvial soil, Hill soil, Desert soil",
        image: "./images/states/IND_gujarat.png"
    },

    MP: {
        name: "Madhya Pradesh",
        Crops: "Wheat, Maize, Jowar, Gram, Tur, Urad, Moong, Soybean, Groundnuts, Mustard, Cotton, Sugarcane",
        Soil_type: "Black soil, Red & Yellow soil, Alluvial soil, Laterite soil, Mixed soil",
        image: "./images/states/IND_madhyapradesh.png"
    },
    MH: {
        name: "Maharashtra",
        Crops: "Rice, Jowar, Bajra, Wheat, Pulses, Cotton, Sugarcane, Several Oil Seeds, Sunflower, Groundnuts & Soybean",
        Soil_type: "Black-Cotton soil, Kali soil, Morad soil, Pather soil",
        image: "./images/states/maharashtra.png"
    },
    CT: {
        name: "Chattisgarh",
        Crops: "Rice, Maize, Wheat, Niger, Groundnut, Pulses",
        Soil_type: "Red & Yellow soil, Red Sandy soil, Red Loam soil, Black Cotton soil, Laterite soil",
        image: "./images/states/chattisgarh.png"
    },
    JH: {
        name: "Jharkhand",
        Crops: "Rice, Ragi, Maize, Wheat, Redgram, Niger, Fruits",
        Soil_type: "Red soil, Micacious soil, Sandy soil, Black soil, Laterite soil",
        image: "./images/states/IND_jharkhand.png"
    },
    HP: {
        name: "Himachal Pradesh",
        Crops: "Off-season vegetables, vegetables seeds, potato & ginger besides soybean, oilseeds, pulses, fruits",
        Soil_type: "Sedimentary soil, Brown soil, Brownish soil",
        image: "./images/states/map-of-himachal-pradesh.jpg"
    },
    JK: {
        name: "Jammu and Kashmir",
        Crops: "Paddy, Wheat, Maize, Barley, Bajra, Jowar, Gram, Apple, Walnuts",
        Soil_type: "Brown Forest soil, Grey Brown Podzolic soil, Red & Yellow Podzolic soil, Hills Forest soil, Mountain Meadow soil, Saline Alkali soil, Alluvial soil",
        image: "./images/states/j_and_k.png"
    },
    WB: {
        name: "West Bengal",
        Crops: "Rice, Jute, Tea, Potatoes, Oilseeds, Betel, Vine, Tobacco, Wheat, Barley, Maize",
        Soil_type: "Laterite soil, Red soil, Alluvial soil, Coastal soil, Terai soil, Colluvial soil",
        image: "./images/states/IND_westbengal.png"
    },
    KA: {
        name: "Karnataka",
        Crops: "Paddy, Jowar, Ragi, Maize, Sunflower, sugarcane, Cotton, Tobacco",
        Soil_type: "Red soil, Lateritic soil, Black soil, Alluvio-Colluvial soil, Forest soil, Coastal soil",
        image: "./images/states/karnataka.jpg"
    }
}