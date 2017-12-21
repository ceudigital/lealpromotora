<?php

	 /**
	  * Helper para servi�o Gravatar (Globally Recognized Avatar)
	  * @see https://pt.gravatar.com/site/implement/images/
	  */
	 class GravatarHelper extends AppHelper {

		 /**
		  * Lista de helpers
		  * @var type 
		  */
		 public $helpers = array('Html');

		 /**
		  * URL base do servi�o
		  * @var string
		  */
		 const urlBase = 'https://www.gravatar.com/avatar/';

		 /**
		  * Retorna url para imagem associada ao e-mail informado
		  * @param string $email Endere�o de e-mail
		  * @param int $size Tamanho da imagem (1 a 2048)
		  * @param string $default Imagem padr�o quando e-mail n�o for encontrado (404, mm, identicon, monsterid, wavatar, retro, blank)
		  * @param string $rating Classifica��o da imagem (g, pg, r, x)
		  * @see https://pt.gravatar.com/site/implement/images/
		  * @return string URL para imagem
		  */
		 public function imageurl($email, $size = 80, $default = 'mm', $rating = 'g') {
			 $hash = md5(trim(strtolower($email)));
			 $query = http_build_query(compact('size', 'default', 'rating'));
			 return sprintf('%s%s?%s', self::urlBase, $hash, $query);
		 }

		 /**
		  * Retorna html para exibi��o da imagem associada ao e-mail informado
		  * @param type $email
		  * @param array $image_options Array de op��es para Html::image
		  * @param int $size Tamanho da imagem (1 a 2048)
		  * @param string $default Imagem padr�o quando e-mail n�o for encontrado (404, mm, identicon, monsterid, wavatar, retro, blank)
		  * @param string $rating Classifica��o da imagem (g, pg, r, x)
		  * @param type $size
		  * @return type
		  */
		 public function image($email, $image_options = array(), $size = 80, $default = 'mm', $rating = 'g') {
			 $url = $this->imageurl($email, $size, $default, $rating);
			 return $this->Html->image($url, $image_options);
		 }

	 }
	 