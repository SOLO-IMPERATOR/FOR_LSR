<?

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Localization\Loc;
use Bitrix\Translate\ComponentBase;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
\Bitrix\Main\Loader::includeModule("highloadblock");
Loc::loadMessages(__FILE__);
class LsrForm extends CBitrixComponent{
    private const EMAIL_PATTERN = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,}$/';
    private const PHONE_PATTERN = '/^\+7\d{3}\d{3}\d{2}\d{2}$/';

    private const HLB_ID = 1;
    public function save($name,$email,$phone){
        $valitdationResult = $this->validate($email,$phone);

        if($valitdationResult === true){
            $this->getDataClass()::add(array(
                "UF_USERNAME" => $name,
                "UF_EMAIL" => $email,
                "UF_PHONE" => $phone
            ));
            return array(
                "response" => true
            );
        }
        return array(
            "response" => false,
            "errors" => $valitdationResult
        );
        
    }


    private function validate($email,$phone){
        $errors = array();
        if (!$this->isValidEmail($email)) {
            $errors['email'][] = Loc::getMessage("NOT_VALID_MAIL");
        }
        if ($this->isAlreadyHaveEmail($email)) {
            $errors['email'][] = Loc::getMessage("ISSET_MAIL");
        }
        if (!$this->isValidPhone($phone)) {
            $errors['phone'][] = Loc::getMessage("NOT_VALID_PHONE");
        }
        if($this->isAlreadyHavePhone($phone)){
            $errors['phone'][] = Loc::getMessage("ISSET_PHONE");
        }

        return empty($errors) ? true : $errors;
    }
    private function isValidEmail($email){
        return (bool)preg_match(self::EMAIL_PATTERN, $email);
    }

    private function isValidPhone($phone){
        return (bool)preg_match(self::PHONE_PATTERN, $phone);
    }
    
    private function isAlreadyHaveEmail($email){
        $resultDb = $this->getDataClass()::getList(array(
            "select" => array("ID"),
            "filter" => array("UF_EMAIL" => $email) 
        ));
        while ($arItem = $resultDb->Fetch()) {
            return true;
        }
        return false;
    }

    private function isAlreadyHavePhone($phone){
        $resultDb = $this->getDataClass()::getList(array(
            "select" => array("ID"),
            "filter" => array("UF_PHONE" => $phone) 
        ));
        while ($arItem = $resultDb->Fetch()) {
            return true;
        }
        return false;
    }
    private function getDataClass(){
        $objectHlb = HighloadBlockTable::getById(self::HLB_ID)->fetch();
        $objectEntityHL = HighloadBlockTable::compileEntity($objectHlb);
        return $objectEntityHL->getDataClass();
    }

   
}
