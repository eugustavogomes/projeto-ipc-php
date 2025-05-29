<?php
// Cria ou acessa a fla de mensagens IPC
$key = ftok(__DIR__ . '/ipc_keyfile', 'a');
$queue = msg_get_queue($key);

// Conecta ao banco PostgreSQL via PDO
try {
    $pdo = new PDO(
    "pgsql:host=localhost;port=5432;dbname=ipc_project",
    getenv("DB_USER"),
    getenv("DB_PASS")
);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

echo "Daemon iniciado. Aguardando mensagens...\n";

// Loop infinito: verifica mensagens a cadasegundo
while (true) {
    $message = null;
    $msg_type = null;

    if (msg_receive($queue, 0, $msg_type, 1024, $message, true, MSG_IPC_NOWAIT)) {
        echo "Mensagem recebida: $message\n";

        try {
            // Insere o valor recebido no banco
            $stmt = $pdo->prepare("INSERT INTO dados (valor) VALUES (:valor)");
            $stmt->execute([':valor' => $message]);

            $response = "✅ Dado inserido com sucesso no PostgreSQL!";
        } catch (Exception $e) {
            $response = "❌ Erro ao inserir: " . $e->getMessage();
        }

        // Envia resposta de volta a fila
        msg_send($queue, 2, $response);
    }

    sleep(1); // Espera 1 segundo antes de verificar de novo
}
?>
