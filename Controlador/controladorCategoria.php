<?php

require_once('../Modelo/Categoria.php');//Incluir el modelo Categoria
require_once('../Modelo/crudCategoria.php');//Incluir el CRUD.
class controladorCategoria{
    //Crear el constructor
      
    public function __construct(){
       //$categoria = new Categoria(); //Instanciar un objeto categoria
       //$crudCategoria = new crudCategoria();//Instanciar crudCategoria
    }

    public function listarCategoria(){ //READ
       //Llamar el método listarCategoria del crudCategoria.
       $crudCategoria = new crudCategoria();//Instanciar crudCategoria
       $listaCategoria = $crudCategoria->listarCategoria();//Listado de categorias
       return $listaCategoria;
    }

      //recive los valores del formulario, crea un objeto y envia la peticion al CRUD
      public function registrarCategoria($e_nombre){
         //instanciacion del objeto
         $categoria = new Categoria();//crear un objeto de tipo categoria
         // $categora->setid('');          //asignar el valor del formulario
         $categoria->setnombre($e_nombre);//setear es agregar valores a un objeto de una categoria

         //SOLICITAR AL MODELO QUE REALIZE LA INSERCION
         $crudCategoria = new crudCategoria();
         $mensaje = $crudCategoria->registrarCategoria($categoria);
         echo "
         <script>
            alert('$mensaje');
            document.location.href = '../Vista/listarCategoria.php';
         </script>
         ";
      }

      public function buscarCategoria($e_idCategoria){
         $categoria = new Categoria();
         $categoria->setid($e_idCategoria);

         $crudCategoria = new crudCategoria();
         $datosCategoria = $crudCategoria->buscarCategoria($categoria);

         var_dump($datosCategoria);
         $categoria->setnombre($datosCategoria['nombre']);
         return $categoria;
      }

      public function actualizarCategoria($e_idCategoria,$e_nombre){
         //instanciacion del objeto
         $categoria = new Categoria();//crear un objeto de tipo categoria
         $categoria->setid($e_idCategoria);          //asignar el valor del formulario
         $categoria->setnombre($e_nombre);//setear es agregar valores a un objeto de una categoria

         //SOLICITAR AL MODELO QUE REALIZE LA INSERCION
         $crudCategoria = new crudCategoria();
         $crudCategoria->actualizarCategoria($categoria);
      }


public function eliminarCategoria($e_idCategoria){
         //instanciacion del objeto
   $categoria = new Categoria();//crear un objeto de tipo categoria
   $categoria->setid($e_idCategoria);          //asignar el valor del formulario
   //$categoria->setnombre($e_nombre);//setear es agregar valores a un objeto de una categoria

   //SOLICITAR AL MODELO QUE REALIZE LA INSERCION
   $crudCategoria = new crudCategoria();
   $crudCategoria->eliminarCategoria($categoria);
}
      public function desplegarVista($pagina){

         header("Location:../Vista/".$pagina);
      }

}

//Probar el Controlador
$controladorCategoria = new controladorCategoria();
$listaCategoria = $controladorCategoria->listarCategoria();//Verificar si se devuelven datos


//verificar la accion a realizar 
if (isset($_POST['Registrar'])){ //isset confirma si una variable existe
   echo "Registrando";
   $e_nombre = $_POST['nombre'];
   $controladorCategoria->registrarCategoria($e_nombre);
}

else if(isset($_POST['Editar'])){
   $e_idCategoria = $_POST['idCategoria'];
   //echo $e_idCategoria;
   $controladorCategoria->desplegarVista("editarCategoria.php?idCategoria=$e_idCategoria");
}

else if(isset($_REQUEST['Actualizar'])){
   //Capturar valores enviados desde la vista
   $e_idCategoria = $_REQUEST['id'];
   $e_nombre = $_REQUEST['nombre'];

   //Llamar el metodo actualizar()
   $controladorCategoria->actualizarCategoria($e_idCategoria,$e_nombre);
 
}

else if(isset($_REQUEST['Eliminar'])){
   //Capturar valores enviados desde la vista
   $e_idCategoria = $_REQUEST['idCategoria'];
  

   //Llamar el metodo actualizar()
   $controladorCategoria->eliminarCategoria($e_idCategoria);
}

else if(isset($_REQUEST['vista'])){
   $controladorCategoria->desplegarVista($_REQUEST['vista']);
}




//Probar en el navegador

//Probar la creación de objetos
//crear o instanciar 1 objeto de la clase Categoria.


/*
$categoria1 = new Categoria();

var_dump($categoria1);
$categoria1->setid($_POST['id']);
$categoria1->setnombre($_POST['nombre']);
//var_dump($categoria1);
echo "<br>";
echo "El id de la categoria es: ".$categoria1->getid();
echo "<br>";
echo "El nombre de la categoria es: ".$categoria1->getnombre();

*/
?>