<h2>Корзина</h2>

<?php if(!empty($basket)) : foreach($basket as $item):?>
    <div data-id="$item['price']" id="<?=$item['basket_id']?>" >
        <h3><?=$item['name']?></a></h3>          <!-- в item будет приходить из бд ассоциативн.массив где имена полей будут совпадать с именами столбцов в бд. -->
        <img src="/image/small/<?= $item['image'] ?>" width="150" alt="image"/><br>
        <p>Стоимость: <?=$item['price']?>  руб.</p>
        <?php $totalBasket += $item['price']; ?>
       <button data-id="<?=$item['basket_id']?>" class="delete">Удалить</button>
        <hr>
    </div>



<?php endforeach; ?>
        <?php else : ?>
            <h3>Корзина пуста.</h3>
        <? endif; ?>
    <b>Итого к оплате: <span  id="total"><?=$totalBasket . " руб.";?></span></b>

        <h3><i><b>Пожалуйста введите данные, чтобы оформить заказ:<br></b></i></h3>
        <form action="/basket/order" method="post">
            <input type="text" name="nameInBasket" placeholder="Имя">
            <input type="text" name="phone" placeholder="Телефон">
            <input type="text" name="email" placeholder="Электронная почта">
            <input type="submit" value="Оформить заказ">
            <input type="text" name="totalBasket" hidden value="<?=$totalBasket?>">   <!-- в скрытом поле передаём общую сумму заказа -->
        </form><br>
        <br>
<h2><i><b><?=$ordermessage;?></b></i></h2>


<!-- document.getElementById('totalBasket').onkeyup = function() {
                        document.getElementById("test").innerHTML = </?=$totalBasket;?>
                    }
                     document.getElementById("test").innerHTML = </?=$totalBasket;?>;-->
<script>
    let buttons = document.querySelectorAll('.delete'); //выбрать все элементы на странице с классом delete
    //console.log(buttons); отладка инструмент разработчика хром--консоль
    buttons.forEach((elem)=>{ //параметр анонимной стрелочной функции- elem, т.е. перебираемый элемент
        elem.addEventListener('click', ()=>{
            let id =elem.getAttribute('data-id');//имя с кнопки
            (
                async elementId => {
                    const response = await fetch('/basket/delete', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json;charset=utf-8'}, //inform for browser
                        body: JSON.stringify({
                            id:id //id: - имя поля объекта которое мы преобразуем в JSON
                            //id - переменная с кнопки  let id =elem.getAttribute('data-id')
                        })
                    });//тут мы постучались в бекэнд и получили текущ.сессию
                    //за счёт синтаксич.сахара async await строка ниже выполнится только после ответа со стороны бэкэнда
                    const answer = await response.json();//приняли ответ в виде json строки/ response.text() а так бы приняли в виде текста
                    //console.log(answer);
                    document.getElementById('count').innerText = answer.count;//.count потому что мы в BasketControllerе формировали переменую response
                    // со значением 'count' => Basket::getCountWhere('session_id',session_id())
                    /*</?app\engine\App::call()->session->set('total',$totalBasket);?>
                    document.getElementById('total').innerText = answer.total;*/
                    document.getElementById(id).remove();

                }
            )();
        })
    })
</script>