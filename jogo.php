<?php
	require 'php/verifySession.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<link rel="icon" href="imagens/logounicamp.png" type="image/png">
		<title>Mirror Tetris</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<section id="choose_board">
			<div class="tetris_container" id="tetris_container">
				<div class="hero_area_curta">
					<!-- HEADER -->
					<a class="logo" href="index.html"><img class="logo" src="imagens/logounicamp.png" alt="Unicamp Maior e Melhor"></a>
					<header class="header_section">
						<nav class="custom_nav-container ">
							<div class="navbar-itens">
								<ul class="navbar-nav">
									<li class="nav-item active">
										<a class="nav-link" href="php/logout.php">Sair <img class="img-perfil" src="imagens/logout_icon.png" alt="ícone de logout"></a>
									</li>
									<li class="nav-item active">
										<a class="nav-link" href="perfil.php">Perfil <img class="img-perfil" src="imagens/perfil.png" alt="ícone de perfil"></a>
									</li>
								</ul>
							</div>
						</nav>
					</header>
				</div>
				<!-- HEADER MENU -->
				<div class="hero_area_curta">
					<header class="header_section">
						<nav class="custom_nav-container-left">
							<div class="navbar-itens">
								<ul class="navbar-nav-left">
									<li class="nav-item ">
										<a class="nav-link " href="menu.php">Menu</a>
									</li>
									<li class="nav-item ">
										<a class="nav-link " href="jogo.php">Jogar</a>
									</li>
									<li class="nav-item ">
										<a class="nav-link" href="rankingGlobal.php">Ranking Global</a>
									</li>
								</ul>
							</div>
						</nav>
					</header>
				</div>
				<!--Colocar 2 botões para selecionar os tamanhos de tabuleiro 1 para tabuleiro normal e 1 para o tabuleiro grande-->
				<div id="game-board-size-selector">
					<div id="selector">
						<h1>Selecione o tamanho do tabuleiro</h1>
						<button onclick="play_game(20, 10)">Tabuleiro Padrão<br>10x20</button>
						<button onclick="play_game(44, 22)" style="--c:#E95A49">Tabuleiro Extendido<br>22x44</button>
					</div>
				</div>

				<div class="footer_container">
					<section class="footer_content ">
						<ul class="footer-list">
							<li>
								<h3>Contato</h3>
							</li>
							<li>
								<a class="footer-link">Matheus Yudi Colli Issida</a>
							</li>
							<li>
								<a class="footer-link">Miguel Miranda Melo Donanzam</a>
							</li>
							<li>
								<a class="footer-link">Nícolas Canova Berton de Almeida</a>
							</li>
							<li>
								<a class="footer-link">Wilson Alberto Alves Junior</a>
							</li>
						</ul>
						<ul class="footer-list">
							<li>
								<h3>&nbsp;</h3>
							</li>
							<li>
								<a class="footer-link">(m260848@dac.unicamp.br)</a>
							</li>
							<li>
								<a class="footer-link">(m260851@dac.unicamp.br)</a>
							</li>
							<li>
								<a class="footer-link">(n260857@dac.unicamp.br)</a>
							</li>
							<li>
								<a class="footer-link">(w256598@dac.unicamp.br)</a>
							</li>
						</ul>
						<ul class="footer-list">
							<li>
								<h3>Endereço</h3>
							</li>
							<li>
								<a class="footer-link">R. Paschoal Marmo, 1888 - Jardim Nova Italia, Limeira - SP, 13484-332</a>
							</li>
						</ul>
						<ul class="footer-list">
							<li>
								<h3>Professor responsável</h3>
							</li>
							<li>
								<a class="footer-link">Prof. Guilherme Palermo Coelho</a>
							</li>
							<li>
								<a class="footer-link">(gpcoelho@unicamp.br)</a>
							</li>
						</ul>
						<ul class="footer-list">
							<li>
								<h3>Monitores</h3>
							</li>
							<li>
								<a class="footer-link">Caio Pereira Masseu (c256341@dac.unicamp.br)</a>
							</li>
							<li>
								<a class="footer-link">Felipe Eduardo Dos Santos Freire (f170240@dac.unicamp.br)</a>
							</li>
							<li>
								<a class="footer-link">Andrey Toshiro Okamura (a213119@dac.unicamp.br)</a>
							</li>
						</ul>
					</section>
					<footer class="footer_section">
						<p>
							&copy; Todos os Direitos Reservados para 
							<a href="https://www.ft.unicamp.br/">Faculdade de Tecnologia - Unicamp</a>
						</p>		
					</footer>
				</div>
			</div>
		</section>
		<a id="seta-voltar" href="jogo.php">
		</a>
		<section id="tetris_content" class="tetris_content">
			<div class="tetris-list">
				<div class="container-ranking">
					<table class="tabela-rank-pessoal">
						<thead>
							<tr>
								<th>Rank</th>
								<th>Username</th>
								<th>Pontuação</th>
								<th>Nível</th>
							</tr>
						</thead>
						<!-- PERSONAL RANKING -->
						<?php
							try {
								$username = $_SESSION["username"];

								$conn = new PDO("mysql:host=localhost;dbname=tetris", "root", "");

								$stmt = $conn->query("SELECT * FROM ranking WHERE username = '" . $username . "' ORDER BY pontuacao DESC LIMIT 10");

								$top10 = 1;

								while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
									echo "<tr>";
									echo "<td>" . $top10 . "</td>";
									echo "<td>" . $row["username"] . "</td>";
									echo "<td>" . $row["pontuacao"] . "</td>";
									echo "<td>" . $row["nivel"] . "</td>";
									echo "</tr>";
									$top10++;
								}


							} catch(PDOException $e) {
								echo "Ocorreu um erro: " . $e->getMessage();
							}
						?>
					</table>
				</div>
			</div>

			<div class="tetris-list">
				<canvas id="tetrisCanvas" width="200" height="400"></canvas>
				<script src="js/tetris.js"></script>
			</div>

			<div class="tetris-list">
				<div class="container-informacoes">
					<div class="prox-peca">
						<h3>Próxima Peça:</h3>
						<canvas id="nextPieceCanvas" width="180" height="180"></canvas>						
					</div>
					<div class="pontuacao">
						<h1 class="info-game">Pontos:&nbsp;</h1><h1 id="points" class="info-game">0</h1>
					</div>
					<div class="nivel-dificuldade">
						<h1 class="info-game">Nível:&nbsp;</h1><h1 id="level" class="info-game">1</h1>
					</div>							
					<div class="linhas-eliminadas">
						<h1 class="info-game">Linhas Eliminadas:&nbsp;</h1><h1 id="lines" class="info-game">0</h1>
					</div>
					<div class="tempo-de-partida">
						<h1 class="info-game">Tempo:&nbsp;</h1><h1 id="time" class="info-game">00:00</h1>
					</div>
				</div>
			</div>
		</section>
	</body>
</html>