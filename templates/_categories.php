<ul class="nav__list container">
    <?php foreach ($cats as $key => $value): ?>
      <li class="nav__item">
        <a href="all-lots.html"><?=$value['cat']; ?></a>
      </li>
    <?php endforeach; ?>
</ul>