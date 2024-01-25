function sliderActive() {
    if (document.getElementById("slider").className == "cookie-text slider slider-active") {
        document.cookie = "cookies-accepted=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.getElementById("slider").className = "cookie-text slider slider-inactive"; 
    } else {
        const date = new Date(Date.now() + 30 * 6 * 1000 * 60 * 60 * 24);
        document.cookie = "cookies-accepted=True; expires=" + date + ";";
        document.getElementById("slider").className = "cookie-text slider slider-active";  
    }
}
function submit() {
    document.getElementById("cookies").className = "cookie-start cookie-transition cookie-shut";
}
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}