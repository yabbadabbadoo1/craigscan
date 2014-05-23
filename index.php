
 <html> 
 <head>
 <font size=18>craigscan</font><br><br>
 </head>
 
<body>
<form action="sub.php" method="post"> 
  <table>
    <tr>
      <td align="right">Phone number to text:</td>
      <td align="left"><input type="text" name="phone" maxlength=10 /> (Use format 3105551234)</td>
    </tr>
	<tr>
	  <td align="right">Carrier:</td>
	  <td align="left"><select name="carrier">
	  <option value="att"> AT & T</option>
	  <option value="boost">Boost Mobile</option>
	  <option value="nextel">Nextel</option>
	  <option value="sprint">Sprint</option>
	  <option value="tmobile">T-Mobile</option>
	  <option value="verizon">Verizon</option>
	  <option value="virgin">Virgin</option>
	 </tr>
	<tr>
      <td align="right">Location:</td>
      <td align="left"><select name="location">
	  <option value="bakersfield">bakersfield</option>
	  <option value="chico">chico</option>
	  <option value="fresno">fresno / madera</option>
	  <option value="hanford">hanford-corcoran</option>
	  <option value="humboldt">humboldt county</option>
	  <option value="imperial">imperial county</option>
	  <option value="inlandempire">inland empire</option>
	  <option value="losangeles">los angeles</option>
	  <option value="mendocino">mendocino county</option>
	  <option value="merced">merced</option>
	  <option value="modesto">modesto</option>
	  <option value="monterey">monterey bay</option>
	  <option value="orangecounty">orange county</option>
	  <option value="palmsprings">palmsprings</option>
	  <option value="redding">redding</option>
	  <option value="sacramento">sacramento</option>
	  <option value="sfbay">san francisco bay area</option>
	  <option value="slo">san luis obispo</option>
	  <option value="santabarbara">santa barbara</option>
	  <option value="santamaria">santa maria</option>
	  <option value="siskiyou">siskiyou county</option>
	  <option value="stockton">stockton</option>
	  <option value="susanville">susanville</option>
	  <option value="ventura">ventura county</option>
	  <option value="visalia">visalia-tulare</option>
	  <option value="yubasutter">yuba-sutter</option></td>
    </tr>
	<tr>
	  <td align="right">Search Keywords:</td>
	  <td align="left"><input type="text" name="search" maxlength=80 /></td>
	</tr>
	<tr>
      <td align="right">Category:</td>
      <td align="left"><select name="category">
	  <option value="sss">for sale</option>
	  <option value="hhh">housing</option>
	  <option value="bbb">services</option>
	  <option value="jjj">jobs</option>
	  <option value="ggg">gigs</option>
	</tr>
	<tr>
	  <td align="right">Include nearby?</td>
	  <td align="left">Yes<input type="radio" name="nearby" value="yes">
	  No<input type="radio" name="nearby" value="no" checked></td>
	</tr>
	<tr>
	  <td align="right">Price maximum: $</td>
	  <td align="left"><input type="text" name="price" maxlength=8 />.00</td>
	</tr>
	<tr>
	  <td align="right"><input type="submit" value="Submit"></td>
	</tr>
  </table>
 </body>
