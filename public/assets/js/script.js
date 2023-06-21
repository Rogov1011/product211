let $btn = $(".add-to-cart");

$btn.on("click", function (e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr("href"),
        method: "GET",
        success: function (res) {
            let $sticky = $(".sticky-message");
            let message =
                '<div class="alert alert-success">' + res["success"] + "</div>";
            $sticky.html(message);

            let $headerCart = $(".header-cart");
            $headerCart.html("Корзина(" + res["qty"] + ")");
        },
    });
});

$(".change-qty").on("change", function () {
    $(this).closest("form").submit();
});

let $phone = $("#phone");
if ($phone.length > 0) {
    $("#phone").inputmask({ mask: "+7 (999) 999-99-99" });
}

$(".changeStatus").on("change", function () {
    let select = $(this);
    $.ajax({
        url: select.closest("form").attr("action") + '?status=' + select.val(),
        method: "GET",
    });
});
