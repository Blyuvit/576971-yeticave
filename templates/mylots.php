  <nav class="nav">
    <?=renderTemplate('templates/_categories.php', ['cats' => $cats]); ?>
  </nav>
  <section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
      <?php foreach ($rates as $value): ?>
        <tr class="rates__item">
          <td class="rates__info">
            <div class="rates__img">
              <img src="<?=$lots[$value['lotid']]['url'] ?>" width="54" height="40" alt="Сноуборд">
            </div>
            <h3 class="rates__title"><a href="lot.html"><?=$lots[$value['lotid']]['lot-name'] ?></a></h3>
          </td>
          <td class="rates__category">
            <?=$cats[$lots[$value['lotid']]['category']]['cat'] ?>
          </td>
          <td class="rates__timer">
            <div class="timer timer--finishing">07:13:34</div>
          </td>
          <td class="rates__price">
            <?=$value['cost'] ?>
          </td>
          <td class="rates__time">
            <?=bettimeformat($value['time']) ?>
          </td>
        </tr>
      <?php endforeach; ?> 
    </table>
  </section>

