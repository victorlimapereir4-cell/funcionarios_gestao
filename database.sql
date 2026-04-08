CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome_completo VARCHAR(120) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(32) NOT NULL
);

CREATE TABLE servidores (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(120) NOT NULL,
    departamento VARCHAR(60) NOT NULL,
    email VARCHAR(120) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'Ativo',
    data_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (nome_completo, usuario, senha)
VALUES ('Administrador do Portal', 'admin', md5('123456'));

INSERT INTO servidores (nome, departamento, email, telefone, status) VALUES
('Aline Mendes', 'Protocolo', 'aline.mendes@orgao.gov.br', '(61) 98111-2041', 'Ativo'),
('Marcos Vieira', 'Gabinete', 'marcos.vieira@orgao.gov.br', '(61) 98222-2052', 'Licença'),
('Daniela Costa', 'Financeiro', 'daniela.costa@orgao.gov.br', '(61) 98333-2063', 'Ativo'),
('Carlos Nobre', 'Tecnologia', 'carlos.nobre@orgao.gov.br', '(61) 98444-2074', 'Ativo'),
('Priscila Azevedo', 'Atendimento', 'priscila.azevedo@orgao.gov.br', '(61) 98555-2085', 'Desligado'),
('Renato Silveira', 'Gabinete', 'renato.silveira@orgao.gov.br', '(61) 98666-2096', 'Ativo'),
('Luciana Prado', 'Protocolo', 'luciana.prado@orgao.gov.br', '(61) 98777-2107', 'Licença');
