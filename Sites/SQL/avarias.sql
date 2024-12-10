-- Cria��o da base de dados Avarias em SQL(Structured Query Language (Linguagem de Consulta Estruturada))
CREATE DATABASE IF NOT EXISTS avarias COLLATE utf8_general_ci; -- Cria a base de dados avarias se n�o existir com a codifica��o utf8_general_ci para permitir caract�res especiais como por exemplo o � de Jo�o
USE avarias; -- Entra na base de dados avarias

-- Tabelas relativas � localiza��o da escola e dos seus equipamentos
-- Cria a tabela agrupamentos
CREATE TABLE IF NOT EXISTS agrupamentos
(
    idagrupamento INT(3) PRIMARY KEY AUTO_INCREMENT, -- Chave prim�ria do tipo inteiro com no m�ximo 3 digitos que � automaticamente incrementado, exemplo 1 2 3
	nome_agrupamento VARCHAR(120) NOT NULL COLLATE utf8_general_ci -- N�o pode ser nulo, o campo n�o pode estar em branco
);

-- Cria a tabela escolas
CREATE TABLE IF NOT EXISTS escolas
(
    idescola INT(3) PRIMARY KEY AUTO_INCREMENT,
	nome_escola VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	localizacao VARCHAR(120) NOT NULL COLLATE utf8_general_ci, -- Local aonde fica por exemplo Charneca da Caparica
	idagrupamento INT(3) NOT NULL, FOREIGN KEY(idagrupamento) REFERENCES agrupamentos(idagrupamento) -- Chave estrangeira, s� aceita valores se j� existir, por exemplo existe o agrupamento de c�digo 3 esta chave permite do 1 ao 3 mas n�o permite o 5 pois n�o existe o agrupamento de c�digo 5
);

-- Cria a tabela blocos
CREATE TABLE IF NOT EXISTS blocos
(
    idbloco INT(3) PRIMARY KEY AUTO_INCREMENT,
	nome_bloco VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	idescola INT(3) NOT NULL, FOREIGN KEY(idescola) REFERENCES escolas(idescola)
);

-- Cria a tabela salas
CREATE TABLE IF NOT EXISTS salas
(
    idsala INT(3) PRIMARY KEY AUTO_INCREMENT,
	nome_sala VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	idbloco INT(3) NOT NULL, FOREIGN KEY(idbloco) REFERENCES blocos(idbloco)
);

-- Tabelas relativas aos equipamentos existentes na escola
-- Cria a tabela computadores
CREATE TABLE IF NOT EXISTS computadores
(
    idcomputador INT(3) PRIMARY KEY AUTO_INCREMENT,
	tipo VARCHAR(1) NOT NULL COLLATE utf8_general_ci, -- Se � torre (T), se � um port�til (P), se � um servidor (S), se � nulo (N)
	fabricante VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	modelo VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	ram VARCHAR(120) COLLATE utf8_general_ci, -- Mem�ria Ram
	cpu VARCHAR(120) COLLATE utf8_general_ci, -- Processador
	motherboard VARCHAR(120) COLLATE utf8_general_ci,
	disco_rigido VARCHAR(120) COLLATE utf8_general_ci,
	disco_otico VARCHAR(120) COLLATE utf8_general_ci,
	placa_grafica VARCHAR(120) COLLATE utf8_general_ci,
	placa_rede VARCHAR(120) COLLATE utf8_general_ci,
	fonte_alimentacao VARCHAR(120) COLLATE utf8_general_ci,
    cooler VARCHAR(120) COLLATE utf8_general_ci, -- Ventoinha
	so VARCHAR(120) COLLATE utf8_general_ci -- Sistema Operativo
);

