--
-- MySQL
-- Data : `compositor` et `period_compositor`
-- Exécution : 3
--

USE php_api;

-- Moyen-Âge : 1
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "DE MACHAUT",
    "Guillaume",
    "1320-01-01",
    "1377-12-31",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/0/0a/Machaut_1.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "LE GRAND",
    "Pérotin",
    "1160-01-01",
    "1230-12-31",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/0/09/P%C3%A9rotin_photo.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "DE LA HALLE",
    "Adam",
    "1240-01-01",
    "1288-12-31",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/e/ed/Adam_de_la_halle.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "DE VITRY",
    "Philippe",
    "1291-10-31",
    "1361-06-09",
    "France",
    "https://www.elodiebayet.com/shared/figures/side_figure_640x640.jpg"
);
-- Joining
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 1, id from `compositor` where `lastname` = "DE MACHAUT";

INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 1, id from `compositor` where `lastname` = "LE GRAND";

INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 1, id from `compositor` where `lastname` = "DE LA HALLE";

INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 1, id from `compositor` where `lastname` = "DE VITRY";


-- Renaissance : 2
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "DUFAY",
    "Guillaume",
    "1397-01-01",
    "1474-11-27",
    "Belgique",
    "https://upload.wikimedia.org/wikipedia/commons/4/4f/DufayBinchois.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "OCKEGHEM",
    "Johannes",
    "1420-01-01",
    "1497-12-31",
    "Belgique",
    "https://upload.wikimedia.org/wikipedia/commons/2/28/Johannes_Ockeghem.png"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "DES PRÉS",
    "Josquin",
    "1440-01-01",
    "1521-08-27",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/8/8e/Josquin_des_Prez.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "GABRIELI",
    "Andrea",
    "1533-01-01",
    "1585-08-30",
    "Italie",
    NULL
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "PIERLUIGI DA PALESTRINA",
    "Giovanni",
    "1525-01-01",
    "1594-02-02",
    "Italie",
    "https://upload.wikimedia.org/wikipedia/commons/1/18/Giovanni_Pierluigi_da_Palestrina.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "DE LASSUS",
    "Roland",
    "1532-01-01",
    "1594-06-14",
    "Belgique",
    "https://upload.wikimedia.org/wikipedia/commons/2/2c/LassusPortrait.jpg"
);

-- Joining
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 2, id from `compositor` where `lastname` = "DUFAY";

INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 2, id from `compositor` where `lastname` = "OCKEGHEM";

INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 2, id from `compositor` where `lastname` = "DES PRÉS";

INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 2, id from `compositor` where `lastname` = "GABRIELI";

INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 2, id from `compositor` where `lastname` = "PIERLUIGI DA PALESTRINA";

INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 2, id from `compositor` where `lastname` = "DE LASSUS";


-- Baroque : 3
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "SCARLATTI",
    "Alessandro",
    "1660-05-02",
    "1725-10-24",
    "Italie",
    "https://upload.wikimedia.org/wikipedia/commons/b/b3/Alessandro_Scarlatti.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "MONTEVERDI",
    "Claudio",
    "1567-05-15",
    "1643-11-29",
    "Italie",
    "https://upload.wikimedia.org/wikipedia/commons/c/c2/Claudio_Monteverdi_4.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "LULLY",
    "Jean-Baptiste",
    "1632-11-28",
    "1687-03-22",
    "Italie",
    "https://upload.wikimedia.org/wikipedia/commons/8/85/Paul_Mignard_-_Jean-Baptiste_Lully.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "BACH",
    "Johann-Sebastian",
    "1685-03-31",
    "1750-07-28",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/6/6a/Johann_Sebastian_Bach.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "HAENDEL",
    "Georg-Friedrich",
    "1685-02-23",
    "1759-04-14",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/f/fa/George_Frideric_Handel_by_Balthasar_Denner.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "VIVALDI",
    "Antonio",
    "1678-03-04",
    "1741-07-28",
    "Italie",
    "https://upload.wikimedia.org/wikipedia/commons/1/1b/Antonio_Vivaldi.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "RAMEAU",
    "Jean-Philippe",
    "1683-09-25",
    "1768-09-12",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/9/98/Attribu%C3%A9_%C3%A0_Joseph_Aved%2C_Portrait_de_Jean-Philippe_Rameau_%28vers_1728%29_-_001.jpg"
);

-- Joining
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 3, id from `compositor` where `lastname` = "SCARLATTI";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 3, id from `compositor` where `lastname` = "MONTEVERDI";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 3, id from `compositor` where `lastname` = "LULLY";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 3, id from `compositor` where `lastname` = "BACH";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 3, id from `compositor` where `lastname` = "HAENDEL";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 3, id from `compositor` where `lastname` = "VIVALDI";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 3, id from `compositor` where `lastname` = "RAMEAU";


