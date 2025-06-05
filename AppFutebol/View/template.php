<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Futebol</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; }
        .section { background: white; margin: 20px 0; padding: 20px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .form-group { margin: 10px 0; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, button { padding: 8px; margin: 5px 0; border: 1px solid #ddd; border-radius: 3px; }
        button { background: #007bff; color: white; cursor: pointer; }
        button:hover { background: #0056b3; }
        .message { padding: 10px; margin: 10px 0; border-radius: 3px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-warning { background: #fff3cd; color: #856404; border: 1px solid #ffeaa7; padding: 10px; border-radius: 3px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        h1 { color: #333; text-align: center; }
        h2 { color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 5px; }

        /* Estilos para a tabela */
        .tabela-competicao { margin-top: 20px; }
        .tabela-competicao h3 { color: #007bff; margin-bottom: 15px; text-align: center; }
        .tabela-competicao table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .tabela-competicao th, .tabela-competicao td {
            padding: 12px 8px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .tabela-competicao th {
            background: #007bff;
            color: white;
            font-weight: bold;
        }
        .tabela-competicao tbody tr:nth-child(even) {
            background: #f8f9fa;
        }
        .tabela-competicao tbody tr:hover {
            background: #e3f2fd;
        }
        .tabela-competicao td:nth-child(2) {
            text-align: left;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>⚽ App Futebol</h1>

    <?php if ($this->getMessage()): ?>
        <div class="message <?= strpos($this->getMessage(), 'Erro') === 0 ? 'error' : 'success' ?>">
            <?= htmlspecialchars($this->getMessage()) ?>
        </div>
    <?php endif; ?>

    <div class="grid">
        <!-- Criar Estádio -->
        <div class="section">
            <h2>🏟️ Adicionar Estádio</h2>
            <form method="POST">
                <input type="hidden" name="action" value="criar_estadio">
                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" required>
                </div>
                <div class="form-group">
                    <label>País:</label>
                    <input type="text" name="pais" required>
                </div>
                <button type="submit">Adicionar Estádio</button>
            </form>
        </div>

        <!-- Criar Clube -->
        <div class="section">
            <h2>🏆 Adicionar Clube</h2>
            <form method="POST">
                <input type="hidden" name="action" value="criar_clube">
                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" required>
                </div>
                <div class="form-group">
                    <label>País:</label>
                    <input type="text" name="pais" required>
                </div>
                <div class="form-group">
                    <label>Estádio:</label>
                    <select name="estadio_id" required>
                        <option value="">Selecione um estádio</option>
                        <?php foreach ($this->getEstadios() as $e): ?>
                            <option value="<?= $e->getId() ?>"><?= htmlspecialchars($e->getNome()) ?> (<?= htmlspecialchars($e->getPais()) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit">Adicionar Clube</button>
            </form>
        </div>

        <!-- Criar Jogador -->
        <div class="section">
            <h2>👤 Adicionar Jogador</h2>
            <form method="POST">
                <input type="hidden" name="action" value="criar_jogador">
                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" required>
                </div>
                <div class="form-group">
                    <label>Nacionalidade:</label>
                    <input type="text" name="nacionalidade" required>
                </div>
                <div class="form-group">
                    <label>Data de Nascimento:</label>
                    <input type="date" name="nascimento" required>
                </div>
                <div class="form-group">
                    <label>Posição:</label>
                    <select name="posicao" required>
                        <option value="Goleiro">Goleiro</option>
                        <option value="Zagueiro">Zagueiro</option>
                        <option value="Lateral Direito">Lateral Direito</option>
                        <option value="Lateral Esquerdo">Lateral Esquerdo</option>
                        <option value="Volante">Volante</option>
                        <option value="Meio-campo">Meio-campo</option>
                        <option value="Atacante">Atacante</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pé Dominante:</label>
                    <select name="pe_dominante" required>
                        <option value="Direito">Direito</option>
                        <option value="Esquerdo">Esquerdo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Altura (m):</label>
                    <input type="number" step="0.01" name="altura" required>
                </div>
                <div class="form-group">
                    <label>Peso (kg):</label>
                    <input type="number" step="0.1" name="peso" required>
                </div>
                <button type="submit">Adicionar Jogador</button>
            </form>
        </div>

        <!-- Criar Competição -->
        <div class="section">
            <h2>🏅 Adicionar Competição</h2>
            <form method="POST">
                <input type="hidden" name="action" value="criar_competicao">
                <div class="form-group">
                    <label>Nome:</label>
                    <input type="text" name="nome" required>
                </div>
                <div class="form-group">
                    <label>Número de Clubes:</label>
                    <input type="number" name="num_clubes" required>
                </div>
                <div class="form-group">
                    <label>País:</label>
                    <input type="text" name="pais" required>
                </div>
                <div class="form-group">
                    <label>Tipo:</label>
                    <select name="tipo" required>
                        <option value="regional">Regional</option>
                        <option value="estadual">Estadual</option>
                        <option value="nacional">Nacional</option>
                        <option value="continental">Continental</option>
                        <option value="mundial">Mundial</option>
                    </select>
                </div>
                <button type="submit">Adicionar Competição</button>
            </form>
        </div>

        <!-- Adicionar Clube à Competição -->
        <div class="section">
            <h2>➕ Adicionar Clube à Competição</h2>
            <form method="POST">
                <input type="hidden" name="action" value="adicionar_clube_competicao">
                <div class="form-group">
                    <label>Competição:</label>
                    <select name="competicao_id" required>
                        <option value="">Selecione uma competição</option>
                        <?php foreach ($this->getCompeticoes() as $c): ?>
                            <option value="<?= $c->getId() ?>"><?= htmlspecialchars($c->getNome()) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Clube:</label>
                    <select name="clube_id" required>
                        <option value="">Selecione um clube</option>
                        <?php foreach ($this->getClubes() as $clube): ?>
                            <option value="<?= $clube->getId() ?>"><?= htmlspecialchars($clube->getNome()) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit">Adicionar Clube</button>
            </form>
        </div>

        <!-- Registrar Resultado -->
        <div class="section">
            <h2>⚽ Registrar Resultado</h2>
            <form method="POST">
                <input type="hidden" name="action" value="finalizar_partida">
                <div class="form-group">
                    <label>Competição:</label>
                    <select name="competicao_id" required>
                        <option value="">Selecione uma competição</option>
                        <?php foreach ($this->getCompeticoes() as $c): ?>
                            <option value="<?= $c->getId() ?>"><?= htmlspecialchars($c->getNome()) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Clube da Casa:</label>
                    <select name="clube_casa_id" required>
                        <option value="">Selecione o clube da casa</option>
                        <?php foreach ($this->getClubes() as $clube): ?>
                            <option value="<?= $clube->getId() ?>"><?= htmlspecialchars($clube->getNome()) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Clube Visitante:</label>
                    <select name="clube_visitante_id" required>
                        <option value="">Selecione o clube visitante</option>
                        <?php foreach ($this->getClubes() as $clube): ?>
                            <option value="<?= $clube->getId() ?>"><?= htmlspecialchars($clube->getNome()) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Gols da Casa:</label>
                    <input type="number" name="gols_casa" min="0" required>
                </div>
                <div class="form-group">
                    <label>Gols Visitante:</label>
                    <input type="number" name="gols_visitante" min="0" required>
                </div>
                <button type="submit">Registrar Resultado</button>
            </form>
        </div>
    </div>

    <!-- Visualizar Tabela -->
    <div class="section" align="center">
        <h2>📊 Visualizar Tabela de Competição</h2>
        <form method="GET">
            <div class="form-group">
                <label>Competição:</label>
                <select name="competicao_id" required>
                    <option value="">Selecione uma competição</option>
                    <?php foreach ($this->getCompeticoes() as $c): ?>
                        <option value="<?= $c->getId() ?>" <?= (isset($_GET['competicao_id']) && $_GET['competicao_id'] == $c->getId()) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c->getNome()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="ver_tabela" value="1">Mostrar Tabela</button>
        </form>

        <?php if (isset($tabelaOutput) && !empty($tabelaOutput)): ?>
            <?= $tabelaOutput ?>
        <?php endif; ?>
    </div>
</div>
</body>
</html>