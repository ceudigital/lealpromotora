<?php

    /**
     * Estado
     *
     * @author Andre Araujo
     */
    abstract class Estado {

        /**
         * Lista de estados indexados pela siglas
         * @var array
         */
        private static $estados = array(
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhã',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
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
            return self::$estados;
        }

        /**
         * @return array
         */
        public static function getValues() {
            return array_keys(self::$estados);
        }

    }
    