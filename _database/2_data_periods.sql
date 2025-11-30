--
-- MySQL
-- Data : `period, `fr_period` et `en_period`
-- Exécution : 2
--

INSERT INTO `period` (`id`, `name`, `begin`, `end`, `description`, `tag`)
VALUES (
    1,
    "Moyen-Âge",
    600,
    1400,
    "La musique du Moyen Âge est représentée principalement par des compositions vocales, religieuses ou profanes, marquées dans les premiers siècles par la monodie, notamment représentée par le plain-chant religieux et dans le domaine profane par la lyrique courtoise des troubadours et les trouvères.",
    "moyen-age"
);

INSERT INTO `period` (`id`, `name`, `begin`, `end`, `description`, `tag`)
VALUES (
    2,
    "Renaissance",
    1400,
    1600,
    "Par rapport au Moyen Âge, les compositeurs passent du tempérament pythagoricien au tempérament mésotonique dans l'accord des instruments à sons fixes. L'usage des tierces et des sixtes se généralise. Le modèle esthétique vocal persiste, malgré la naissance d'une musique spécifiquement instrumentale. Les genres de la musique de la Renaissance sont essentiellement vocaux : la chanson polyphonique, la chanson pour luth, le motet, la messe, le madrigal ou la canzone instrumentale." ,
    "renaissance"
);

INSERT INTO `period` (`id`, `name`, `begin`, `end`, `description`, `tag`)
VALUES (
    3,
    "Baroque",
    1600,
    1750,
    "Le style baroque se caractérise notamment par l’importance du contrepoint puis par une harmonie qui s’enrichit progressivement, par une expressivité accrue, par l’importance donnée aux ornements, par la division fréquente de l’orchestre avec basse continue, qui est nommé ripieno, par un groupe de solistes qui est le concertino et par la technique de la basse continue chiffrée comme accompagnement de sonates. C’est un style savant et sophistiqué." ,
    "baroque"
);

INSERT INTO `period` (`id`, `name`, `begin`, `end`, `description`, `tag`)
VALUES (
    4,
    "Classique",
    1750,
    1800,
    "Le langage classique se définit par des règles très strictes, une grande rigueur formelle, une grande simplicité harmonique, et un sens développé de la mélodie. Le principe de contraste, très dramatique, au sein d'une même pièce est l'élément moteur. En outre, disparition de la basse continue. On passe de l'utilisation de “figures” (prédominantes en Baroque) à la structuration à partir de “phrases musicales ponctuées”, et des procédés “analogiques” vers des ceux de “logique discursive”.",
    "classique"
);

INSERT INTO `period` (`id`, `name`, `begin`, `end`, `description`, `tag`)
VALUES (
    5,
    "Romantique",
    1800,
    1900,
    "L'expression musique romantique désigne un type de musique qui domine en Europe tout au long du xixe siècle. Ce courant musical aux formes variées qui met au premier plan l'expression de l'émotion1 s'inscrit dans le mouvement esthétique européen du romantisme qui touche les arts et la littérature sous l'influence de l'Angleterre et de l'Allemagne où s'approfondit une nouvelle sensibilité à partir de la fin du xviiie siècle.",
    "romantique"
);

INSERT INTO `period` (`id`, `name`, `begin`, `end`, `description`, `tag`)
VALUES (
    6,
    "Moderne",
    1900,
    1950,
    "Seule la chronologie est significative, cette période n'a pas d'unité de style : c'est la floraison d'expériences et d'esthétiques diverses, souvent opposées à ce qui se développe à cette époque comme la trialité “musique tonale / musique modale / musique atonale”. Avec Debussy, il y a une rupture dans l'écriture du discours musical, qui non seulement s'affranchit des contraintes tonales, mais pose aussi les premières pierres de la musique séquentielle.",
    "moderne"
);

INSERT INTO `period` (`id`, `name`, `begin`, `end`, `description`, `tag`)
VALUES (
    7,
    "Contemporaine",
    1950,
    NULL,
    "La musique contemporaine représente les différents courants de musique savante apparus après la Seconde Guerre mondiale, dont certains ont emprunté des voies nouvelles en dehors du système tonal. L’émergence de mutations dans les formes d'écriture laisse entrevoir une nouvelle tendance de la composition. Surtout : recherches de nouvelles formes d’expression pour aboutir à de nouveaux concepts (notions fondamentales d’acoustique, et d’objets sonores et musicaux).",
    "contemporaine"
);
