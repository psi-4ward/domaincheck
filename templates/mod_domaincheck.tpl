<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
	<?php if ($this->headline): ?><<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>><?php endif; ?>

	<form action="<?php echo $this->action;?>" id="domaincheckFrm" method="post" enctype="application/x-www-form-urlencoded">
	<div class="formbody">
	<input name="FORM_SUBMIT" value="domaincheck" type="hidden">
	
	<table summary="Form fields" cellpadding="0" cellspacing="0">
	  <tbody><tr class="row_0 row_first even">
	    <td class="col_0 col_first">
	    	<label for="ctrl_domain" class="mandatory"><?php echo $GLOBALS['TL_LANG']['domaincheck']['domain'];?></label>
	    </td>
	    <td class="col_1 col_last">
	    	<?php if($this->domainError): echo $GLOBALS['TL_LANG']['domaincheck']['domainError']; endif;?>
	    	<span class="bold right">www.</span><input name="domain" id="ctrl_domain" class="text mandatory required" value="<?php echo $this->Input->post('domain');?>" type="text">
	    </td>
	  </tr>
	  <tr class="row_1 odd">
	    <td class="col_0 col_first">
	    	<label for="ctrl_tld" class="mandatory"><?php echo $GLOBALS['TL_LANG']['domaincheck']['tld']?></label>
	    </td>
	    <td class="col_1 col_last">
	    	<div id="ctrl_tld" class="checkbox_container">
	    		<input name="tld" value="" type="hidden">
		    	<?php if($this->tldError) echo $GLOBALS['TL_LANG']['domaincheck']['tldError'];?>
	    		<?php foreach($GLOBALS['TL_CONFIG']['domaincheckTLDs'] as $k=>$tld):?>
	    		<span>
	    			<input name="tld[]" id="opt_tld_<?php echo $k;?>" class="checkbox validate-one-required" value="<?php echo $tld;?>" type="checkbox"<?php if(is_array($this->Input->post('tld')) && in_array($tld,$this->Input->post('tld'))) echo 'CHECKED';?>/>
	    			<label id="lbl_tld_<?php echo $k;?>" for="opt_tld_<?php echo $k;?>"><?php echo $tld;?></label>
	    		</span>
	    		<?php endforeach;?>
	    	</div>
	    	<div class="selectAll"><a href="#" onclick="$$('#ctrl_tld input').each(function(el){el.checked=true;});return false;"><?php echo $GLOBALS['TL_LANG']['MSC']['selectAll'];?></a></div>
	    </td>
	  </tr>
	  <tr class="row_2 even">
	    <td class="col_0 col_first">&nbsp;</td>
	    <td class="col_1 col_last">
	    	<div class="submit_container"><input id="ctrl_submit" class="submit" value="<?php echo $GLOBALS['TL_LANG']['domaincheck']['submit']?>" type="submit"></div>
	    </td>
	  </tr>
	
	</tbody></table>
	</div>
	</form>

	<div id="domaincheckResult">
		<?php echo $this->result;?>
	</div>
</div>

<script type="text/javascript">
<!--//--><![CDATA[//><!--
window.addEvent('domready',function(){
	$('domaincheckFrm').set('action',$('domaincheckFrm').get('action')+'?isAjax=yes');
	new Form.Request($('domaincheckFrm'),$('domaincheckResult'),{
		resetForm:false,
		 requestOptions: {
		        spinnerOptions: {
		            message: '<?php echo $GLOBALS['TL_LANG']['domaincheck']['ajaxRunning'];?>'
		        }
		    }
	});
});
//--><!]]>
</script>
