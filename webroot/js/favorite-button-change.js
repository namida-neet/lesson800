$(function () {
  $('.favorite-add-button').click(function (event) {
    event.preventDefault();

    var param = $(this).parent('.favorite-form').serializeArray();
    console.log(param);

    $.ajax({
      url: '/minibbs/Favorites/add',
      type: 'POST',
      dataType: 'json',
      data: param,
      timeout: 10000,
    }).done(function (result) {
      console.log(result);
      alert("成功");
      $('#addfavorite' + result['result']['post_id']).addClass('hide');
      $('#deletefavorite' + result['result']['post_id']).removeClass('hide');
    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
      alert("失敗");
    });
  });

  $('.favorite-delete-button').click(function (event) {
    event.preventDefault();

    var param = $(this).parent('.favorite-form').serializeArray();
    console.log(param);

    $.ajax({
      url: '/minibbs/Favorites/delete',
      type: 'POST',
      dataType: 'json',
      data: param,
      timeout: 10000,
    }).done(function (result) {
      console.log(result);
      alert("成功");
      $('#addfavorite' + result['result']['post_id']).removeClass('hide');
      $('#deletefavorite' + result['result']['post_id']).addClass('hide');
    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
      alert("失敗");
    });
  });
});
