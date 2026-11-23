<?php

function conectarBanco()
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $pdo = new PDO('sqlite:' . __DIR__ . '/mini-loja.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS produtos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            preco REAL NOT NULL
        )'
    );

    $quantidade = (int) $pdo->query('SELECT COUNT(*) FROM produtos')->fetchColumn();
    if ($quantidade === 0) {
        $inserir = $pdo->prepare(
            'INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)'
        );
        $produtosIniciais = array(
            array('nome' => 'Placa ESP32', 'preco' => 39.90),
            array('nome' => 'Arduino Uno', 'preco' => 59.90),
            array('nome' => 'Sensor de temperatura DHT11', 'preco' => 12.50),
        );

        foreach ($produtosIniciais as $produto) {
            $inserir->execute($produto);
        }
    }

    return $pdo;
}

function listarProdutos()
{
    $consulta = conectarBanco()->query('SELECT id, nome, preco FROM produtos ORDER BY nome');

    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}

function buscarProdutoPorId($id)
{
    $consulta = conectarBanco()->prepare(
        'SELECT id, nome, preco FROM produtos WHERE id = :id'
    );
    $consulta->execute(array('id' => $id));
    $produto = $consulta->fetch(PDO::FETCH_ASSOC);

    return $produto === false ? null : $produto;
}

function inserirProduto($nome, $preco)
{
    $consulta = conectarBanco()->prepare(
        'INSERT INTO produtos (nome, preco) VALUES (:nome, :preco)'
    );
    $consulta->execute(array('nome' => $nome, 'preco' => $preco));
}

function atualizarProduto($id, $nome, $preco)
{
    $consulta = conectarBanco()->prepare(
        'UPDATE produtos SET nome = :nome, preco = :preco WHERE id = :id'
    );
    $consulta->execute(array('id' => $id, 'nome' => $nome, 'preco' => $preco));
}

function excluirProduto($id)
{
    $consulta = conectarBanco()->prepare('DELETE FROM produtos WHERE id = :id');
    $consulta->execute(array('id' => $id));
}
