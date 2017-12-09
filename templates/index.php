<div class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?php foreach ($categories as $key => $value): ?>
                <li class="promo__item promo__item--<?=$value['catimage'] ?>">
                    <a class="promo__link" href="all-lots.html"><?=$value['catname'] ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <?=renderTemplate('templates/_lots.php', ['lots' => $lots]); ?>
        </ul>
    </section>
<?=renderTemplate('templates/_pagination.php', ['pages' => $pages, 'pagesqty' => $pagesqty, 'page' => $page]); ?>
</div>
