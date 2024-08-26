<?php
class AulasController {

    /**
     * Muestra una lista de todas las aulas.
     * Realiza una operación de lectura (Read) usando el método all() del modelo Aula.
     */
    public function index()
    {
        // Obtiene todos los registros de las aulas usando el método estático all() del modelo Aula.
        $aulas = Aula::all();
        // Llama a la función view() para renderizar la vista con los datos obtenidos.
        view("aulas.index", ["aulas" => $aulas]);
    }

    /**
     * Muestra una página para crear una nueva aula.
     * Este método es un placeholder para la vista de creación en las aulas.
     */
    public function crear()
    {
        // Muestra un mensaje indicando que estamos en la etapa de creación de una aula.
        echo "Estamos en crear aula";
    }

    /**
     * Crea una nueva aula en la base de datos.
     * Realiza una operación de creación (Create) usando el método save() del modelo Aula.
     */
    public function create()
    {
        // Lee el JSON de la entrada HTTP y lo decodifica en un objeto PHP.
        $data = json_decode(file_get_contents('php://input'));
        
        // Crea una nueva instancia de la clase Aula.
        $aula = new Aula();
        // Asigna los valores recibidos a los atributos del objeto Aula.
        $aula->aula_nombre = $data->aula_nombre;
        $aula->aula_numero_estudiantes = $data->aula_numero_estudiantes;
        $aula->aula_capacidad_maxima = $data->aula_capacidad_maxima;
        $aula->aula_tipo = $data->aula_tipo;
        
        // Llama al método save() para insertar el nuevo registro en la base de datos.
        $aula->save();
        
        // Devuelve el objeto Aula como una respuesta JSON.
        echo json_encode($aula);
    }

    /**
     * Actualiza un aula existente en la base de datos.
     * Realiza una operación de actualización (Update) usando el método save() del modelo Aula.
     */
    public function update()
    {
        // Lee el JSON de la entrada HTTP y lo decodifica en un objeto PHP.
        $data = json_decode(file_get_contents('php://input'));
        
        // Busca la aula existente usando el método estático find() del modelo Aula.
        $aula = Aula::find($data->aula_id);
        
        // Asigna los nuevos valores a los atributos del objeto Aula.
        $aula->aula_nombre = $data->aula_nombre;
        $aula->aula_numero_estudiantes = $data->aula_numero_estudiantes;
        $aula->aula_capacidad_maxima = $data->aula_capacidad_maxima;
        $aula->aula_tipo = $data->aula_tipo;
        
        // Llama al método save() para actualizar el registro existente en la base de datos.
        $aula->save();
        
        // Devuelve el objeto Aula actualizado como una respuesta JSON.
        echo json_encode($aula);
    }

    /**
     * Elimina una aula existente en la base de datos.
     * Realiza una operación de eliminación (Delete) usando el método remove() del modelo Aula.
     * $id es el identificador de la aula a eliminar.
     */
    public function delete($id)
    {
        try {
            // Busca la aula existente usando el método estático find() del modelo Aula.
            $aula = Aula::find($id);
            
            // Llama al método remove() para eliminar el registro de la base de datos.
            $aula->remove();
            
            // Devuelve un estado de éxito como respuesta JSON.
            echo json_encode(['status' => true]);
        } catch (\Exception $e) {
            // Devuelve un estado de error en caso de excepción.
            echo json_encode(['status' => false]);
        }
    }
}
?>