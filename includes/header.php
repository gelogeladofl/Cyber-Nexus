<?php 
// Verifica se já existe uma sessão ativa antes de iniciar
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'cyber_style.php';
?>

<header class="main-header">
    <div class="header-container" style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
        
        <!-- LOGO / IDENTITY HUD -->
        <a href="/aa/" class="logo" style="text-decoration: none; font-size: 1.2em; font-weight: bold; color: var(--neon-cyan);">
            <span class="logo-prefix" style="color: var(--neon-pink);">//</span> CYBER NEXUS
        </a>

        <!-- NAVEGAÇÃO PRINCIPAL -->
        <nav class="nav-menu">
            <ul style="list-style: none; display: flex; align-items: center; gap: 15px; margin: 0; padding: 0;">
                <li><a href="/aa/index.php" class="nav-link">INÍCIO</a></li>
                <li><a href="/aa/app/missao/index.php" class="nav-link">MISSÕES</a></li>
                <li><a href="/aa/app/implantes/index.php" class="nav-link">IMPLANTES</a></li>
                <li><a href="/aa/app/agentes/index.php" class="nav-link">AGENTES</a></li>
                
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <!-- Usuário Logado -->
                    <li>
                        <span style="color: var(--neon-cyan); font-family: 'Share Tech Mono', monospace;">
                            Operador: <strong><?= htmlspecialchars($_SESSION['usuario_apelido'] ?? '') ?></strong>
                        </span>
                    </li>
                    <li>
                        <a href="/aa/app/usuarios/logout.php" style="color: var(--neon-yellow); font-weight: bold; text-decoration: none;">[ SAIR ]</a>
                    </li>
                <?php else: ?>
                    <!-- Usuário Visitante -->
                    <li>
                        <a href="/aa/app/usuarios/index.php" style="color: var(--neon-cyan); text-decoration: none;">Acessar a Rede (Login)</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['usuario_nivel']) && strcasecmp(trim($_SESSION['usuario_nivel']), 'Admin') === 0): ?>
                    <li>
                        <a href="/aa/app/admin/dashboard.php" style="color: var(--neon-pink); font-weight: bold; text-decoration: none; text-shadow: 0 0 8px rgba(255, 0, 85, 0.4);">[ PAINEL ADMIN ]</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>
</header>