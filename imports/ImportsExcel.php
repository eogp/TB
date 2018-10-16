<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImportsExcel
 *
 * @author enriquegomezpena
 */
require '../vendor/autoload.php';
require "../db/DBSingleton.php";

class ImportsExcel {

    public function import($inputFileName) {

        //$inputFileName = '../excel/example1.xls';
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($inputFileName);
        //$worksheet = $spreadsheet->getActiveSheet();
        $worksheetPersonas = $spreadsheet->getSheetByName("Cumpleanos");
        // Get the highest row and column numbers referenced in the worksheet
        
//        $highestColumnPropiedades = $worksheetPropiedades->getHighestColumn(); // e.g 'F'
//        $highestColumnIndexPropiedades = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumnPropiedades); // e.g. 5
//        $highestColumnPropietarios = $worksheetPresonas->getHighestColumn(); // e.g 'F'
//        $highestColumnIndexPropietarios = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumnPropietarios); // e.g. 5
//        $highestColumnLugares = $worksheetPresonas->getHighestColumn(); // e.g 'F'
//        $highestColumnIndexLugares = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumnLugares); // e.g. 5

        $this->delete("cumpleanos");
        $this->insertCumpleanos($worksheetPersonas);
       
       

    }
    
    public function delete($tabla){
        $dbSingleton = DBSingleton::getInstance();
        $db = $dbSingleton->getRedBean();
        
        $result=$db->findAll($tabla);
        $db->trashAll($result);
    }
    
    public function insertCumpleanos($worksheet){

        $highestRow = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
        for ($row = 2; $row <= $highestRow; ++$row) {
            $celdas = [];
            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $celdas[] = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                //print_r($worksheet->getCellByColumnAndRow($col, $row)->getValue());
            }
            //print_r($celdas);
            $this->insterItem($celdas);

        }

    }
    
    public function insterItem($celdas) {
        //print_r($celdas);
        $dbSingleton = DBSingleton::getInstance();
        $db = $dbSingleton->getRedBean();

        $fila = $db->dispense("cumpleanos");
        
        $fila->dia = $celdas[0];
        $fila->mes = $celdas[1];
        $fila->anio = $celdas[2];
        $fila->nombres = $celdas[3];
        $fila->apellidos = $celdas[4];

        $db->store($fila);
        //$beanPersona = $db->load("persona",$idPersona);
    }

}
