<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$response = null;
$erro = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valor = $_POST['valor'];
    $key = ftok(__DIR__ . '/ipc_keyfile', 'a');
    $queue = msg_get_queue($key);

    if (!$queue || !msg_send($queue, 1, $valor)) {
        $erro = true;
        $response = "❌ Erro ao enviar a mensagem para o daemon.";
    } else {
        $msg_type = null;
        if (!msg_receive($queue, 2, $msg_type, 1024, $response, true)) {
            $erro = true;
            $response = "❌ Erro ao receber resposta do daemon.";
        }
    }
} else {
    $erro = true;
    $response = "❌ Requisição inválida.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultado do Envio</title>
    <style>
        body {
            background-color: #f2f4f8;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 2rem 3rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        h1 {
            font-size: 1.6rem;
            color: #333;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.1rem;
            color: <?= $erro ? '#c0392b' : '#2e7d32' ?>;
            margin-bottom: 2rem;
        }

        a {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            font-size: 1rem;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }

        .footer {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Resultado do Envio</h1>
        <p><?= htmlspecialchars($response) ?></p>
        <a href="index.php">Voltar ao Formulário</a>
    </div>
</body>
</html>

