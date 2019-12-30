<?php



function equacao($x, $y, $z){

	if($x == 0){
		echo 'x não pode ser 0';
	}

	$delta = pow($y,2) - ((4*$x)*$z);

	 if($delta === 0) {
	   $raiz = -($y)/(2*$x);
	   echo $raiz;
	
	 } elseif($delta > 0) {
		   $r1 = (-$y + sqrt($delta))/(2*$x);
		   $r2 = (-$y - sqrt($delta))/(2*$x);
		   $raiz = array($r1, $r2);
		   echo $raiz[0]. "," .$raiz[1];
	 } else {
	 	echo 'Sem solução';
	 }

}

 equacao(5, 3 , -3);
?>