<?php if (!defined('BASEPATH')) {exit('No se permite el acceso directo al script');
}

class Limites {
	//ejemplo de objeto

	function calcula($objeto, $cantidad) {

                if($cantidad >= $objeto[0][0] && $cantidad <=  $objeto[0][1]){
                        return  $objeto[0][2];
                }

                if($cantidad >= $objeto[1][0] && $cantidad <=  $objeto[1][1]){
                        return  $objeto[1][2];
                }

                if($cantidad >= $objeto[2][0] && $cantidad <=  $objeto[2][1]){
                        return  $objeto[2][2];
                }

                if($cantidad >= $objeto[3][0] && $cantidad <=  $objeto[3][1]){
                        return  $objeto[3][2];
                }

                if($cantidad >= $objeto[4][0] && $cantidad <=  $objeto[4][1]){
                        return  $objeto[4][2];
                }

                // echo $objeto[0][0];

                // var_dump($objeto);
	}


        function texto($objeto, $cantidad) {

                if($cantidad >= $objeto[0][0] && $cantidad <=  $objeto[0][1]){
                        return  $objeto[0][3];
                }

                if($cantidad >= $objeto[1][0] && $cantidad <=  $objeto[1][1]){
                        return  $objeto[1][3];
                }

                if($cantidad >= $objeto[2][0] && $cantidad <=  $objeto[2][1]){
                        return  $objeto[2][3];
                }

                if($cantidad >= $objeto[3][0] && $cantidad <=  $objeto[3][1]){
                        return  $objeto[3][3];
                }

                if($cantidad >= $objeto[4][0] && $cantidad <=  $objeto[4][1]){
                        return  $objeto[4][3];
                }

                // echo $objeto[0][0];

                // var_dump($objeto);
        }




}

?>
