<h2>Корзина</h2>

<?php if(!empty($basket)) : foreach($basket as $item):?>
    <div>
        <h3><?=$item['name']?></a></h3>          <!-- в item будет приходить из бд ассоциативн.массив где имена полей будут совпадать с именами столбцов в бд. -->
        <img src="/image/small/<?= $item['image'] ?>" width="150"/></a><br>
        <p>Стоимость: <?=$item['price']?>  руб.</p>
        <form action="/basket/delete" method="post"><!-- ВАЖНО! Здесь мы передаём какой экшн надо задействовать -->
           <input type="text" name="basket_id" hidden value="<?=$item['basket_id']?>">   <!-- в скрытом поле передаём методом пост с именем  id
           данные айди позиции товара в корзине -->
       <button type="submit">Удалить</button>
       </form>
        <hr>
    </div>
<?php endforeach; ?>
<?php else : ?>
    <h3>Корзина пуста.</h3>
<? endif; ?>
<p>Итого: </p>
