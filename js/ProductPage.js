$(document).ready(() => {
    $("#to-cart").click(() => {
        if(($("#to-cart").hasClass("to-cart")) && ($("#product-quantity").val() > 0)){
            $("#to-cart").prop("className", "to-cart-active");
            $("#to-cart").find("span").text("ДОБАВЛЕНО");

            let numItems = $("#cartItemsCount").text();
            numItems++;
            $("#cartItemsCount").text(numItems);

            let card = [$("#product-name").text(), $("#product-type").text(), $("#product-price").text(), $("#product-image").attr("src"), $("#product-quantity").val()];
            $.ajax({
                url:'php/addToCart.php',
                method: 'post',        
                data: { cardArray: card },
            });
        } else if(($("#product-quantity").val() > 0)){
            $("#to-cart").prop("className", "to-cart");
            $("#to-cart").find("span").text("В КОРЗИНУ");

            let numItems = $("#cartItemsCount").text();
            numItems--;
            $("#cartItemsCount").text(numItems);

            let nameProd = $("#product-name").text();
            $.ajax({
                url:'php/deleteFromCart.php',
                method: 'post',             
                data: { name: nameProd }, 
            });
        }
    })
})
