CREATE TABLE IF NOT EXISTS pessoas (
  id       BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  nome     VARCHAR(45)     NOT NULL,
  email    VARCHAR(45)     NOT NULL,
  telefone VARCHAR(45)     NULL,
  foto     VARCHAR(45)     NULL,
  created  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated  DATETIME        NULL,
  deleted  DATETIME        NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX id (id ASC)
)
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = latin1;
