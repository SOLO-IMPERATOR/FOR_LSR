<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_bitrix_sessid()) {
   $this->arResult['RESULT'] =  $this->save($_POST['username'],$_POST['email'], $_POST['phone']);
}
$this->includeComponentTemplate();