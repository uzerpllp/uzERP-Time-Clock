CREATE TABLE clock
(
  id bigserial NOT NULL,
  employee_id bigint NOT NULL,
  "in" bigint NOT NULL,
  out bigint,
  error boolean,
  CONSTRAINT clock_pkey PRIMARY KEY (id)
);

CREATE TABLE employees
(
  id bigserial NOT NULL,
  number character varying NOT NULL,
  first_name character varying NOT NULL,
  last_name character varying NOT NULL,
  CONSTRAINT employees_pkey PRIMARY KEY (id)
);

CREATE TABLE settings
(
  key character varying NOT NULL,
  value character varying NOT NULL,
  CONSTRAINT settings_pkey PRIMARY KEY (key)
);


-- SQL CODE FOR AG_AUTH, BY ADAM GRIFFITHS
-- https://github.com/adamgriffiths/ag-auth

CREATE TABLE ci_sessions
(
  session_id character varying(40) NOT NULL DEFAULT '0',
  ip_address character varying(16) NOT NULL DEFAULT '0',
  user_agent character varying(255) NOT NULL,
  last_activity int NOT NULL DEFAULT '0',
  user_data text NOT NULL,
  CONSTRAINT ci_sessions_pkey PRIMARY KEY (session_id)
);

CREATE TABLE groups
(
  id bigserial NOT NULL,
  title character varying(20) NOT NULL DEFAULT '',
  description character varying(100) NOT NULL DEFAULT '',
  CONSTRAINT groups_pkey PRIMARY KEY (id)
);

CREATE TABLE users
(
  id bigserial NOT NULL,
  username character varying(255) NOT NULL,
  email character varying(255) NOT NULL,
  password character varying(255) NOT NULL,
  group_id int NOT NULL DEFAULT '100',
  token character varying(255),
  identifier character varying(255),
  CONSTRAINT users_pkey PRIMARY KEY (id)
);