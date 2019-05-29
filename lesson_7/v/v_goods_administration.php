<h2>Управление товарами</h2>

<form id="form_add_good" name="form_add_good" class="add_new_good" method="POST" enctype="multipart/form-data">
  <h4>Добавить новый товар</h4>
  <table class="table_admin">
    <tr>
      <th>Выберите изображение</th>
      <th>Название товара</th>
      <th>Цена в руб.</th>
      <th>Тип</th>
      <th>Описание</th>
      <th>Действие</th>
    </tr>
    <tr>
      <td><input type="file" id="file" name="file" data-filename-placement="inside" title="Выбрать файл" accept="image/jpeg,image/png" required/></td>
      <td><input type="text" id="good_name" name="good_name" value="<?=$name?>" required></td>
      <td><input type="text" id="good_price" name="good_price" value="<?=$price?>" required></td>
      <td><input type="text" id="good_type" name="good_type" value="<?=$type?>" required></td>
      <td><textarea id="good_description" name="good_description" required><?=$description?></textarea></td>
      <td><button class="btn btn-primary button_add" onclick="addNewGood()">Добавить в каталог</button></td>
    </tr>
  </table>
</form>
<table class="table_admin" style="margin: 5px;">
  <tbody class="new_goods">
  </tbody>
</table>
<br>
<h4>Товары из каталога</h4>
<p><i>Для изменения информации о товаре <b>внесите необходимые значения в поле ввода</b>. Для невозвратного удаления товара из каталога нажмите кнопку <b>"Удалить из каталога</b>"</i></p>
<form id="form_change_good" name="form_change_good" class="add_change_good" method="POST" enctype="multipart/form-data">
  <table class="table_admin">
      <tbody class='good'>
    	 <tr>
			 <th>id</th>
			 <th>Изображение</th>
			 <th>Название файла</th>
    		  <th>Название товара</th>
   			  <th>Цена в руб.</th>
   			  <th>Тип</th>
   			  <th>Описание</th>
    		  <th>Действие</th>
		  </tr>
          <? echo $catalogue_content;?>
      </tbody>
  </table>
</form>
<input id="show_more_admin" count_show="4" count_add="4" count_page="1" type="button" class="btn btn-primary button" value="Показать еще" />