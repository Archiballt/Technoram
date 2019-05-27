<?php

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {   $I->amOnPage('/');



    }

        // tests

        public function regLogin(AcceptanceTester $I)
        {   $I->click('[data-target="#authModal"]');
            $I->click('[href="#registration_form"]');
            $I->fillField('#REGISTER_NAME', 'Test');
            $I->fillField('#REGISTER_PERSONAL_PHONE', '7777777777');
            $glas = ["a","e","i","y","o","u"];
            $soglas = ["b","c","d","f","g","h","j","k","l","m","n","p","q","r","s","t","v","x","w","z"];
            $wordlen = 5;
            $newWord='';
            for ($i=0; $i <$wordlen/2 ; $i++) {
                $ng = rand(0, count($glas) - 1);
                $nsg = rand(0, count($soglas) - 1);
                $newWord .= $glas[$ng].$soglas[$nsg];
            }
            $I->fillField('#REGISTER_EMAIL', $newWord.'@origix.ru');
            $I->fillField('#REGISTER_PASSWORD', '499581');
            $I->fillField('#REGISTER_CONFIRM_PASSWORD', '499581');
            $I->click('#REGISTER_register_submit_button');
            $I->waitForText("Пожалуйста, подтвердите номер вашего телефона.",30);
            $I->see('Пожалуйста, подтвердите номер вашего телефона.');
        }

    /**
     * @before regLogin
     */
    public function tryToBuy(AcceptanceTester $I)
    {
        $I->amOnPage('catalog/muzhskie-membrannye-kurtki/kurtka-muzhskaya-the-north-face-venture-2-taupe-green/');
        $I->waitForText('В корзину',30);
        $I->click('В корзину');
        $I->waitForText('Товар добавлен в корзину',30);
        $I->click('Перейти в корзину');
        $I->waitForText('Оформить заказ',30);
        $I->click('[class="basket__button button"]');
        $I->click('Продолжить оформление');
        $I->waitForText('Ваш город',30);
        $I->fillField('.bx-ui-sls-fake', 'Тула');

        try{$I->waitForElementVisible('.bx-ui-sls-pane', 2);
        }
        catch(\Exception $e)
        { $I->fillField('.bx-ui-sls-fake', 'тула');

        }
        $I->wait(1);
        $I->click('.dropdown-item-text');
        $I->waitForElementClickable('[data-filler-listitemproperty="item.NAME"]', 30);
        $I->click('[data-filler-listitemproperty="item.NAME"]');
        $I->waitForElementVisible('#ORDER_PROP_25', 30);
        $I->fillField('#ORDER_PROP_25', 'Городской переулок');
        $I->waitForElementVisible('.suggestions-suggestions', 30);
        $I->click('.suggestions-suggestions');
        //$I->waitForElementClickable('[data-filler-listitemproperty="item.NAME"]', 30);
        //$I->click('[data-filler-binddatacondition="validated !== true"]');
        //$I->pressKey('#ORDER_PROP_25', WebDriverKeys::ENTER);
        $I->wait(1);
        //$I->click('[data-filler-binddatacondition="validated !== true"]');
        $I->click('#order_step_2 .order__button.button');
        $I->waitForText('Оформить заказ',30);
        $I->click('Оформить заказ');
        $I->waitForText('оформлен',30);
        $I->see('оформлен');
    }

        public  function tryToLogin(AcceptanceTester $I)
        {   $I->click('[data-target="#authModal"]');
            $I->fillField('#system_auth_form_USER_LOGIN', 'dawadw@origix.ru');
            $I->fillField('#system_auth_form_USER_PASSWORD', '123456');
            //$I->fillField('#system_auth_form_USER_LOGIN', 'm.aldergot@origix.ru');
            //$I->fillField('#system_auth_form_USER_PASSWORD', '499581');
            $I->click('#system_auth_form_Login');
            $I->see('АМ');

        }

//        public function tryToBuy(AcceptanceTester $I)
//    {
//        tryToLogin($I);
//        $I->amOnPage('catalog/muzhskie-membrannye-kurtki/kurtka-muzhskaya-the-north-face-venture-2-taupe-green/');
//        $I->waitForText('В корзину',30);
//        $I->click('В корзину');
//        $I->waitForText('Товар добавлен в корзину',30);
//        $I->click('Перейти в корзину');
//        $I->click('[class="basket__button button"]');
//        $I->click('Продолжить оформление');
//        $I->waitForText('Ваш город',30);
//        $I->fillField('.bx-ui-sls-fake', 'Тула');
//        $I->waitForElementVisible('.bx-ui-sls-pane', 30);
//        $I->click('.dropdown-item-text');
//        $I->waitForElementClickable('[data-filler-listitemproperty="item.NAME"]', 30);
//        $I->click('[data-filler-listitemproperty="item.NAME"]');
//        $I->waitForElementVisible('#ORDER_PROP_25', 30);
//        $I->fillField('#ORDER_PROP_25', 'Городской переулок');
//        $I->waitForElementVisible('.suggestions-suggestions', 30);
//        $I->click('.suggestions-suggestions');
//        //$I->waitForElementClickable('[data-filler-listitemproperty="item.NAME"]', 30);
//        //$I->click('[data-filler-binddatacondition="validated !== true"]');
//        //$I->pressKey('#ORDER_PROP_25', WebDriverKeys::ENTER);
//        $I->wait(1);
//        //$I->click('[data-filler-binddatacondition="validated !== true"]');
//        $I->click('#order_step_2 .order__button.button');
//        $I->waitForText('Оформить заказ',30);
//        $I->click('Оформить заказ');
//        $I->waitForText('оформлен',30);
//        $I->see('оформлен');
//    }
}
