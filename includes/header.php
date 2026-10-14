
<?php  session_start();?>
<?php 
// Teste de depuração (remover depois)
?>
<header class="main-header">
    <div class="header-container">
        
        <!-- LOGO / IDENTITY HUD -->
        <a href="/index.php" class="logo">
            <span class="logo-prefix">//</span> CYBER NEXUS
        </a>

        <!-- NAVEGAÇÃO PRINCIPAL -->
        <nav class="nav-menu">
            <ul>
                <li><a href="/index.php" class="nav-link">INÍCIO</a></li>
                <li><a href="/app/missao/index.php" class="nav-link">MISSÕES</a></li>
                <li><a href="/app/implantes/index.php" class="nav-link">IMPLANTES</a></li>
                <li><a href="/app/agentes/index.php" class="nav-link">AGENTES</a></li>
                <li><?php if (isset($_SESSION['usuario_id'])): ?>
                    <!-- Usuário Logado -->
                    <span style="color: #00ffcc; margin-left: 15px;">
                        Operador: <strong><?= htmlspecialchars($_SESSION['usuario_apelido']) ?></strong>
                    </span>
                    <a href="/app/usuarios/logout.php" style="color: #fcee0a; font-weight: bold; margin-left: 15px;">[ SAIR ]</a>
                <?php else: ?>
                    <!-- Usuário Visitante -->
                    <a href="/app/usuarios/index.php" style="color: #00ffcc; margin-left: 15px;">Acessar a Rede (Login)</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['usuario_nivel']) && $_SESSION['usuario_nivel'] === 'Admin'): ?>
                <a href="/app/admin/dashboard.php" style="color: red; font-weight: bold;">[ PAINEL ADMIN ]</a>
                <?php endif; ?>
                

            </ul>
            
        </nav>

    </div>
</header>

<main class="container">