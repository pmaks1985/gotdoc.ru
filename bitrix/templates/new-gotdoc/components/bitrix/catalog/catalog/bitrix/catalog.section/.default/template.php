<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? //print_r($arResult);?>
<? //направление сортировки
if (isset($_REQUEST['orderBy'])) {
    if ($_REQUEST['orderBy'] == 'asc') {
        $orderBy = 'desc';
    } else {
        $orderBy = 'asc';
    }
} else {
    $orderBy = 'asc';
}
?>

<? if (empty($arResult["ITEMS"])): ?>
    <div class="text-danger mt-3">По данным параметрам ничего не найдено. Измените условия фильтра.</div>
<? else: ?>

    <div class="sort d-flex">
        <p class="sort-title">Сортировать:</p>
        <a class="sort-link"
           href="<?= $APPLICATION->GetCurPageParam('sortBy=show&orderBy=' . $orderBy, array('sortBy', 'orderBy')) ?>">По
            популярности</a>
        <a class="sort-link"
           href="<?= $APPLICATION->GetCurPageParam('sortBy=price&orderBy=' . $orderBy, array('sortBy', 'orderBy')) ?>">По
            цене</a>
        <a class="sort-link"
           href="<?= $APPLICATION->GetCurPageParam('sortBy=name&orderBy=' . $orderBy, array('sortBy', 'orderBy')) ?>">По
            алфавиту</a>
    </div>

    <? foreach ($arResult["ITEMS"] as $cell => $arElement): ?>
        <?
        $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
        ?>
        <? if ($cell % $arParams["LINE_ELEMENT_COUNT"] == 0): ?>
            <div>
        <? endif; ?>

        <td valign="top" width="<?= round(100 / $arParams["LINE_ELEMENT_COUNT"]) ?>%"
            id="<?= $this->GetEditAreaId($arElement['ID']); ?>">


            <div class="product-list d-flex">
                <? if (is_array($arElement["PREVIEW_PICTURE"])): ?>
                    <div class="product-list_img"
                         style="background-image: url('<?= $arElement["PREVIEW_PICTURE"]["SRC"] ?>')"></div>
                <? elseif (is_array($arElement["DETAIL_PICTURE"])): ?>
                    <div class="product-list_img"
                         style="background-image: url('<?= $arElement["DETAIL_PICTURE"]["SRC"] ?>')"></div>
                <? endif ?>

                <div class="product-list_text">
                    <p class="product-list_text__title"><a class="product-list_text__title-link"
                                                           href="<?= $arElement["DETAIL_PAGE_URL"] ?>"><?= $arElement["NAME"] ?></a>
                    </p>
                    <p class="product-list_text__description"><?= $arElement["PREVIEW_TEXT"] ?></p>
                </div>
                <? if (is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"])): ?>
					<div class="price">
                    <? foreach ($arElement["OFFERS"] as $arOffer): ?>
                        <? foreach ($arParams["OFFERS_FIELD_CODE"] as $field_code): ?>
                            <small><? echo GetMessage("IBLOCK_FIELD_" . $field_code) ?>:&nbsp;<?
                                echo $arOffer[$field_code]; ?></small><br/>
                        <? endforeach; ?>
                        <? foreach ($arOffer["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
                            <small><?= $arProperty["NAME"] ?>:&nbsp;<?
                                if (is_array($arProperty["DISPLAY_VALUE"]))
                                    echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
                                else
                                    echo $arProperty["DISPLAY_VALUE"]; ?></small><br/>
                        <? endforeach ?>

                        <? foreach ($arOffer["PRICES"] as $code => $arPrice): ?>
                            <? if ($arPrice["CAN_ACCESS"]): ?>
                                    <? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
                                        <s><?= $arPrice["PRINT_VALUE"] ?></s> <span
                                                class="catalog-price"><?= $arPrice["PRINT_DISCOUNT_VALUE"] ?></span>
                                    <? else: ?>
									<? $val = substr($arPrice["PRINT_VALUE"], 0, -7); ?>
                                        <span class="price-new"><?= $val; ?> руб.</span>
										<? if ($arElement['PROPERTIES']['OLD_PRICE']['VALUE']): ?>
                                    		<span class="price-old"><? echo $arElement['PROPERTIES']['OLD_PRICE']['VALUE']; ?> руб.</span>
                                		<? endif; ?>
                                    <? endif ?>
                            <? endif; ?>
                        <? endforeach; ?>
                        <span>
                        <? if ($arParams["DISPLAY_COMPARE"]): ?>
                            <noindex>
                                <a href="<? echo $arOffer["COMPARE_URL"] ?>"
                                   rel="nofollow"><? echo GetMessage("CATALOG_COMPARE") ?></a>&nbsp;
                            </noindex>
                        <? endif ?>
                        <? if ($arOffer["CAN_BUY"]): ?>
                            <? if ($arParams["USE_PRODUCT_QUANTITY"]): ?>
                                <form action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
                                    <table border="0" cellspacing="0" cellpadding="2">
                                        <tr valign="top">
                                            <td><? echo GetMessage("CT_BCS_QUANTITY") ?>:</td>
                                            <td>
                                                <input type="text"
                                                       name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"] ?>"
                                                       value="1" size="5">
                                            </td>
                                        </tr>
                                    </table>
                                    <input type="hidden" name="<? echo $arParams["ACTION_VARIABLE"] ?>" value="BUY">
                                    <input type="hidden" name="<? echo $arParams["PRODUCT_ID_VARIABLE"] ?>"
                                           value="<? echo $arOffer["ID"] ?>">
                                    <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "BUY" ?>"
                                           value="<? echo GetMessage("CATALOG_BUY") ?>">
                                    <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "ADD2BASKET" ?>"
                                           value="<? echo GetMessage("CATALOG_ADD") ?>">
                                </form>
                            <? else: ?>
								<div class="buy-button">
                                    <a href="<?= $arElement["DETAIL_PAGE_URL"] ?>"
                                       class="btn-outline-danger text-decoration-none buy-button_link">
                                        Подробнее
                                    </a>
                                </div>
                            <? endif; ?>
                        <? elseif (count($arResult["PRICES"]) > 0): ?>
                            <?= GetMessage("CATALOG_NOT_AVAILABLE") ?>
                        <? endif ?>
                        </span>
						<? break; ?> <?//останавливаю цикл после перовй итерации?>
                    <? endforeach; ?>
				</div>
                <? else: ?>
                    <? foreach ($arElement["PRICES"] as $code => $arPrice): ?>
                        <? if ($arPrice["CAN_ACCESS"]): ?>
                            <div class="price">
                                <? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]): ?>
                                    <s><?= $arPrice["PRINT_VALUE"] ?></s> <span
                                            class="catalog-price"><?= $arPrice["PRINT_DISCOUNT_VALUE"] ?></span>
                                <? else: ?>
                                    <? $val = substr($arPrice["PRINT_VALUE"], 0, -7); ?>
                                    <? if ($arElement["PROPERTIES"]["FILE_FOR_FREE"]["VALUE"]) : ?>
                                        <span class="price-new">Бесплатно</span>
                                    <? else: ?>
                                        <span class="price-new"><?= $val; ?> руб.</span>
                                    <? endif; ?>
                                <? endif; ?>
                                <? if ($arElement['PROPERTIES']['OLD_PRICE']['VALUE']): ?>
                                    <span class="price-old"><? echo $arElement['PROPERTIES']['OLD_PRICE']['VALUE']; ?> руб.</span>
                                <? endif; ?>
                                <div class="buy-button">
                                    <a href="<?= $arElement["DETAIL_PAGE_URL"] ?>"
                                       class="btn-outline-danger text-decoration-none buy-button_link">
                                        Подробнее
                                    </a>
                                </div>
                            </div>
                        <? endif; ?>
                    <? endforeach; ?>
                    <? if (is_array($arElement["PRICE_MATRIX"])): ?>
                        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="data-table">
                            <thead>
                            <tr>
                                <? if (count($arElement["PRICE_MATRIX"]["ROWS"]) >= 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)): ?>
                                    <td valign="top" nowrap><?= GetMessage("CATALOG_QUANTITY") ?></td>
                                <? endif ?>
                                <? foreach ($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType): ?>
                                    <td valign="top" nowrap><?= $arType["NAME_LANG"] ?></td>
                                <? endforeach ?>
                            </tr>
                            </thead>
                            <? foreach ($arElement["PRICE_MATRIX"]["ROWS"] as $ind => $arQuantity): ?>
                                <tr>
                                    <? if (count($arElement["PRICE_MATRIX"]["ROWS"]) > 1 || count($arElement["PRICE_MATRIX"]["ROWS"]) == 1 && ($arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_FROM"] > 0 || $arElement["PRICE_MATRIX"]["ROWS"][0]["QUANTITY_TO"] > 0)): ?>
                                        <th nowrap><?
                                            if (IntVal($arQuantity["QUANTITY_FROM"]) > 0 && IntVal($arQuantity["QUANTITY_TO"]) > 0)
                                                echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_FROM_TO")));
                                            elseif (IntVal($arQuantity["QUANTITY_FROM"]) > 0)
                                                echo str_replace("#FROM#", $arQuantity["QUANTITY_FROM"], GetMessage("CATALOG_QUANTITY_FROM"));
                                            elseif (IntVal($arQuantity["QUANTITY_TO"]) > 0)
                                                echo str_replace("#TO#", $arQuantity["QUANTITY_TO"], GetMessage("CATALOG_QUANTITY_TO"));
                                            ?></th>
                                    <? endif ?>
                                    <? foreach ($arElement["PRICE_MATRIX"]["COLS"] as $typeID => $arType): ?>
                                        <td><?
                                            if ($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"] < $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"]):?>
                                                <s><?= FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]) ?></s>
                                                <span class="catalog-price"><?= FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["DISCOUNT_PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]); ?></span>
                                            <? else: ?>
                                                <span class="catalog-price"><?= FormatCurrency($arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["PRICE"], $arElement["PRICE_MATRIX"]["MATRIX"][$typeID][$ind]["CURRENCY"]); ?></span>
                                            <? endif ?>&nbsp;
                                        </td>
                                    <? endforeach ?>
                                </tr>
                            <? endforeach ?>
                        </table><br/>
                    <? endif ?>
                    <? if ($arParams["DISPLAY_COMPARE"]): ?>
                        <noindex>
                            <a href="<? echo $arElement["COMPARE_URL"] ?>"
                               rel="nofollow"><? echo GetMessage("CATALOG_COMPARE") ?></a>&nbsp;
                        </noindex>
                    <? endif ?>
                    <? if ($arElement["CAN_BUY"]): ?>
                        <? if ($arParams["USE_PRODUCT_QUANTITY"] || count($arElement["PRODUCT_PROPERTIES"])): ?>
                            <form action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data">
                                <table border="0" cellspacing="0" cellpadding="2">
                                    <? if ($arParams["USE_PRODUCT_QUANTITY"]): ?>
                                        <tr valign="top">
                                            <td><? echo GetMessage("CT_BCS_QUANTITY") ?>:</td>
                                            <td>
                                                <input type="text"
                                                       name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"] ?>"
                                                       value="1" size="5">
                                            </td>
                                        </tr>
                                    <? endif; ?>
                                    <? foreach ($arElement["PRODUCT_PROPERTIES"] as $pid => $product_property): ?>
                                        <tr valign="top">
                                            <td><? echo $arElement["PROPERTIES"][$pid]["NAME"] ?>:</td>
                                            <td>
                                                <? if (
                                                    $arElement["PROPERTIES"][$pid]["PROPERTY_TYPE"] == "L"
                                                    && $arElement["PROPERTIES"][$pid]["LIST_TYPE"] == "C"
                                                ): ?>
                                                    <? foreach ($product_property["VALUES"] as $k => $v): ?>
                                                        <label><input type="radio"
                                                                      name="<? echo $arParams["PRODUCT_PROPS_VARIABLE"] ?>[<? echo $pid ?>]"
                                                                      value="<? echo $k ?>" <? if ($k == $product_property["SELECTED"]) echo '"checked"' ?>><? echo $v ?>
                                                        </label><br>
                                                    <? endforeach; ?>
                                                <? else: ?>
                                                    <select name="<? echo $arParams["PRODUCT_PROPS_VARIABLE"] ?>[<? echo $pid ?>]">
                                                        <? foreach ($product_property["VALUES"] as $k => $v): ?>
                                                            <option value="<? echo $k ?>" <? if ($k == $product_property["SELECTED"]) echo '"selected"' ?>><? echo $v ?></option>
                                                        <? endforeach; ?>
                                                    </select>
                                                <? endif; ?>
                                            </td>
                                        </tr>
                                    <? endforeach; ?>
                                </table>
                                <input type="hidden" name="<? echo $arParams["ACTION_VARIABLE"] ?>" value="BUY">
                                <input type="hidden" name="<? echo $arParams["PRODUCT_ID_VARIABLE"] ?>"
                                       value="<? echo $arElement["ID"] ?>">
                                <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "BUY" ?>"
                                       value="<? echo GetMessage("CATALOG_BUY") ?>">
                                <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "ADD2BASKET" ?>"
                                       value="<? echo GetMessage("CATALOG_ADD") ?>">
                            </form>
                        <? else: ?>

                        <? endif; ?>
                    <? elseif ((count($arResult["PRICES"]) > 0) || is_array($arElement["PRICE_MATRIX"])): ?>
                        <?= GetMessage("CATALOG_NOT_AVAILABLE") ?>
                    <? endif ?>
                <? endif ?>
                &nbsp;
            </div>
        </div>

        <? $cell++;
        if ($cell % $arParams["LINE_ELEMENT_COUNT"] == 0):?>
            </tr>
        <? endif ?>

    <? endforeach; // foreach($arResult["ITEMS"] as $arElement):?>

    <? if ($cell % $arParams["LINE_ELEMENT_COUNT"] != 0): ?>
        <? while (($cell++) % $arParams["LINE_ELEMENT_COUNT"] != 0): ?>
            <td>&nbsp;</td>
        <? endwhile; ?>
        </tr>
    <? endif ?>


    <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
        <br/><?= $arResult["NAV_STRING"] ?>
    <? endif; ?>

<? endif; //empty($arResult["ITEMS"])?>
<div class="text">
        <span>
            <?= $arResult["DESCRIPTION"] ?>
        </span>
</div>