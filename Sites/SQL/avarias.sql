-- Criação da base de dados Avarias em SQL(Structured Query Language (Linguagem de Consulta Estruturada))
CREATE DATABASE IF NOT EXISTS avarias COLLATE utf8_general_ci; -- Cria a base de dados avarias se não existir com a codificação utf8_general_ci para permitir caractéres especiais como por exemplo o ã de João
USE avarias; -- Entra na base de dados avarias

-- Tabelas relativas à localização da escola e dos seus equipamentos
-- Cria a tabela agrupamentos
CREATE TABLE IF NOT EXISTS agrupamentos
(
    idagrupamento INT(3) PRIMARY KEY AUTO_INCREMENT, -- Chave primária do tipo inteiro com no máximo 3 digitos que é automaticamente incrementado, exemplo 1 2 3
	nome_agrupamento VARCHAR(120) NOT NULL COLLATE utf8_general_ci -- Não pode ser nulo, o campo não pode estar em branco
);

-- Cria a tabela escolas
CREATE TABLE IF NOT EXISTS escolas
(
    idescola INT(3) PRIMARY KEY AUTO_INCREMENT,
	nome_escola VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	localizacao VARCHAR(120) NOT NULL COLLATE utf8_general_ci, -- Local aonde fica por exemplo Charneca da Caparica
	idagrupamento INT(3) NOT NULL, FOREIGN KEY(idagrupamento) REFERENCES agrupamentos(idagrupamento) -- Chave estrangeira, só aceita valores se já existir, por exemplo existe o agrupamento de código 3 esta chave permite do 1 ao 3 mas não permite o 5 pois não existe o agrupamento de código 5
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
	tipo VARCHAR(1) NOT NULL COLLATE utf8_general_ci, -- Se é torre (T), se é um portátil (P), se é um servidor (S), se é nulo (N)
	fabricante VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	modelo VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	ram VARCHAR(120) COLLATE utf8_general_ci, -- Memória Ram
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

-- Mete tudo a NULL caso não queira inserir um computador na tabela tipo_equipamentos
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

-- Mete tudo a NULL caso não queira inserir um monitor na tabela tipo_equipamentos
INSERT INTO monitores VALUES(1, 'NULL', 'NULL', 'NULL', 'NULL', 0);

-- Cria a tabela projetores
CREATE TABLE IF NOT EXISTS projetores
(
    idprojetor INT(3) PRIMARY KEY AUTO_INCREMENT,
	tipo VARCHAR(1) NOT NULL COLLATE utf8_general_ci, -- Se está no teto como videoprojetor (V), se está no qim(Quadro Interativo Multimédia) (Q) ou se é nulo (N)
	fabricante VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	modelo VARCHAR(120) NOT NULL COLLATE utf8_general_ci
);

-- Mete tudo a NULL caso não queira inserir um projetor na tabela tipo_equipamentos
INSERT INTO projetores VALUES(1, 'N', 'NULL', 'NULL');

-- Cria a tabela qim(Quadro Interativo Multimédia)
CREATE TABLE IF NOT EXISTS qims
(
    idqim INT(3) PRIMARY KEY AUTO_INCREMENT,
	fabricante VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	modelo VARCHAR(120) NOT NULL COLLATE utf8_general_ci
);

-- Mete tudo a NULL caso não queira inserir um quadro interativo na tabela tipo_equipamentos
INSERT INTO qims VALUES(1, 'NULL', 'NULL');

-- Cria a tabela tipo_equipamentos que é a tabela que serve de ligação entre todos os equipamentos
CREATE TABLE IF NOT EXISTS tipo_equipamentos
(
    idtpequip INT(3) PRIMARY KEY AUTO_INCREMENT, -- id tipo equipamento
	idcomputador INT(3), FOREIGN KEY(idcomputador) REFERENCES computadores(idcomputador),
	idmonitor INT(3), FOREIGN KEY(idmonitor) REFERENCES monitores(idmonitor),
	idprojetor INT(3), FOREIGN KEY(idprojetor) REFERENCES projetores(idprojetor),
	idqim INT(3), FOREIGN KEY(idqim) REFERENCES qims(idqim)
);

-- Cria a tabela equipamentos para fazer a ligação entre os equipamentos e a sala
CREATE TABLE IF NOT EXISTS equipamentos
(
    idequipamento INT(3) PRIMARY KEY AUTO_INCREMENT,
	serial_number VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	foto VARCHAR(120) NOT NULL COLLATE utf8_general_ci, -- Caminho para a fotografia do equipamento
	posto INT(2), -- Número do computador
	prioridade VARCHAR(1) NOT NULL COLLATE utf8_general_ci, -- Se tem prioridade pa ser arranjado S, se não tem prioridade N
	operacional VARCHAR(1) NOT NULL COLLATE utf8_general_ci, -- Se está a funcionar S, se não está a funcionar N
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
	cargo_utilizador VARCHAR(120) NOT NULL COLLATE utf8_general_ci, -- Se é aluno, professor, estagiário, funcionário, etc..
	tipo_utilizador VARCHAR(1) NOT NULL COLLATE utf8_general_ci -- Se é Administrador (A) com todas as permissões, se é Estagiário (E) só com perissões para gerir as avarias e consultar, se é um utilizador normal por exemplo professor, funcionário, etc.. (N) que só pode reportar avaria
);

-- Cria a tabela tecnicos para saber quem foi o técnico que consertou
CREATE TABLE IF NOT EXISTS tecnicos
(
    idtecnico INT(3) PRIMARY KEY AUTO_INCREMENT,
	nome_tecnico VARCHAR(120) NOT NULL COLLATE utf8_general_ci,
	cargo_tecnico VARCHAR(120) NOT NULL COLLATE utf8_general_ci
);

-- Mete tudo a NULL porque por defeito quando reportamos uma avaria não existe um técnico que já consertou, só futuramente que alguém vai arranjar depois se saber que foi reportado uma avaria
INSERT INTO tecnicos VALUES(1, 'NULL', 'NULL');

-- Tabela relativa às avarias existentes
CREATE TABLE IF NOT EXISTS avarias
(
    idavaria INT(3) PRIMARY KEY AUTO_INCREMENT,
	descricao TEXT(1000) NOT NULL COLLATE utf8_general_ci,
	data_avaria DATE NOT NULL, -- Data que foi reportada a avaria
	estado VARCHAR(1) NOT NULL COLLATE utf8_general_ci, -- S se está consertado, N se ainda está avariado
	data_conserto DATE, -- Data que foi consertado a avaria
	idequipamento INT(3) NOT NULL, FOREIGN KEY(idequipamento) REFERENCES equipamentos(idequipamento),
	idutilizador INT(3) NOT NULL, FOREIGN KEY(idutilizador) REFERENCES utilizadores(idutilizador),
	idtecnico INT(3), FOREIGN KEY(idtecnico) REFERENCES tecnicos(idtecnico)
);