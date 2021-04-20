<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="d-flex align-items-center pt-3">
    <?
    $TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
    $CURRENT_DEPTH = $TOP_DEPTH;
    foreach ($arResult["SECTIONS"] as $arSection):
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <a href="<?= $arSection["SECTION_PAGE_URL"] ?>" class="text-decoration-none">
            <div class="card mr-3">
                <? if (strlen($arSection["PICTURE"]["SRC"]) > 0): ?>
                    <div class="card-img-top" style="background-image: url('<?= $arSection["PICTURE"]["SRC"] ?>')"></div>
                <? else: ?>
                    нет картинки
                <? endif ?>
                <div class="card-body">
                    <p class="card-text"><?= $arSection["NAME"] ?></p>
                </div>
            </div>
        </a>

    <? endforeach; ?>
</div>
