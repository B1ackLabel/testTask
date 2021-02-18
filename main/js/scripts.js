"use strict";

$(document).ready(function (){
    //скрытие строки
    let counter = $("#counter");
    let tbody = $("tbody");
    let changeCountTimerID;

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
                downloadRowsTable();
            } else {
                $("#hideSpan").replaceWith(btn);
                console.log(response.message);
            }
        });
    });

    let checkCointBtn; //проверка нажатой кновки
    //изменение на кнопки +- и в инпут значений.
    $("#plus").click(function (){
        let count = (+counter.val());
        checkCointBtn = true;
        counter.val(++count).change();
    });

    $("#minus").click(function (){
        let count = (+counter.val());
        count--;
        if (count < 0){
            count = 0;
        }
        checkCointBtn = false;
        counter.val(count).change();
    });

    counter.change(function (){
        clearTimeout(changeCountTimerID);
        changeCountTimerID = setTimeout(function (){
            $.post('/ajax.php',{
                'method':'changeCounter',
                'count' : +counter.val()
            }, function (response){
                if (!response.success){
                    console.log(response.message);
                }
            });

            if (tbody.children().length > +counter.val()){
                tbody.children().slice(( +counter.val() )).remove();
            } else {
                downloadRowsTable();
            }
        }, 250);
    });

    function downloadRowsTable() {
        let count = +counter.val();
        let offset = tbody.children().length;
        $.post('/ajax.php', {
            'method': 'reloadTable',
            'count': count - offset,
            'offset': offset
        }, function (response) {
            if (response.success) {
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

    // $("#btn-timer").click(function (){
    //     let val = +$("#num-test").val();
    //     $("#num-test").val(++val);
    // });


   // setTimeout($("#btn-timer").click, 1000);
});