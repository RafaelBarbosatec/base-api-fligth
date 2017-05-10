<?php


  class Fcm{
	  
	  protected $apiUrl = 'https://fcm.googleapis.com/fcm/send';
	  
	  private $Result;
	  private $apiKey;
	  
	  
	  public function __construct($apiKey, $apiUrl = null)
    {
        $this->apiKey = $apiKey;
        if ($apiUrl) {
            $this->apiUrl = $apiUrl;
        }
       
    }
	  
	  public function send($data, array $registrationIds = array()){
		  
		  $headers = array('Authorization: key='.$this->apiKey, 'Content-Type: application/json');
		  
          $i = 0;
          $limit = 1000;
		  foreach ($registrationIds as $token) {
		  
		      if($i < ($limit-1) && $i < (count($registrationIds)-1)){

		      	$sendTokens[] = $token;

		      }else{

                 $sendTokens[] = $token;

                 $options = array('registration_ids'=>$sendTokens,
								//'notification_key'=>'',
								//'collapse_key'=>'suporteapp',
								'delay_while_idle'=>false,
								//'time_to_live'=>(60*1000),
								//'restricted_package_name'=>'com.navegarte.bocaonews',
								'dry_run'=>false,
								'data'=>$data);

			// OPEN CONNECTION
				$ch = curl_init();
				// SET CURL
				curl_setopt( $ch, CURLOPT_URL, $this->apiUrl);
				curl_setopt( $ch, CURLOPT_POST, true );
				curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $options ) );

                // SEND POST
				$this->Result[] = curl_exec($ch);

                unset($sendTokens);
                
				$limit = $limit + 1000;

		      }

		      $i++;
		       

		  }
		  
			


			
	  }
	  
	  public function getResult(){
			return $this->Result;
		}
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
  }

//USO
  /*
		$fcm = new Fcm($apiKey);
		$fcm->send($data,$token_user_to);
		$fcm->getResult());
  */

  //Exemplo Tratar IDS
  /*
	$resultJson = json_decode($fsm->getResult(), true);
							
	if((int)$resultJson['failure'] > 0 || (int)$resultJson['canonical_ids'] > 0){
		if(isset($resultJson['results']) ){
			foreach($resultJson['results'] as $chave => $valor){
				
				if(isset($valor['registration_id'])){
					// Pode implementar algo com os tokens enviados com sucesso
				}elseif(isset($valor['error']) && $valor['error'] == 'NotRegistered'){
					//Aqui deleta ou seta como offline os tokens
					mysql_query("DELETE FROM pushs WHERE TOKEN_PUSH = '" . $data['registration_ids'][$chave] . "'");
				}
			}
		}
	}


  */


?>
