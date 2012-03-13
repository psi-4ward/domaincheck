<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 *
 * PHP version 5
 * @copyright  4ward.media 2012
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    Domaincheck
 * @license	   LGPL
 * @filesource
 */


class ModuleDomaincheck extends Module
{
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_domaincheck';

	
	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### DOMAINCHECK ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		$this->loadLanguageFile('domaincheck');
		return parent::generate();
	}

	
	/**
	 * Generate module
	 */
	protected function compile()
	{
		$this->Template->action = $this->generateFrontendUrl($GLOBALS['objPage']->row());
		$GLOBALS['TL_CSS']['domaincheck'] = 'system/modules/domaincheck/html/style.css';
		
		if($this->Input->post('FORM_SUBMIT') == 'domaincheck')
		{
			// Validateion
			if(!is_array($this->Input->post('tld')) || count(array_diff($this->Input->post('tld'), $GLOBALS['TL_CONFIG']['domaincheckTLDs'])))
			{
				if($this->Input->get('isAjax') == 'yes')
				{
					echo $GLOBALS['TL_LANG']['domaincheck']['tldError'];
					exit;	
				}
				else 
				{
					$this->Template->tldError = true;
					$this->Input->setPost('tld', array());
					return;
				}
			}
			if(!strlen($this->Input->post('domain')) || !preg_match('/^[0-9a-z_\-üöäß]+$/i',$this->Input->post('domain')))
			{
				if($this->Input->get('isAjax') == 'yes')
				{
					echo $GLOBALS['TL_LANG']['domaincheck']['domainError'];
					exit;	
				}
				else 
				{
					$this->Template->domainError = true;
					$this->Input->setPost('domain', '');
					return;
				}
			}
			
			$resultTpl = new FrontendTemplate('domaincheck_result');
			
			// check domains
			$domains = array();
			$DomainWhois = new DomainWhois();
			foreach($this->Input->post('tld') as $tld)
			{
				$domains[$this->Input->post('domain').'.'.$tld] = $DomainWhois->isDomainRegistred($this->Input->post('domain').'.'.$tld);
			}
			$resultTpl->domains = $domains;

			// output
			
			if($this->Input->get('isAjax') == 'yes')
			{
				echo $resultTpl->parse();
				exit;
			}
			else
			{
				$this->Template->result = $resultTpl->parse();
			}
		}
		
		
	}	
}

?>