$(document).ready(() => {
    $('.cart-href').click(() => {
        location = "cart.php";
    });

    $.ajax({
        url:'php/getCartItems.php',
        method: 'get', 
        dataType: 'json',            
        success: function(cartItem){
            $("#cartItemsCount").text(cartItem[1]);

            $('.catalog-card').each((index, element) => {
                for (i = 0; i < cartItem[1]; i++){
                    if ($(element).find("#catalog-card-title").text() == cartItem[0][i][1]){
                        $(element).find(".cart-image").css("display", "none");
                        $(element).find(".cart-image-active").css("display", "block");
                    }
                }
            })

            for (i = 0; i < cartItem[1]; i++){
                if ($("#product-name").text() == cartItem[0][i][1]){
                    $("#to-cart").prop("className", "to-cart-active");
                    $("#to-cart").find("span").text("ДОБАВЛЕНО");
                }
            }

            $('.popular-card').each((index, element) => {
                for (i = 0; i < cartItem[1]; i++){
                    if ($(element).find("#popular-card-title").text() == cartItem[0][i][1]){
                        $(element).find(".cart-image").css("display", "none");
                        $(element).find(".cart-image-active").css("display", "block");
                    }
                }
            })
        } 
    });
});