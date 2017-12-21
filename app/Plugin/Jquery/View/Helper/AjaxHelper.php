<?php

	 /**
	  * 
	  * Céu Digital - http://www.ceudigital.com.br
	  * Limites?!
	  * 
	  * AjaxHelper
	  *
	  * @author Andre Araujo
	  * 
	  * @property HtmlHelper $Html 
	  */
	 class AjaxHelper extends AppHelper {

		 /**
		  * Helpers
		  * @var array
		  */
		 public $helpers = array('Html');

		 public function loadOnChange($src, $target, $url, $inline = false) {
			 $url = is_array($url) ? Router::url($url) : $url;
			 $js = <<<JS
	$(function(){
		$(document).on('change', '$src', function(e){						
			var src = $(this);
			if($(src).val() != ''){
				$.ajax({
					url: '$url',
					data: {
						val: $(src).val(),
					},
					method: 'POST',
					beforeSend: function(){
						Pace.restart();
						$('$target').attr('disabled','disabled');
						$('$target').html('');
					},
					success: function(data, textStatus, jqXHR){
						$('$target').html(data);
					},
					complete: function(){
						$('$target').removeAttr('disabled');
					},
					error: function(jqXHR, textStatus, errorThrown){
						new PNotify({
							title: 'Erro',
							text: 'Erro ao carregar os dados ('+errorThrown+')',
							type: 'error'
						});
					}
				});
			} else {
				$('$target').attr('disabled','disabled');
				$('$target').html('');
			}			
		});
	});
JS;
			 return $this->Html->scriptBlock($js, compact('inline'));
		 }

	 }
	 