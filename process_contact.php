<?php
// Configurações de recebimento
$to = "mborges.rs@gmail.com";
$subject = "Novo Contato - Landing Page BTI Tecnologia";

// Coleta de dados via POST com segurança básica
$nome = strip_tags($_POST['nome'] ?? '');
$empresa = strip_tags($_POST['empresa'] ?? '');
$telefone = strip_tags($_POST['telefone'] ?? '');
$mensagem = strip_tags($_POST['necessidade'] ?? '');

// Montagem do corpo do e-mail
$email_content = "Um novo contato foi enviado através da landing page:\n\n";
$email_content .= "Nome: $nome\n";
$email_content .= "Empresa: $empresa\n";
$email_content .= "Telefone: $telefone\n";
$email_content .= "Mensagem: $mensagem\n\n";
$email_content .= "--- Fim da Mensagem ---";

// Headers
$headers = "From: no-reply@btitecnologia.com.br" . "\r\n" .
    "Reply-To: mborges.rs@gmail.com" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

// Resposta JSON
header('Content-Type: application/json');

if (mail($to, $subject, $email_content, $headers)) {
    echo json_encode(["status" => "success", "message" => "E-mail enviado com sucesso."]);
} else {
    // Nota: A função mail() pode falhar em ambiente local se não houver SMTP configurado.
    // Retornamos sucesso mesmo assim para prosseguir com o redirecionamento do WhatsApp.
    echo json_encode(["status" => "error", "message" => "Falha ao enviar e-mail via servidor local."]);
}
?>