-- Mete tudo a NULL caso n�o queira inserir um computador na tabela tipo_equipamentos
INSERT INTO computadores VALUES(1, 'N', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL', 'NULL');

-- Cria a tabela monitores
CREATE TABLE IF NOT EXISTS monitores
(
    idmonitor INT(3) PRIMARY KEY AUTO_INCREMENT,
	fabricante VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	modelo VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	resolucao VARCHAR(9) NOT NULL COLLATE utf8_general_ci,
	polegadas VARCHAR(5) NOT NULL COLLATE utf8_general_ci,
	quantidade INT(4) NOT NULL
);

-- Mete tudo a NULL caso n�o queira inserir um monitor na tabela tipo_equipamentos
INSERT INTO monitores VALUES(1, 'NULL', 'NULL', 'NULL', 'NULL', 0);

-- Cria a tabela projetores
CREATE TABLE IF NOT EXISTS projetores
(
    idprojetor INT(3) PRIMARY KEY AUTO_INCREMENT,
	tipo VARCHAR(1) NOT NULL COLLATE utf8_general_ci, -- Se est� no teto como videoprojetor (V), se est� no qim(Quadro Interativo Multim�dia) (Q) ou se � nulo (N)
	fabricante VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	modelo VARCHAR(120) NOT NULL COLLATE utf8_general_ci
);

-- Mete tudo a NULL caso n�o queira inserir um projetor na tabela tipo_equipamentos
INSERT INTO projetores VALUES(1, 'N', 'NULL', 'NULL');

-- Cria a tabela qim(Quadro Interativo Multim�dia)
CREATE TABLE IF NOT EXISTS qims
(
    idqim INT(3) PRIMARY KEY AUTO_INCREMENT,
	fabricante VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	modelo VARCHAR(120) NOT NULL COLLATE utf8_general_ci
);

-- Mete tudo a NULL caso n�o queira inserir um quadro interativo na tabela tipo_equipamentos
INSERT INTO qims VALUES(1, 'NULL', 'NULL');

-- Cria a tabela tipo_equipamentos que � a tabela que serve de liga��o entre todos os equipamentos
CREATE TABLE IF NOT EXISTS tipo_equipamentos
(
    idtpequip INT(3) PRIMARY KEY AUTO_INCREMENT, -- id tipo equipamento
	idcomputador INT(3), FOREIGN KEY(idcomputador) REFERENCES computadores(idcomputador),
	idmonitor INT(3), FOREIGN KEY(idmonitor) REFERENCES monitores(idmonitor),
	idprojetor INT(3), FOREIGN KEY(idprojetor) REFERENCES projetores(idprojetor),
	idqim INT(3), FOREIGN KEY(idqim) REFERENCES qims(idqim)
);

-- Cria a tabela equipamentos para fazer a liga��o entre os equipamentos e a sala
CREATE TABLE IF NOT EXISTS equipamentos
(
    idequipamento INT(3) PRIMARY KEY AUTO_INCREMENT,
	serial_number VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	foto VARCHAR(120) NOT NULL COLLATE utf8_general_ci, -- Caminho para a fotografia do equipamento
	posto INT(2), -- N�mero do computador
	prioridade VARCHAR(1) NOT NULL COLLATE utf8_general_ci, -- Se tem prioridade pa ser arranjado S, se n�o tem prioridade N
	operacional VARCHAR(1) NOT NULL COLLATE utf8_general_ci, -- Se est� a funcionar S, se n�o est� a funcionar N
	idsala INT(3), FOREIGN KEY(idsala) REFERENCES salas(idsala),
	idtpequip INT(3) NOT NULL, FOREIGN KEY(idtpequip) REFERENCES tipo_equipamentos(idtpequip)
);

-- Tabelas relativas aos utilizadores
-- Cria a tabela utilizadores
CREATE TABLE IF NOT EXISTS utilizadores
(
    idutilizador INT(3) PRIMARY KEY AUTO_INCREMENT,
	nome_utilizador VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	email VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	pass VARCHAR(400) NOT NULL COLLATE utf8_general_ci,
	cargo_utilizador VARCHAR(120) NOT NULL COLLATE utf8_general_ci, -- Se � aluno, professor, estagi�rio, funcion�rio, etc..
	tipo_utilizador VARCHAR(1) NOT NULL COLLATE utf8_general_ci -- Se � Administrador (A) com todas as permiss�es, se � Estagi�rio (E) s� com periss�es para gerir as avarias e consultar, se � um utilizador normal por exemplo professor, funcion�rio, etc.. (N) que s� pode reportar avaria
);

-- Cria a tabela tecnicos para saber quem foi o t�cnico que consertou
CREATE TABLE IF NOT EXISTS tecnicos
(
    idtecnico INT(3) PRIMARY KEY AUTO_INCREMENT,
	nome_tecnico VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	cargo_tecnico VARCHAR(120) NOT NULL COLLATE utf8_general_ci
);

-- Mete tudo a NULL porque por defeito quando reportamos uma avaria n�o existe um t�cnico que j� consertou, s� futuramente que algu�m vai arranjar depois se saber que foi reportado uma avaria
INSERT INTO tecnicos VALUES(1, 'NULL', 'NULL');

-- Tabela relativa �s avarias existentes
CREATE TABLE IF NOT EXISTS avarias
(
    idavaria INT(3) PRIMARY KEY AUTO_INCREMENT,
	descricao TEXT(1000) NOT NULL COLLATE utf8_general_ci,
	data_avaria DATE NOT NULL, -- Data que foi reportada a avaria
	estado VARCHAR(1) NOT NULL COLLATE utf8_general_ci, -- S se est� consertado, N se ainda est� avariado
	data_conserto DATE, -- Data que foi consertado a avaria
	idequipamento INT(3) NOT NULL, FOREIGN KEY(idequipamento) REFERENCES equipamentos(idequipamento),
	idutilizador INT(3) NOT NULL, FOREIGN KEY(idutilizador) REFERENCES utilizadores(idutilizador),
	idtecnico INT(3), FOREIGN KEY(idtecnico) REFERENCES tecnicos(idtecnico)
);