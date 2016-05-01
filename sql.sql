CREATE TABLE IF NOT EXISTS rnyz_urlinfo (
	id INT(7) NOT NULL auto_increment,
	long_url VARCHAR(255),
	short_url VARCHAR(255),
    password VARCHAR(255),
	gen_time TIMESTAMP(6),
	PRIMARY KEY  (`id`)
);
