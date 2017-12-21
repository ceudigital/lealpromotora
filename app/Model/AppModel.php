<?php

    /**
     * Application model for CakePHP.
     *
     * This file is application-wide model file. You can put all
     * application-wide model-related methods here.
     *
     * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
     * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
     *
     * Licensed under The MIT License
     * For full copyright and license information, please see the LICENSE.txt
     * Redistributions of files must retain the above copyright notice.
     *
     * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
     * @link          http://cakephp.org CakePHP(tm) Project
     * @package       app.Model
     * @since         CakePHP(tm) v 0.2.9
     * @license       http://www.opensource.org/licenses/mit-license.php MIT License
     */
    App::uses('Model', 'Model');

    /**
     * Application model for Cake.
     *
     * Add your application-wide methods in the class below, your models
     * will inherit them.
     *
     * @package       app.Model
     */
    class AppModel extends Model {

        /**
         * Recursividade padrão para consultas
         * @var int
         */
        public $recursive = -1;

        /**
         * Retornar o valor de um atributo do model
         * @param string $field Nome do atributo
         * @param mixed $default Valor default caso o atributo não esteja definido
         * @return mixed Valor do atributo ou valor default caso o atributo não esteja definido
         */
        public function get($field, $default = null) {
            return isset($this->data[$this->alias][$field]) ? $this->data[$this->alias][$field] : $default;
        }

        /**
         * Método para validação do digito verificador do CPF
         * @param mixed $check array ou string com cpf
         * @return boolean
         */
        public function validarCPF($check = array()) {
            $cpf = is_array($check) ? array_shift($check) : $check;
            // Verifica se um número foi informado
            if (empty($cpf)) {
                return false;
            }
            // Elimina possivel mascara
            $cpf = ereg_replace('[^0-9]', '', $cpf);
            $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
            // Verifica se o numero de digitos informados é igual a 11 
            if (strlen($cpf) != 11) {
                return false;
            }
            // Verifica se nenhuma das sequências invalidas abaixo 
            // foi digitada. Caso afirmativo, retorna falso
            for ($i = 0; $i <= 9; $i++) {
                if ($cpf == str_repeat($i, 11)) {
                    return false;
                }
            }
            // Calcula os digitos verificadores para verificar se o
            // CPF é válido
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }

    }
    