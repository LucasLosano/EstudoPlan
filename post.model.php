<?php
    class Post{
        private $titulo = null;
        private $tempoPlanejado = null;
        private $idUsuario = null;

        public function __get($atr){
            return $this->$atr;
        }

        public function __set($atr, $valor){
            $this->$atr = $valor;
        }

        public function __construct($titulo, $tempoPlanejado,$idUsuario){
            $this->titulo = $titulo;
            $this->tempoPlanejado = $tempoPlanejado;
            $this->idUsuario = $idUsuario;
        }
    }
?>