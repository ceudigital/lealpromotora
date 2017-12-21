<?php

    /**
     * Description of BlueimpGalleryHelper
     *
     * @author Andre Araujo
     */
    class BlueimpGalleryHelper extends AppHelper {

        /**
         * Lista de nomes de helpers
         * @var array
         */
        public $helpers = array('Html');

        /**
         * beforeLayout
         * - Carrega os assets (css e js)
         * - Inclui no bloco "content" o código do lightbox
         * @param type $viewFile
         */
        public function beforeLayout($viewFile) {
            parent::beforeLayout($viewFile);
            $this->Html->css('BlueimpGallery.blueimp-gallery.min', array('inline' => false));
            $this->Html->script('BlueimpGallery.jquery.blueimp-gallery.min', array('inline' => false));
            $this->_View->append('content', $this->_View->element('BlueimpGallery.lightbox'));
        }

        /**
         * Criar uma galeria
         * @param array $images Lista de imagens, cada elemento deve conter as
         * seguintes chaves:
         * - src: Caminho para a imagem original
         * - thumb: Caminho para a miniatua
         * - title: Título da imagem
         */
        public function create($images = array()) {
            $gallery_id = sprintf('blueimp-gallery-%s', md5(time()));
            return $this->_View->element('BlueimpGallery.gallery', compact('gallery_id', 'images'));
        }

    }
    