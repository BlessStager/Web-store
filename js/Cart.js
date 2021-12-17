$(document).ready(() => {
	$('.order-menu').find('div').click((e) => {
        $(e.target).prop('className', 'content-order-btn-active');
        $(e.target).parent().find('.content-order-btn-active').not(e.target).prop('className', 'content-order-btn');
    });

    $('#content-fast-order-btn').click(() => {
        $('#content-delivery').css('display', 'none');
        $('#content-fast-order').css('display', 'flex');
    });
    
    $('#content-delivery-btn').click(() => {
        $('#content-fast-order').css('display', 'none');
        $('#content-delivery').css('display', 'flex');
    });

    $('.card-close').click((e) => {
        $(e.target).parent().remove();

        if ($('#confirm-cards').find('.confirm-card').length == 1){
            $('.confirm-order').css("display", "none");
            $('.order-header').find('span').text("КОРЗИНА ПУСТА");
            $('.order-content').css("display", "none");
        }

        if ($('#confirm-cards').find('.confirm-card').length > 4){
            $('#confirm-cards').css('height', '630');
            $('#confirm-cards').css('overflowY', 'scroll');
        } else{
            $('#confirm-cards').css('height', 'auto');
            $('#confirm-cards').css('overflowY', 'visible');
        }

        let numItems = $("#cartItemsCount").text();
        numItems--;
        $("#cartItemsCount").text(numItems);

        $.ajax({
            url:'php/deleteFromCart.php',
            method: 'post',             
            data: { name: $(e.target).parent().find("#confirm-card-name").text() }, 
        });

        let totalAmount = 0;
        $("#confirm-cards").find(".confirm-card").each((index, element) => {
            totalAmount += +$(element).find("#confirm-card-amount").text();
        });
        $(".confirm-order").find("#confirm-order-total-amount").text(totalAmount);
    });

    $.ajax({
        url:'php/getCartItems.php',
        method: 'get', 
        dataType: 'json',            
        success: function(cartItem){
            for (i = 0; i < cartItem[1]; i++){
                let clone = $("#confirm-card").clone(true, true);
                $(clone).prop("id", $(clone).prop("id") + cartItem[0][i][0]);
                $(clone).find("#confirm-card-name").text(cartItem[0][i][1]);
                $(clone).find("#confirm-card-type").text(cartItem[0][i][2]);
                $(clone).find("#confirm-card-price").text(cartItem[0][i][3]);
                $(clone).find("#confirm-card-amount").text(cartItem[0][i][3]);
                $(clone).find("#confirm-card-image").attr("src", cartItem[0][i][4]);
                $(clone).find("#confirm-card-input").val(cartItem[0][i][5]);
                $(clone).css("display", "flex");
                $(clone).appendTo("#confirm-cards");
            }

            if ($('#confirm-cards').find('.confirm-card').length == 1){
                $('.confirm-order').css("display", "none");
                $('.order-header').find('span').text("КОРЗИНА ПУСТА");
                $('.order-content').css("display", "none");
            }

            if ($('#confirm-cards').find('.confirm-card').length > 5){
                $('#confirm-cards').css('height', '630');
                $('#confirm-cards').css('overflowY', 'scroll');
            }

            let price, quantity, amount;
            let totalAmount = 0;
            $("#confirm-cards").find(".confirm-card").each((index, element) => {
                price = $(element).find("#confirm-card-price").text();
                quantity = $(element).find("#confirm-card-input").val();
                amount = price * quantity;
                $(element).find("#confirm-card-amount").text(amount);
            });
            $("#confirm-cards").find(".confirm-card").each((index, element) => {
                totalAmount += +$(element).find("#confirm-card-amount").text();
            });
            $(".confirm-order").find("#confirm-order-total-amount").text(totalAmount);
        } 
    });

    $('#confirm-card-input').change((e) => {
        let price = $(e.target).parents(".confirm-card").find("#confirm-card-price").text();
        let quantity = $(e.target).val();
        let amount = price * quantity;
        let totalAmount = 0;

        $(e.target).parents(".confirm-card").find("#confirm-card-amount").text(amount);

        $(e.target).parents("#confirm-cards").find(".confirm-card").each((index, element) => {
            totalAmount += +$(element).find("#confirm-card-amount").text();
        });
        $(e.target).parents(".confirm-order").find("#confirm-order-total-amount").text(totalAmount);
    });
});