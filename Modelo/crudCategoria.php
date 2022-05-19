<?php
//APLICACIONES TRANSACCIONALES 
//CRUD : CREATE=crear / READ=leer / UPDATE=modificar / DELET=eliminar

require_once('conexion.php');//Incluir el archivo conexión
class crudCategoria{
    public function __construct(){
    }

    //Método para consultar todas las categorías
    //de la base de datos.
    public function listarCategoria(){ //READ

      //Establecer la conexión a la base datos
      $baseDatos = Conexion::conectar();
      //Definir la sentencia sql
      $sql = $baseDatos->query('SELECT * FROM categoria ORDER BY idCategoria ASC');
      //Ejecutar la consulta
      $sql->execute();
      //Cerrar la conexión
      Conexion::desconectar($baseDatos);
      //Retornar el resultado de la consulta a la tabla.
      return($sql->fetchAll());//Retornar el resultado de la consulta
    }

    public function registrarCategoria($categoria){//UPDATE
      $mensaje = "";  // Declarar variable llamada mensaje
      $baseDatos = Conexion::conectar();

        $sql = $baseDatos->prepare('INSERT INTO
        categoria(idCategoria,nombre)
        VALUES(:e_idCategoria,:e_nombre) 
        ');
        //e: = dato de entrada (versatil, pero se le deve de colocar los atributos para no generar confuciones en el futuro) / se define la tabla y sus atributos

        //las siguientes lineas capturan los valores de los atributos del objeto
        //del objeto categoria ('e_idCategoria' se almacena lo que hay en $categoria->getidCategoria) y ()
        $sql->bindValue('e_idCategoria', $categoria->getidCategoria());
        $sql->bindValue('e_nombre', $categoria->getnombre());

       



        try{ 
          $sql->execute(); //esto se ejecuta si todo sale bien 
          $mensaje = "registro exitoso";

        }catch(Exception $excepcion){
          //se usa para capturar ecepciones ecepciones son : id iguales, base de datos mal nombrada etc
          //exepciones que no se pueden controlar
          $mensaje = "Problemas en el registro";

          echo $excepcion->getMessage();//funcion reserbada de php sirve para imprimir mensajes de error
        }

        Conexion::desconectar($baseDatos);//siempre se cierra la conexion 
        return $mensaje;
    }


    public function buscarCategoria($categoria){ //READ

      //Establecer la conexión a la base datos
      $baseDatos = Conexion::conectar();
      //Definir la sentencia sql
      $sql = $baseDatos->query("SELECT * FROM categoria WHERE idCategoria=".$categoria->getidCategoria());
      //Ejecutar la consulta
      $sql->execute();
      //Cerrar la conexión
      Conexion::desconectar($baseDatos);
      //Retornar el resultado de la consulta a la tabla.
      return($sql->fetch());//Retornar el resultado de la consulta
    }

    public function actualizarCategoria($categoria){      //UPDATE

      $baseDatos = Conexion::conectar();

        $sql = $baseDatos->prepare('UPDATE
        categoria SET nombre =:e_nombre WHERE idCategoria=:e_idCategoria');
        
        //las siguientes lineas capturan los valores de los atributos del objeto
        //del objeto categoria ('e_idCategoria' se almacena lo que hay en $categoria->getidCategoria) y ()
        $sql->bindValue('e_idCategoria', $categoria->getidCategoria());
        $sql->bindValue('e_nombre', $categoria->getnombre());

       



        try{ 
          $sql->execute(); //esto se ejecuta si todo sale bien 
          echo "Actualizacion exitosa";
          header("Location:../Vista/listarCategoria.php");

        }catch(Exception $excepcion){
          //se usa para capturar ecepciones ecepciones son : id iguales, base de datos mal nombrada etc
          //exepciones que no se pueden controlar

          echo $excepcion->getMessage();//funcion reserbada de php sirve para imprimir mensajes de error
          echo "Problemas de actualizacion";
        }

        Conexion::desconectar($baseDatos);//siempre se cierra la conexion 
    }

    public function eliminarCategoria($categoria){//UPDATE

      $baseDatos = Conexion::conectar();

        $sql = $baseDatos->prepare('DELETE FROM
        categoria WHERE idCategoria=:e_idCategoria');
        
        //las siguientes lineas capturan los valores de los atributos del objeto
        //del objeto categoria ('e_idCategoria' se almacena lo que hay en $categoria->getidCategoria) y ()
        $sql->bindValue('e_idCategoria', $categoria->getidCategoria());
        

        try{ 
          $sql->execute(); //esto se ejecuta si todo sale bien 
          echo "Eliminacion exitosa";
          header("Location:../Vista/listarCategoria.php");

        }catch(Exception $excepcion){
          //se usa para capturar ecepciones ecepciones son : id iguales, base de datos mal nombrada etc
          //exepciones que no se pueden controlar

          echo $excepcion->getMessage();//funcion reserbada de php sirve para imprimir mensajes de error
          echo "Problemas de actualizacion";
        }

        Conexion::desconectar($baseDatos);//siempre se cierra la conexion 
    }
}



?>