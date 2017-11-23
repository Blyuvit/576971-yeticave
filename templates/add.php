
<nav class="nav">
  <ul class="nav__list container">
    <?php foreach ($cats as $key => $value): ?>
      <li class="nav__item">
        <a href="all-lots.html"><?=$value['cat']; ?></a>
      </li>
    <?php endforeach; ?>
  </ul>
</nav>
<?php $iteminvalid = isset($errors) ? "form--invalid" : ""; ?>
<form class="form form--add-lot container <?=$iteminvalid ?>" action="add.php" method="post" enctype="multipart/form-data">
  <h2>Добавление лота</h2>
  <div class="form__container-two">
    <?php $iteminvalid = isset($errors['lot-name']) ? "form__item--invalid" : ""; 
    $inputvalue = isset($inputlot['lot-name']) ? $inputlot['lot-name'] : ""; ?>
    <div class="form__item <?=$iteminvalid; ?>"> 
      <label for="lot-name">Наименование</label>
      <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$inputvalue; ?>">
      <span class="form__error">Введите наименование лота</span>
    </div>
    <?php $iteminvalid = isset($errors['category']) ? "form__item--invalid" : ""; 
    $selected = isset($inputlot['category']) ? "" : "selected"; ?>
    <div class="form__item <?=$iteminvalid; ?>">
      <label for="category">Категория</label>
      <select id="category" name="category">
        <option <?=$selected ?> value="">Выберите из списка</option>
        <?php foreach ($cats as $key => $value): ?> 
          <option value="<?=$key ?>" <?php if (!empty($inputlot['category']) && ($inputlot['category'] == $key)) echo "selected"; ?>><?=$value['cat'] ?></option>
        <?php endforeach; ?>
      </select>
      <span class="form__error">Выберите категорию</span>
    </div>
  </div>
  <?php $iteminvalid = isset($errors['message']) ? "form__item--invalid" : "";
  $inputvalue = isset($inputlot['message']) ? $inputlot['message'] : ""; ?>
  <div class="form__item form__item--wide <?=$iteminvalid; ?>">
    <label for="message">Описание</label>
    <textarea id="message" name="message" placeholder="Напишите описание лота"><?=$inputvalue; ?></textarea>
    <span class="form__error">Напишите описание лота</span>
  </div>
  <?php $iteminvalid = isset($errors['url']) ? "form__item--invalid" : "";
  $itemuploaded = isset($inputlot['url']) ? "form__item--uploaded" : "" ?>
  <div class="form__item form__item--file <?=$iteminvalid ?> <?=$itemuploaded ?> ">
    <label>Изображение</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <?php $preview__img = isset($inputlot['url']) ? $inputlot['url'] : ""; ?>
        <img src="<?=$preview__img; ?>" width="113" height="113" alt="Изображение лота">
      </div>
    </div> 
    <div class="form__input-file">
      <input class="visually-hidden" type="file" name="url" id="photo2" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
    <span class="form__error">Добавьте изображение</span>
  </div>
  <div class="form__container-three">
    <?php $iteminvalid = isset($errors['lot-rate']) ? "form__item--invalid" : "";
    $inputvalue = isset($inputlot['lot-rate']) ? $inputlot['lot-rate'] : ""; ?>
    <div class="form__item form__item--small <?=$iteminvalid; ?>">
      <label for="lot-rate">Начальная цена</label>
      <input id="lot-rate" name="lot-rate" placeholder="0" value="<?=$inputvalue ?>">
      <span class="form__error">Введите начальную цену</span>
    </div>
    <?php $iteminvalid = isset($errors['lot-step']) ? "form__item--invalid" : "";
    $inputvalue = isset($inputlot['lot-step']) ? $inputlot['lot-step'] : ""; ?>
    <div class="form__item form__item--small <?=$iteminvalid; ?>">
      <label for="lot-step">Шаг ставки</label>
      <input id="lot-step" type="number" name="lot-step" placeholder="0" value="<?=$inputvalue ?>">
      <span class="form__error">Введите шаг ставки</span>
    </div>
    <?php $iteminvalid = isset($errors['lot-date']) ? "form__item--invalid" : "";
    $inputvalue = isset($inputlot['lot-date']) ? $inputlot['lot-date'] : ""; ?>
    <div class="form__item <?=$iteminvalid; ?>">
      <label for="lot-date">Дата окончания торгов</label>
      <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$inputvalue ?>">
      <span class="form__error">Введите дату завершения торгов</span>
    </div>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Добавить лот</button>
</form>