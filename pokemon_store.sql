--
-- PostgreSQL database dump
--

\restrict w4ldp3IJ9ePbzO5xBWVb8XVnasadoEBG3W4wVwVNUFH7WSchsWCe3iz5gTmh0Qw

-- Dumped from database version 18.4 (Ubuntu 18.4-0ubuntu0.26.04.1)
-- Dumped by pg_dump version 18.4 (Ubuntu 18.4-0ubuntu0.26.04.1)

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
-- Name: produtos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produtos (
    id integer NOT NULL,
    nome character varying(100),
    descricao character varying(255),
    preco numeric(10,2),
    quantidade integer,
    imagem character varying(255)
);


ALTER TABLE public.produtos OWNER TO postgres;

--
-- Name: produtos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.produtos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.produtos_id_seq OWNER TO postgres;

--
-- Name: produtos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.produtos_id_seq OWNED BY public.produtos.id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    usuario character varying(50),
    senha character varying(255),
    tipo character varying(20)
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_id_seq OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;


--
-- Name: produtos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produtos ALTER COLUMN id SET DEFAULT nextval('public.produtos_id_seq'::regclass);


--
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);


--
-- Data for Name: produtos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produtos (id, nome, descricao, preco, quantidade, imagem) FROM stdin;
6	Charizard Vmax		3000.00	3	1791983608_6acf7ff81a00c.jpg
7	Pikachu EX full art		5000.00	5	1791988087_6acf91773da5b.avif
8	Eevee EX - Evoluções Prismaticas		700.00	7	1791988349_6acf927d220f1.png
9	Vaporeon V full art		300.00	5	1791988604_6acf937c3c8f5.avif
10	Gardevoir EX full art		239.27	3	1791988907_6acf94ab38122.jpg
11	Giratina V full art		1200.00	2	1791989021_6acf951d3c972.webp
13	Snorlax Pelucia		389.90	7	43d2f9596a911ac97a462f2ef5255399.webp
14	Pelucia Charizard Jumbo		460.90	4	75468b3f6e8144dcce54dbf55f70220e.jpg
15	buster bundle 30 anos		999.90	32	49c610da5eeb9680f99a5ef8a1f8104e.webp
16	Box coleçao parceiro incial		189.97	5	be49be08604d87f8f67cb65f144cf0b5.jpg
17	Trainer Box MegaEvolução - Pitch Black		739.00	2	3a4c017d855177f8e35aa60c0325872b.webp
18	Pokemon Card Game Scarlet & Violet Special Box Pokemon Center Fukuoka (Japones)		2012.08	1	6dcfdd2cd558b59d63da36365b5ca856.jpg
19	Mega Rayquaza EX		999.90	3	4440c9b0ddd1c2c1fbf4f1b07ce3fe79.webp
20	Greninja EX Especial ART		230.50	4	66a3d0a8ed349410a00a9aa37654135d.jpg
21	Sylveon Vmax Full ART		143.23	4	59e6df653526783f253d658a1e74ee5c.jpg
23	Pikachu EX full arte coleção 30 anos		500.00	3	4a36080d7bf8cff0b72c0a7569b86e9e.jpg
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (id, usuario, senha, tipo) FROM stdin;
2	joao	1234	usuario
4	user	12345	cliente
7	henrique	123	cliente
1	admin	$2y$12$S6M6vSIolIXyyW9XKn3qhuwjPiJtwjwiwn2z2mM58z7l6Ha/7OwBa	admin
3	admin	$2y$12$S6M6vSIolIXyyW9XKn3qhuwjPiJtwjwiwn2z2mM58z7l6Ha/7OwBa	admin
5	admin	$2y$12$S6M6vSIolIXyyW9XKn3qhuwjPiJtwjwiwn2z2mM58z7l6Ha/7OwBa	admin
6	admin	$2y$12$S6M6vSIolIXyyW9XKn3qhuwjPiJtwjwiwn2z2mM58z7l6Ha/7OwBa	admin
8	livia	$2y$12$J.YjJj/QC6ZtOKVM8vdcfOB6bAHcxjl0F84/MmnhOjbQ/i.kJJFzS	cliente
9	leticia	$2y$12$Rj6j7LXawUqvQqdkm2WMsOYUCl2ofZD.OKTyj91wAseObsGEroJ2m	cliente
\.


--
-- Name: produtos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produtos_id_seq', 23, true);


--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_id_seq', 9, true);


--
-- Name: produtos produtos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produtos
    ADD CONSTRAINT produtos_pkey PRIMARY KEY (id);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: pg_database_owner
--

GRANT ALL ON SCHEMA public TO pokestore;


--
-- Name: TABLE produtos; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.produtos TO pokestore;


--
-- Name: SEQUENCE produtos_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON SEQUENCE public.produtos_id_seq TO pokestore;


--
-- Name: TABLE usuarios; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.usuarios TO pokestore;


--
-- Name: SEQUENCE usuarios_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON SEQUENCE public.usuarios_id_seq TO pokestore;


--
-- Name: DEFAULT PRIVILEGES FOR TABLES; Type: DEFAULT ACL; Schema: public; Owner: postgres
--

ALTER DEFAULT PRIVILEGES FOR ROLE postgres IN SCHEMA public GRANT ALL ON TABLES TO pokestore;


--
-- PostgreSQL database dump complete
--

\unrestrict w4ldp3IJ9ePbzO5xBWVb8XVnasadoEBG3W4wVwVNUFH7WSchsWCe3iz5gTmh0Qw

