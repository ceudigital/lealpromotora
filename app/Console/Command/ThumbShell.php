<?php

    App::uses('Folder', 'Utility');
    App::uses('ImageResizer', 'Lib');

    /**
     * Description of ThumbShell
     *
     * @author Andre Araujo
     */
    class ThumbShell extends AppShell {

        public function main() {
            $this->out('Gerar miniaturas');
            $this->out('Lendo diretorio de imagens');
            $path = ROOT . DS . 'img' . DS . 'SolicitacaoDocumento';
            $folder = new Folder($path);
            $files = $folder->read();
            $ImageResizer = new ImageResizer();
            foreach ($files[1] as $file) {
                $this->out(sprintf('Redimensionando %s...', $file), 0);
                $ImageResizer->setSrc($path . DS . $file);
                $ImageResizer->resize($path . DS . 'thumb_' . $file, 150, 150);
                $this->out(' ok!');
            }
        }

    }
    