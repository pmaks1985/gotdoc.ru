<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

</div><!--content-->
</div><!--container-->
<footer>
    <div class="container">
        <div class="footer d-flex justify-content-between">
            <div><a class="footer-title text-decoration-none" href="/">Готовые документы</a>
            </div>
            <div class="footer-phone">
                <p><a class="text-decoration-none footer-phone_link" href="tel:88005509590">8 (800) 550-95-90</a>
                </p>
                <p>Звонок по России бесплатный</p>
                <p><a href="mailto:info@gotdoc.ru">info@gotdoc.ru</a></p>
            </div>
            <div class="footer-schedule">
                <p>График работы:</p>
                <p>пн-пт: 6:00-21:00</p>
                <p>(время московское)</p>
            </div>
            <div class="footer-nord-soft">
                <a class="text-decoration-none" href="https://nordsoftware.ru/">
                    <p class="footer-nord-soft_title">Создание сайта:</p>
                    <img src="/bitrix/templates/new-gotdoc/img/nord-soft.png" alt="nord-soft">
                </a>
            </div>
        </div>
    </div>
</footer>

<script>
    $(document).ready(function () {
        $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
            if (!$(this).next().hasClass('show')) {
                $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
            }
            var $subMenu = $(this).next('.dropdown-menu');
            $subMenu.toggleClass('show');
            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
                $('.dropdown-submenu .show').removeClass('show');
            });
            return false;
        });

        $('.dropdown').on("hidden.bs.dropdown", function () {
            $('.dropdown-menu.show').removeClass('show');
        });

        $(document).on('click', '.dropdown-menu', function (e) {
            $(this).hasClass('keep_open') && e
                .stopPropagation();
        });

    });
</script>

</body>

</html>