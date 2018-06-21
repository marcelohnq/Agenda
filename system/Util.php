<?php

class Util
{
	
	public static function formatPhone($phone)
	{
		$length = strlen($phone);

		$digits = 4;

		if ($length == 11) {
			$digits = 5;
		}

		$regex = '/^(\d{2})(\d{'. $digits .'})(\d{4})$/';

		if(  preg_match( $regex, $phone,  $matches ) )
		{		    
		    $result = "({$matches[1]}){$matches[2]}-{$matches[3]}";
		    return $result;
		}

		return false;
	}

	public static function formatCPF($cpf)
	{
		$regex = '/^(\d{3})(\d{3})(\d{3})(\d{2})$/';

		if(  preg_match( $regex, $cpf,  $matches ) )
		{		    
		    $result = "{$matches[1]}.{$matches[2]}.{$matches[3]}-{$matches[4]}";
		    return $result;
		}

		return false;
	}	
}