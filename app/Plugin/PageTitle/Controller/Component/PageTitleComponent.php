<?php

    /**
     * Description of PageTitleComponent
     *
     * @author Andre Araujo
     */
    class PageTitleComponent extends Component {

        /**
         * Lista de títulos
         * @var type 
         */
        private $titles = array();

        /**
         * Configurações padrão
         * @var type 
         */
        private $default_settings = array(
            'default' => null,
            'separator' => ' :: ',
        );

        /**
         * @param ComponentCollection $collection
         * @param type $settings
         */
        public function __construct(ComponentCollection $collection, $settings = array()) {
            parent::__construct($collection, array_merge($this->default_settings, $settings));
        }

        /**
         * before render
         * @param Controller $controller
         */
        public function beforeRender(Controller $controller) {
            parent::beforeRender($controller);
            $this->titles[] = $this->settings['default'];
            $separator = $this->settings['separator'];
            $title = implode($separator, $this->titles);
            $controller->set('title_for_layout', $title);
        }

        /**
         * Incluir um título
         * @param type $title
         */
        public function add() {
            $args = func_get_args();
            foreach ($args as $arg) {
                $this->titles[] = $arg;
            }
        }

    }
    