$("#closeMenu").click(function () {
    if ($("section").css("width") == "0px") {
        $("section").css("width", "225px");
        $("body").css("grid-template-columns", "1fr 225px");
    } else {
        $("section").css("width", "0");
        $("body").css("grid-template-columns", "1fr 0px");
    }
});
