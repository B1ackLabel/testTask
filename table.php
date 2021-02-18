<?php
$connectCfg = require_once "db/cfg.php";
require_once "db/CConfigs.php";
require_once "db/CProducts.php";
$Products = new CProducts($connectCfg);
$Configs = new CConfigs($connectCfg);
$count = $Configs->getConfig('counter');
$arr = $Products->get($count, 0);

//start row
?>
<tbody>
<? foreach ( $arr as $key => $value ): ?>
    <tr class="row" data-id="<?= $value['ID'] ?>">
        <td>
            <?= $value['ID'] ?>
        </td>
        <td>
            <?= $value['PRODUCT_ID'] ?>
        </td>
        <td>
            <?= $value['PRODUCT_NAME'] ?>
        </td>
        <td>
            <?= $value['PRODUCT_PRICE'] ?>
        </td>
        <td>
            <?= $value['PRODUCT_ARTICLE'] ?>
        </td>
        <td>
            <?= $value['PRODUCT_QUANTITY'] ?>
        </td>
        <td>
            <?= $value['DATE_CREATE'] ?>
        </td>
        <td>
            <input type="submit" class="btn-row-hide" name="send" value="Скрыть" />
        </td>
    </tr>
<?  //end row
    endforeach;
?>
</tbody>

