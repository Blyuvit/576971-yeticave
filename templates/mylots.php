  <nav class="nav">
    <?=renderTemplate('templates/_categories.php', ['categories' => $categories]); ?>
  </nav>
  <section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
      <?php foreach ($rates as $value): ?>
        <tr class="rates__item">
          <td class="rates__info">
            <div class="rates__img">
              <img src="<?=$value['image'] ?>" width="54" height="40" alt="Сноуборд">
            </div>
            <h3 class="rates__title"><a href="lot.php?lot_id=<?=$value['lot_id'] ?>"><?=$value['lotname'] ?></a></h3>
          </td>
          <td class="rates__category">
            <?=$value['catname'] ?>
          </td>
          <td class="rates__timer">
            <div class="timer timer--finishing"><?=lotTimeRemaining($value['completed_at']) ?></div>
          </td>
          <td class="rates__price">
            <?=$value['rate'] ?>
          </td>
          <td class="rates__time">
            <?=rateTimeFormat($value['created_at']) ?>
          </td>
        </tr>
      <?php endforeach; ?> 
    </table>
  </section>

