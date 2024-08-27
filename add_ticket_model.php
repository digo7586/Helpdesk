<?php 
date_default_timezone_set('America/Sao_Paulo');

// Inclua os arquivos das classes necessárias
require_once 'Class/Department.php';
require_once 'Class/Users.php';

// Crie uma instância das classes
$user = new Users();

// Recupere o departamento e o email do usuário logado
$userDetails = $user->getUserInfo();
$emailUser = $userDetails['email'];
$departmentId = $userDetails['department'];



$setorrDetails = $user->getUserInfo();
$setorUser = $setorrDetails['department'];
// Função para obter o nome do departamento com base no ID do departamento
function getDepartmentNameById($departmentId) {
    // Conexão com o banco de dados (substitua essas configurações com as suas)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestao";

    // Cria uma conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Consulta SQL com prepared statement para obter o nome do departamento com base no ID fornecido
    $sql = "SELECT name FROM hd_departments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $departmentId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se a consulta retornou resultados
    if ($result->num_rows > 0) {
        // Retorna o nome do departamento encontrado
        $row = $result->fetch_assoc();
        return $row["name"];
    } else {
        return "Departamento Desconhecido"; // Retorna um valor padrão se o ID do departamento não for encontrado
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}


// Obter o nome do departamento com base no ID do departamento do usuário logado
$departmentName = getDepartmentNameById($departmentId);
?>




<div id="ticketModal" class="modal fade">
    <div class="modal-dialog">
        <form action="#" method="POST" id="ticketForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="bi bi-plus"></i> Abrir Chamado</h4>
                </div>
                <div class="modal-body">
                    <section class="emailMsg">
                        <div class="form-group mb-1">
                            <input type="hidden" class="form-control" id="email" name="email" value="<?= $emailUser ?>">
                            
                        </div>

                            <div class="form-group mb-1">
                                <label for="department" class="control-label mb-1">Ocorrência</label>
                                <select required id="priority" name="priority" class="form-control" style="background-color: #b3e4ff;">
                                    <option value="Selecione">Selecione</option>
                                    <?php $tickets->getpriority(); ?>
                                </select> 
                            </div>

                        <div class="form-group mb-1">
                            <label for="department" class="control-label mb-1">Setor</label>
                            
                            <input type="text" class="form-control" id="department" name="department" value="<?= $setorUser ?>" disabled>
                        </div>


                        <div class="form-group mb-1">
                            <label for="subject" class="control-label mb-1">Titulo</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        

                    <div class="form-group mb-1" style="display: none;">
                        <label for="departmentName" class="control-label mb-1">Setor</label>
                        <input type="text" class="form-control" id="departmentName" name="departmentName" value="<?= $departmentName ?>" disabled>
                    </div>


                  



                        <div class="form-group mb-1">
                            <label for="message" class="control-label">Mensagem</label>
                            <textarea class="form-control" rows="5" id="message" name="message" placeholder="Descreva..." required></textarea>
                        </div>    
                        
                        
                    </section>
                
                   
                    <div class="form-check form-check-inline">
                         <?php if (isset($_SESSION["admin"])) { ?>
                        <label for="status" class="form-check-label">Status/</label>
                        <label class="radio">
                            <input type="radio" name="status" id="open" value="0" required>Aberto
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                       
                            <label class="radio">
                                <input type="radio" name="status" id="close" value="2" required>Fechado
                            </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="radio">
                            <input type="radio" name="status" id="visto" value="1" required>Visualizado
                        </label>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="ticketId" id="ticketId" />
                    <input type="hidden" name="action" id="action" value="" />
                    <button type="submit" name="save" id="save" class="btn btn-primary" value="Save" onclick="myFunction()">Enviar</button>
                    

                         

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="js/notification.js"></script>
<script src="js/conrfirmedTicket.js"></script>
