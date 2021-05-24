<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?

use Bitrix\Main\Page\Asset;

Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/select2.min.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/select2.min.js");

?>

<div class="col-lg-5 pl-0 pr-4">
    <div class="goods">
        <div class="goods-img" style="background-image: url('<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>')"></div>
    </div>
</div>
<div class="col-lg-7 px-0">
    <h1 class="title w-75"><?= $arResult["NAME"] ?></h1>
    <div class="price">
        <div>
            <!-- Если нет предложений -->
            <!-- Цены без предложений -->
            <? foreach ($arResult["PRICES"] as $code => $arPrice): ?>
                <? if ($arResult["PROPERTIES"]["FILE_FOR_FREE"]["VALUE"]) : ?>
                    <span class="goods_price-new">Бесплатно</span>
                <? else: ?>
                    <span class="goods_price-new"><?= substr($arPrice["PRINT_VALUE"], 0, -7); ?> руб.</span>
                <? endif; ?>
                <span class="price-old">
                	<? if ($arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"]): ?>
                        <?= $arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"] ?> руб.
                    <? endif; ?>
            	</span>
            <? endforeach; ?>
            <!-- Если есть предложения -->
            <!-- Цены с предложениями -->
            <? foreach ($arResult["OFFERS"] as $arOffer) : ?>
                <? foreach ($arOffer["PRICES"] as $code => $arPrice) : ?>
                    <? if ($arPrice["CAN_ACCESS"]) : ?>
                        <? if ($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]) : ?>
                            <s><?= $arPrice["PRINT_VALUE"]; ?></s> <?= $arPrice["PRINT_DISCOUNT_VALUE"]; ?>
                        <? else : ?>
                            <span class="goods_price-new"><?= substr($arPrice["PRINT_VALUE"], 0, -7); ?> руб.</span>
                        <? endif; ?>
                    <? endif; ?>
                <? endforeach; ?>
                <span class="price-old">
                <? if ($arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"]): ?>
                    <?= $arResult["PROPERTIES"]["OLD_PRICE"]["VALUE"] ?> руб.
                <? endif; ?>
            	</span>
                <!-- Покупка с предложениями -->
                <? if ($arOffer["CAN_BUY"]) : ?>
                    <? foreach ($arOffer["ITEM_MEASURE_RATIOS"] as $code => $arOffers): ?>
                        <form action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data"
                              class="add_form">
                            <input type="text" name="QUANTITY" value="1" size="5" style="display: none;">
                            <input type="hidden" name="<? echo $arParams["ACTION_VARIABLE"] ?>" value="BUY">
                            <input type="hidden" name="<? echo $arParams["PRODUCT_ID_VARIABLE"] ?>"
                                   value="<?= $arOffers["PRODUCT_ID"] ?>">
                            <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "BUY" ?>"
                                   value="<? echo GetMessage("CATALOG_BUY") ?>" style="display: none;">
                            <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "ADD2BASKET" ?>"
                                   value="<? echo GetMessage("CATALOG_ADD_TO_BASKET") ?>"
                                   class="btn text-decoration-none goods_buy-button" disabled="disabled">
                        </form>
                    <? endforeach; ?>
                <? elseif (count($arResult["CAT_PRICES"]) > 0) : ?>
                    <?= GetMessage("CATALOG_NOT_AVAILABLE") ?>
                <? endif; ?>

                <? break; ?>
            <? endforeach; ?>

            <? if ($arResult["OFFERS"]) : ?>
                <div class="form-group mt-3">
                    <label for="kfpo">Выберите класс функциональной пожарной опасности вашего объекта</label>
                    <select class="form-control select-fpo">
                        <option id="empty">
                            <div></div>
                        </option>
                        <? foreach ($arResult["OFFERS"] as $arOffer) : ?>
                            <? foreach ($arOffer["DISPLAY_PROPERTIES"] as $pid => $arProperty) : ?>

                                <?php
echo '<pre>';
print_r($arOffer["ITEM_MEASURE_RATIOS"]);
echo '</pre>';
                                ?>

                                <option value="">
                                    <div><?= $arProperty["DISPLAY_VALUE"]; ?></div>
                                </option>
                            <? endforeach; ?>
                        <? endforeach; ?>
                    </select>
                </div>
            <? endif; ?>

        </div>
        <div>
            <!-- Скачать -->
            <? if ($arResult["PROPERTIES"]["FILE_FOR_FREE"]["VALUE"] > 0) : ?>
                <a class="btn text-decoration-none goods_buy-button"
                   href="<?= CFile::GetPath($arResult["PROPERTIES"]["FILE_FOR_FREE"]["VALUE"]) ?>">Скачать</a>
            <? else: ?>
                <!-- Покупка без предложений -->
                <? if ($arResult["CAN_BUY"]): ?>
                    <form action="<?= POST_FORM_ACTION_URI ?>" method="post" enctype="multipart/form-data"
                          class="add_form">
                        <input type="hidden" name="QUANTITY" value="1" id="QUANTITY<?= $arElement['ID'] ?>"/>
                        <input type="hidden" name="<? echo $arParams["ACTION_VARIABLE"] ?>" value="BUY">
                        <input type="hidden" name="<? echo $arParams["PRODUCT_ID_VARIABLE"] ?>"
                               value="<? echo $arResult["ID"] ?>">
                        <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "BUY" ?>"
                               value="<? echo GetMessage("CATALOG_BUY") ?>" style="display: none;">
                        <input type="submit" name="<? echo $arParams["ACTION_VARIABLE"] . "ADD2BASKET" ?>"
                               value="<? echo GetMessage("CATALOG_ADD_TO_BASKET") ?>"
                               class="btn text-decoration-none goods_buy-button">
                    </form>
                <? elseif ((count($arResult["PRICES"]) > 0) || is_array($arResult["PRICE_MATRIX"])): ?>
                    <?= GetMessage("CATALOG_NOT_AVAILABLE") ?>
                <? endif ?>
            <? endif; ?>


        </div>
    </div>
    <div class="goods-content">
        <p class="goods-content_text">
            <?= $arResult["PROPERTIES"]["WHAT_CORRESPONDS"]["~VALUE"]["TEXT"] ?>
        </p>
    </div>
    <div class="goods-banner">
        <? if ($arResult["DISPLAY_PROPERTIES"]["BONUS"]["FILE_VALUE"]["SRC"]): ?>
            <img src="<?= $arResult["DISPLAY_PROPERTIES"]["BONUS"]["FILE_VALUE"]["SRC"] ?>"
                 alt="goods-banner">
        <? endif; ?>
    </div>
</div>
</div>

<?php
//echo '<pre>';
//print_r($arOffer["PROPERTIES"]);
//echo '</pre>';
?>

<div class="goods-description">
    <div class="d-flex">
        <a class="btn goods-description_btn" data-toggle="collapse" href="#description1" role="button"
           aria-expanded="false" aria-controls="description1">Описание</a>
        <a class="btn goods-description_btn" data-toggle="collapse" href="#description2" role="button"
           aria-expanded="false" aria-controls="description2">Перечень документов</a>
        <a class="btn goods-description_btn" data-toggle="collapse" href="#description3" role="button"
           aria-expanded="false" aria-controls="description3">Как заказать</a>
        <a class="btn goods-description_btn" data-toggle="collapse" href="#description4" role="button"
           aria-expanded="false" aria-controls="description4">Вопросы-ответы</a>
        <a class="btn goods-description_btn" data-toggle="collapse" href="#description5" role="button"
           aria-expanded="false" aria-controls="description5">Отзывы</a>
    </div>
    <div class="" id="description" data-default="1">
        <div class="col-lg-10 px-0">
            <div class="collapse multi-collapse show" id="description1" data-parent="#description">
                <div class="goods-description_list">
                    <?= $arResult["DISPLAY_PROPERTIES"]["DESCRIPTION_TEXT"]["~VALUE"]["TEXT"] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-10 px-0">
            <div class="collapse multi-collapse" id="description2" data-parent="#description">
                <div class="goods-description_list">
                    <?= $arResult["DISPLAY_PROPERTIES"]["LIST_OF_DOCUMENTS"]["~VALUE"]["TEXT"] ?>
                </div>
            </div>
        </div>
        <div class="col-lg-10 px-0">
            <div class="collapse multi-collapse" id="description3" data-parent="#description">
                <div class="d-flex goods-description_list">
                    <? if ($arResult["DISPLAY_PROPERTIES"]["HOW_TO_ORDER_LINK"]["VALUE"] && $arResult["DISPLAY_PROPERTIES"]["HOW_TO_ORDER_TEXT_LINK"]["VALUE"]): ?>
                        <div class="goods-description_list__frame">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe width="410" height="280"
                                        src="<?= $arResult["DISPLAY_PROPERTIES"]["HOW_TO_ORDER_LINK"]["VALUE"] ?>"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                            <p class="goods-description_list__text goods-content_text"><?= $arResult["DISPLAY_PROPERTIES"]["HOW_TO_ORDER_TEXT_LINK"]["VALUE"] ?></p>
                        </div>
                    <? endif; ?>
                    <div>
                        <?= $arResult["DISPLAY_PROPERTIES"]["HOW_TO_ORDER_TEXT"]["~VALUE"]["TEXT"] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 px-0">
            <div class="collapse multi-collapse" id="description4" data-parent="#description">
                <? foreach ($arResult["PROPERTIES"]["QUESTIONS_ANSWERS"]["VALUE"] as $idel): ?>
                    <? $obj = CIBlockElement::GetByID($idel); ?>
                    <? if ($objres = $obj->GetNext()) ?>
                        <div class="question">
                        <b class="question-title"><?= $objres["NAME"]; ?></b>
                    <div class="question-text"><?= $objres["~PREVIEW_TEXT"]; ?></div>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
        <div class="col-lg-12 px-0">
            <div class="collapse multi-collapse" id="description5" data-parent="#description">
                <? foreach ($arResult["PROPERTIES"]["REVIEWS"]["VALUE"] as $analog): ?>
                    <? $res = CIBlockElement::GetByID($analog); ?>
                    <? if ($ar_res = $res->GetNext()) ?>
                        <div class="question d-flex">
                            <div class="review-img rounded-circle">
                                <div class="review-img_url" style="background-image: url(<?= CFile::GetPath($ar_res["PREVIEW_PICTURE"]) ?>);"></div>
                            </div>
                            <div>
                                <b class="question-title"><?=$ar_res["NAME"]?></b>
                                <div class="question-text"><?=$ar_res["~PREVIEW_TEXT"]?></div>
                            </div>
                        </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="questions d-flex justify-content-between align-items-center">
    <div class="questions-text">Появились вопросы?</div>
    <div><span class="questions-text mr-3">8 (800) 550-49-08</span><span>Бесплатно по РФ</span></div>
    <div><a href="#" class="btn text-decoration-none goods_buy-button questions-button">Написать сообщение</a></div>
</div>

<script>
    $(document).ready(function () {
        // $('.select-fpo').select2({
        //     placeholder: "Выберите КФПО"
        // });
        // $('.select-fpo').on("select2:select", function (e) {
        //     if (e.params.data.id) {
        //         $(".goods_buy-button").prop('disabled', false)
        //     }
        // });
    });
</script>
