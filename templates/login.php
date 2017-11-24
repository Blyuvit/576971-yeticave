  <nav class="nav">
    <ul class="nav__list container">
      <?php foreach($cats as $key => $value): ?>
        <li class="nav__item">
          <a href="all-lots.html"><?=$value['cat'] ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </nav>
  <?php $forminvalid = isset($errors) ? "form--invalid" : ""; ?>
  <form class="form container <?=$forminvalid ?>" action="login.php" method="post">
    <h2>Вход</h2>
    <?php $iteminvalid = isset($errors['email']) ? "form__item--invalid" : ""; 
    $value = isset($input['email']) ? $input['email'] : ""; 
    $errormsg = isset ($errors['email']) ? $errors['email'] : ""; ?>
    <div class="form__item <?=$iteminvalid ?>">
      <label for="email">E-mail</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$value ?>">
      <span class="form__error"><?=$errors['email']?></span>
    </div>
    <?php $iteminvalid = isset($errors['password']) ? "form__item--invalid" : ""; 
    $errormsg = isset($errors['password']) ? $errors['password'] : ""; ?>
    <div class="form__item form__item--last <?=$iteminvalid ?>">
      <label for="password">Пароль</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль">
      <span class="form__error"><?=$errors['password']?></span>
    </div>
    <button type="submit" class="button">Войти</button>
  </form>
