<?php 


namespace App\Service;


class LogicHelper
{
    function IsPostcode($postcode)
    {
        $postcode = strtoupper(str_replace(' ','',$postcode));
        if(preg_match("/(^[A-Z]{1,2}[0-9R][0-9A-Z]?[\s]?[0-9][ABD-HJLNP-UW-Z]{2}$)/i",$postcode) || preg_match("/(^[A-Z]{1,2}[0-9R][0-9A-Z]$)/i",$postcode))
        {    
            return true;
        }
        else
        {
            return false;
        }
    }

    public function verifyPostCode($string){

        $valid_return_value =  'SUCCESS - Postcode Within M25';
        $invalid_return_value = 'ERROR - Postcode Outside M25';
		$invalid_post_value = 'ERROR - Invalid PostCode';
		$invalid_code = 'ERROR - Invalid Code';
        
        if ($this->IsPostcode($string) == false)
		{
			return $invalid_post_value;
        }
        
        $exceptions = json_decode(file_get_contents('../data/m25Postcodes.md'), true);
        $string = strtoupper(preg_replace('/\s/', '', $string)); 
        $exceptions = array_flip($exceptions);
        if(isset($exceptions[$string])){return $valid_return_value;} 
        $length = strlen($string);
        if($length < 5 || $length > 7){return $invalid_return_value;} 
        $letters = array_flip(range('A', 'Z')); 
        $numbers = array_flip(range(0, 9)); 

        switch($length){
            case 7:
                if(!isset($letters[$string[0]], $letters[$string[1]], $numbers[$string[2]], $numbers[$string[4]], $letters[$string[5]], $letters[$string[6]])){break;}
                $my_value = substr($string, 0, 4);
                if(isset($exceptions[$my_value])){return $valid_return_value;} 
                else{return $invalid_return_value;}                
            break;
            case 6:
                if(!isset($letters[$string[0]], $numbers[$string[3]], $letters[$string[4]], $letters[$string[5]])){break;}
                $my_value = substr($string, 0, 3);
                if(isset($exceptions[$my_value])){return $valid_return_value;} 
                else {return $invalid_return_value;}              
            break;
            case 5:
                $my_value = substr($string, 0, 2);
                if(isset($exceptions[$my_value])){return $valid_return_value;} 
                else {return $invalid_return_value;} 
            break;
        }

        return $invalid_code;
    }
    
}







