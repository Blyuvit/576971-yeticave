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