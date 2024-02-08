<?php   
    class DBManager {
        private $conn;
    
        public function __construct() {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "todo";
    
            // Create connection
            $this->conn = new mysqli($servername, $username, $password, $dbname);
    
            // Check connection
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }
    
        public function create($id_user, $descrizione) {
            $sql = "INSERT INTO task  (`id`, `User_id`, `Descrizione`, `Data`, `Completato`) VALUES (NULL, ?, ?, 2024-02-23, 0)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("is", $id_user, $descrizione); // usa il tipo di dato s per entrambi i parametri            
            $stmt->execute();
            $stmt->close();
        }
    
        public function update($id, $id_user, $descrizione) {
            $sql = "UPDATE task SET Descrizione = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $descrizione, $id); // usa il tipo di dato s per entrambi i parametri
            if ($stmt->execute()) { // controlla se la query ha avuto successo
                echo "task aggiornata con successo";
            } else {
                echo "Errore nell'aggiornare la task: " . $stmt->error;
            }
            $stmt->close();
        }

    
        public function delete($id) {
            $sql = "DELETE FROM task WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        public function getTasks($id) {
            // Creare una query SQL per ottenere tutti i task
            $sql = "SELECT * FROM task where User_id = $id";
        
            // Preparare la query SQL
            $stmt = $this->conn->prepare($sql);
        
            // Eseguire la query
            $stmt->execute();
        
            // Ottenere i risultati
            $result = $stmt->get_result();
            $tasks = $result->fetch_all(MYSQLI_ASSOC);
        
            return $tasks;
        }
        
    
        public function __destruct() {
            $this->conn->close();
        }
    }
    
?>