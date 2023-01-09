$("#closeMenu").click(function () {
    if ($("section").css("width") == "0px") {
        $("section").css("width", "250px");
        $("body").css("grid-template-columns", "1fr 250px");
    } else {
        $("section").css("width", "0");
        $("body").css("grid-template-columns", "1fr 0px");
    }
});
