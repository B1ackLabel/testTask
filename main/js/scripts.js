"use strict";

$(document).ready(function (){
    //скрытие строки
    let counter = $("#counter");

    $(document).on('click', ".btn-row-hide", function (){
        let btn = $(this);
        let row = btn.closest('tr'); //поиск строки
        let id = row.data('id');

        $(this).replaceWith('<span id="hideSpan" >Скрываю</span>');

        $.post('/ajax.php', {
            'method': 'hideRow',
            'id': id
        }, function (response){
            if(response.success){
                row.remove();
                reloadTable();
            } else {
                $("#hideSpan").replaceWith(btn);
                console.log(response.message);
            }
        });
    });

    //изменение на кнопки +- и в инпут значений.
    $("#plus").click(function (){
        let count = (+counter.val());
        counter.val(++count).change();
    });

    $("#minus").click(function (){
        let count = (+counter.val());
        count--;
        if (count < 0){
            count = 0;
        }

        counter.val(count).change();
    });

    counter.change(function (){
        $.post('/ajax.php',{
            'method':'changeCounter',
            'count' : this.value
        }, function (response){
            if (!response.success){
                console.log(response.message);
            }
        });
        reloadTable();
    });


    function reloadTable() {
        $.post('/ajax.php', {
            'method': 'reloadTable',
            'count': counter.val()
        }, function (response) {
            if (response.success) {
                let tbody = $("tbody").empty();
                response.data.forEach(function (product) {
                    let rowHtml = $('<tr class="row" data-id="' + product.ID + '" ></tr>');
                    rowHtml.append('<td>' + product.ID + '</td>');
                    rowHtml.append('<td>' + product.PRODUCT_ID + '</td>');
                    rowHtml.append('<td>' + product.PRODUCT_NAME + '</td>');
                    rowHtml.append('<td>' + product.PRODUCT_PRICE + '</td>');
                    rowHtml.append('<td>' + product.PRODUCT_ARTICLE + '</td>');
                    rowHtml.append('<td>' + product.PRODUCT_QUANTITY + '</td>');
                    rowHtml.append('<td>' + product.DATE_CREATE + '</td>');
                    rowHtml.append('<td><input type="submit" class="btn-row-hide" name="send" value="Скрыть" /></td>');
                    tbody.append(rowHtml);
                });
            } else {
                console.log(response.message);
            }
        });
    }

});