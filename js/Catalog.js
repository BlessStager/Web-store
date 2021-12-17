let catalogItem, numberCatalogItems;

function displayCatalog(catalogArray){

    catalogItem = catalogArray[0];
    numberCatalogItems = catalogArray[1];

    for (let i = 0; i < numberCatalogItems; i++){
        let prototype = document.getElementById('catalog-item');
        let clone = prototype.cloneNode(true);
        clone.id = 'catalog-item' + catalogItem[i][0];
        clone.querySelector('#catalog-item-href').innerHTML = catalogItem[i][1];
        clone.onclick = () => openCatalogPage(catalogItem[i][1], 1);
        clone.style.display="block";
        document.getElementById('listProducts').appendChild(clone);
    }
}

function openCatalogPage(typeProduct, pageNumber){
    $.ajax({
        url:'php/getNewCatalogPage.php',
        method: 'get',             
        dataType: 'json',
        data: { type: typeProduct, page: pageNumber }, 
        success:function(newPageUrl){
            document.location = newPageUrl;
        }
    });
}

function displayCatalogPage(typeProduct, pageNumber){
    $.ajax({
        url:'php/catalogPageRequest.php',
        method: 'get',             
        dataType: 'json',
        data: { type: typeProduct, page: pageNumber }, 
        success:function(catalogPage){
            catalogAssignment(catalogPage, pageNumber, typeProduct);
        }
    });
}

function catalogAssignment(catalogPage, pageNumber, typeProduct){
    countPage = catalogPage[2];
    document.getElementById('catalog-option').innerHTML = 1;

    $(document).ready(() => {
        $('.cart-image').click((e) => {
            $(e.target).css("display", "none");
            $(e.target).parent().find(".cart-image-active").css("display", "block");
            let card = [$(e.target).parents(".catalog-card").find("#catalog-card-title").text(), $(e.target).parents(".catalog-card").find("#catalog-card-type").text(), $(e.target).parents(".catalog-card").find("#catalog-card-price").text(), $(e.target).parents(".catalog-card").find("#catalog-card-image").attr("src"), 1];
            
            let numItems = $("#cartItemsCount").text();
            numItems++;
            $("#cartItemsCount").text(numItems);
            
            $.ajax({
                url:'php/addToCart.php',
                method: 'post',        
                data: { cardArray: card },
            });
        });

        $('.cart-image-active').click((e) => {
            $(e.target).css("display", "none");
            $(e.target).parent().find(".cart-image").css("display", "block");
            let nameProd = $(e.target).parents(".catalog-card").find("#catalog-card-title").text();

            let numItems = $("#cartItemsCount").text();
            numItems--;
            $("#cartItemsCount").text(numItems);

            $.ajax({
                url:'php/deleteFromCart.php',
                method: 'post',             
                data: { name: nameProd }, 
            });
        });
    });

    for (let i = 1; i < countPage; i++){
        let prototypeSelector = document.getElementById('catalog-option');
        let cloneSelector = prototypeSelector.cloneNode(true);
        cloneSelector.innerHTML = i + 1;
        if (pageNumber == (i + 1)){
            cloneSelector.selected = true;
        }
        document.getElementById('catalog-select').appendChild(cloneSelector);
    }

    if (countPage <= 6){
        if (countPage == 1){
            let prototypeNavigator = document.getElementById('pag-number');
            prototypeNavigator.className = "pag-number-active";
        }
        for (let i = 1; i < countPage; i++){
            let prototypeNavigator = document.getElementById('pag-number');
            let cloneNavigator = prototypeNavigator.cloneNode(true)
            cloneNavigator.innerHTML = i + 1;
            if (pageNumber == (i + 1)){
                cloneNavigator.className = "pag-number-active";
            } else if (pageNumber == 1){
                prototypeNavigator.className = "pag-number-active";
            }
            prototypeNavigator.onclick = () => openCatalogPage(typeProduct, prototypeNavigator.innerHTML);
            cloneNavigator.onclick = () => {
                if (cloneNavigator.innerHTML != '...'){
                    openCatalogPage(typeProduct, cloneNavigator.innerHTML);
                }
            }
            document.getElementById('pag-numbers').appendChild(cloneNavigator);
        }
    } 
    else{
        let prototypeNavigator = document.getElementById('pag-number');
        pageNumber = parseInt(pageNumber);
        for (let i = 1; i <= 6; i++){
            let cloneNavigator = prototypeNavigator.cloneNode(true);
            cloneNavigator.id = 'pag-number' + i;

            if (pageNumber >= 1 && pageNumber <= 3){
                if (i >= 1 && i <= 4){
                    cloneNavigator.innerHTML = i + 1;
                } else if (i == 5){
                    cloneNavigator.innerHTML = '...';
                } else{
                    cloneNavigator.innerHTML = countPage;
                } 
                if (pageNumber == 1){
                    prototypeNavigator.className = "pag-number-active";
                    cloneNavigator.className = "pag-number";
                } else if (i == pageNumber - 1){
                    cloneNavigator.className = "pag-number-active";
                }
            }
            else if (pageNumber >= (countPage - 2) && pageNumber <= countPage){
                if (i == 1){
                    cloneNavigator.innerHTML = '...';
                } else{
                    cloneNavigator.innerHTML = countPage - (6 - i);
                } 
                if ((i == 4) && (pageNumber == countPage - 2) || (i == 5) && (pageNumber == countPage - 1) || (i == 6) && (pageNumber == countPage)){
                    cloneNavigator.className = "pag-number-active";
                }
            }
            else {
                if (i == 1 || i == 5){
                    cloneNavigator.innerHTML = '...';
                }else if (i == 6){
                    cloneNavigator.innerHTML = countPage;
                } else{
                    cloneNavigator.innerHTML = pageNumber + i - 3;
                } 
                if (i == 3){
                    cloneNavigator.className = "pag-number-active";
                }
            }
            prototypeNavigator.onclick = () => openCatalogPage(typeProduct, prototypeNavigator.innerHTML);
            cloneNavigator.onclick = () => {
                if (cloneNavigator.innerHTML != '...'){
                    openCatalogPage(typeProduct, cloneNavigator.innerHTML);
                }
            }
            document.getElementById('pag-numbers').appendChild(cloneNavigator);
        }
    }
    document.getElementById('pagination').style.display = "flex";

    let [products, countCards] = catalogPage;
    for (let i = 0; i < countCards; i++){
        let prototype = document.getElementById('catalog-card');
        let clone = prototype.cloneNode(true);
        clone.id = 'catalog-card' + products[i][0];
        clone.querySelector('#catalog-card-title').innerHTML = products[i][1];
        clone.querySelector('#catalog-card-type').innerHTML = products[i][3];
        clone.querySelector('#catalog-card-price').innerHTML = products[i][4];
        clone.querySelector('#catalog-card-image').src = products[i][5];
        clone.querySelector('#catalog-card-image').onclick = () => {
            document.location = `product-page.php?id=${products[i][0]}`;
        };
        clone.style.display="block";
        document.getElementById('catalog-cards').appendChild(clone);
    }
}

function incrementPage(typeProduct, pageNumber){
    if (pageNumber < countPage){
        pageNumber++;
        openCatalogPage(typeProduct, pageNumber);
    }
}

function decrementPage(typeProduct, pageNumber){
    if (pageNumber > 1){
        pageNumber--;
        openCatalogPage(typeProduct, pageNumber);
    }
}

$(document).ready(() => {
    $('.cart-href').click((e) => {
        location = "cart.php";
    });
});
