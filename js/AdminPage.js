$(document).ready(() => {
    $('#btn-form-category').click(() => {
        $('#form-category').css('display', 'flex');
        $('#form-category').parent().children().not('#form-category').css('display', 'none');
    })

    $('#btn-form-product').click(() => {
        $('#form-product').css('display', 'flex');
        $('#form-product').parent().children().not('#form-product').css('display', 'none');
    })

    $('#btn-form-news').click(() => {
        $('#form-news').css('display', 'flex');
        $('#form-news').parent().children().not('#form-news').css('display', 'none');
    })
})