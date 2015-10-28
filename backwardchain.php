<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace bwc;

use regla\regla;
use hecho\hecho;
use Pila\Pila;
use literal\literal;
use bh\bh;
/**
 * Description of backwardchain
 *
 * @author root
 */
class backwardchain {
    private $reglasMarcadas;
    private $metasMarcadas;
    private $reglas;
    
    function __construct() {
        $this->reglasMarcadas=array();
        $this->metasMarcadas=array();
        $this->reglas=array();
    }

    function bwcr(hecho $hecho, bh &$bh){
        $h=$bh->existeHecho($hecho);
        if($h!=null){
            return $h;
        }else{
            $conjuntoConflictivo=  $this->buscarReglas($hecho);
            while(!empty($conjuntoConflictivo) && $h==NULL){
                $contadorRegla=0;
                $regla=$conjuntoConflictivo[$contadorRegla];
                unset($conjuntoConflictivo[$contadorRegla]);
                $metas=$regla->clonarAntecedente();
                $contadorLiteral=0;
                $dispara=TRUE;
                while(!empty($metas) && $dispara){
                    $meta=$metas[$contadorLiteral];
                    unset($metas[$contadorLiteral]);
                    $h=  $this->bwcr($meta,$bh);
                    if($h!=null){
                        $bh->addHecho($h);
                    }else{
                        $dispara=FALSE;
                    }
                    ++$contadorLiteral;
                }
                if($dispara && $this->disparaRegla($regla, $bh)){
                    $bh->addHecho($regla->getConsecuente());
                    $h=$regla->getConsecuente();
                }
                ++$contadorRegla;
            }
            return $h;
        }
    }
    
   
    private function disparaRegla(regla $r, bh $bh){
        $dispara=TRUE;
        foreach ($r->getAntecedente() as $literal){
            $dispara=$dispara && $this->disparaLiteral($literal, $bh);
        }
        return $dispara;
    }
    private function disparaLiteral(literal $literal, bh $bh){
        foreach ($bh->getHechos() as $i => $hecho){
            if(strcmp($hecho->getVariable(),$literal->getVariable())==0){
                return $this->dispara($literal, $hecho);
            }
        }
        return false;
    }
    private function dispara(literal $literal, hecho $hecho){
        if($literal->getEsNumerico()){
            switch ($literal->getOprel()){
                case literal::$DIFERENTE:
                    return $literal->getValor()!=$hecho->getValor();
                case literal::$IGUAL:
                    return $literal->getValor()==$hecho->getValor();
                case literal::$MAYOR:
                    return $hecho->getValor()>$literal->getValor();
                case literal::$MAYOR_IGUAL:
                    return $hecho->getValor()>=$literal->getValor();
                case literal::$MENOR:
                    return $hecho->getValor()<$literal->getValor();
                case literal::$MENOR_IGUAL:
                    return $hecho->getValor()<=$literal->getValor();
            }
        }else{
            switch ($literal->getOprel()){
                case literal::$IGUAL:
                    return strcmp($literal->getValor(),$hecho->getValor()==0)?TRUE:FALSE;
                case literal::$DIFERENTE:
                    return strcmp($literal->getValor(),$hecho->getValor()==0)?FALSE:TRUE;
            }
        }
    }
   
    private function buscarReglas(hecho $hecho){
        $conjunto_conflictivo=array();
        foreach ($this->reglas as $i => $regla){
            if(strcmp($regla->getConsecuente()->getVariable(),$hecho->getVariable())==0){
                $conjunto_conflictivo[]=$regla;
            }
        }
        return $conjunto_conflictivo;
    }


    function getReglas() {
        return $this->reglas;
    }

    function setReglas( $r) {
        $this->reglas[] = $r;
    }


}
