<?php

if (!class_exists('GestorErrores')) {
    /**
     * Clase que me permitirá llevar un registro de los errores que se producen.
     */
    class GestorErrores
    {
        /**
         * Lista en la que guardamos los errores. Solo se podrá almacenar una descripción por campo.
         * @var array $errores
         * @var string $format_prefix
         * @var string $format_sufix
         */
        private $errores = array();
        private $format_prefix;
        private $format_suffix;

        /**
         * Crea el gestor de errores y anota las etiquetas que se muestran antes
         * y después en caso de queramos salida formateada
         * @param string $format_prefix
         * @param string $format_sufix
         * @return void
         */
        public function __construct(string $format_prefix = '', string $format_sufix = '')
        {
            $this->format_prefix = $format_prefix;
            $this->format_suffix = $format_sufix;
        }

        /**
         * Anota un error para un campo en nuestro gestor de errores
         * @param string $campo
         * @param string $descripcion
         * @return void
         */
        public function AnotaError(string $campo, string $descripcion):void
        {
            $this->errores[$campo] = $descripcion;
        }

        /**
         * Indica si hay errores
         * @return boolean
         */
        public function HayErrores():bool
        {
            return count($this->errores) > 0;
        }

        /**
         * Indica si hay error en un campo
         * @return boolean
         */
        public function HayError(string $campo):bool
        {
            return isset($this->errores[$campo]);
        }

        /**
         * Devuelve la descripción de error para un campo o una cadaena vacia si no
         * hay
         * @param string $campo
         * @return string
         */
        public function Error(string $campo):string
        {
            if (isset($this->errores[$campo])) {
                return $this->errores[$campo];
            } else {
                return '';
            }
        }

        /**
         * Devuelve la descripción del error o cadena vacia si no hay
         * @param string $campo
         * @return string
         */
        public function ErrorFormateado(string $campo):string
        {
            if ($this->HayError($campo)) {
                return $this->format_prefix . $this->Error($campo) . $this->format_suffix;
            } else {
                return '';
            }
        }
    }
}