<?php
	
	## Cloudflare api ##
	
	$mail 	 = "mail@mail.com";
	$key  	 = "Bearer sAKwthu0XmXmJi3l4ZXxckFzg1VTWMLIP3HSGjfj";
	$zoneid  = "8JdQ2DKX6MBBeBowg4AD2S5le8pT2QpW";
	
	## Clear Cache ##
	if(isset($_POST["url_purge"])){
		$number = count($_POST["arr"]);  
		
		if($number > 0)  
		{  
			$arr=array();
			for($i=0; $i<$number; $i++)  
			{  
				if(trim($_POST["arr"][$i]) != '')  
				{  
					array_push($arr,trim($_POST["arr"][$i]));
				}  
			} 
			try {
				$head = [];
				$head[] = 'Content-Type: application/json';
				$head[] = 'X-Auth-Email: '.$mail;
				$head[] = 'Authorization: '.$key;
				$head[] = 'cache-control: no-cache';

				$url = 'https://api.cloudflare.com/client/v4/zones/'.$zoneid.'/purge_cache';
				$purge = ['files' => $arr ];
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
				curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
				curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($purge));
				$result = curl_exec($ch);
				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				
			}
			catch(Exception $e) {
				echo $e->getMessage();				
			}
			 
		}  
		
	}
?>