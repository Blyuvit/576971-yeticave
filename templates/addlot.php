
<nav class="nav">
  <?=renderTemplate('templates/_categories.php', ['categories' => $categories]); ?>
</nav>
<?php $iteminvalid = isset($errors) ? "form--invalid" : ""; ?>
<form class="form form--add-lot container <?=$iteminvalid ?>" action="addlot.php" method="post" enctype="multipart/form-data">
  <h2>Добавление лота</h2>
  <div class="form__container-two">
    <?php $iteminvalid = isset($errors['lotname']) ? "form__item--invalid" : ""; 
    $inputvalue = isset($inputlot['lotname']) ? $inputlot['lotname'] : ""; ?>
    <div class="form__item <?=$iteminvalid; ?>"> 
      <label for="lot-name">Наименование</label>
      <input id="lot-name" type="text" name="lotname" placeholder="Введите наименование лота" value="<?=$inputvalue; ?>">
      <span class="form__error">Введите наименование лота</span>
    </div>
    <?php $iteminvalid = isset($errors['category_id']) ? "form__item--invalid" : ""; 
    $selected = isset($inputlot['category_id']) ? "" : "selected"; ?>
    <div class="form__item <?=$iteminvalid; ?>">
      <label for="category">Категория</label>
      <select id="category" name="category_id">
        <option <?=$selected ?> value="">Выберите из списка</option>
        <?php foreach ($categories as $value): ?> 
          <option value="<?=$value['category_id'] ?>" <?php if (!empty($inputlot['category_id']) && ($inputlot['category_id'] == $value['category_id'])) echo "selected"; ?>><?=$value['catname'] ?></option>
        <?php endforeach; ?>
      </select>
      <span class="form__error">Выберите категорию</span>
    </div>
  </div>
  <?php $iteminvalid = isset($errors['description']) ? "form__item--invalid" : "";
  $inputvalue = isset($inputlot['description']) ? $inputlot['description'] : ""; ?>
  <div class="form__item form__item--wide <?=$iteminvalid; ?>">
    <label for="message">Описание</label>
    <textarea id="message" name="description" placeholder="Напишите описание лота"><?=$inputvalue; ?></textarea>
    <span class="form__error">Напишите описание лота</span>
  </div>
  <?php $iteminvalid = isset($errors['image']) ? "form__item--invalid" : "";
  $itemuploaded = isset($inputlot['image']) ? "form__item--uploaded" : "" ?>
  <div class="form__item form__item--file <?=$iteminvalid ?> <?=$itemuploaded ?> ">
    <label>Изображение</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <?php $preview__img = isset($inputlot['image']) ? $inputlot['image'] : ""; ?>
        <img src="<?=$preview__img; ?>" width="113" height="113" alt="Изображение лота">
      </div>
    </div> 
    <div class="form__input-file">
      <input class="visually-hidden" type="file" name="image" id="photo2" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
    <?php $errormsg = isset($errors['image']) ? $errors['image'] : ''; ?>
    <span class="form__error"><?=$errormsg ?></span>
  </div>
  <div class="form__container-three">
    <?php $iteminvalid = isset($errors['initprice']) ? "form__item--invalid" : "";
          $inputvalue = isset($inputlot['initprice']) ? $inputlot['initprice'] : ""; 
          $errormsg = isset($errors['initprice']) ? $errors['initprice'] : ''; ?>
    <div class="form__item form__item--small <?=$iteminvalid; ?>">
      <label for="lot-rate">Начальная цена</label>
      <input id="lot-rate" name="initprice" placeholder="0" value="<?=$inputvalue ?>">
      <span class="form__error"><?=$errormsg ?></span>
    </div>
    <?php $iteminvalid = isset($errors['steprate']) ? "form__item--invalid" : "";
          $inputvalue = isset($inputlot['steprate']) ? $inputlot['steprate'] : "";
          $errormsg = isset($errors['steprate']) ? $errors['steprate'] : ''; ?>
    <div class="form__item form__item--small <?=$iteminvalid; ?>">
      <label for="lot-step">Шаг ставки</label>
      <input id="lot-step" name="steprate" placeholder="0" value="<?=$inputvalue ?>">
      <span class="form__error"><?=$errormsg ?></span>
    </div>
    <?php $iteminvalid = isset($errors['completed_at']) ? "form__item--invalid" : "";
          $inputvalue = isset($inputlot['completed_at']) ? $inputlot['completed_at'] : "";
          $errormsg = isset($errors['completed_at']) ? $errors['completed_at'] : ''; ?>
    <div class="form__item <?=$iteminvalid; ?>">
      <label for="lot-date">Дата окончания торгов</label>
      <input class="form__input-date" id="lot-date" placeholder="дд.мм.гггг" name="completed_at" value="<?=$inputvalue ?>">
      <span class="form__error"><?=$errormsg ?></span>
    </div>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Добавить лот</button>
</form>