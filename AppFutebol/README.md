# App de Futebol

Este é um aplicativo de futebol orientado a objetos desenvolvido para fins didáticos. O aplicativo permite gerenciar competições, clubes, jogadores, partidas e estatísticas.

## Estrutura do Projeto

O projeto segue o padrão de arquitetura MVC (Model-View-Controller):

### Model
- **Pessoa**: Classe abstrata base para pessoas (jogadores, treinadores)
- **Jogador**: Representa um jogador de futebol com estatísticas
- **Treinador**: Representa um treinador de futebol com estatísticas
- **Clube**: Representa um clube de futebol com jogadores e treinador
- **Estadio**: Representa um estádio de futebol
- **Competicao**: Representa uma competição de futebol
- **Partida**: Representa uma partida entre dois clubes
- **TraitId**: Trait para gerenciar IDs de objetos

### View
- **MainView**: Interface de usuário principal para interação com o aplicativo

### Controller
- **PartidaController**: Gerencia operações relacionadas a partidas
- **CompeticaoController**: Gerencia operações relacionadas a competições
- **JogadorController**: Gerencia operações relacionadas a jogadores

## Funcionalidades

1. **Adicionar resultado de partida**
   - Registrar o placar de uma partida
   - Registrar quais jogadores marcaram gols
   - Atualizar automaticamente a tabela da competição
   - Atualizar estatísticas dos jogadores

2. **Visualizar tabela de competição**
   - Ver a classificação dos clubes em uma competição
   - Visualizar pontos, jogos, vitórias, empates, derrotas, gols pró, gols contra e saldo de gols

3. **Visualizar estatísticas de jogadores**
   - Ver estatísticas de jogadores de um clube específico
   - Visualizar partidas, gols, assistências, cartões amarelos e cartões vermelhos

## Como Executar

1. Certifique-se de ter o PHP instalado (versão 7.0 ou superior)
2. Clone este repositório
3. Navegue até o diretório do projeto
4. Execute o comando: `php index.php`

## Exemplo de Uso

O aplicativo já vem com dados de exemplo para teste, incluindo:
- 4 clubes (Flamengo, Palmeiras, São Paulo e Internacional)
- 12 jogadores (3 para cada clube)
- 4 treinadores (um para cada clube)
- 1 competição (Brasileirão Série A)
- 4 partidas agendadas

Ao iniciar o aplicativo, você verá um menu com as seguintes opções:
1. Adicionar resultado de partida
2. Visualizar tabela de competição
3. Visualizar estatísticas de jogadores
4. Sair

## Melhorias Futuras

- Adicionar persistência de dados (banco de dados)
- Implementar interface gráfica
- Adicionar mais estatísticas para jogadores e partidas
- Implementar diferentes tipos de competições (copa, torneio, etc.)
- Adicionar funcionalidade para transferência de jogadores entre clubes