<?php
require_once __DIR__ . '/banco.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir'])) {
        excluirProduto((int) $_POST['excluir']);
    } else {
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $nome = trim($_POST['nome']);
        $preco = (float) $_POST['preco'];

        if ($id > 0) {
            atualizarProduto($id, $nome, $preco);
        } else {
            inserirProduto($nome, $preco);
        }
    }

    header('Location: cadastro.php');
    exit;
}

$produtoEdicao = null;
if (isset($_GET['editar'])) {
    $produtoEdicao = buscarProdutoPorId((int) $_GET['editar']);
}

$produtos = listarProdutos();
require __DIR__ . '/tela.php';