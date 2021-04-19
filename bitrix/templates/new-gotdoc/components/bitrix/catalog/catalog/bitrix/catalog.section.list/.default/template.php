<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="d-flex align-items-center pt-3">
    <?
    $TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
    $CURRENT_DEPTH = $TOP_DEPTH;
    foreach ($arResult["SECTIONS"] as $arSection):
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));

    if ($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
        echo "\n", str_repeat("\t", $arSection["DEPTH_LEVEL"] - $TOP_DEPTH), "<ul>";
    elseif ($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
        echo "</li>";
    else {
        while ($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"]) {
            echo "</li>";
            echo "\n", str_repeat("\t", $CURRENT_DEPTH - $TOP_DEPTH), "</ul>", "\n", str_repeat("\t", $CURRENT_DEPTH - $TOP_DEPTH - 1);
            $CURRENT_DEPTH--;
        }
        echo "\n", str_repeat("\t", $CURRENT_DEPTH - $TOP_DEPTH), "</li>";
    }

    echo "\n", str_repeat("\t", $arSection["DEPTH_LEVEL"] - $TOP_DEPTH);
    ?>
    <li id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
        <a href="<?= $arSection["SECTION_PAGE_URL"] ?>"><?= $arSection["NAME"] ?></a>

        <?

        $CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
        endforeach;

        while ($CURRENT_DEPTH > $TOP_DEPTH) {
            echo "</li>";
            echo "\n", str_repeat("\t", $CURRENT_DEPTH - $TOP_DEPTH), "</ul>", "\n", str_repeat("\t", $CURRENT_DEPTH - $TOP_DEPTH - 1);
            $CURRENT_DEPTH--;
        }
        ?>
</div>

<div class="d-flex align-items-center pt-3">
    <a href="<?= $arSection["SECTION_PAGE_URL"] ?>" class="text-decoration-none">
        <div class="card mr-3">
            <img class="card-img-top" src="/new-gotdoc/img/books.png" alt="books">
            <div class="card-body">
                <p class="card-text"><?= $arSection["NAME"] ?></p>
            </div>
        </div>
    </a>
    <a href="#" class="text-decoration-none">
        <div class="card mr-3">
            <img class="card-img-top" src="/new-gotdoc/img/docs.png" alt="docs">
            <div class="card-body">
                <p class="card-text">Типовые шаблоны</p>
            </div>
        </div>
    </a>
</div>
