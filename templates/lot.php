<?php

$betsqty = count($bets);

if(!isset($_SESSION)) {
    session_start();
}

?>
<div>
    <?php if (isset($lot)): ?>
        <nav class="nav">
            <ul class="nav__list container">
                <?php foreach ($cats as $key => $value): ?>
                    <li class="nav__item">
                        <a href="all-lots.html"><?=$value['cat']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <section class="lot-item container">
            <h2><?=$lot['lot-name'] ?></h2>
            <div class="lot-item__content">
                <div class="lot-item__left">
                    <div class="lot-item__image">
                        <img src="<?=$lot['url'] ?>" width="730" height="548" alt="Изображение лота">
                    </div>
                    <p class="lot-item__category">Категория: <span><?=$cats[$lot['category']]['cat'] ?></span></p>
                    <p class="lot-item__description"><?=$lot['message'] ?></p>
                </div>
                <div class="lot-item__right">
                <?php if (isset($_SESSION['user']) && (!searchLotRate($lot_id, $rates))) : ?>
                    <div class="lot-item__state">
                        <div class="lot-item__timer timer">
                            10:54:12
                        </div>
                        <div class="lot-item__cost-state">
                            <div class="lot-item__rate">
                                <span class="lot-item__amount">Текущая цена</span>
                                <span class="lot-item__cost"><?=$lot['lot-rate'] ?></span>
                            </div>
                            <div class="lot-item__min-cost">
                                Мин. ставка <span>12 000 р</span>
                            </div>
                        </div>
                        <form class="lot-item__form" action="addrate.php" method="post">
                            <input hidden name="time" value="<?=strtotime('now') ?>">
                            <input hidden name="lotid" value="<?=$lot_id ?>">
                            <p class="lot-item__form-item">
                                <label for="cost">Ваша ставка</label>
                                <input id="cost" type="number" name="cost" placeholder="12 000">
                            </p>
                            <button type="submit" class="button">Сделать ставку</button>
                        </form>
                    </div>
                <?php endif; ?>
                    <div class="history">
                        <h3>История ставок (<span><?=$betsqty ?></span>)</h3>
                        <?php foreach ($bets as $key => $value): ?>
                            <table class="history__list">
                                <tr class="history__item">
                                    <td class="history__name"><?=$value['name'] ?></td>
                                    <td class="history__price"><?=$value['lot-rate'] ?> р</td>
                                    <td class="history__time"><?=bettimeformat($value['ts']); ?></td>
                                </tr>
                            </table>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <div class="container">
            <h1 style="color: black">Выбранный лот отсутствует</h1>
        </div>
    <?php endif; ?>
</div>