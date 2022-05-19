<?php

require_once('../Modelo/Producto.php');//Incluir el modelo Producto
require_once('../Modelo/crudProducto.php');//Incluir el CRUD.
class controladorProducto{
    //Crear el constructor
      
    public function __construct(){
       //$Producto = new Producto(); //Instanciar un objeto Producto
       //$crudProducto = new crudProducto();//Instanciar crudProducto
    }

    public function listarProducto(){ 
       
       $crudProducto = new crudProducto();//Instanciar crudProducto
       $listaProducto = $crudProducto->listarProducto();//Listado de productos
       return $listaProducto;
    }

      //recive los valores del formulario, crea un objeto y envia la peticion al CRUD
      public function registrarProducto($e_nombre){
         //instanciacion del objeto
         $Producto = new Producto();//crear un objeto de tipo Producto
         // $categora->setid('');          //asignar el valor del formulario
         $Producto->setnombre($e_nombre);//setear es agregar valores a un objeto de una Producto

         //SOLICITAR AL MODELO QUE REALIZE LA INSERCION
         $crudProducto = new crudProducto();
         $mensaje = $crudProducto->registrarProducto($Producto);
         echo "
         <script>
            alert('$mensaje');
            document.location.href = '../Vista/listarProducto.php';
         </script>
         ";
      }

      public function buscarProducto($e_idProducto){
         $Producto = new Producto();
         $Producto->setid($e_idProducto);

         $crudProducto = new crudProducto();
         $datosProducto = $crudProducto->buscarProducto($Producto);

         var_dump($datosProducto);
         $Producto->setnombre($datosProducto['nombre']);
         return $Producto;
      }

      public function actualizarProducto($e_idProducto,$e_nombre){
         //instanciacion del objeto
         $Producto = new Producto();//crear un objeto de tipo Producto
         $Producto->setid($e_idProducto);          //asignar el valor del formulario
         $Producto->setnombre($e_nombre);//setear es agregar valores a un objeto de una Producto

         //SOLICITAR AL MODELO QUE REALIZE LA INSERCION
         $crudProducto = new crudProducto();
         $crudProducto->actualizarProducto($Producto);
      }


public function eliminarProducto($e_idProducto){
         //instanciacion del objeto
   $Producto = new Producto();//crear un objeto de tipo Producto
   $Producto->setid($e_idProducto);          //asignar el valor del formulario
   //$Producto->setnombre($e_nombre);//setear es agregar valores a un objeto de una Producto

   //SOLICITAR AL MODELO QUE REALIZE LA INSERCION
   $crudProducto = new crudProducto();
   $crudProducto->eliminarProducto($Producto);
}
      public function desplegarVista($pagina){

         header("Location:../Vista/".$pagina);
      }

}

//Probar el Controlador
$controladorProducto = new controladorProducto();
$listaProducto = $controladorProducto->listarProducto();//Verificar si se devuelven datos


//verificar la accion a realizar 
if (isset($_POST['Registrar'])){ //isset confirma si una variable existe
   echo "Registrando";
   $e_nombre = $_POST['nombre'];
   $controladorProducto->registrarProducto($e_nombre);
}

else if(isset($_POST['Editar'])){
   $e_idProducto = $_POST['idProducto'];
   //echo $e_idProducto;
   $controladorProducto->desplegarVista("editarProducto.php?idProducto=$e_idProducto");
}

else if(isset($_REQUEST['Actualizar'])){
   //Capturar valores enviados desde la vista
   $e_idProducto = $_REQUEST['id'];
   $e_nombre = $_REQUEST['nombre'];

   //Llamar el metodo actualizar()
   $controladorProducto->actualizarProducto($e_idProducto,$e_nombre);
 
}

else if(isset($_REQUEST['Eliminar'])){
   //Capturar valores enviados desde la vista
   $e_idProducto = $_REQUEST['idProducto'];
  

   //Llamar el metodo actualizar()
   $controladorProducto->eliminarProducto($e_idProducto);
}

else if(isset($_REQUEST['vista'])){
   $controladorProducto->desplegarVista($_REQUEST['vista']);
}




//Probar en el navegador

//Probar la creación de objetos
//crear o instanciar 1 objeto de la clase Producto.


/*
$Producto1 = new Producto();

var_dump($Producto1);
$Producto1->setid($_POST['id']);
$Producto1->setnombre($_POST['nombre']);
//var_dump($Producto1);
echo "<br>";
echo "El id de la Producto es: ".$Producto1->getid();
echo "<br>";
echo "El nombre de la Producto es: ".$Producto1->getnombre();

*/
?>