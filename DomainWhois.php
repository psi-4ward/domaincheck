<?php 

/**
 * DomainWhois Class
 * * domain whois queries
 * * ip whois queries
 * * domain-free check
 * 
 * @copyright by 4ward.media - http://www.4wardmedia.de
 * @author Christoph Wiechert <wio@psitrax.de>
 * @license LGPL
 */

class DomainWhois extends System
{
	
	// For the full list of TLDs/Whois servers see http://www.iana.org/domains/root/db/ and http://www.whois365.com/en/listtld/
	public $whoisservers = array
	(
		'at' => array
		(
			'server' 			=> 'whois.nic.at',
			'notRegistredRegex' => '~% nothing found~i',
			'limitErrorRegex'	=> '~% (Access denied|Quota exceeded)~im'
		),
		'biz' => array
		(
			'server' 			=> 'whois.biz',
			'notRegistredRegex' => '~^Not found: ~i'
		),
		'com' => array
		(
			'server' 			=> 'whois.verisign-grs.com',
			'notRegistredRegex' => '~^No match for ~im'
		),
		'de' => array
		(
			'server' 			=> 'whois.denic.de',
			'notRegistredRegex' => '~Status:\s*free~i',
			'limitErrorRegex'	=> '~access control limit exceeded~im'
		),
		'eu' => array
		(
			'server' 			=> 'whois.eu',
			'notRegistredRegex' => '~^Status:\s*AVAILABLE~im',
			'limitErrorRegex'	=> '~Still in grace period~im'
		),
		'info' => array
		(
			'server' 			=> 'whois.afilias.info',
			'notRegistredRegex' => '~^NOT FOUND~im',
			'limitErrorRegex' 	=> '~LIMIT EXCEEDED~im'
		),
		'net' => array
		(
			'server' 			=> 'whois.verisign-grs.net',
			'notRegistredRegex' => '~^No match for ~im'
		),
		'org' => array
		(
			'server' 			=> 'whois.pir.org',
			'notRegistredRegex' => '~^NOT FOUND~im',
			'limitErrorRegex' 	=> '~LIMIT EXCEEDED~im'
		)
	);
	

	/**
	 * Look if a domain is registred
	 * @param str $domain Domain 
	 * @return boolean true if the domain is registred
	 */
	public function isDomainRegistred($domain)
	{
		// first try a dns-check
		if(checkdnsrr($domain,'A') || checkdnsrr($domain,'MX'))
		{
			return true;
		}
		
		$result = $this->lookupDomain($domain);
		$tld = substr($domain,strrpos($domain,".")+1);
		// echo "<pre>".$result."</pre><hr>";		
		
		// Limit exceeded, query per DNS
		if(isset($this->whoisservers[$tld]['limitErrorRegex']) && preg_match($this->whoisservers[$tld]['limitErrorRegex'],$result))
		{
			return 2;
		}
		
		return !preg_match($this->whoisservers[$tld]['notRegistredRegex'],$result);
	}
	
	
	/**
	 * Domain Lookup
	 * this function tries to find the appropriate Whois server 
	 * @param str $domain Domainname 
	 * @return str
	 */
	public function lookupDomain($domain)
	{
		$tld = substr($domain,strrpos($domain,".")+1);
		if(!isset($this->whoisservers[$tld])) throw new Exception("Error: No appropriate Whois server found for $domain domain!");
		$result = $this->query($this->whoisservers[$tld]['server'], $domain);
		if(!$result) throw new Exception("Error: No results retrieved from $whoisserver server for $domain domain!");
		
		return $result;
	}
	
	/**
	 * Querys the whois-server and returns its answer
	 * @param $whoisserver ulr or ip from the server
	 * @param $domain domain
	 * @return str answer
	 */
	public function query($whoisserver, $domain)
	{
		$port = 43;
		$timeout = 10;
		$fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout);
		if(!$fp) throw new Exception("Socket Error " . $errno . " - " . $errstr);
		fputs($fp, $domain . "\r\n");
		$out = "";
		while(!feof($fp))
		{
			$out .= fgets($fp);
		}
		fclose($fp);
		return $out;
	}
	
	/**
	 * IP Lookup
	 * @param str $ip IP-Adress
	 * @return str Answer
	 */
	function lookupIP($ip)
	{
		$whoisservers = array
		(
			//"whois.afrinic.net", // Africa - returns timeout error :-(
			"whois.apnic.net", // Asia/Pacific - OK :-)
			"whois.arin.net", // North America - OK :-)
			"whois.lacnic.net", // Latin America and some Caribbean - OK :-)
			"whois.ripe.net" // Europe, the Middle East, and Central Asia - OK :-)
		);
		$out = array();
		foreach($whoisservers as $whoisserver)
		{
			$result = $this->query($whoisserver, $ip);
			if(preg_match("/Country: (.*)/i", $result, $matches))
			{
				$out[]= "lookup results for $ip from $whoisserver server:\n\n" . $result;
			}
		}
		return count($out) . " RESULTS FOUND:\n-------------\n" . implode("\n\n-------------\n\n", $out);
	}
	
	
}



?>
