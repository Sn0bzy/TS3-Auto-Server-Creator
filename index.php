<?php
	date_default_timezone_set('America/Argentina/Buenos_Aires'); //Change Here!
	require_once("libraries/TeamSpeak3/TeamSpeak3.php");
	include 'data/config.php';
	
	
    $connect = "serverquery://".$USER_QUERY.":".$PASS_QUERY."@".$HOST_QUERY.":".$PORT_QUERY."";
    $ts3 = TeamSpeak3::factory($connect);
	
	if (isset($_POST["create"])) {
		
		$servername = $_POST['servername'];
		$slots = $_POST['slots'];
		$unixTime = time();
		$realTime = date('[Y-m-d]-[H:i]',$unixTime);
		
		if(!empty($_POST['port'])) {
			
			$port = $_POST['port'];
			try
			{
				$new_ts3 = $ts3->serverCreate(array(
				"virtualserver_name" => $servername,
				"virtualserver_maxclients" => $slots,
				"virtualserver_port" => $port,
				"virtualserver_name_phonetic" => $realTime,
				"virtualserver_hostbutton_tooltip" => "Can Network",
				"virtualserver_hostbutton_url" => "http://can.name.tr",
				"virtualserver_hostbutton_gfx_url" => "http://etc.usf.edu/presentations/extras/letters/varsity_letters/51/15/c-400.png",
				));
				
				$token = $new_ts3['token'];
				
			}
			catch(Exception $e)
			{
				echo "Error (ID " . $e->getCode() . ") <b>" . $e->getMessage() . "</b>";
			}
			} else{
			
			try
			{
				$new_ts3 = $ts3->serverCreate(array(
				"virtualserver_name" => $servername,
				"virtualserver_maxclients" => $slots,
				"virtualserver_name_phonetic" => $realTime,
				"virtualserver_hostbutton_tooltip" => "Can Network",
				"virtualserver_hostbutton_url" => "http://can.name.tr",
				"virtualserver_hostbutton_gfx_url" => "http://etc.usf.edu/presentations/extras/letters/varsity_letters/51/15/c-400.png",
				));
				
				$token = $new_ts3['token'];
				$portran = $new_ts3['virtualserver_port'];
				
			}
			catch(Exception $e)
			{
				echo "Error (ID " . $e->getCode() . ") <b>" . $e->getMessage() . "</b>";
			}
			
		}
		
		
	}

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <title>Can Network | TeamSpeak</title>
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
    <body>
        <div class="container">
            <header>
				<h1>Can Network<span> TeamSpeak</span></h1>
				<h1><font  color="red">!! Max. 128 Kisilik Sunucu Olusturunuz !!</font></h1>
			</header>
            <section>				
                <div id="container_demo" >
                    <div id="wrapper">
                        <div id="login" class="animate form">
							<?php 
								if (isset($_POST["create"])) {
								?>
								<form  method="post" autocomplete="off"> 
									
									<h1>Sunucu Oluşturuldu!</h1> 
									
									<p> 
										<label  class="uname" data-icon="u" > Sunucu Adı</label>
										<input readonly type="text" value="<?php echo $servername; ?>"/>
									</p>
									
									<p> 
										<label  class="uname" data-icon="u" > Yetki Kodu</label>
										<input readonly type="text" value="<?php echo $token; ?>"/>
									</p>
									
									<p> 
										<label  class="uname" data-icon="u" > Sunucu Adresiniz</label>
										<input readonly type="text" value="94.177.229.46:<?php if(!empty($_POST['port'])) { echo $port; } else{ echo $portran; }  ?>"/>
									</p>
									
								</form>
								
								<?php } 
								else{
								?>
								<form  method="post" autocomplete="off"> 
									<h1>Ayarlar</h1> 
									<p> 
										<label  class="uname" data-icon="u" > Sunucu Adı</label>
										<input  name="servername" required="required" type="text" placeholder="Sunucu Adı"/>
									</p>
									
									<p> 
										<label class="youpasswd" data-icon="p"> Kişi Sayısı</label>
										<input name="slots" required="required" type="text" placeholder="Max. 256" /> 
									</p>
									
									<p> 
										<label class="youpasswd" data-icon="p"> Port</label>
										<input name="port" type="text" placeholder="İstediğinizi girin veya boş bırakın" /> 
									</p>
									
									<p>
									    <label><input type="checkbox" name="onay"/> Herhangi bir kötüye kullanım oluşturmayacağımı onaylıyorum.</label>
									</p>
									
									<p>
									    <label><input type="checkbox" name="onay"/> 128 dan fazla kişi sayısı ile sunucu oluşturduğumda sunucumun silineceğini biliyorum.</label>
									</p>

									<p class="login button"> 
										<input type="submit" name="create" value="Olustur!" /> 
									</p>

								</form>
							<?php } ?>
						</div>
						
					</div>
				</div>  
			</section>
			<footer>
				<h1>Created By <span><a href="http://hasancan.net.tr"target="_blank">Hasan CAN</a><br /></span></h1>
			</footer>
		</div>
	</body>
</html>																							