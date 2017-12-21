<?php

    /**
     * Description of CoeficienteHelper
     *
     * @author Andre Araujo
     */
    class SimuladorHelper extends AppHelper {

        /**
         * Exibição do radio button para um coeficiente
         * @param array $tabela Array de dados do coeficiente
         * @return string HTML
         */
        public function coeficientes(array $tabela) {
            $html = array();
            foreach ($tabela['Coeficiente'] as $coeficiente) {
                $html[] = $this->_View->element('simulador_coeficiente_radio', compact('coeficiente', 'tabela'));
            }
            return implode('', $html);
        }

    }
    