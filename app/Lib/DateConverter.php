<?php

    /**
     * Classe para manipulação de datas
     *
     * @author Andre Araujo
     */
    abstract class DateConverter {

        public static function iso(&$data) {
            if (preg_match('/^(?<d>\d{2})\/(?<m>\d{2})\/(?<a>\d{4})$/', $data, $matches)) {
                $data = sprintf('%04d-%02d-%02d', $matches['a'], $matches['m'], $matches['d']);
            }
        }

        public static function ptbr(&$data) {
            if (preg_match('/^(?<a>\d{4})-(?<m>\d{2})-(?<d>\d{2})$/', $data, $matches)) {
                $data = sprintf('%02d/%02d/%04d', $matches['d'], $matches['m'], $matches['a']);
            }
        }

    }
    