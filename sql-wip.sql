CREATE TABLE "extendeduser"(
	extendeduser_id serial PRIMARY KEY,
	owner_id integer DEFAULT 1 REFERENCES public."user" ON DELETE SET DEFAULT,
	about_me text,
	profile_img text
);

CREATE TABLE "question"(
	question_id serial PRIMARY KEY,
	owner_id integer DEFAULT 1 REFERENCES public."user" ON DELETE SET DEFAULT,
	title text NOT NULL,
	body text,
	rating integer,
	time_stamp timestamp
);

CREATE TABLE "answer"(
	answer_id serial PRIMARY KEY,
	owner_id integer DEFAULT 1 REFERENCES public."user" ON DELETE SET DEFAULT,
	question_id integer REFERENCES question(question_id) ON DELETE CASCADE,
	body text,
	rating integer,
	time_stamp timestamp
);