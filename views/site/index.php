<?php

/* @var $this yii\web\View */

$this->title = 'Тестовое задание PHP Developer';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>

        <p class="lead">Задание 2</p>
        <p class="lead">PHP</p>


    </div>

    <div class="body-content">
        <p><strong>Задание:</strong></p>
        <p>Необходимо реализовать на  языке php JSON API для работы с курсами обмена валют для BTC. В качестве источника курсов будем использовать: https://blockchain.info/ticker и будем работать только с этим методом.</p>
        <p>Данное API будет доступно только после авторизации. Все методы будут приватными.</p>
        <p><span >Формат запросов: &lt;your_domain&gt;</span><b>/api/v1?method=</b><span>&lt;method_name&gt;&amp;&lt;parameter&gt;=&lt;value&gt;</span></p>
        <p>Для авторизации будет использоваться фиксированный токен (64 символа включающих в себя a-z A-Z 0-9 а так-же символы - и _ ), передавать его будем в заголовках запросов. Тип Authorization: Bearer.</p>
        <code style="display: block; width:100%; padding:30px; text-align: center;">Ваш фиксированный токен: <?= $token ?></code>
        <p>Формат ответа API: JSON (все ответы при любых сценариях JSON)</p>
        <p>Все значения курса обмена должны считаться учитывая нашу комиссию = 2%</p>
        <p></p>
        <p><span style="font-weight: 400;">API должен иметь 2 метода:</span></p>
        <p></p>
        <ol>
            <li style="font-weight: 400;" aria-level="1"><b>rates</b><span style="font-weight: 400;">: Получение всех курсов с учетом комиссии = 2% (GET запрос) в формате:</span></li>
        </ol>
        <pre class="language-javascript"><code>{
	&ldquo;status&rdquo;: &ldquo;success&rdquo;,
	&ldquo;code&rdquo;: 200,
	&ldquo;data&rdquo;: {
	&ldquo;USD&rdquo; : &lt;rate&gt;,
	...
}
}
</code></pre>
        <p><span style="font-weight: 400;"><br />В случае ошибки:</span></p>
        <pre class="language-javascript"><code>{
	&ldquo;status&rdquo;: &ldquo;error&rdquo;,
	&ldquo;code&rdquo;: 403,
	&ldquo;message&rdquo;: &ldquo;Invalid token&rdquo;
}
</code></pre>
        <p><span style="font-weight: 400;">Сортировка от меньшего курса к большему курсу.</span></p>
        <p></p>
        <p><span style="font-weight: 400;">В качестве параметров может передаваться интересующая валюта, в формате USD,RUB,EUR и тп В этом случае, отдаем указанные в качестве параметра currency значения.</span></p>
        <p></p>
        <ol>
            <li style="font-weight: 400;" aria-level="1"><b>convert</b><span style="font-weight: 400;">: Запрос на обмен валюты c учетом комиссии = 2%. POST запрос с параметрами:</span></li>
        </ol>
        <p><span style="font-weight: 400;">currency_from: USD</span></p>
        <p><span style="font-weight: 400;">currency_to: BTC</span></p>
        <p><span style="font-weight: 400;">value: 1.00</span></p>
        <p></p>
        <p><span style="font-weight: 400;">или в обратную сторону</span></p>
        <p></p>
        <p><span style="font-weight: 400;">currency_from: BTC</span></p>
        <p><span style="font-weight: 400;">currency_to: USD</span></p>
        <p><span style="font-weight: 400;">value: 1.00</span></p>
        <p></p>
        <p><span style="font-weight: 400;">В случае успешного запроса, отдаем:</span></p>
        <p></p>
        <pre class="language-javascript"><code>{
	&ldquo;status&rdquo;: &ldquo;success&rdquo;,
	&ldquo;code&rdquo;: 200,
	&ldquo;data&rdquo;: {
	&ldquo;currency_from&rdquo; : BTC,
	&ldquo;currency_to&rdquo; : USD,
	&ldquo;value&rdquo;: 1.00,
	&ldquo;converted_value&rdquo;: 1.00,
	&ldquo;rate&rdquo; : 1.00,
}
}
</code></pre>
        <p></p>
        <p><span style="font-weight: 400;">В случае ошибки:</span></p>
        <pre class="language-javascript"><code>{
	&ldquo;status&rdquo;: &ldquo;error&rdquo;,
	&ldquo;code&rdquo;: 403,
	&ldquo;message&rdquo;: &ldquo;Invalid token&rdquo;
}
</code></pre>
        <p><br /><span style="font-weight: 400;">Важно, минимальный обмен равен 0,01 валюты from</span><span style="font-weight: 400;"><br /></span><span style="font-weight: 400;">Например: USD = 0.01 меняется на 0.0000005556 (считаем до 10 знаков)</span><span style="font-weight: 400;"><br /></span><span style="font-weight: 400;">Если идет обмен из BTC в USD - округляем до 0.01</span></p>
    </div>
</div>
