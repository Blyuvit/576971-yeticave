  <nav class="nav">
    <?=renderTemplate('templates/_categories.php', ['categories' => $categories]); ?>
  </nav>
  <section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
      <?php foreach ($rates as $value): ?>
        <tr class="rates__item" <?php if ($user_id = $value['winner_id']) echo 'style="background-color: silver"'; ?>>
          <td class="rates__info">
            <div class="rates__img">
              <img src="<?=$value['image'] ?>" width="54" height="40" alt="Сноуборд">
            </div>
            <h3 class="rates__title"><a href="lot.php?lot_id=<?=$value['lot_id'] ?>"><?=$value['lotname'] ?></a></h3>
          </td>
          <td class="rates__timer">
            <div class="timer <?php if ($value['completed_at'] <= strtotime('now')) echo "timer--finishing"; ?>"><?=lotTimeRemaining($value['completed_at']) ?></div>
          </td>
          <td class="rates__price">
            <?=$value['rate'] ?>
          </td>
          <td class="rates__time">
            <?=rateTimeFormat($value['created_at']) ?>
          </td>
          <?php if ($user_id = $value['winner_id']) : ?>
          <td class="rates__contacts">
            <?=$value['contacts'] ?>
          </td>
          <?php else : ?>
          <td class="rates__time">
          </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?> 
    </table>
  </section>

