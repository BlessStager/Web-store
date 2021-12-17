let numberPage = 1;
let news;
let countPages;
let countNewsOnPage;

function newsChange(id, operation){
    if (operation == "inc") {
        increment(numberPage);
    } else if (operation == "dec"){
        decrement(numberPage);
    }
    removeNews();
    newsRequest(id);
}

function increment(){
    if (numberPage < countPages){
        numberPage++;
    }
}

function decrement(){
    if (numberPage > 1){
        numberPage--;
    }
}

function displayFirstNumber(id1){
    document.getElementById(id1).innerHTML = 1;
}

function displaySecondNumber(id2, num){
    document.getElementById(id2).innerHTML = num;
}

function newAssignment(newsArray){
    news = newsArray[0];
    countPages = newsArray[1];
    countNewsOnPage = newsArray[2];

    displaySecondNumber('p2', countPages);

    for (let i = 0; i < countNewsOnPage; i++){
        let prototype = document.getElementById('all-news-new');
        let clone = prototype.cloneNode(true);
        clone.id = 'all-news-new' + news[i][0];

        clone.onclick = () => NewPageOpen(news[i][0]);

        clone.querySelector('#new-title').innerHTML = news[i][1];
        clone.querySelector('#new-date').innerHTML = news[i][2];
        clone.querySelector('#new-content').innerHTML = news[i][3];

        clone.style.display="flex";

        document.getElementById('all-news-content').appendChild(clone);

        document.getElementById('all-news').style.display="block"; 
    }
}

function removeNews(){
    let lengthNews = document.getElementsByClassName('all-news-new').length;
    for (let i = 1; i < lengthNews; i++){
        document.getElementsByClassName('all-news-new')[1].remove(); 
    }
}

function newsRequest(id){
    document.getElementById('all-news').style.display="none";
    document.getElementById(id).innerHTML = numberPage;
    let dt = document.getElementById('p1').innerHTML;
    $.ajax({
        url:'php/newsRequest.php',
        method: 'get',             
        dataType: 'json',
        data: { dt: dt }, 
        success:function(newsArray){
            newAssignment(newsArray);     
        }
    });
}