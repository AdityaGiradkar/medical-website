function showDetails(a) {
    var x = document.querySelector("#" + a);
    var arrow = document.querySelector("#" + a + "_arrow");
    if (x.style.display === "none") {
        x.style.display = "block";
        arrow.classList.remove("fa-angle-right");
        arrow.classList.add("fa-angle-down");
    } else {
        x.style.display = "none";
        arrow.classList.remove("fa-angle-down");
        arrow.classList.add("fa-angle-right");
    }

}


function close_treatment() {
    if (confirm("do you want to close this treatment?")) {
        return true;
    }
    return false;
}