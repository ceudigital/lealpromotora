<?php

    /**
     * Description of Ambiente
     *
     * @author Andre Araujo
     */
    abstract class Ambiente {

        public static function isDesenvolvimento() {
            $dev = array(
                'localhost',
                'teste7650.lealpromotora.com.br',
                '10.0.0.119'
            );

            return in_array(env('SERVER_NAME'), $dev);
        }

        public static function isProducao() {
            return env('SERVER_NAME') == 'simulador.lealpromotora.com.br';
        }

    }
    