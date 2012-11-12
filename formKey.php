<?php        

class ADGFormKey{   
	   
	/**
	 * 
	 */
	public function genFormKey(){
	        $ip   = $_SERVER['REMOTE_ADDR'];
	        return hash('sha256', $ip . uniqid(mt_rand(), true));
	} 
	       
    /**
     * 
     */
	public function storeInSession($key,$value){
		if (isset($_SESSION)){
			$_SESSION[$key]=$value;
			return true;
		}
		else{
			return false;
		}
	} 
	
    /**
     * 
     */
	public function unsetSession($key){
		if(isset($_SESSION) && isset($_SESSION[$key])){
			unset($_SESSION[$key]);
			return true;
		}
		else{
			return false;
		}
	}  
	
    /**
     * 
     */
	public function isInSession($key, $value){
		if(isset($_SESSION) && isset($_SESSION[$key])){
			return $_SESSION[$key] == $value;
		}
		else{
			return false;
		}
	}


	/**
	 * 
	 *  Array methods prevent onetime
	 *  generated keys from breaking tabbed browsing and back button.
	 *
	 */
	
	/**
	 * 
	 */
	public function storeInSessionArray($key,$value){
		if (isset($_SESSION)){
			$_SESSION[$key][]=$value;
			return true;
		}
		else{
			return false;
		}
	}

    /**
     * 
     */
	public function isInSessionArray($key, $value){
		if(isset($_SESSION) && isset($_SESSION[$key])){
			return in_array($_SESSION[$key], $value);
		}
		else{
			return false;
		}
	}

	/** 
	 *   	USAGE: 
	 *         
	 *     if(!isset($_SESSION)){
	 *      	session_start();
	 *     }
	 *  
	 *     include('FormKey.php');
	 *     
	 *	   $formKey = new ADGFormKey; 
	 *
	 * 	   if(isset($_POST) && !empty($_POST['post_form_token'])){
	 *          if($formKey->isInSessionArray('session_form_tokens', $_POST['post_form_token'])) {
	 *          		Do something ...  
	 *					exit;
	 *  		}
	 *     } 
	 *      
	 *     
	 *     $token = $formKey->genFormKey();
	 *     $formKey->storeInSessionArray('session_form_tokens', $token); 
	 *  
	 *  	echo "<form method='post'>
	 *  			<input type='hidden'
	 *  			 	   name='post_form_token'
	 *  			 	   value='{$token}'
	 *  			/>
	 *  			... Other Form fields ... 
	 *
	 *  			<input type='submit'
	 *  			 	   value='Do Something!!!' />   
	 *  		  </form>";
	 *
	 **/
	
}
