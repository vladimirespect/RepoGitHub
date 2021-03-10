<h2>Корзина</h2>

<?php foreach($basket as $item):?>
    <div>
        <h3><?=$item['name']?></a></h3>          <!-- в item будет приходить из бд ассоциативн.массив где имена полей будут совпадать с именами столбцов в бд. -->
        <img src="/image/small/<?= $item['image'] ?>" width="150"/></a><br>
        <p>Стоимость: <?=$item['price']?>  руб.</p>
        <hr>
    </div>
<?php endforeach; ?>
<p>Итого: </p>
