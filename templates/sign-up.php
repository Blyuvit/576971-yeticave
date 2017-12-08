  <nav class="nav">
    <?=renderTemplate('templates/_categories.php', ['categories' => $categories]); ?>
  </nav>
  <?php $iteminvalid = isset($errors) ? "form--invalid" : ""; ?>
  <form class="form container <?=$iteminvalid ?>" action="sign-up.php" method="post" enctype="multipart/form-data"> 
    <h2>Регистрация нового аккаунта</h2>
    <?php $iteminvalid = isset($errors['email']) ? "form__item--invalid" : ""; 
          $inputvalue = isset($input['email']) ? $input['email'] : ""; 
          $errormsg = isset($errors['email']) ? $errors['email'] : ""; ?>
    <div class="form__item <?=$iteminvalid; ?>">
      <label for="email">E-mail*</label>
      <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$inputvalue; ?>">
      <span class="form__error"><?=$errormsg ?></span>
    </div>
        <?php $iteminvalid = isset($errors['password']) ? "form__item--invalid" : "";
              $inputvalue = isset($input['password']) ? $input['password'] : "";  
              $errormsg = isset($errors['password']) ? $errors['password'] : ""; ?>
    <div class="form__item <?=$iteminvalid; ?>">
      <label for="password">Пароль*</label>
      <input id="password" type="text" name="password" placeholder="Введите пароль" value="<?=$inputvalue ?>">
      <span class="form__error"><?=$errormsg ?></span>
    </div>
    <?php $iteminvalid = isset($errors['name']) ? "form__item--invalid" : ""; 
          $inputvalue = isset($input['name']) ? $input['name'] : ""; 
          $errormsg = isset($errors['name']) ? $errors['name'] : "";?>
    <div class="form__item <?=$iteminvalid; ?>">
      <label for="name">Имя*</label>
      <input id="name" type="text" name="name" placeholder="Введите имя" value="<?=$inputvalue; ?>">
      <span class="form__error"><?=$errormsg ?></span>
    </div>
    <?php $iteminvalid = isset($errors['contacts']) ? "form__item--invalid" : ""; 
          $inputvalue = isset($input['contacts']) ? $input['contacts'] : ""; 
          $errormsg = isset($errors['contacts']) ? $errors['contacts'] : "";?>
    <div class="form__item <?=$iteminvalid; ?>">
      <label for="message">Контактные данные*</label>
      <textarea id="message" name="contacts" placeholder="Напишите как с вами связаться"><?=$inputvalue; ?></textarea>
      <span class="form__error"><?=$errormsg ?></span>
    </div>
    <?php $iteminvalid = isset($errors['avatar']) ? "form__item--invalid" : "";
          $preview_img = isset($input['avatar']) ? $input['avatar'] : ""; 
          $errormsg = isset($errors['avatar']) ? $errors['avatar'] : ""; ?>
    <div class="form__item form__item--file form__item--last <?=$iteminvalid; ?>">
      <label>Аватар</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="<?=$preview_img ?>" width="113" height="113" alt="Ваш аватар">
        </div>
      </div>
      <div class="form__input-file">
        <input class="visually-hidden" name="avatar" type="file" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
      <span class="form__error"><?=$errormsg ?></span>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="/login.php">Уже есть аккаунт</a>
  </form>
