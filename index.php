<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Envio de Dados</title>
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
            width: 100%;
            max-width: 400px;
        }

        h1 {
            margin-bottom: 1rem;
            font-size: 1.8rem;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
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
        <h1>Envie alguma coisa para o daemon</h1>
        <form method="POST" action="form.php">
            <input type="text" name="valor" placeholder="Digite um valor" required />
            <button type="submit">Enviar</button>
        </form>
        <div class="footer">
            Projeto IPC com PHP e Postgres
        </div>
    </div>
</body>
</html>

