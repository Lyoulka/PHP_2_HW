<tr id="good_<?=$id?>">
	<td><?=$id?></td>
	<td><img id="img_<?=$id?>" src="v/img/thumbs/<?=$image?>" alt="Изображение_товара_<?=$name?>"></td>
	<td><input type="file" id="file_<?=$id?>" name="file_<?=$id?>"  data-filename-placement="inside" title="Выбрать другой файл" accept="image/jpeg,image/png" onchange="changeImg(<?=$id?>, 'img')"/></td>
    <td><input type="text" id="name_<?=$id?>" value="<?=$name?>" onchange="changeGood(<?=$id?>, 'name')"></td>
   	<td><input type="text" id="price_<?=$id?>" value="<?=$price?>" onchange="changeGood(<?=$id?>, 'price')"></td>
   	<td><input type="text" id="type_<?=$id?>" value="<?=$type?>" onchange="changeGood(<?=$id?>, 'type')"></td>
   	<td><textarea id="description_<?=$id?>" onchange="changeGood(<?=$id?>, 'description')"><?=$description?></textarea></td>
    <td><button class="btn btn-primary button_delete" id="delete<?=$id?>" onclick="deleteOldGood(<?=$id?>)">Удалить из каталога</button></td>
</tr>


