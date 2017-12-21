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
            'AP' => 'Amap�',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Cear�',
            'DF' => 'Distrito Federal',
            'ES' => 'Esp�rito Santo',
            'GO' => 'Goi�s',
            'MA' => 'Maranh�',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Par�',
            'PB' => 'Para�ba',
            'PR' => 'Paran�',
            'PE' => 'Pernambuco',
            'PI' => 'Piau�',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rond�nia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'S�o Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        );

        /**
         * Retorna a descri��o a partir do valor
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
    