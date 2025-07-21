<?php
// Habilita a exibição de erros para depuração (opcional, mas bom para desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica se a requisição é do tipo POST, o método correto para formulários
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Limpa os dados recebidos do formulário para segurança
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_SPECIAL_CHARS);

    // ALTERAÇÃO: Remove caracteres não numéricos do telefone para validação
    $telefoneDigits = preg_replace('/[^0-9]/', '', $telefone);

    // Validação no lado do servidor
    if (
        empty($nome) || 
        !filter_var($email, FILTER_VALIDATE_EMAIL) || 
        strlen($telefoneDigits) < 10 || // Verifica se o telefone tem pelo menos 10 dígitos
        empty($mensagem)
    ) {
        // Se a validação falhar, retorna um erro para o JavaScript
        http_response_code(400); // Código de erro "Bad Request"
        echo "Por favor, preencha todos os campos obrigatórios corretamente.";
        exit; // Interrompe a execução do script
    }


    // Se a validação passar, retorna uma mensagem de sucesso para o JavaScript
    http_response_code(200); // Código de sucesso "OK"
    echo "Mensagem recebida com sucesso! Agradeço o seu contato.";

} else {
    // Se o acesso não for via POST, retorna um erro de acesso negado
    http_response_code(403); // Código de erro "Forbidden"
    echo "Acesso negado.";
}
?>
