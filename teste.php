<?php
$pdoSqliteAtivo = extension_loaded('pdo_sqlite');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#111a2b">
    <link rel="stylesheet" href="index.css">
    <title>Teste do ambiente PHP - Mini Loja</title>
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
                <a class="button button-small" href="cadastro.php">Produtos</a>
            </nav>
        </div>
    </header>
    <main class="container test-main">
        <a class="back-link" href="index.html"><span aria-hidden="true">←</span> Voltar ao início</a>
        <section class="panel test-panel">
            <p class="eyebrow page-eyebrow"><span class="eyebrow-dot"></span> DIAGNÓSTICO</p>
            <h1>Ambiente PHP<span class="heading-period">.</span></h1>
            <p class="test-description">Confira se o servidor está pronto para executar a Mini Loja.</p>
            <div class="status-row">
                <span>Versão do PHP</span>
                <strong><?php echo htmlspecialchars(PHP_VERSION, ENT_QUOTES, 'UTF-8'); ?></strong>
            </div>
            <div class="status-row">
                <span>Extensão pdo_sqlite</span>
                <strong class="status-pill <?php echo $pdoSqliteAtivo ? 'status-ok' : 'status-off'; ?>">
                    <span class="status-dot"></span>
                    <?php echo $pdoSqliteAtivo ? 'Ativa' : 'Inativa'; ?>
                </strong>
            </div>
            <a class="button test-button" href="cadastro.php">Ir para os produtos <span aria-hidden="true">→</span></a>
        </section>
    </main>
    <footer class="site-footer">
        <div class="container footer-inner">
            <span>MINI LOJA <span class="footer-separator">/</span> COMPONENTES ELETRÔNICOS</span>
            <span>Feito para boas ideias.</span>
        </div>
    </footer>
</body>
</html>