-- Classique : 4
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "HAYDN",
    "Joseph",
    "1732-03-31",
    "1809-05-31",
    "Autriche",
    "https://upload.wikimedia.org/wikipedia/commons/0/05/Joseph_Haydn.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "MOZART",
    "Wolfgang Amadeus",
    "1756-01-27",
    "1791-12-05",
    "Autriche",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/1/1e/Wolfgang-amadeus-mozart_1.jpg/1200px-Wolfgang-amadeus-mozart_1.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "VAN BEETHOVEN",
    "Ludwig",
    "1770-12-15",
    "1827-03-26",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/6/6f/Beethoven.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "VON WEBER",
    "Carl Maria",
    "1786-11-18",
    "1826-06-05",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/4/42/Caroline_Bardua_-_Bildnis_des_Komponisten_Carl_Maria_von_Weber.jpg/1200px-Caroline_Bardua_-_Bildnis_des_Komponisten_Carl_Maria_von_Weber.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "WOLF",
    "Maria Carolina",
    "1742-01-01",
    "1820-08-02",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/5/51/Benda%2C_Maria_Carolina.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "SALIERI",
    "Antonio",
    "1750-08-18",
    "1825-05-07",
    "Italie",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/0/07/Antonio_Salieri_painted_by_Joseph_Willibrord_M%C3%A4hler.jpg/1200px-Antonio_Salieri_painted_by_Joseph_Willibrord_M%C3%A4hler.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "ROSSINI",
    "Gioachino",
    "1792-02-29",
    "1868-11-13",
    "Italie",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Composer_Rossini_G_1865_by_Carjat_-_Restoration.jpg/1200px-Composer_Rossini_G_1865_by_Carjat_-_Restoration.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "DE MONTGEROULT",
    "Hélène",
    "1764-03-02",
    "1836-05-20",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/1/13/Portrait_de_la_m%C3%A8re_de_His_de_la_Salle%2C_Madame_H%C3%A9l%C3%A8ne_de_Montgeroult_-_par_COSWAY_Richard.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "FARRENC",
    "Jeanne-Louise",
    "1804-05-31",
    "1875-09-16",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/Louise_Farrenc.jpg/1200px-Louise_Farrenc.jpg"
);

-- Joining
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 4, id from `compositor` where `lastname` = "HAYDN";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 4, id from `compositor` where `lastname` = "MOZART";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 4, id from `compositor` where `lastname` = "VAN BEETHOVEN";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 4, id from `compositor` where `lastname` = "VON WEBER";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 4, id from `compositor` where `lastname` = "WOLF";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 4, id from `compositor` where `lastname` = "SALIERI";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 4, id from `compositor` where `lastname` = "ROSSINI";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 4, id from `compositor` where `lastname` = "DE MONTGEROULT";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 4, id from `compositor` where `lastname` = "FARRENC";

INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "VAN BEETHOVEN";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "VON WEBER";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "ROSSINI";


-- Romantique : 5
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "BERLIOZ",
    "Hector",
    "1803-12-11",
    "1869-03-08",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/a/aa/Hector_Berlioz_fusain.JPG"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "MENDELSSOHN",
    "Felix",
    "1809-02-03",
    "1847-11-04",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/3/38/Felix_Mendelssohn_Bartholdy.jpg/1200px-Felix_Mendelssohn_Bartholdy.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "SCHUBERT",
    "Franz",
    "1797-01-31",
    "1828-11-17",
    "Autriche",
    "https://upload.wikimedia.org/wikipedia/commons/0/0d/Franz_Schubert_by_Wilhelm_August_Rieder_1875.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "CHOPIN",
    "Frédéric",
    "1810-03-01",
    "1849-10-18",
    "Pologne",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/3/33/Chopin%2C_by_Wodzinska.JPG/1200px-Chopin%2C_by_Wodzinska.JPG"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "SCHUMANN",
    "Robert",
    "1810-06-18",
    "1856-07-29",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/f/fa/Robert_Schumann_1839.jpg/1200px-Robert_Schumann_1839.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "SCHUMANN-WIECK",
    "Clara",
    "1819-09-13",
    "1896-05-20",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/f/f3/Clara-CC.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "LISZT",
    "Franz",
    "1811-10-22",
    "1886-07-31",
    "Hongrie",
    "https://upload.wikimedia.org/wikipedia/commons/f/ff/Liszt_1858.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "WAGNER",
    "Richard",
    "1813-05-22",
    "1883-02-18",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/RichardWagner.jpg/1200px-RichardWagner.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "VERDI",
    "Giuseppe",
    "1813-10-10",
    "1901-01-27",
    "Italie",
    "https://upload.wikimedia.org/wikipedia/commons/7/7c/Verdi-photo-Brogi.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "BRAHMS",
    "Johannes",
    "1833-05-07",
    "1897-04-03",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/1/15/JohannesBrahms.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "TCHAÏKOVSKI",
    "Piotr Ilitch",
    "1840-04-25",
    "1893-11-06",
    "Russie",
    "https://upload.wikimedia.org/wikipedia/commons/0/02/Tchaikowsky.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "BONIS",
    "Mélanie Hélène",
    "1858-01-21",
    "1937-03-18",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/0/07/Mel_Bonis_1.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "MENDELSSOHN",
    "Fanny",
    "1805-11-14",
    "1847-05-14",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/0/0b/Fannymendelssohn-improved.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "SAINT-SAËNS",
    "Camille",
    "1835-10-09",
    "1921-12-16",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Saintsaens.jpg/1200px-Saintsaens.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "BRUCH",
    "Max",
    "1838-01-06",
    "1920-10-02",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/f/f5/Max_bruch.jpg"
);

