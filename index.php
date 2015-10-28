<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include 'hecho.php';
        include 'Pila.php';
        include 'regla.php';
        include 'literal.php';
        include 'bh.php';
        include 'backwardchain.php';
        use bwc\backwardchain;
        use bh\bh;
        use hecho\hecho;
        use literal\literal;
        use regla\regla;
//        $bh=new bh();
//        
//        $reglas=array();
//        //iniciamos la bh;
//        $hecho1=new hecho();
//        $hecho1->setVariable('tiempo');
//        $hecho1->setValor('soleado');
//        $hecho1->setEsNumerico(FALSE);
//        $bh->addHecho($hecho1);
//        $hecho2=new hecho();
//        $hecho2->setVariable('humor');
//        $hecho2->setValor('negro');
//        $hecho2->setEsNumerico(FALSE);
//        $bh->addHecho($hecho2);
//        $hecho3=new hecho();
//        $hecho3->setVariable('temp');
//        $hecho3->setValor(27);
//        $hecho3->setEsNumerico(TRUE);
//        //creamos las reglas
//        //regla 1
//        $literal=new literal();
//        $literal->setHecho($hecho2);
//        $literal->setOprel(literal::$IGUAL);
//        $regla1=new regla();
//        $regla1->addLiteral($literal);
//        $regla1->setConsecuente($hecho3);
//        //regla 2
//        $literal2=new literal();
//        $literal2->setHecho($hecho3);
//        $literal2->setOprel(literal::$MAYOR);
//        $literal3=new literal();
//        $literal3->setHecho($hecho1);
//        $literal3->setOprel(literal::$IGUAL);
//        $regla2=new regla();
//        $regla2->addLiteral($literal2);
//        $regla2->addLiteral($literal3);
//        $meta=new hecho();
//        $meta->setVariable('meta');
//        $meta->setValor('no hay nubes');
//        $meta->setEsNumerico(FALSE);
//        $regla2->setConsecuente($meta);
//        $reglas[]=$regla1;
//        $reglas[]=$regla2;
//        
//        //iniciamos el backwardchain
//        $bwc=new backwardchain();
//        $bwc->bawc($bh, $meta, $reglas);
//        var_dump($bh);
        $bwx=new backwardchain();
        $h1=new hecho();
        $h1->setVariable('z');
        $h1->setValor(0);
        $h1->setEsNumerico(TRUE);
        $h2=new hecho();
        $h2->setVariable('y');
        $h2->setValor('A');
        $h2->setEsNumerico(FALSE);
        $bh=new bh();
        $bh->addHecho($h1);
        $bh->addHecho($h2);
        ////bh////////////////////
        ///////////////////////////
        $h3=new hecho();
        $h3->setVariable('y');
        $h3->setValor('A');
        $h3->setEsNumerico(FALSE);
        $l1=new literal();
        $l1->setHecho($h3);
        $l1->setOprel(literal::$IGUAL);
        $h4=new hecho();
        $h4->setVariable('x');
        $h4->setValor('b');
        $h4->setEsNumerico(FALSE);
        $r1=new regla();
        $r1->addLiteral($l1);
        $r1->setConsecuente($h4);
        $bwx->setReglas($r1);
        
        $h5=new hecho();
        $h5->setVariable('z');
        $h5->setValor(0);
        $h5->setEsNumerico(TRUE);
        $l1=new literal();
        $l1->setHecho($h5);
        $l1->setOprel(literal::$MAYOR_IGUAL);
        $h6=new hecho();
        $h6->setVariable('p');
        $h6->setValor(1);
        $h6->setEsNumerico(TRUE);
        $r2=new regla();
        $r2->addLiteral($l1);
        $r2->setConsecuente($h6);
        $bwx->setReglas($r2);
        
        $l2=new literal();
        $l2->setHecho($h6);
        $l2->setOprel(literal::$IGUAL);
        $l3=new literal();
        $l3->setHecho($h4);
        $l3->setOprel(literal::$IGUAL);
        $r3=new regla();
        $r3->addLiteral($l2);
        $r3->addLiteral($l3);
        
        $h7=new hecho();
        $h7->setVariable('m');
        $h7->setValor('oscar');
        $h7->setEsNumerico(FALSE);
        $r3->setConsecuente($h7);
        $bwx->setReglas($r3);
        
        $meta=new hecho();
        $meta->setVariable('m');
        $literal=new literal();
        $literal->setHecho($meta);
        $literal->setOprel(literal::$IGUAL);
        $bwx->bwcr($meta, $bh);
        var_dump($bh);

        ?>
    </body>
</html>
