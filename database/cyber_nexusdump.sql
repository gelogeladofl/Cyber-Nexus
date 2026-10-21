--
-- PostgreSQL database dump
--

\restrict 9FMDoMzkVXjhmaIrhJ3fV1qcIK3iIENeYxNh8fXPyoScyWRTHrmToGMdZUFgrrX

-- Dumped from database version 18.6 (Ubuntu 18.6-0ubuntu0.26.04.1)
-- Dumped by pg_dump version 18.6 (Ubuntu 18.6-0ubuntu0.26.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: agentes; Type: TABLE; Schema: public; Owner: cyber_nexus
--

CREATE TABLE public.agentes (
    id integer NOT NULL,
    nome character varying(100) DEFAULT 'Não Informado'::character varying NOT NULL,
    codinome character varying(100) NOT NULL,
    funcao character varying(50) NOT NULL,
    distrito character varying(100) NOT NULL,
    reputacao character varying(20) NOT NULL,
    status character varying(20) DEFAULT 'Ativo'::character varying NOT NULL,
    biografia text NOT NULL,
    criado_em timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.agentes OWNER TO cyber_nexus;

--
-- Name: agentes_id_seq; Type: SEQUENCE; Schema: public; Owner: cyber_nexus
--

CREATE SEQUENCE public.agentes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.agentes_id_seq OWNER TO cyber_nexus;

--
-- Name: agentes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: cyber_nexus
--

ALTER SEQUENCE public.agentes_id_seq OWNED BY public.agentes.id;


--
-- Name: implantes; Type: TABLE; Schema: public; Owner: cyber_nexus
--

CREATE TABLE public.implantes (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    tipo character varying(50) NOT NULL,
    preco numeric(10,2) DEFAULT 0.00 NOT NULL,
    descricao text,
    criado_em timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.implantes OWNER TO cyber_nexus;

--
-- Name: implantes_id_seq; Type: SEQUENCE; Schema: public; Owner: cyber_nexus
--

CREATE SEQUENCE public.implantes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.implantes_id_seq OWNER TO cyber_nexus;

--
-- Name: implantes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: cyber_nexus
--

ALTER SEQUENCE public.implantes_id_seq OWNED BY public.implantes.id;


--
-- Name: missoes; Type: TABLE; Schema: public; Owner: cyber_nexus
--

CREATE TABLE public.missoes (
    id integer NOT NULL,
    nome character varying(150) NOT NULL,
    descricao text,
    dificuldade character varying(30) NOT NULL,
    recompensa numeric(10,2) DEFAULT 0.00 NOT NULL,
    status character varying(20) DEFAULT 'Pendente'::character varying,
    criado_em timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    criador_id integer,
    agente_id integer,
    CONSTRAINT missoes_dificuldade_check CHECK (((dificuldade)::text = ANY ((ARRAY['Baixa'::character varying, 'Média'::character varying, 'Alta'::character varying, 'Extrema'::character varying])::text[]))),
    CONSTRAINT missoes_status_check CHECK (((status)::text = ANY ((ARRAY['Pendente'::character varying, 'Em Andamento'::character varying, 'Concluída'::character varying, 'Falhou'::character varying])::text[])))
);


ALTER TABLE public.missoes OWNER TO cyber_nexus;

--
-- Name: missoes_id_seq; Type: SEQUENCE; Schema: public; Owner: cyber_nexus
--

CREATE SEQUENCE public.missoes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.missoes_id_seq OWNER TO cyber_nexus;

--
-- Name: missoes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: cyber_nexus
--

ALTER SEQUENCE public.missoes_id_seq OWNED BY public.missoes.id;


--
-- Name: missoes_principais; Type: TABLE; Schema: public; Owner: cyber_nexus
--

CREATE TABLE public.missoes_principais (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    descricao text NOT NULL,
    ato character varying(20) NOT NULL,
    dificuldade character varying(20) DEFAULT 'MÉDIO'::character varying NOT NULL,
    recompensa numeric(10,2) DEFAULT 0.00 NOT NULL,
    status character varying(20) DEFAULT 'DISPONÍVEL'::character varying NOT NULL
);


ALTER TABLE public.missoes_principais OWNER TO cyber_nexus;

--
-- Name: missoes_principais_id_seq; Type: SEQUENCE; Schema: public; Owner: cyber_nexus
--

CREATE SEQUENCE public.missoes_principais_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.missoes_principais_id_seq OWNER TO cyber_nexus;

--
-- Name: missoes_principais_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: cyber_nexus
--

ALTER SEQUENCE public.missoes_principais_id_seq OWNED BY public.missoes_principais.id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: cyber_nexus
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    email character varying(150) NOT NULL,
    apelido character varying(50) NOT NULL,
    senha character varying(255) NOT NULL,
    nivel_acesso character varying(20) DEFAULT 'Operador'::character varying,
    criado_em timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.usuarios OWNER TO cyber_nexus;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: cyber_nexus
--

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_id_seq OWNER TO cyber_nexus;

--
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: cyber_nexus
--

ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;


--
-- Name: agentes id; Type: DEFAULT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.agentes ALTER COLUMN id SET DEFAULT nextval('public.agentes_id_seq'::regclass);


--
-- Name: implantes id; Type: DEFAULT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.implantes ALTER COLUMN id SET DEFAULT nextval('public.implantes_id_seq'::regclass);


--
-- Name: missoes id; Type: DEFAULT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.missoes ALTER COLUMN id SET DEFAULT nextval('public.missoes_id_seq'::regclass);


--
-- Name: missoes_principais id; Type: DEFAULT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.missoes_principais ALTER COLUMN id SET DEFAULT nextval('public.missoes_principais_id_seq'::regclass);


--
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);


--
-- Data for Name: agentes; Type: TABLE DATA; Schema: public; Owner: cyber_nexus
--

COPY public.agentes (id, nome, codinome, funcao, distrito, reputacao, status, biografia, criado_em) FROM stdin;
1	david martinez	O Sandevistan de Santo	Mercenário	Heywood	Lenda	Morto	um jovem inteligente de origem humilde que vive na perigosa Night City. Após a morte trágica de sua mãe em um acidente e sem dinheiro para sobreviver, ele decide instalar em si mesmo o Sandevistan, um implante cibernético militar ilegal que lhe permite mover-se em supervelocidade. Essa decisão o introduz ao submundo do crime, onde ele se junta a uma gangue de edgerunners liderada por Maine e se apaixona pela trilha-redes Lucy, adotando o sonho dela de ir à Lua como seu próprio objetivo.\r\nCom o tempo e após a morte de seu mentor Maine, David assume a liderança do grupo e modifica drasticamente seu corpo com implantes pesados para proteger seus aliados. No entanto, o excesso de cibernéticos deteriora sua mente, levando-o à ciberpsicose. Em sua última missão, David usa um exotraje experimental altamente destrutivo para salvar Lucy de uma armadilha da megacorporação Arasaka. Ele enfrenta o lendário Adam Smasher e morre sorrindo após garantir a fuga de sua amada, tornando-se uma lenda imortalizada com um drink em seu nome no famoso bar Afterlife.	2026-10-07 08:58:34.486209
3	José Macalé da Silva	Tião Macalé	Mercenário	Rede Globo - Brasil	Lenda	Morto	Ih nojento!	2026-10-14 11:13:42.057814
\.


--
-- Data for Name: implantes; Type: TABLE DATA; Schema: public; Owner: cyber_nexus
--

COPY public.implantes (id, nome, tipo, preco, descricao, criado_em) FROM stdin;
1	Olhos Kiroshi Mk.3	SISTEMA OCULAR	5000.00	Aumenta o campo de visão e escaneia alvos em tempo real.	2026-09-30 09:43:07.27477
2	Lâminas de Louva-a-deus	MEMBROS	18500.00	Lâminas retráteis de liga leve instaladas nos antebraços.	2026-09-30 09:43:07.27477
3	Ciberterminal Sandevistan Mk.4	SISTEMA NERVOSO	28000.00	Acelera a percepção neural do usuário, deixando o tempo mais lento.	2026-09-30 09:43:07.27477
7	Braços de Gorila	MEMBROS	2500.00	Os Braços de Gorila substituem a estrutura muscular e óssea dos braços por servomotores hidráulicos de alta potência, revestidos por placas pesadas	2026-09-30 13:52:59.671759
\.


--
-- Data for Name: missoes; Type: TABLE DATA; Schema: public; Owner: cyber_nexus
--

COPY public.missoes (id, nome, descricao, dificuldade, recompensa, status, criado_em, criador_id, agente_id) FROM stdin;
5	Fantasmas na Sobrecarga	Um prot&oacute;tipo de firmware neural de &uacute;ltima gera&ccedil;&atilde;o, codinome AURA-7, foi roubado dos laborat&oacute;rios da Kang Tao durante uma transfer&ecirc;ncia de carga nos subsolos de Pac&iacute;fica. O contratante  um fixer agindo em nome de uma corpora&ccedil;&atilde;o rival misteriosa precisa do chip de dados intacto antes que a seguran&ccedil;a da Kang Tao feche o cerco na regi&atilde;o.	Alta	450000.00	Pendente	2026-10-02 11:29:29.407785	\N	\N
6	Adestrar Tatu Bola	Adestrar um Tatu Bola espacial hostil	Extrema	2.00	Pendente	2026-10-14 11:10:59.607719	\N	\N
2	Sabotagem Arasaka Tower	Infiltrar no subsolo e implantar um vírus no servidor principal.	Extrema	50000.00	Pendente	2026-09-30 09:44:00.516407	\N	\N
1	Resgate no Distrito Kabuki	Extrair um netrunner capturado por uma gangue local.	Média	12000.00	Pendente	2026-09-30 09:44:00.516407	\N	\N
\.


--
-- Data for Name: missoes_principais; Type: TABLE DATA; Schema: public; Owner: cyber_nexus
--

COPY public.missoes_principais (id, nome, descricao, ato, dificuldade, recompensa, status) FROM stdin;
1	O Salvamento (The Rescue)	Resgatar Sandra Dorsett de um cativeiro dos Scavengers em Watson.	ATO 1	BAIXO	2500.00	DISPONÍVEL
2	O Serviço (The Ride)	Encontrar-se com Dexter DeShawn na limousine para discutir o grande roubo.	ATO 1	BAIXO	0.00	DISPONÍVEL
3	A Coleta (The Pickup)	Recuperar o robô Flathead da gangue Maelstrom na fábrica All Foods.	ATO 1	MÉDIO	5000.00	DISPONÍVEL
4	A Informante (The Information)	Analisar a BD (Brain-Dance) no Konpeki Plaza com Evelyn Parker no Lizzie's Bar.	ATO 1	BAIXO	3000.00	DISPONÍVEL
5	O Roubo (The Heist)	Infiltrar no Konpeki Plaza para roubar o Relic da suíte de Yorinobu Arasaka.	ATO 1	ALTO	10000.00	DISPONÍVEL
6	Amor de Matar (Love Like Fire)	Reviver as memórias do ataque de Johnny Silverhand à Arasaka Tower em 2023.	ATO 1	ALTO	0.00	DISPONÍVEL
7	O Espaço Entre Eles (Playing for Time)	Acordar no lixão, sobreviver ao ataque dos assassinos e encontrar Takemura.	ATO 2	ALTO	0.00	DISPONÍVEL
8	Invisível (Automatic Love)	Investigar o paradeiro de Evelyn Parker através do clube Clouds em Japantown.	ATO 2	MÉDIO	4000.00	DISPONÍVEL
9	A Pista (Ghost Town)	Localizar Rogue na Afterlife e contratar Panam Palmer para capturar Hellman.	ATO 2	MÉDIO	15000.00	DISPONÍVEL
10	A Luta Espacial (Lightning Breaks)	Derrubar o AV da Kang Tao nas Badlands usando um EMP.	ATO 2	ALTO	8000.00	DISPONÍVEL
11	A Vida em Tempos de Guerra (Life During Wartime)	Procurar Anders Hellman nos destroços do AV e interrogá-lo.	ATO 2	ALTO	12000.00	DISPONÍVEL
12	Sombra e Escuridão (Down on the Street)	Encontrar-se com Takemura e Oda para tentar uma audiência com Hanako Arasaka.	ATO 2	MÉDIO	5000.00	DISPONÍVEL
13	Gimme Danger	Infiltrar no galpão de segurança da Arasaka para hackear o carro alegórico.	ATO 2	ALTO	9000.00	DISPONÍVEL
14	Play It Safe	Proteger Takemura neutralizando os snipers durante o festival de Dashi.	ATO 2	ALTO	15000.00	DISPONÍVEL
15	Search and Destroy	Sobreviver ao ataque da Arasaka ao esconderijo e decidir se resgata Takemura.	ATO 2	ALTO	0.00	DISPONÍVEL
16	I Walk the Line	Infiltrar no cinema abandonado dominado pelos Animals em Pacífica.	ATO 2	ALTO	10000.00	DISPONÍVEL
17	Transmission	Entrar na Sub-Rede dos Voodoo Boys com Brigitte e cruzar a Blackwall.	ATO 2	ALTO	20000.00	DISPONÍVEL
18	Nocturne OP55N1	A reunião decisiva com Hanako no Embers. Ponto sem retorno da campanha.	ATO 3	ALTO	0.00	DISPONÍVEL
19	Knockin' on Heaven's Door	Infiltrar na Arasaka Tower pela rota dos Aldecaldos ou com Rogue.	FINAL	ALTO	50000.00	DISPONÍVEL
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: cyber_nexus
--

COPY public.usuarios (id, nome, email, apelido, senha, nivel_acesso, criado_em) FROM stdin;
7	Breno Luiz	brenoluiz1958@gmail.com	lobo	$2y$12$te6f2MIFBg86poN9Dg5/leLMb6k4Sv5m3g2kD6/OtrKcL.LZWpJ56	Admin	2026-10-09 15:23:46.025717
13	Luiz	tex@gmail.com	Breno	$2y$12$hWC1N6hVNcTaM6M/QJpc7.p2mARIklyKL4pL7AIo5z9kizkZXOY3e	Operador	2026-10-14 08:47:15.227619
5	Administrador da Rede	admin@cybernexus.com	admin_nexus	$2y$12$BUsGBXX/c03xMQ6iyoapPefeC/RN6comGoidokEKHDppsobOy9Rre	Admin	2026-10-09 15:19:00.452355
11	Novo Administrador	novo_admin@cybernexus.com	novo_admin	$2y$12$s/Y4h9Pa.Pf7LBCsDO5kIuRsiJFId1YcxYo5kmJt0hdAW1MyuY1.6	Operador	2026-10-09 16:14:35.798201
12	liviaM	Shana@gmail.com	L	$2y$12$fmMsD7.bNcllwmVi00enhe18deTKIUitsEMI/Rl.Y0pWypw0SMasS	Admin	2026-10-09 16:58:36.634636
14	Ronaldo da Silva	ronaldo123@gmail.com	Ronaldinho	$2y$12$KV3rQ2fMyrEXppoArX5Te.1ikRuPQ/w33uIruCgB/DEyqIR5AYdau	Admin	2026-10-14 11:10:07.059437
\.


--
-- Name: agentes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: cyber_nexus
--

SELECT pg_catalog.setval('public.agentes_id_seq', 3, true);


--
-- Name: implantes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: cyber_nexus
--

SELECT pg_catalog.setval('public.implantes_id_seq', 9, true);


--
-- Name: missoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: cyber_nexus
--

SELECT pg_catalog.setval('public.missoes_id_seq', 6, true);


--
-- Name: missoes_principais_id_seq; Type: SEQUENCE SET; Schema: public; Owner: cyber_nexus
--

SELECT pg_catalog.setval('public.missoes_principais_id_seq', 19, true);


--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: cyber_nexus
--

SELECT pg_catalog.setval('public.usuarios_id_seq', 14, true);


--
-- Name: agentes agentes_pkey; Type: CONSTRAINT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.agentes
    ADD CONSTRAINT agentes_pkey PRIMARY KEY (id);


--
-- Name: implantes implantes_pkey; Type: CONSTRAINT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.implantes
    ADD CONSTRAINT implantes_pkey PRIMARY KEY (id);


--
-- Name: missoes missoes_pkey; Type: CONSTRAINT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.missoes
    ADD CONSTRAINT missoes_pkey PRIMARY KEY (id);


--
-- Name: missoes_principais missoes_principais_pkey; Type: CONSTRAINT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.missoes_principais
    ADD CONSTRAINT missoes_principais_pkey PRIMARY KEY (id);


--
-- Name: usuarios usuarios_apelido_key; Type: CONSTRAINT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_apelido_key UNIQUE (apelido);


--
-- Name: usuarios usuarios_email_key; Type: CONSTRAINT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_email_key UNIQUE (email);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- Name: missoes missoes_agente_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.missoes
    ADD CONSTRAINT missoes_agente_id_fkey FOREIGN KEY (agente_id) REFERENCES public.usuarios(id);


--
-- Name: missoes missoes_criador_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: cyber_nexus
--

ALTER TABLE ONLY public.missoes
    ADD CONSTRAINT missoes_criador_id_fkey FOREIGN KEY (criador_id) REFERENCES public.usuarios(id);


--
-- PostgreSQL database dump complete
--

\unrestrict 9FMDoMzkVXjhmaIrhJ3fV1qcIK3iIENeYxNh8fXPyoScyWRTHrmToGMdZUFgrrX

