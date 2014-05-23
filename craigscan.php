<?php
	require "simple_html_dom.php";
	require("phpmailer/class.phpmailer.php");
	
	$db_connection = mysql_connect("localhost", "asdf", "asdf");
	mysql_select_db("craig", $db_connection);
	$query = "SELECT * FROM users";
	$rs = mysql_query($query, $db_connection);
	
	while($row = mysql_fetch_row($rs))
	{
		$id = $row[0];
		$phone = $row[1];
		$location = $row[2];
		$search = $row[3];
		$category = $row[4];
		$nearby = $row[5];
		$price = $row[6];
		$sent = $row[7];
		$carrier = $row[8];
		
		//if the alert has already been sent, don't do anything and go to next loop iteration
		if ($sent == true)
		{
			continue;
		}
		//get the email we want to send the message to, depends on carrier where we want to send the text
		if ($carrier == "att")
		{
			$recipient = $phone . "@txt.att.net";
		}
		elseif ($carrier == "boost")
		{
			$recipient = $phone . "@myboostmobile.com";
		}
		elseif ($carrier == "nextel")
		{
			$recipient = $phone . "@messaging.nextel.com";
		}
		elseif ($carrier == "sprint")
		{
			$recipient = $phone . "@messaging.sprintpcs.com";
		}
		elseif ($carrier == "tmobile")
		{
			$recipient = $phone . "@tmomail.net";
		}
		elseif ($carrier == "verizon")
		{
			$recipient = $phone . "@vtext.com";
		}
		else
		{
			$recipient = $phone . "@vmobl.com";
		}
		$search = urlencode($search);
		$craigurl = "http://" . $location . ".craigslist.org/search/?sort=date&catAbb=" . $category . "&query=" . $search;
		$html = file_get_html($craigurl);

		$html = $html->find('div.content');
		$ret = $html[0]->find('div.noresults');
		
		//check if results are found
		if ($ret[0] != NULL) // if noresults class is found, then there are no results
			return;
		else
		{
			$subject = $html[0]->find('a');
			$title = $subject[1]->plaintext;
			$listingurl = $subject[1]->href;
			$listingprice = $subject[0]->plaintext;
			$listingurl = "http://" . $location . ".craigslist.org" . $listingurl;
			// truncate the title of the listing
			$i = 0;
			$newtitle = "";
			while ($i < 35 && $i < strlen($title))
			{
				$newtitle = $newtitle . $title[$i];
				$i++;
			}
			//if the title was truncated, add an ellipsis 
			if (strlen($newtitle) != strlen($title)) 
			{
				$newtitle = $newtitle . "...";
			}
			// using bitly's API to shorten the link
			$encodelistingurl = urlencode($listingurl);
			$t = 'https://api-ssl.bitly.com/v3/shorten?access_token=ff23eee3beefa9a7636f9e192b2edcaf4f67b436&format=txt&longUrl=' . $encodelistingurl;
			$h = file_get_contents($t);
			
			// change the price to integer
			$newprice = "";
			if (substr($listingprice, 0, 8) == '&#x0024;')
			{
				for ($i = 8; $i < strlen($listingprice); $i++)
				{
					$newprice = $newprice . $listingprice[$i];
				}
				
			}
			$newprice = (int) $newprice;			
			
			//create the message we send to the user
			$message = "A listing has been found. " . $newtitle . " at " .  $h . " for " . '$' . $newprice;

			
			// if the listing's price is higher than user's asking price, don't alert them.
			if ($price <= $newprice)
				return;
				
			//send the alert, update the mysql table so sent is now 1, 
			$sentquery = "UPDATE users SET sent = TRUE WHERE id = " . $id;
			mysql_query($sentquery, $db_connection);
			
			//send the alert
			$mail = new PHPMailer();
			$mail->Encoding = "base64";
			$mail->IsSMTP(); // send via SMTP
			$mail->SMTPAuth = true; // turn on SMTP authentication
			$mail->SMTPSecure = "tls";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 587;
			$mail->Username = "craigscan1@gmail.com"; // SMTP username
			$mail->Password = "boguspw1"; // SMTP password
			$webmaster_email = "craigscan1@gmail.com"; //Reply to this email ID
			$email= $recipient; // Recipients email ID
			$name="you"; // Recipient’s name
			$mail->From = $webmaster_email;
			$mail->FromName = "craigscan";
			$mail->AddAddress($email,$name);
			$mail->AddReplyTo($webmaster_email,"craigscan");
			//$mail->WordWrap = 160; // set word wrap
			//$mail->Subject = "CS";
			$mail->Body = $message . ". Thanks for using craigscan!";
			$mail->AltBody = $message . ". Thanks and try craigscan again!"; //Text Body
			if(!$mail->Send())
			{
				echo "Mailer Error: " . $mail->ErrorInfo;
			}
			else
			{
				echo "Message has been sent";
			}
		}
	}
	
?>
