<?php
class Aula extends DB
{
    public $aula_id;                // Identificador único del aula
    public $aula_nombre;            // Nombre del aula
    public $aula_numero_estudiantes; // Número de estudiantes en el aula
    public $aula_capacidad_maxima;  // Capacidad máxima del aula
    public $aula_tipo;              // Tipo del aula

    /**
     * Operación CRUD: Read (Leer)
     * Obtiene todos los registros de aulas.
     * Realiza una consulta SQL para seleccionar todas las filas de la tabla 'aulas'.
     */
    public static function all()
    {
        $db = new DB();
        try {
            $prepare = $db->prepare("SELECT * FROM aulas");
            $prepare->execute();
            // Retorna todos los registros como objetos Aula
            return $prepare->fetchAll(PDO::FETCH_CLASS, Aula::class);
        } catch (PDOException $e) {
            // Manejo básico de errores en caso de fallo en la consulta
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Operación CRUD: Read (Leer)
     * Encuentra un aula por su ID.
     * Realiza una consulta SQL para seleccionar un registro específico basado en el ID.
     * La vairable $id es el identificador del aula a buscar.
     * La parte return Aula | null se denota como el objeto Aula correspondiente al ID, o sino null si no se encuentra.
     */
    public static function find($id)
    {
        $db = new DB();
        try {
            $prepare = $db->prepare("SELECT * FROM aulas WHERE aula_id = :id");
            $prepare->execute([":id" => $id]);
            // Retorna el registro encontrado como un objeto Aula
            return $prepare->fetchObject(Aula::class);
        } catch (PDOException $e) {
            // Manejo básico de errores en caso de fallo en la consulta
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Operación CRUD: Create (Crear) y Update (Actualizar)
     * Guarda el aula en la base de datos.
     * Si el ID del aula está vacío, realiza una inserción; de lo contrario, realiza una actualización.
     */
    public function save()
    {
        $db = new DB();
        $params = [
            ":aula_nombre" => $this->aula_nombre,
            ":aula_numero_estudiantes" => $this->aula_numero_estudiantes,
            ":aula_capacidad_maxima" => $this->aula_capacidad_maxima,
            ":aula_tipo" => $this->aula_tipo
        ];

        try {
            if (empty($this->aula_id)) {
                // Operación CRUD: Create (Crear)
                // Insertar un nuevo registro en la tabla 'aulas'
                $prepare = $db->prepare("INSERT INTO aulas (aula_nombre, aula_numero_estudiantes, aula_capacidad_maxima, aula_tipo) VALUES (:aula_nombre, :aula_numero_estudiantes, :aula_capacidad_maxima, :aula_tipo)");
                $prepare->execute($params);
                // Obtener el ID del nuevo registro insertado
                $this->aula_id = $db->lastInsertId();
            } else {
                // Operación CRUD: Update (Actualizar)
                // Actualizar un registro existente en la tabla 'aulas'
                $params[":aula_id"] = $this->aula_id;
                $prepare = $db->prepare("UPDATE aulas SET aula_nombre = :aula_nombre, aula_numero_estudiantes = :aula_numero_estudiantes, aula_capacidad_maxima = :aula_capacidad_maxima, aula_tipo = :aula_tipo WHERE aula_id = :aula_id");
                $prepare->execute($params);
            }
        } catch (PDOException $e) {
            // Manejo básico de errores en caso de fallo en la consulta
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Operación CRUD: Delete (Eliminar)
     * Elimina el aula de la base de datos.
     * Realiza una consulta SQL para eliminar el registro con el ID especificado.
     */
    public function remove()
    {
        $db = new DB();
        try {
            // Operación CRUD: Delete (Eliminar)
            $prepare = $db->prepare("DELETE FROM aulas WHERE aula_id = :aula_id");
            $prepare->execute([":aula_id" => $this->aula_id]);
        } catch (PDOException $e) {
            // Manejo básico de errores en caso de fallo en la consulta
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
