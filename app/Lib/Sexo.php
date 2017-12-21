<?php

    /**
     * Sexo
     *
     * @author Andre Araujo
     */
    abstract class Sexo {

        /**
         * Lista de estados indexados pela siglas
         * @var array
         */
        private static $sexo = array(
            'F' => 'Feminino',
            'M' => 'Masculino',
        );

        /**
         * Retorna a descrição a partir do valor
         * @param type $value
         */
        public static function get($value) {
            return isset(self::$sexo[$value]) ? self::$sexo[$value] : null;
        }

        /**
         * @return array
         */
        public static function getList() {
            return self::$sexo;
        }

        /**
         * @return array
         */
        public static function getValues() {
            return array_keys(self::$sexo);
        }

    }
    