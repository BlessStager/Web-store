const regexName = /^[A-ZА-Я]{1}[a-zа-я]+$/
const regexSurname = /^[A-ZА-Я]{1}[a-zа-я]+$/
const regexSecondName = /^[A-ZА-Я]{1}[a-zа-я]+$/
const regexEmail = /^[A-Za-z]{1}[A-Za-z\d]*[@]{1}[a-z.]+$/
const regexCity = /^[A-ZА-Я]{1}[a-zа-я\-]*$/

$(document).ready(() => {
    let uName, surname, secondName, number, index, city, email, address, comment;
    $(".btns-confirm").click(() => {
        if ($("#content-fast-order").css("display") == "flex"){
            uName = $("#content-fast-order").find("#fastName").val();
            number = $("#content-fast-order").find("#fastNumber").val();
            email = $("#content-fast-order").find("#fastEmail").val();
            
            if ((regexName.test(uName)) && (number.length == 11) && ((regexEmail.test(email)))){
                var order = {
                    uName,
                    number, 
                    email
                };

                $.ajax({
                    url:'php/addFastOrder.php',
                    method: 'post', 
                    data: { order: order },  
                    success:function(message){
                        console.log(message);
                        if (message === 'true'){
                            alert("Ваш заказ принят!");      
                            document.location = "main-page.php";                   
                        } else{
                            alert("Сначала необходимо авторизоваться!");
                        }
                    }
                });
            } else{
                alert("Некоторые данные введены некорректно!");
            }

        } else if($("#content-delivery").css("display") == "flex"){
            surname = $("#content-delivery").find("#surname").val();
            uName = $("#content-delivery").find("#name").val();
            secondName = $("#content-delivery").find("#secondname").val();
            number = $("#content-delivery").find("#number").val();
            email = $("#content-delivery").find("#email").val();
            index = $("#content-delivery").find("#index").val();
            city = $("#content-delivery").find("#city").val();
            address = $("#content-delivery").find("#address").val();
            comment = $("#content-delivery").find("#comment").val();

            if ((regexSurname.test(surname)) && (regexName.test(uName)) && (regexSecondName.test(secondName)) && (number.length == 11) && (regexEmail.test(email)) && (index.length == 6) && (regexCity.test(city)) && (address.length > 0)){
                var order = {
                    surname,
                    uName, 
                    secondName,
                    number,
                    email,
                    index,
                    city,
                    address,
                    comment
                };

                $.ajax({
                    url:'php/addDeliveryOrder.php',
                    method: 'post', 
                    data: { order: order },  
                    success:function(message){
                        console.log(message);
                        if (message === 'true'){
                            alert("Ваш заказ принят!"); 
                            document.location = "main-page.php";                        
                        } else{
                            alert("Сначала необходимо авторизоваться!");
                        }
                    }
                });
            } else{
                alert("Некоторые данные введены некорректно!");
            }
        }
    })
})
