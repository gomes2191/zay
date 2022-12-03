<?php

/*
 *  Ponto de partida para a Model Register.
 */
namespace App\Models;

use App\Core\Database\Model;

class Register extends Model
{
    protected static $table = 'Registers';

    public function check_user($email)
	{
		$result = parent::count($email);
		$count = count($result);
		return $count;
	}
}



