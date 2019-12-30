<?php

 function busca($mode = 0){

 	 	$escala = [0=>'Melhor preço com escalas', 1=>'Melhor preço sem escalas'];

 		$pattern = '/('.$escala[$mode].') (R\$ (\d*\.?\d{3})|\d*\.?\d{3})/';

 		$matches = [];


		 $subject = "Melhor preço sem escalas R$ 1.367(1)
					 Melhor preço com escalas R$ 994 (1)

					 1 - Incluindo todas as taxas.";
 	        
 	     preg_match_all($pattern, $subject, $matches);

 		 echo number_format((float) str_replace('.', '', $matches[3][0]),2, '.', '');

 }

// escolha entre 0 e 1 para utilizar a função busca 
// 0 = sem escalas
// 1 = com escalas

 busca(0);
?>