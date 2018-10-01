<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pantallas
 *
 * @author enriquegomezpena
 */
class Pantallas {
    //put your code here
    private $id_pantallas;
    private $id_tipos;
    private $id_categorias;
    private $nombre;
    private $duracion;
    private $fecha;
    private $texto1;
    private $texto2;
    private $texto3;
    private $url_img;
    private $url_vimeo;
    private $activo;
    
    public function __construct() {
        
    }

    
    function getId_pantallas() {
        return $this->id_pantallas;
    }

    function getId_tipos() {
        return $this->id_tipos;
    }

    function getId_categorias() {
        return $this->id_categorias;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDuracion() {
        return $this->duracion;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getTexto1() {
        return $this->texto1;
    }

    function getTexto2() {
        return $this->texto2;
    }

    function getTexto3() {
        return $this->texto3;
    }

    function getUrl_img() {
        return $this->url_img;
    }

    function getUrl_vimeo() {
        return $this->url_vimeo;
    }

    function getActivo() {
        return $this->activo;
    }

    function setId_pantallas($id_pantallas) {
        $this->id_pantallas = $id_pantallas;
    }

    function setId_tipos($id_tipos) {
        $this->id_tipos = $id_tipos;
    }

    function setId_categorias($id_categorias) {
        $this->id_categorias = $id_categorias;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDuracion($duracion) {
        $this->duracion = $duracion;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setTexto1($texto1) {
        $this->texto1 = $texto1;
    }

    function setTexto2($texto2) {
        $this->texto2 = $texto2;
    }

    function setTexto3($texto3) {
        $this->texto3 = $texto3;
    }

    function setUrl_img($url_img) {
        $this->url_img = $url_img;
    }

    function setUrl_vimeo($url_vimeo) {
        $this->url_vimeo = $url_vimeo;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }


}
