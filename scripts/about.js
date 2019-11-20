let next = document.getElementsByClassName("next")[0];
let prev = document.getElementsByClassName("back")[0];
let img = document.getElementsByClassName("profileImg")[0];
let name = document.getElementsByClassName("name")[0];
let srn = document.getElementsByClassName("srn")[0];
let count = 0;
let details = {
    0:{
        name:"Ashwin Alaparthi",
        srn:"PES1201802062"
    },
    1:{
        name:"Raghav Roy",
        srn:"PES1201800342"
    },
    2: {
        name: "Sanjeev Gopinath",
        srn: "PES1201800136"
    }
}
next.addEventListener('click', function(){
    count = (count+1)%3;
    name.innerText = details[count].name;
    srn.innerText = details[count].srn;
});