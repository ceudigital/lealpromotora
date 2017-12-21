<?php

    /**
     * Description of ImageResizer
     *
     * @author Andre Araujo
     */
    class ImageResizer {

        private $src;
        private $srcw;
        private $srch;
        private $dst;
        private $ext;

        public function setSrc($filename) {
            $this->initSrc($filename);
        }

        public function resize($output_filename, $width = null, $height = null) {
            switch (true) {
                case!is_null($width) && !is_null($height):
                    $this->crop($width, $height);
                    break;
                case!is_null($width):
                    $this->resizeByWidth($width);
                    break;
                case!is_null($height):
                    $this->resizeByHeight($height);
                    break;
            }
            $this->saveResized($output_filename);
        }

        private function crop($width, $height) {
            $srcratio = $this->srcw / $this->srch;
            $dstratio = $width / $height;
            $srcx = 0;
            $srcy = 0;
            $dstx = 0;
            $dsty = 0;
            if ($srcratio > $dstratio) {
                $srcx = round(($this->srcw - ($this->srch * $dstratio)) / 2);
                $this->srcw = $this->srch * $dstratio;
            } else {
                $srcy = round(($this->srch - ($this->srcw / $dstratio)) / 2);
                $this->srch = $this->srcw / $dstratio;
            }
            $this->copyImage($width, $height, $dstx, $dsty, $srcx, $srcy);
        }

        private function resizeByWidth($width) {
            $ratio = $this->srcw / $this->srch;
            $height = $width / $ratio;
            $this->copyImage($width, $height);
        }

        private function resizeByHeight($height) {
            $ratio = $this->srcw / $this->srch;
            $width = $height * $ratio;
            $this->copyImage($width, $height);
        }

        /**
         * Realiza a cópia da imagem
         * @param type $width
         * @param type $height
         * @param type $dstx
         * @param type $dsty
         * @param type $srcx
         * @param type $srcy
         */
        private function copyImage($width, $height, $dstx = 0, $dsty = 0, $srcx = 0, $srcy = 0) {
            $this->initDst($width, $height);
            imagecopyresampled($this->dst, $this->src, $dstx, $dsty, $srcx, $srcy, $width, $height, $this->srcw, $this->srch);
        }

        /**
         * Cria a imagem a partir da imagem original
         * @param type $folder
         * @param type $filename
         * @return resource
         */
        private function initSrc($filename) {
            $imagesize = getimagesize($filename);
            $this->srcw = $imagesize[0];
            $this->srch = $imagesize[1];
            $this->ext = $this->getFiletype($filename);
            switch ($this->ext) {
                case 'jpg':
                case 'jpeg':
                    $this->src = imagecreatefromjpeg($filename);
                    break;
                case 'gif':
                    $this->src = imagecreatefromgif($filename);
                    break;
                case 'png':
                    $this->src = imagecreatefrompng($filename);
                    break;
                default:
                    $this->src = null;
            }
        }

        /**
         * 
         * @param type $width
         * @param type $height
         */
        private function initDst($width, $height) {
            $this->dst = imagecreatetruecolor($width, $height);
            if (in_array($this->ext, array('gif', 'png'))) {
                $alpha = imagecolorallocatealpha($this->dst, 0, 0, 0, 127);
                imagesavealpha($this->dst, true);
                imagefill($this->dst, 0, 0, $alpha);
            }
        }

        /**
         * Salvar a imagem em disco
         */
        private function saveResized($output_filename) {
            switch ($this->ext) {
                case 'jpg':
                case 'jpeg':
                    imagejpeg($this->dst, $output_filename, 100);
                    break;
                case 'gif':
                    imagegif($this->dst, $output_filename);
                    break;
                case 'png':
                    imagepng($this->dst, $output_filename);
                    break;
            }
            //Libera memoria
            unset($this->src);
            unset($this->dst);
        }

        /**
         * Retorna a extensão de um arquivo em caixa baixa
         * @param string $filename Nome do arquivo
         * @return string Extensão do arquivo
         */
        private function getFiletype($filename) {
            $info = pathinfo($filename);
            return strtolower($info['extension']);
        }

    }
    