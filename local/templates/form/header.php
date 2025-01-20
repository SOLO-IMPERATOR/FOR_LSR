<?

use Bitrix\Main\Localization\Loc;
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
Loc::getMessage(__FILE__);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?$APPLICATION->ShowTitle()?></title>
    <?php
	$APPLICATION->ShowHead();
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/assets/css/normalize.css", true);
    CJSCore::Init(array("jquery"));
    ?>
</head>
<body>
<?$APPLICATION->ShowPanel();
?>
 
    
