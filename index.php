<?php
    $title_name = "Продукты";
    require_once "header.php";

?>

<table border="1" style="border: 1px solid black" id="table-products">
    <caption>Table Products</caption>
    <thead>
        <tr style="border: 1px solid black">
            <th>ID</th>
            <th>PRODUCT_ID</th>
            <th>PRODUCT_NAME</th>
            <th>PRODUCT_PRICE</th>
            <th>PRODUCT_ARTICLE</th>
            <th>PRODUCT_QUANTITY</th>
            <th>DATE_CREATE</th>
            <th>HIDE</th>
        </tr>
    </thead>

    <? require_once "table.php"; ?>

    <tfoot>
        <tr id="counter-row">
            <td colspan="7">
                <input type="submit" id="plus"  value="+"/>
                <input style="width: 100px" type="number" name="counter" id="counter" value="<?=$count?>" min="0"/>
                <input type="submit" id="minus" value="-"/>
            </td>
        </tr>
    </tfoot>
</table>

<!--<input type="submit" id="btn-timer"  value="+"/>
<input style="width: 100px" type="number" name="counter" id="num-test" value="123" min="0"/> -->

<?
    require_once "footer.php";
?>
