 <nav class="nav">
  <?=renderTemplate('templates/_categories.php', ['categories' => $categories]); ?>
</nav>
<div class="container">
  <section class="lots">
    <?php $catmsg=isset($cat) ? $cat : ''; ?>
    <h2>Все лоты в категории «<span><?=$catmsg ?></span>»</h2>
    <?php $errormsg=isset($error) ? $error : ''?>
    <p class="error"><?=$errormsg ?></p>
    <ul class="lots__list">
      <?=renderTemplate('templates/_lots.php', ['lots' => $lots]); ?>
    </ul>
  </section>
  <?=renderTemplate('templates/_pagination.php', ['pages' => $pages, 'pagesqty' => $pagesqty, 'page' => $page, 'cat' => $cat]); ?>
</div>