-- Joining
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 4, id from `compositor` where `lastname` = "SCHUBERT";

INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "BERLIOZ";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "MENDELSSOHN";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "SCHUBERT";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "CHOPIN";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "SCHUMANN";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "SCHUMANN-WIECK";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "LISZT";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "WAGNER";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "VERDI";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "BRAHMS";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "TCHAÏKOVSKI";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "BONIS";
-- INSERT INTO `period_compositor` (`period_id`, `compositor_id`) select 5, id from `compositor` where `lastname` = "MENDELSSOHN";  -- Process for "Felix" with "Fanny"
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "SAINT-SAËNS";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "BRUCH";


-- Moderne : 6
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "STRAUSS",
    "Richard",
    "1864-06-11",
    "1949-09-08",
    "Allemagne",
    "https://upload.wikimedia.org/wikipedia/commons/2/2d/Strauss3.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "MAHLER",
    "Gustav",
    "1860-07-07",
    "1911-05-18",
    "Autriche",
    "https://upload.wikimedia.org/wikipedia/commons/6/61/Mahler_Gustav_von_Sz%C3%A9kely.png"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "GERSHWIN",
    "George",
    "1898-09-26",
    "1937-07-11",
    "États-Unis",
    "https://upload.wikimedia.org/wikipedia/commons/6/68/George_Gershwin_1937.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "SIBELIUS",
    "Jean",
    "1865-12-08",
    "1957-09-20",
    "Finlande",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2b/Jean_Sibelius%2C_1913.jpg/1200px-Jean_Sibelius%2C_1913.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "DEBUSSY",
    "Claude",
    "1862-08-22",
    "1918-03-25",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/f/f9/Claude_Debussy_ca_1908%2C_foto_av_F%C3%A9lix_Nadar.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "DUKAS",
    "Paul",
    "1865-10-01",
    "1935-05-17",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/2/2a/Paul_Dukas_01.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "RAVEL",
    "Maurice",
    "1875-03-07",
    "1937-12-28",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/7/78/Maurice_Ravel_1925.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "RESPIGHI",
    "Ottorino",
    "1879-07-09",
    "1936-04-18",
    "Italie",
    "https://upload.wikimedia.org/wikipedia/commons/c/cc/Respighi_1935.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "RACHMANINOV",
    "Sergueï",
    "1873-04-01",
    "1943-03-28",
    "Russie",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Sergei_Rachmaninoff_LOC_30160_cropped.jpg/1200px-Sergei_Rachmaninoff_LOC_30160_cropped.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "STRAVINSKY",
    "Igor",
    "1882-06-17",
    "1971-04-06",
    "Russie",
    "https://upload.wikimedia.org/wikipedia/commons/c/cc/Igor_Stravinsky_Essays.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "PROKOFIEV",
    "Sergueï",
    "1891-04-23",
    "1953-03-05",
    "Russie",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Sergei_Prokofiev_circa_1918_over_Chair_Bain.jpg/1200px-Sergei_Prokofiev_circa_1918_over_Chair_Bain.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "CHOSTAKOVITCH",
    "Dmitri",
    "1906-09-25",
    "1975-08-09",
    "Russie",
    "https://upload.wikimedia.org/wikipedia/commons/thumb/a/ab/Dmitri_Shostakovich_credit_Deutsche_Fotothek_adjusted.jpg/1200px-Dmitri_Shostakovich_credit_Deutsche_Fotothek_adjusted.jpg"
);
INSERT INTO `compositor` (`id`, `lastname`, `firstname`, `birth`, `death`, `origin`, `figure`)
VALUES (
    NULL,
    "TAILLEFERRE",
    "Germaine",
    "1892-04-19",
    "1983-11-07",
    "France",
    "https://upload.wikimedia.org/wikipedia/commons/1/12/Tailleferre_Harcourt_1937_2.jpg"
);

-- Joining
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "STRAUSS";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "MAHLER";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "SIBELIUS";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "DEBUSSY";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "DUKAS";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 5, id from `compositor` where `lastname` = "RACHMANINOV";

INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "STRAUSS";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "MAHLER";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "GERSHWIN";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "SIBELIUS";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "DEBUSSY";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "DUKAS";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "RAVEL";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "RESPIGHI";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "RACHMANINOV";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "STRAVINSKY";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "PROKOFIEV";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "CHOSTAKOVITCH";
INSERT INTO `period_compositor` (`period_id`, `compositor_id`)
select 6, id from `compositor` where `lastname` = "TAILLEFERRE";
