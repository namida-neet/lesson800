$(function () {
    $('.favorite-add-button').click(function (event) {
        event.preventDefault();

        var param = $(this).parent('.favorite-form').serializeArray();

        $.ajax({
            url: '/minibbs/Favorites/add',
            type: 'POST',
            dataType: 'json',
            data: param,
            timeout: 10000,
        }).done(function (result) {
            console.log(result);
            $('#addfavorite' + result['received_data']['post_id']).addClass('hide');
            $('#deletefavorite' + result['received_data']['post_id']).removeClass('hide');
            $('#favCount' + result['received_data']['post_id']).text(result['count']);
        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            alert("失敗");
        });
    });

    $('.favorite-delete-button').click(function (event) {
        event.preventDefault();

        var param = $(this).parent('.favorite-form').serializeArray();

        $.ajax({
            url: '/minibbs/Favorites/delete',
            type: 'POST',
            dataType: 'json',
            data: param,
            timeout: 10000,
        }).done(function (result) {
            console.log(result);
            $('#addfavorite' + result['received_data']['post_id']).removeClass('hide');
            $('#deletefavorite' + result['received_data']['post_id']).addClass('hide');
            $('#favCount' + result['received_data']['post_id']).text(result['count']);
        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            alert("失敗");
        });
    });
});
