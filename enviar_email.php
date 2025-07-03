<?php
// Habilita a exibição de erros para depuração (remova em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Limpa e valida os dados recebidos do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_SPECIAL_CHARS);

    // Validação no lado do servidor
    if (empty($nome) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($telefone) || empty($mensagem)) {
        http_response_code(400); // Bad Request
        echo "Por favor, preencha todos os campos obrigatórios corretamente.";
        exit;
    }

    // ATENÇÃO: Substitua pelo seu endereço de e-mail!
    $para = "joocortezz18@gmail.com "; 
    $assunto = "Nova mensagem do Portfólio de $nome";

    // Monta o corpo do e-mail
    $corpo_email = "Você recebeu uma nova mensagem do seu portfólio.\n\n";
    $corpo_email .= "Nome: " . $nome . "\n";
    $corpo_email .= "Email: " . $email . "\n";
    $corpo_email .= "Telefone: " . $telefone . "\n";
    $corpo_email .= "Mensagem:\n" . $mensagem . "\n";

    // Monta os cabeçalhos do e-mail
    $headers = "From: " . $nome . " <" . $email . ">" . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Tenta enviar o e-mail
    if (mail($para, $assunto, $corpo_email, $headers)) {
        http_response_code(200); // OK
        echo "Mensagem enviada com sucesso! Obrigado por entrar em contato.";
    } else {
        http_response_code(500); // Internal Server Error
        echo "Houve um erro no servidor ao tentar enviar a mensagem. Tente novamente mais tarde.";
    }

} else {
    http_response_code(403); // Forbidden
    echo "Acesso negado.";
}
?>
