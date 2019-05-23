<tr id="good_card_<?= $id?>">
    <td><img src="v/img/thumbs/<?=$image?>"></td>
    <td><a href="index.php?c=page&act=catalogue"><?=$name?></a></td>
    <td><span id="price<?= $id?>"><?=$price?></span> руб.</td>
    <td> 
        <div class="input_numbers">
          <button type="button" class="btn btn-primary" onclick="add_item(<?= $id?>)">+</button>
          <input class="form-control" type="text" name="numbers" id="count<?= $id?>" onchange="change(<?=$id?>)" onclick="memorizing(<?=$id?>)" old_value="" value="<?=$numbers?>" style="width: 50px;">
          <button  type="button" class="btn btn-primary" onclick="deleteItem(<?=$id?>)">-</button> 
        </div> 
    </td>
</tr>