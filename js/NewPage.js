function NewPageRequest(pageID){
    $.ajax({
        url:'php/newPageRequest.php',
        method: 'get',             
        dataType: 'json',
        data: { id:  pageID }, 
        success:function(newPage){
            document.getElementById('new-page-title').innerHTML = newPage[1];
            document.getElementById('new-page-date').innerHTML = newPage[2];
            document.getElementById('new-page-content').innerHTML = newPage[3];
        }
    });
}

function NewPageOpen(pageID){
    $.ajax({
        url:'php/getNewPageID.php',
        method: 'get',             
        dataType: 'json',
        data: { pageID:  pageID }, 
        success:function(newPageUrl){
            document.location = newPageUrl;
        }
    });
}