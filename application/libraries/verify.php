<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

class Verify {
   //funciones que queremos implementar en Miclase.
   function seccion($rolsecc, $rol){


           $rol_seccion = $rolsecc;
           $rol_user = $rol;


           if($rol_seccion==$rol_user){
                   return true;
           }else{

                   switch ($rol_user) {
                           case 1:
                                   redirect('admin', 'refresh');
                                   break;
                           case 2:
                                   //Registro de accion
                                   redirect('home', 'refresh');
                                   break;
                           case 3:
                                   redirect('consultams', 'refresh');
                                   break;
                           case 4:
                                   redirect('consultasup', 'refresh');
                                   break;
                           default:
                                   redirect('home', 'refresh');
                   }

           }
   }

   function seccionHome($rol){
           if($rol == 2){
                   return true;
           }else{
                   redirect('error', 'refresh');
           }
   }


   function refresh404($rol){
           switch ($rol) {
                   case 1:
                           redirect('admin', 'refresh');
                           break;
                   case 2:
                           //Registro de accion
                           redirect('home', 'refresh');
                           break;
                   case 3:
                           redirect('consultams', 'refresh');
                           break;
                   case 4:
                           redirect('consultasup', 'refresh');
                           break;
                   default:
                           redirect('login', 'refresh');
           }

   }


   function seccionLocal($rolsecc, $rol){


           $rol_seccion = $rolsecc;
           $rol_user = $rol;


           if($rol_seccion==$rol_user){
                   return true;
           }else{

                   switch ($rol_user) {
                           case 1:
                                   redirect('admin', 'refresh');
                                   break;
                           case 2:
                                   //Registro de accion
                                   redirect('home', 'refresh');
                                   break;
                           case 3:
                                   redirect('consultams', 'refresh');
                                   break;
                           case 4:
                                   redirect('consultasup', 'refresh');
                                   break;
                           default:
                                   redirect('login', 'refresh');
                   }

           }
   }


}

?>
