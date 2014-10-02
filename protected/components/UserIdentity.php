<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=User::model()->find("LOWER(usuario)=?",array(strtolower($this->username)));
		if($user == null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif(sha1($this->password) != $user->contrasena)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->_id=$user->id;
			$this->setState("rol",$user->rol);
			$this->setState("nombre",$user->nombre);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	public function getId(){
		return $this->_id;
	}
}