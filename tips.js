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
        Crops:""
        Soil_type:""
        image:""
    },
    PB:{
        name:"Punjab",
        Crops:"Wheat, Rice, Maize, Barley, Pulses, Rapeseed and Mustard, Sunflower, Oil Seeds, Sugarcane, Cotton, Fruits, Vegetables",
        Soil_type:"Flood plain soil, Loamy soil, Sandy soil, Desert soil, Kandi Soil, Sierozems, Sodic and Saline soil",
        image:"./images/states/IND_punjab.png"
    },
    HR:{
        name:"Haryana",
        Crops:"Sugarcane, Barley, Jowar, Bajra, Gram, Rice, Wheat, Mustard, Cotton",
        Soil_type:"Salt Affected soil, Alkali Soil, Saline soil",
        image:"./images/states/haryana.jpg"
    },
    RJ:{
        name:"Rajasthan",
        Crops:"Wheat, Sugarcane, Bajra, Baley, Jowar, Maize, Chili, Cotton, Mango, Rice, Vegetables, Groundnut, Oil seeds, Pulses",
        Soil_type:"Sandy soil, Saline soil, Alkaline soil, Chalky soil, Clay soil, Loamy soil, Black Lava soil, Nitrogenous soil",
        image:"./images/states/IND_rajasthan.png"
    },
    UP:{
        name:"Uttar Pradesh",
        Crops:"Fruits, Vegetables, Spices, Floriculture, Medicinal/aromatic plants, others like Betel vine, Mushroom, Honey ",
        Soil_type:"Alluvium soil, Sandy soil, Clayey Soil, Red & Black soil",
        image:"./images/states/up.png"
    },
    
    BR:{
        name:"Andhra Pradesh",
        Crops:"Rice, Wheat, Maize, Pulses, Vegetables, Fruits, Sugarcane, Jute",
        Soil_type:"Sandy Loam soil, Loam soil, Clay soil, Clay Loam soil",
        image:"./images/states/IND_bihar.png"
    },
    GJ:{
            name:"Gujarat",
            Crops:"Rice, Wheat, Jowar, Bajra, Maize, tur, Gram, Cotton, Groundnuts, Dates, Sugarcane",
            Soil_type:"Black soil, Alluvial soil, Hill soil, Desert soil",
            image:"./images/states/IND_gujarat.png"
        },
    
    MP:{
        name:"Madhya Pradesh",
        Crops:"Wheat, Maize, Jowar, Gram, Tur, Urad, Moong, Soybean, Groundnuts, Mustard, Cotton, Sugarcane",
        Soil_type:"Black soil, Red & Yellow soil, Alluvial soil, Laterite soil, Mixed soil",
        image:"./images/states/IND_madhyapradesh.png"
    },
    MH:{
        name:"Maharashtra",
        Crops:"Rice, Jowar, Bajra, Wheat, Pulses, Cotton, Sugarcane, Several Oil Seeds, Sunflower, Groundnuts & Soybean",
        Soil_type:"Black-Cotton soil, Kali soil, Morad soil, Pather soil",
        image:"./images/states/maharashtra.png"
    },
    CT:{
        name:"Chattisgarh",
        Crops:"Rice, Maize, Wheat, Niger, Groundnut, Pulses",
        Soil_type:"Red & Yellow soil, Red Sandy soil, Red Loam soil, Black Cotton soil, Laterite soil",
        image:"./images/states/chattisgarh.png"
    },
    JH:{
        name:"Jharkhand",
        Crops:"Rice, Ragi, Maize, Wheat, Redgram, Niger, Fruits",
        Soil_type:"Red soil, Micacious soil, Sandy soil, Black soil, Laterite soil",
        image:"./images/states/IND_jharkhand.png"
    },
    HP:{
        name:"Himachal Pradesh",
        Crops:"Off-season vegetables, vegetables seeds, potato & ginger besides soybean, oilseeds, pulses, fruits",
        Soil_type:"Sedimentary soil, Brown soil, Brownish soil",
        image:"./images/states/map-of-himachal-pradesh.png"
    },
    JK:{
        name:"Jammu and Kashmir",
        Crops:"Paddy, Wheat, Maize, Barley, Bajra, Jowar, Gram, Apple, Walnuts",
        Soil_type:"Brown Forest soil, Grey Brown Podzolic soil, Red & Yellow Podzolic soil, Hills Forest soil, Mountain Meadow soil, Saline Alkali soil, Alluvial soil",
        image:"./images/states/j-and-k.png"
    },
    WB:{
        name:"West Bengal",
        Crops:"Rice, Jute, Tea, Potatoes, Oilseeds, Betel, Vine, Tobacco, Wheat, Barley, Maize",
        Soil_type:"Laterite soil, Red soil, Alluvial soil, Coastal soil, Terai soil, Colluvial soil",
        image:"./images/states/IND_westbengal.png"
    },
    KA:{
        name:"Karnataka",
        Crops:"Paddy, Jowar, Ragi, Maize, Sunflower, sugarcane, Cotton, Tobacco",
        Soil_type:"Red soil, Lateritic soil, Black soil, Alluvio-Colluvial soil, Forest soil, Coastal soil",
        image:"./images/states/karnataka.jpg"
    }
}
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
//     AP:{
//         name:"Andhra Pradesh",
//         Crops:""
//         Soil_type:""
//         image:""
//     }
// }