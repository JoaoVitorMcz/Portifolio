<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = htmlspecialchars(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
    $email = htmlspecialchars(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $telefone = htmlspecialchars(filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING));
    $mensagem = htmlspecialchars(filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING));

    // ALTERADO: Adicionado 'telefone' à validação do servidor
    if (empty($nome) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($telefone) || empty($mensagem)) {
        http_response_code(400);
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;
    }

    $para = "seu-email-de-destino@exemplo.com";
    $assunto = "Nova mensagem do Portfólio de $nome";

    $corpo_email = "Você recebeu uma nova mensagem através do formulário de contato do seu site.\n\n";
    $corpo_email .= "Nome: " . $nome . "\n";
    $corpo_email .= "Email: " . $email . "\n";
    $corpo_email .= "Telefone: " . $telefone . "\n";
    $corpo_email .= "Mensagem:\n" . $mensagem . "\n";

    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($para, $assunto, $corpo_email, $headers)) {
        http_response_code(200);
        echo "Mensagem enviada com sucesso!";
    } else {
        http_response_code(500);
        echo "Houve um erro ao enviar a mensagem. Tente novamente mais tarde.";
    }

} else {
    http_response_code(403);
    echo "Acesso negado.";
}
?>