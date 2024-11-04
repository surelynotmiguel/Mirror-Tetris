<?php
	require 'php/verifySession.php';
?>

<!DOCTYPE html>
<html lang="pt">
	<head>
		<link rel="icon" href="imagens/logounicamp.png" type="image/png">
		<title>Mirror Tetris - Ranking</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<!-- HEADER LOGIN -->
		<div id="page-container">
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
		</div>
		<!-- FIM HEADERS -->
		<!-- CONTEUDO -->
		<div class="container-tetris">
			<div class="ranking-gameboy">
				<div class="title-ranking">
					<h1 class="title-ranking">10 MELHORES PARTIDAS</h1>
				</div>
				<div class="seu-ranking">
					<p class="seu-ranking">
						<!-- YOUR POS IN RANKING -->
						<?php
							try {
								$username = $_SESSION["username"];

								$conn = new PDO("mysql:host=localhost;dbname=tetris", "root", "");

								$stmt = $conn->query("SELECT * FROM ranking ORDER BY pontuacao DESC");

								$pos = 0;

								while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
									$pos++;
									if ($row["username"] == $username){
										break;
									}
								}

								echo "Seu ranking: " . $pos . "º";
							} catch(PDOException $e) {
								echo "Ocorreu um erro: " . $e->getMessage();
							}
						?>
					</p>
				</div>
				<div class="ranking">
					<table class="tabela-body">
						<thead>
							<tr>
								<th>Rank</th>
								<th>Username</th>
								<th>Pontuação</th>
								<th>Nível</th>
							</tr>
						</thead>
						<!-- TOP 10 -->
						<?php
							try {
								$conn = new PDO("mysql:host=localhost;dbname=tetris", "root", "");

								$stmt = $conn->query("SELECT * FROM ranking ORDER BY pontuacao DESC LIMIT 10");

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
		</div>

		<div class="container-tetris">
			<div class="ranking-gameboy">
				<div class="title-ranking">
					<h1 class="title-ranking">SUAS 10 MELHORES PARTIDAS</h1>
				</div>
				<div class="ranking">
					<table class="tabela-body">
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
		</div>
		<!-- FIM CONTEUDO-->
		<!-- FOOTER -->
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
			<!-- FIM FOOTER -->
	</body>
</html>