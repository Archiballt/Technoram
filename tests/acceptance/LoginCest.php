<?php

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {   $I->amOnPage('/');



    }



    public function registration_false_email(AcceptanceTester $I)
        {   $I->click('[data-target="#cabinet"]');
            $I->click('[href="/auth/?register=yes&backurl=%2Findex.php&reset=true"]');
            $I->waitForText("Регистрация",30);
            $I->fillField('[name="USER_LOGIN"]', '!@#$%^&');
            $I->fillField('[name="USER_PASSWORD"]', '!@#$%^&');
            $I->fillField('[name="USER_CONFIRM_PASSWORD"]', '!@#$%^&');
            $I->fillField('[name="USER_EMAIL"]', '123');
            $I->fillField('[name="captcha_word"]', 'AAAAA');
            $I->click('[class="confidential__icon"]');
            $I->click('[class="btn btn-red large"]');
            $I->see('Неверный E-mail.');
        }

    public function registration_false_password(AcceptanceTester $I)
{   $I->click('[data-target="#cabinet"]');
    $I->click('[href="/auth/?register=yes&backurl=%2Findex.php&reset=true"]');
    $I->waitForText("Регистрация",30);
    $glas = ["a","e","i","y","o","u"];
    $soglas = ["b","c","d","f","g","h","j","k","l","m","n","p","q","r","s","t","v","x","w","z"];
    $wordlen = 5;
    $newWord='';
    for ($i=0; $i <$wordlen/2 ; $i++) {
        $ng = rand(0, count($glas) - 1);
        $nsg = rand(0, count($soglas) - 1);
        $newWord .= $glas[$ng].$soglas[$nsg];
    }
    $I->fillField('[name="USER_LOGIN"]', '!@#$%^&');
    $I->fillField('[name="USER_EMAIL"]', $newWord.'@origix.ru');
    $I->fillField('[name="USER_PASSWORD"]', '123');
    $I->fillField('[name="USER_CONFIRM_PASSWORD"]', '123');
    $I->fillField('[name="captcha_word"]', 'AAAAA');
    $I->click('[class="confidential__icon"]');
    $I->click('[class="btn btn-red large"]');
    $I->see('Пароль должен быть не менее 6 символов длиной.');

}

    public function registration_false_login(AcceptanceTester $I)
    {   $I->click('[data-target="#cabinet"]');
        $I->click('[href="/auth/?register=yes&backurl=%2Findex.php&reset=true"]');
        $I->waitForText("Регистрация",30);
        $glas = ["a","e","i","y","o","u"];
        $soglas = ["b","c","d","f","g","h","j","k","l","m","n","p","q","r","s","t","v","x","w","z"];
        $wordlen = 5;
        $newWord='';
        for ($i=0; $i <$wordlen/2 ; $i++) {
            $ng = rand(0, count($glas) - 1);
            $nsg = rand(0, count($soglas) - 1);
            $newWord .= $glas[$ng].$soglas[$nsg];
        }
        $I->fillField('[name="USER_LOGIN"]', '12');
        $I->fillField('[name="USER_EMAIL"]', $newWord.'@origix.ru');
        $I->fillField('[name="USER_PASSWORD"]', 'qwertyu');
        $I->fillField('[name="USER_CONFIRM_PASSWORD"]', 'qwertyu');
        $I->fillField('[name="captcha_word"]', 'AAAAA');
        $I->click('[class="confidential__icon"]');
        $I->click('[class="btn btn-red large"]');
        $I->see('Логин должен быть не менее 3 символов.');

    }

    public function registration_OK(AcceptanceTester $I)
    {   $I->click('[data-target="#cabinet"]');
        $I->click('[href="/auth/?register=yes&backurl=%2Findex.php&reset=true"]');
        $I->waitForText("Регистрация",30);
        $glas = ["a","e","i","y","o","u"];
        $soglas = ["b","c","d","f","g","h","j","k","l","m","n","p","q","r","s","t","v","x","w","z"];
        $wordlen = 5;
        $newWord='';
        for ($i=0; $i <$wordlen/2 ; $i++) {
            $ng = rand(0, count($glas) - 1);
            $nsg = rand(0, count($soglas) - 1);
            $newWord .= $glas[$ng].$soglas[$nsg];
        }
        $I->fillField('[name="USER_LOGIN"]', $newWord);
        $I->fillField('[name="USER_EMAIL"]', $newWord.'@origix.ru');
        $I->fillField('[name="USER_PASSWORD"]', 'qwertyu');
        $I->fillField('[name="USER_CONFIRM_PASSWORD"]', 'qwertyu');
        $I->fillField('[name="captcha_word"]', 'AAAAA');
        $I->click('[class="confidential__icon"]');
        $I->click('[class="btn btn-red large"]');
        $I->click('[data-target="#cabinet"]');
        $I->waitForText("Личный кабинет",30);
        $I->see('Личный кабинет');
    }

    public function addProductToBasket(AcceptanceTester $I)
    {
        $I->amOnPage('products/sekator-finland-privivochnyy-tsi/');
        $I->waitForText('Обзор',30);
        $I->click('span.btn.btn-red.large');
        $I->wait(3);
        $I->click('span.btn.btn-red.large');
        $I->waitForText('Купить в кредит',30);
        $I->see('Купить в кредит');


    }

    /**
     * @before addProductToBasket
     */
    public function UpdateProductToBaket(AcceptanceTester $I)
    {
        $I->click('span.plus');
        $I->see('2');
        $I->click('span.minus');
        $I->see('1');


    }


    /**
     * @before addProductToBasket
     */
    public function DeleteProductFromBaket(AcceptanceTester $I)
    {
        $I->click('span.remove');
        $I->see('Корзина пуста');
    }




    public  function tryToLoginFalse_1(AcceptanceTester $I)
        {   $I->click('[data-target="#cabinet"]');
            $I->fillField('#USER_LOGIN', ' ');
            $I->fillField('#USER_PASSWORD', ' ');
            $I->click('[class="btn long"]');
            $I->see('Неверный логин или пароль.');

        }

    public  function tryToLoginFalse_2(AcceptanceTester $I)
    {   $I->click('[data-target="#cabinet"]');
        $I->fillField('#USER_LOGIN', '2*4*6*8*11*14*17*20*23*26*29*32*35*38*41*');
        $I->fillField('#USER_PASSWORD', '123');
        $I->click('[class="btn long"]');
        $I->see('Неверный логин или пароль.');

    }

    public  function tryToLogintTrue(AcceptanceTester $I)
    {   $I->click('[data-target="#cabinet"]');
        $I->fillField('#USER_LOGIN', 'm.aldergot@origix.ru');
        $I->fillField('#USER_PASSWORD', '499581');
        $I->click('[class="btn long"]');
        $I->click('[data-target="#cabinet"]');
        $I->waitForText("Личный кабинет",30);
    }

    /**
     * @before addProductToBasket
     */

    public  function GoToCheckoutTrying(AcceptanceTester $I)
    {   $I->click('//*[@id="basket-container"]/div[3]/div[2]/a[1]');
        $I->wait(3);
        $I->fillField('/html/body/section/div/div/div/div[2]/form/div/div[1]/div[4]/div[2]/div[2]/div/div[2]/div[2]/div[1]/div[1]/input[2]','Тула');
        $I->wait(3);
        $I->click('/html/body/section/div/div/div/div[2]/form/div/div[1]/div[4]/div[2]/div[2]/div/div[2]/div[2]/div[1]/div[5]/div/div[1]/span/span');
        $I->wait(3);
        $I->click('/html/body/section/div/div/div/div[2]/form/div/div[1]/div[4]/div[2]/div[3]/div/a');
        $I->wait(3);
        $I->click('//*[@id="bx-soa-delivery"]/div[2]/div[5]/div/a[2]');
        $I->wait(3);
        $I->click('//*[@id="bx-soa-paysystem"]/div[2]/div[4]/div/a[2]');
        $I->wait(3);
        $I->see('Заберет другой человек?');
    }

    /**
     * @before GoToCheckoutTrying
     */
    public  function GoToCheckoutNameFailed(AcceptanceTester $I)
    {   $I->click('//*[@id="bx-soa-properties"]/div[2]/div[3]/div/a[2]');
        $I->wait(3);
        $I->see('Поле "Ф.И.О." обязательно для заполнения');

    }

    /**
     * @before GoToCheckoutTrying
     */
    public  function GoToCheckoutEmailFailed(AcceptanceTester $I)
    {   $I->fillField('//*[@id="soa-property-1"]','Тестовый заказ');
        $I->click('//*[@id="bx-soa-properties"]/div[2]/div[3]/div/a[2]');
        $I->wait(3);
        $I->see('Поле "E-Mail" обязательно для заполнения');
    }

    /**
     * @before GoToCheckoutTrying
     */
    public  function GoToCheckoutPhoneFailed(AcceptanceTester $I)
    {   $I->fillField('//*[@id="soa-property-1"]','Тестовый заказ');
        $I->fillField('//*[@id="soa-property-2"]','Test@origix.ru');
        $I->click('//*[@id="bx-soa-properties"]/div[2]/div[3]/div/a[2]');
        $I->wait(3);
        $I->see('Поле "Телефон" обязательно для заполнения');
    }

    /**
     * @before GoToCheckoutTrying
     */
    public  function GoToCheckoutAdressFailed(AcceptanceTester $I)
    {   $I->fillField('//*[@id="soa-property-1"]','Тестовый заказ');
        $I->fillField('//*[@id="soa-property-2"]','Test@origix.ru');
        $I->fillField('//*[@id="soa-property-3"]','8800553535');
        $I->click('//*[@id="bx-soa-properties"]/div[2]/div[3]/div/a[2]');
        $I->wait(3);
        $I->see('Поле "Адрес доставки" обязательно для заполнения');
    }

    /**
     * @before GoToCheckoutTrying
     */
    public  function GoToCheckoutSerriesPassportFailed(AcceptanceTester $I)
    {   $I->fillField('//*[@id="soa-property-1"]','Тестовый заказ');
        $I->fillField('//*[@id="soa-property-2"]','Test@origix.ru');
        $I->fillField('//*[@id="soa-property-3"]','8800553535');
        $I->fillField('//*[@id="soa-property-7"]','Происходит автоматическое тестирование');
        $I->click('//*[@id="bx-soa-properties"]/div[2]/div[3]/div/a[2]');
        $I->wait(3);
        $I->see('Поле "Серия паспорта" обязательно для заполнения');
    }

    /**
     * @before GoToCheckoutTrying
     */
    public  function GoToCheckoutNumberPassportFailed(AcceptanceTester $I)
    {   $I->fillField('//*[@id="soa-property-1"]','Тестовый заказ');
        $I->fillField('//*[@id="soa-property-2"]','Test@origix.ru');
        $I->fillField('//*[@id="soa-property-3"]','8800553535');
        $I->fillField('//*[@id="soa-property-7"]','Происходит автоматическое тестирование');
        $I->fillField('//*[@id="soa-property-21_1"]','1111');
        $I->click('//*[@id="bx-soa-properties"]/div[2]/div[3]/div/a[2]');
        $I->wait(3);
        $I->see('Поле "Номер паспорта" обязательно для заполнения');
    }

    /**
     * @before GoToCheckoutTrying
     */
    public  function GoToCheckoutOK(AcceptanceTester $I)
    {   $I->fillField('//*[@id="soa-property-1"]','Тестовый заказ');
        $I->fillField('//*[@id="soa-property-2"]','Test@origix.ru');
        $I->fillField('//*[@id="soa-property-3"]','8800553535');
        $I->fillField('//*[@id="soa-property-7"]','Происходит автоматическое тестирование');
        $I->fillField('//*[@id="soa-property-21_1"]','1111');
        $I->fillField('//*[@id="soa-property-21_2"]','111111');
        $I->click('//*[@id="bx-soa-properties"]/div[2]/div[3]/div/a[2]');
        $I->wait(3);
        $I->click('//*[@id="bx-soa-orderSave"]/a');
        $I->wait(3);
        $I->see('Вы будете перенаправленны на страницу оплаты');
    }

    /**
     * @before GoToCheckoutOK
     */
    public  function TryToPay(AcceptanceTester $I)
    {   $I->click('//*[@id="checkout"]/div/div/div/div[2]/table[2]/tbody/tr[2]/td/div/form/div/span[1]/button');
        $I->wait(3);
        $I->see('По указанному адресу мы вышлем информацию о совершенном платеже.');
    }


    public  function BuyOneClick(AcceptanceTester $I)
    {   $I->amOnPage('products/sekator-finland-privivochnyy-tsi/');
        $I->waitForText('Обзор',30);
        $I->click('//*[@id="product-detail"]/div/div/div[1]/div[2]/div[3]/div[4]/span[2]');
        $I->wait(3);
        $I->see('Покупка в один клик');
    }

    /**
     * @before BuyOneClick
     */
    public  function BuyOneClickCityFailed(AcceptanceTester $I)
    {   $I->click('//*[@id="one_click_buy_form"]/div[6]/button[2]');
        $I->wait(3);
        $I->see('Укажите Ваш город');
    }

    /**
     * @before BuyOneClick
     */
    public  function BuyOneClickNameFailed(AcceptanceTester $I)
    {   $I->fillField('//*[@id="one_click_buy_form"]/div[1]/input[2]','Тула');
        $I->click('//*[@id="one_click_buy_form"]/div[1]/ul/li/ul/li');
        $I->wait(3);
        $I->click('//*[@id="one_click_buy_form"]/div[6]/button[2]');
        $I->see('Не указано имя.');
    }

    /**
     * @before BuyOneClick
     */
    public  function BuyOneClickPhoneFailed(AcceptanceTester $I)
    {   $I->fillField('//*[@id="one_click_buy_form"]/div[1]/input[2]','Тула');
        $I->click('//*[@id="one_click_buy_form"]/div[1]/ul/li/ul/li');
        $I->wait(3);
        $I->fillField('//*[@id="one_click_buy_id_FIO"]','TEST BuyOneClick');
        $I->click('//*[@id="one_click_buy_form"]/div[6]/button[2]');
        $I->see('Не указан или неправильно указан телефон.');
    }

    /**
     * @before BuyOneClick
     */
    public  function BuyOneClickOk(AcceptanceTester $I)
    {   $I->fillField('//*[@id="one_click_buy_form"]/div[1]/input[2]','Тула');
        $I->click('//*[@id="one_click_buy_form"]/div[1]/ul/li/ul/li');
        $I->wait(3);
        $I->fillField('//*[@id="one_click_buy_id_FIO"]','TEST BuyOneClick');
        $I->fillField('//*[@id="one_click_buy_id_PHONE"]','1234567890');
        $I->click('//*[@id="one_click_buy_form"]/div[6]/button[2]');
        $I->see('Выполняется создание заказа. Пожалуйста, подождите.');
    }




}
