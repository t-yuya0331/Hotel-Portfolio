document.getElementById("search").style.display = "none";

function clickBtn1(){
    const search = document.getElementById("search");

    if(search.style.display == "block"){
        search.style.display ="none";
    }else{
        search.style.display ="block";
    }
}
