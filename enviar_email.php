<?php
// Habilita a exibição de erros para depuração (opcional, mas bom para desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verifica se a requisição é do tipo POST, o método correto para formulários
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Limpa e valida os dados recebidos do formulário para segurança
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_SPECIAL_CHARS);

    // Validação no lado do servidor: verifica se os campos não estão vazios e se o e-mail é válido
    if (empty($nome) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($telefone) || empty($mensagem)) {
        // Se a validação falhar, retorna um erro para o JavaScript
        http_response_code(400); // Código de erro "Bad Request"
        echo "Por favor, preencha todos os campos obrigatórios corretamente.";
        exit; // Interrompe a execução do script
    }

    /*
    / ATENÇÃO: A lógica de envio de e-mail foi removida temporariamente.
    / O script agora sempre retornará uma mensagem de sucesso se a validação passar.
    / Descomente e configure o PHPMailer aqui quando estiver pronto.
    */

    // Se a validação passar, retorna uma mensagem de sucesso para o JavaScript
    http_response_code(200); // Código de sucesso "OK"
    echo "Mensagem recebida com sucesso! Agradeço o seu contato.";

} else {
    // Se o acesso não for via POST, retorna um erro de acesso negado
    http_response_code(403); // Código de erro "Forbidden"
    echo "Acesso negado.";
}
?>
