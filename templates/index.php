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
            <?php foreach ($lots as $value): ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="<?=htmlspecialchars($value['image']); ?>" width="350" height="260" alt="Сноуборд">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?=htmlspecialchars($value['catname']); ?></span>
                        <h3 class="lot__title"><a class="text-link" href="lot.php?lot_id=<?=$value['lot_id'] ?>"><?=htmlspecialchars($value['lotname']); ?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?=htmlspecialchars($value['initprice']); ?><b class="rub">р</b></span>
                            </div>
                            <div class="lot__timer timer">
                                <?=lotTimeRemaining($value['completed_at']) ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</div>