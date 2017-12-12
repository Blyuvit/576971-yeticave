<div>
    <?php if (isset($lot)): ?>
        <nav class="nav">
           <?=renderTemplate('templates/_categories.php', ['categories' => $categories]); ?>
        </nav>
        <section class="lot-item container">
            <h2><?=htmlspecialchars($lot['lotname']) ?></h2>
            <div class="lot-item__content">
                <div class="lot-item__left">
                    <div class="lot-item__image">
                        <img src="<?=htmlspecialchars($lot['image']) ?>" width="730" height="548" alt="Изображение лота">
                    </div>
                    <p class="lot-item__category">Категория: <span><?=$lot['catname'] ?></span></p>
                    <p class="lot-item__description"><?=htmlspecialchars($lot['description']) ?></p>
                </div>
                <div class="lot-item__right">
                <?php if ($user_id && !$lotrated && !$lotcreated && !$lotclosed) : ?>
                    <div class="lot-item__state">
                        <div class="lot-item__timer timer">
                            <?=lotTimeRemaining($lot['completed_at']) ?>
                        </div>
                        <div class="lot-item__cost-state">
                            <div class="lot-item__rate">
                                <span class="lot-item__amount">Текущая цена</span>
                                <?php $price = isset($maxrate) ? $maxrate : $lot['initprice'] ?>
                                <span class="lot-item__cost"><?=$price ?></span>
                            </div>
                            <div class="lot-item__min-cost">
                                Мин. ставка <span><?=$lot['steprate'] ?> руб.</span>
                            </div>
                        </div>
                        <form class="lot-item__form" action="addrate.php?lot_id=<?=$lot['lot_id'] ?>" method="post">
                            <input hidden name="created_at" value="<?=strtotime('now') ?>">
                            <input hidden name="lot_id" value="<?=$lot['lot_id'] ?>">
                            <input hidden name="user_id" value="<?=$user_id ?>">
                            <input hidden name="price" value="<?=$price ?>">
                            <input hidden name="steprate" value="<?=$lot['steprate'] ?>">
                            <?php $iteminvalid = isset($error) ? "form__item--invalid" : ""; 
                                  $errormsg = isset($error) ? $error : ""; ?>
                            <p class="lot-item__form-item <?=$iteminvalid ?>">
                                <label for="cost">Ваша ставка</label>
                                <input id="cost" name="rate" placeholder="<?=$price + $lot['steprate'] ?>">
                                <span class="form__error"><?=$errormsg ?></span>
                            </p>
                            <button type="submit" class="button">Сделать ставку</button>
                        </form>
                    </div>
                <?php endif; ?>
                    <div class="history">
                        <h3>История ставок (<span><?=$ratesqty ?></span>)</h3>
                        <?php foreach ($rates as $key => $value): ?>
                            <table class="history__list">
                                <tr class="history__item">
                                    <td class="history__name"><?=htmlspecialchars($value['name']) ?></td>
                                    <td class="history__price"><?=$value['rate'] ?> р</td>
                                    <td class="history__time"><?=rateTimeFormat($value['created_at']); ?></td>
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