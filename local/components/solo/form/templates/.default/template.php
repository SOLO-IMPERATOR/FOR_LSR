<?

use Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

Loc::loadMessages(__FILE__);
?>
<form class="form" method="POST">
    <?=bitrix_sessid_post()?>
    <div class="form-input">
        <label for="username"><?=Loc::GetMessage("FORM_INPUT_NAME")?>:</label>
        <input type="text" name="username" id="username" placeholder="<?=Loc::GetMessage("FORM_INPUT_NAME")?>">
    </div>
    <div class="form-input">
        <label for="email"><?=Loc::GetMessage("FORM_INPUT_EMAIL")?>:</label>
        <input type="email" name="email" id="email" placeholder="test@test.ru">
        <?foreach($arResult['RESULT']['errors']['email'] as $errorText):?>
            <span class="error"><?=$errorText?></span>
        <?endforeach?>
    </div>
    <div class="form-input">
        <label for="phone"><?=Loc::GetMessage("FORM_INPUT_PHONE")?>:</label>
        <input type="text" name="phone" id="phone" placeholder="+79998888888">
        <?foreach($arResult['RESULT']['errors']['phone'] as $errorText):?>
            <span class="error"><?=$errorText?></span>
        <?endforeach?>
    </div>
    <button type="submit"><?=Loc::GetMessage("FORM_BUTTON_NAME")?></button>
    <?
    if($arResult['RESULT']['response'] == true):
    ?>
        <span class="success"><?=Loc::GetMessage("FORM_SUCCES_MESAGE");?></span>
    <?endif;?>
</form>