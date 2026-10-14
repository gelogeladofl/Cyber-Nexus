<style>
    /* Importação de fonte técnica/terminal */
    @import url('https://fonts.googleapis.com/css2?family=Share+Tech+Mono&family=Rajdhani:wght@500;600;700&display=swap');

    :root {
        --bg-deep: #080a0f;
        --bg-panel: #0d121d;
        --bg-panel-hover: #131b2c;
        --border-cyber: #1f304a;
        --neon-cyan: #00ffcc;
        --neon-pink: #ff0055;
        --neon-yellow: #fcee0a;
        --text-main: #c9d1d9;
        --text-dim: #8b949e;
    }

    /* Reset e Base */
    body {
        background-color: var(--bg-deep) !important;
        color: var(--text-main) !important;
        font-family: 'Rajdhani', sans-serif !important;
        background-image: 
            radial-gradient(circle at 50% 0%, rgba(0, 255, 204, 0.03) 0%, transparent 50%),
            linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.25) 50%);
        background-size: 100% 100%, 100% 4px;
        margin: 0;
        padding: 0;
    }

    /* Tipografia Estilo Terminal Wiki */
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Share Tech Mono', monospace !important;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    code, pre, .terminal-text {
        font-family: 'Share Tech Mono', monospace !important;
    }

    /* Cabeçalho / Navbar Estilo HUD Netrunner */
    header {
        background: var(--bg-panel);
        border-bottom: 2px solid var(--neon-cyan);
        box-shadow: 0 0 15px rgba(0, 255, 204, 0.15);
        padding: 12px 20px;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    header nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        flex-wrap: wrap;
        gap: 15px;
    }

    header nav a {
        color: var(--text-main);
        text-decoration: none;
        font-family: 'Share Tech Mono', monospace;
        font-size: 1.05em;
        padding: 6px 12px;
        border: 1px solid transparent;
        transition: all 0.2s ease-in-out;
    }

    header nav a:hover {
        color: var(--neon-cyan);
        border-color: var(--neon-cyan);
        background: rgba(0, 255, 204, 0.05);
        box-shadow: 0 0 8px rgba(0, 255, 204, 0.3);
    }

    /* Containers e Painéis Wiki */
    main, .cyber-container {
        max-width: 1100px;
        margin: 40px auto;
        background: var(--bg-panel);
        border: 1px solid var(--border-cyber);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.8), inset 0 0 15px rgba(0, 255, 204, 0.02);
        padding: 30px;
        position: relative;
    }

    /* Detalhe de canto cortado estilo cyberpunk */
    main::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        border-width: 0 15px 15px 0;
        border-style: solid;
        border-color: var(--neon-cyan) var(--bg-deep);
    }

    /* Tabelas de Dados Wiki */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: 'Share Tech Mono', monospace;
    }

    th {
        background: #111827;
        color: var(--neon-cyan);
        border: 1px solid var(--border-cyber);
        padding: 12px;
        text-align: left;
        letter-spacing: 1px;
    }

    td {
        border: 1px solid var(--border-cyber);
        padding: 12px;
        background: rgba(13, 18, 29, 0.5);
    }

    tr:hover td {
        background: var(--bg-panel-hover);
    }

    /* Botões Estilo Ação Netrunner */
    button, .btn-cyber {
        font-family: 'Share Tech Mono', monospace;
        background: transparent;
        border: 1px solid var(--neon-cyan);
        color: var(--neon-cyan);
        padding: 8px 16px;
        cursor: pointer;
        text-transform: uppercase;
        font-weight: bold;
        letter-spacing: 1px;
        transition: all 0.2s;
    }

    button:hover, .btn-cyber:hover {
        background: var(--neon-cyan);
        color: var(--bg-deep);
        box-shadow: 0 0 12px var(--neon-cyan);
    }

    .btn-danger {
        border-color: var(--neon-pink) !important;
        color: var(--neon-pink) !important;
    }

    .btn-danger:hover {
        background: var(--neon-pink) !important;
        color: white !important;
        box-shadow: 0 0 12px var(--neon-pink) !important;
    }

    /* Formulários e Inputs */
    input, select, textarea {
        background: var(--bg-deep) !important;
        border: 1px solid var(--border-cyber) !important;
        color: var(--text-main) !important;
        padding: 10px !important;
        font-family: 'Share Tech Mono', monospace !important;
        width: 100%;
        box-sizing: border-box;
        margin-top: 5px;
        margin-bottom: 15px;
    }

    input:focus, select:focus, textarea:focus {
        border-color: var(--neon-cyan) !important;
        outline: none;
        box-shadow: 0 0 8px rgba(0, 255, 204, 0.3);
    }

    /* Links Wiki Internos */
    a.wiki-link {
        color: var(--neon-cyan);
        text-decoration: none;
        border-bottom: 1px dotted var(--neon-cyan);
    }

    a.wiki-link:hover {
        color: #fff;
        background: rgba(0, 255, 204, 0.2);
    }
</style>