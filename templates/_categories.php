<ul class="nav__list container">
    <?php foreach ($categories as $key => $value): ?>
      <li class="nav__item">
        <a href="all-lots.html"><?=$value['catname']; ?></a>
      </li>
    <?php endforeach; ?>
</ul>