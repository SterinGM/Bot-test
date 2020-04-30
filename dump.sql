CREATE TABLE public.users
(
	id SERIAL NOT NULL PRIMARY KEY,
	login VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	balance BIGINT DEFAULT 0 NOT NULL,
	session_id VARCHAR(32) DEFAULT NULL
);

CREATE UNIQUE INDEX user_login_uindex ON public.users (login);

CREATE TABLE transactions
(
	id SERIAL NOT NULL PRIMARY KEY,
	user_id INT NOT NULL CONSTRAINT transaction_user_id_fk REFERENCES users ON DELETE CASCADE,
	amount BIGINT NOT NULL,
	created_at timestamp default CURRENT_TIMESTAMP NOT NULL
);

INSERT INTO users (balance, login, password) VALUES
    (10000000, 'user1', '$2y$10$fs7x9PUep4/Jh7aLli/3q.5Rx8ky1pGOC1S7gRnOyFmwm1LINhMMu'),
    (12300000, 'user2', '$2y$10$fs7x9PUep4/Jh7aLli/3q.5Rx8ky1pGOC1S7gRnOyFmwm1LINhMMu');