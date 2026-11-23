<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111a2b">
    <link rel="stylesheet" href="index.css">
    <title>Produtos | Mini Loja</title>
</head>
<body class="store-page">
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="index.html" aria-label="Mini Loja, início">
                <span class="brand-mark" aria-hidden="true">M</span>
                <span>mini<span class="brand-accent">loja</span></span>
            </a>
            <nav class="site-nav" aria-label="Navegação principal">
                <a class="nav-link" href="index.html">Início</a>
                <a class="button button-small" href="teste.php">Ambiente PHP</a>
            </nav>
        </div>
    </header>

    <main class="container store-main">
        <div class="page-heading">
            <div>
                <p class="eyebrow page-eyebrow"><span class="eyebrow-dot"></span> PAINEL DA LOJA</p>
                <h1>Seus componentes<span class="heading-period">.</span></h1>
                <p>Cadastre e organize os produtos da sua loja.</p>
            </div>
            <a class="back-link" href="index.html"><span aria-hidden="true">←</span> Voltar ao início</a>
        </div>

        <div class="management-grid">
            <section class="panel form-panel">
                <div class="panel-heading">
                    <span class="panel-icon" aria-hidden="true"><?php echo $produtoEdicao !== null && !empty($produtoEdicao['id']) ? '↗' : '+'; ?></span>
                    <div>
                        <p class="panel-kicker">CATÁLOGO</p>
                        <h2><?php echo $produtoEdicao !== null && !empty($produtoEdicao['id']) ? 'Editar produto' : 'Novo produto'; ?></h2>
                    </div>
                </div>
                <p class="panel-description">Preencha os dados do componente abaixo.</p>
                <form action="cadastro.php" method="post" class="product-form">
                <input
                    type="hidden"
                    name="id"
                    value="<?php echo htmlspecialchars(isset($produtoEdicao['id']) ? (string) $produtoEdicao['id'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                >

                    <div class="form-field">
                    <label for="nome">Nome do produto</label>
                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        placeholder="Ex.: Placa ESP32"
                        required
                        value="<?php echo htmlspecialchars(isset($produtoEdicao['nome']) ? (string) $produtoEdicao['nome'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                    >
                    </div>
                    <div class="form-field">
                    <label for="preco">Preço <span>(R$)</span></label>
                    <input
                        type="number"
                        id="preco"
                        name="preco"
                        min="0"
                        step="0.01"
                        placeholder="0,00"
                        required
                        value="<?php echo htmlspecialchars(isset($produtoEdicao['preco']) ? (string) $produtoEdicao['preco'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                    >
                    </div>
                    <button class="button form-submit" type="submit">
                        <?php echo $produtoEdicao !== null && !empty($produtoEdicao['id']) ? 'Salvar alterações' : 'Cadastrar produto'; ?>
                        <span aria-hidden="true">→</span>
                    </button>
                <?php if ($produtoEdicao !== null && !empty($produtoEdicao['id'])): ?>
                    <a class="cancel-link" href="cadastro.php">Cancelar edição</a>
                <?php endif; ?>
                </form>
            </section>

            <section class="panel inventory-panel">
                <div class="inventory-heading">
                    <div>
                        <p class="panel-kicker">ESTOQUE</p>
                        <h2>Produtos cadastrados</h2>
                    </div>
                    <span class="count-badge"><?php echo count($produtos); ?> <span>itens</span></span>
                </div>
            <?php if (count($produtos) === 0): ?>
                    <div class="empty-state">
                        <span class="empty-icon" aria-hidden="true">＋</span>
                        <h3>Sua lista está vazia</h3>
                        <p>Cadastre seu primeiro componente usando o formulário.</p>
                    </div>
            <?php else: ?>
                    <ul class="product-list">
                    <?php foreach ($produtos as $produto): ?>
                        <li class="product-item">
                            <span class="product-icon" aria-hidden="true">⌘</span>
                            <div class="product-info">
                                <h3><?php echo htmlspecialchars($produto['nome'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                <span class="product-id">COMPONENTE #<?php echo (int) $produto['id']; ?></span>
                            </div>
                            <div class="product-price">
                                <span>PREÇO</span>
                                <strong>R$ <?php echo number_format((float) $produto['preco'], 2, ',', '.'); ?></strong>
                            </div>
                            <div class="product-actions">
                                <a class="action-link" href="cadastro.php?editar=<?php echo (int) $produto['id']; ?>">Editar</a>
                                <form action="cadastro.php" method="post" class="delete-form">
                                <button
                                    class="action-link action-delete"
                                    type="submit"
                                    name="excluir"
                                    value="<?php echo (int) $produto['id']; ?>"
                                >Excluir</button>
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
            <?php endif; ?>
            </section>
        </div>
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <span>MINI LOJA <span class="footer-separator">/</span> COMPONENTES ELETRÔNICOS</span>
            <a href="index.html">Voltar para o início</a>
        </div>
    </footer>
</body>
</html>
