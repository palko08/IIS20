USE IIS2020;

INSERT INTO Festival(kapacita, datum, adresa)
VALUES(100, '2020-11-05 18:00:00', "Niekde 26");
INSERT INTO Festival(kapacita, datum, adresa)
VALUES(500, '2020-10-25 20:00:00', "Dakde 44");
INSERT INTO Festival(kapacita, datum, adresa)
VALUES(2500, '2020-11-02 20:30:00', "Tuto 17");
INSERT INTO Festival(kapacita, datum, adresa)
VALUES(5000, '2020-11-14 22:00:00', "Ulica 7");

INSERT INTO Podium(festival_ID, nazov)
VALUES(1, "prve podium");
INSERT INTO Podium(festival_ID, nazov)
VALUES(2, "druhe podium");
INSERT INTO Podium(festival_ID, nazov)
VALUES(2, "tretie podium");
INSERT INTO Podium(festival_ID, nazov)
VALUES(3, "stvrte podium");
INSERT INTO Podium(festival_ID, nazov)
VALUES(3, "piate podium");
INSERT INTO Podium(festival_ID, nazov)
VALUES(4, "podium 6");
INSERT INTO Podium(festival_ID, nazov)
VALUES(4, "podium 7");
INSERT INTO Podium(festival_ID, nazov)
VALUES(4, "podium 8");
INSERT INTO Podium(festival_ID, nazov)
VALUES(4, "podium 9");
INSERT INTO Podium(festival_ID, nazov)
VALUES(4, "podium 10");

INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret 1", 3.5);
INSERT INTO Interpret(nazov)
VALUES("interpret 2");
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret 3", 3.7);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret 4", 3.2);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret 5", 4.5);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret 6", 4.1);
INSERT INTO Interpret(nazov)
VALUES("interpret 7");
INSERT INTO Interpret(nazov)
VALUES("interpret 8");
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret 9", 3.7);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret 10", 3.3);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret 11", 4.4);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret 12", 2.9);

INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(1, 1, '2020-11-05 18:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(2, 1, '2020-11-05 19:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(3, 1, '2020-11-05 20:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(4, 1, '2020-11-05 21:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(5, 2, '2020-10-25 20:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(6, 2, '2020-10-25 21:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(7, 2, '2020-10-25 22:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(8, 3, '2020-10-25 20:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(9, 3, '2020-10-25 21:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(10, 3, '2020-10-25 22:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(11, 3, '2020-10-25 23:30:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(12, 4, '2020-11-02 20:30:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(1, 4, '2020-11-02 21:30:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(2, 4, '2020-11-02 22:30:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(3, 5, '2020-11-02 20:30:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(4, 5, '2020-11-02 21:30:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(5, 5, '2020-11-02 22:30:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(6, 5, '2020-11-03 00:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(7, 6, '2020-11-14 22:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(8, 7, '2020-11-14 22:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(9, 8, '2020-11-14 23:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(10, 9, '2020-11-14 23:00:00');
INSERT INTO Interpret_vystupuje_na_Podium(interpret_ID, podium_ID, cas_vystupenia)
VALUES(11, 10, '2020-11-15 01:00:00');

INSERT INTO Clovek(meno)
VALUES("meno 1");
INSERT INTO Clovek(meno)
VALUES("meno 2");
INSERT INTO Clovek(meno)
VALUES("meno 3");
INSERT INTO Clovek(meno)
VALUES("meno 4");
INSERT INTO Clovek(meno)
VALUES("meno 5");
INSERT INTO Clovek(meno)
VALUES("meno 6");
INSERT INTO Clovek(meno)
VALUES("meno 7");
INSERT INTO Clovek(meno)
VALUES("meno 8");
INSERT INTO Clovek(meno)
VALUES("meno 9");
INSERT INTO Clovek(meno)
VALUES("meno 10");
INSERT INTO Clovek(meno)
VALUES("meno 11");
INSERT INTO Clovek(meno)
VALUES("meno 12");
INSERT INTO Clovek(meno)
VALUES("meno 13");
INSERT INTO Clovek(meno)
VALUES("meno 14");
INSERT INTO Clovek(meno)
VALUES("meno 15");
INSERT INTO Clovek(meno)
VALUES("meno 16");
INSERT INTO Clovek(meno)
VALUES("meno 17");
INSERT INTO Clovek(meno)
VALUES("meno 18");
INSERT INTO Clovek(meno)
VALUES("meno 19");
INSERT INTO Clovek(meno)
VALUES("meno 20");
INSERT INTO Clovek(meno)
VALUES("meno 21");
INSERT INTO Clovek(meno)
VALUES("meno 22");
INSERT INTO Clovek(meno)
VALUES("meno 23");
INSERT INTO Clovek(meno)
VALUES("meno 24");
INSERT INTO Clovek(meno)
VALUES("meno 25");
INSERT INTO Clovek(meno)
VALUES("meno 26");
INSERT INTO Clovek(meno)
VALUES("meno 27");
INSERT INTO Clovek(meno)
VALUES("meno 28");
INSERT INTO Clovek(meno)
VALUES("meno 29");
INSERT INTO Clovek(meno)
VALUES("meno 30");
INSERT INTO Clovek(meno)
VALUES("meno 31");
INSERT INTO Clovek(meno)
VALUES("meno 32");

INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(1, "email 1", "login 1", "heslo 1", 'admin');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(2, "email 2", "login 2", "heslo 2", 'poradatel');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(3, "email 3", "login 3", "heslo 3", 'poradatel');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(4, "email 4", "login 4", "heslo 4", 'pokladni');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(5, "email 5", "login 5", "heslo 5", 'pokladni');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(6, "email 6", "login 6", "heslo 6", 'pokladni');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(7, "email 7", "login 7", "heslo 7", 'divak');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(8, "email 8", "login 8", "heslo 8", 'divak');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(9, "email 9", "login 9", "heslo 9", 'divak');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(10, "email 10", "login 10", "heslo 10", 'divak');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(11, "email 11", "login 11", "heslo 11", 'divak');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(12, "email 12", "login 12", "heslo 12", 'divak');

INSERT INTO Neregistrovany(neregistrovany_ID)
VALUES(13);
INSERT INTO Neregistrovany(neregistrovany_ID)
VALUES(14);
INSERT INTO Neregistrovany(neregistrovany_ID)
VALUES(15);

INSERT INTO Clen(clen_ID)
VALUES(16);
INSERT INTO Clen(clen_ID)
VALUES(17);
INSERT INTO Clen(clen_ID)
VALUES(18);
INSERT INTO Clen(clen_ID)
VALUES(19);
INSERT INTO Clen(clen_ID)
VALUES(20);
INSERT INTO Clen(clen_ID)
VALUES(21);
INSERT INTO Clen(clen_ID)
VALUES(22);
INSERT INTO Clen(clen_ID)
VALUES(23);
INSERT INTO Clen(clen_ID)
VALUES(24);
INSERT INTO Clen(clen_ID)
VALUES(25);
INSERT INTO Clen(clen_ID)
VALUES(26);
INSERT INTO Clen(clen_ID)
VALUES(27);
INSERT INTO Clen(clen_ID)
VALUES(28);
INSERT INTO Clen(clen_ID)
VALUES(29);
INSERT INTO Clen(clen_ID)
VALUES(30);
INSERT INTO Clen(clen_ID)
VALUES(31);
INSERT INTO Clen(clen_ID)
VALUES(32);

INSERT INTO Zaner(zaner_nazov)
VALUES("zaner 1");
INSERT INTO Zaner(zaner_nazov)
VALUES("zaner 2");
INSERT INTO Zaner(zaner_nazov)
VALUES("zaner 3");
INSERT INTO Zaner(zaner_nazov)
VALUES("zaner 4");
INSERT INTO Zaner(zaner_nazov)
VALUES("zaner 5");
INSERT INTO Zaner(zaner_nazov)
VALUES("zaner 6");

INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(10, 1, 7);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(10, 1, 8);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(10, 1, 9);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(10, 1, 10);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(15, 2, 11);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(15, 2, 12);
INSERT INTO Vstupenka(cena, festival_ID, neregistrovany_ID)
VALUES(15, 2, 13);
INSERT INTO Vstupenka(cena, festival_ID, neregistrovany_ID)
VALUES(15, 2, 14);
INSERT INTO Vstupenka(cena, festival_ID, neregistrovany_ID)
VALUES(12, 3, 15);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(12, 3, 7);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(12, 3, 8);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(12, 3, 9);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(12, 3, 10);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(25, 4, 11);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(25, 4, 12);
INSERT INTO Vstupenka(cena, festival_ID, neregistrovany_ID)
VALUES(25, 4, 13);
INSERT INTO Vstupenka(cena, festival_ID, neregistrovany_ID)
VALUES(20, 4, 14);
INSERT INTO Vstupenka(cena, festival_ID, neregistrovany_ID)
VALUES(20, 4, 15);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(20, 4, 7);
INSERT INTO Vstupenka(cena, festival_ID, registrovany_ID)
VALUES(20, 4, 8);

INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(1, 1);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(1, 2);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(2, 3);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(2, 4);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(2, 5);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(3, 5);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(3, 6);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(3, 7);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(4, 7);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(4, 8);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(5, 8);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(5, 9);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(5, 10);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(6, 11);
INSERT INTO Interpret_patri_do_Zaner(zaner_ID, interpret_ID)
VALUES(6, 12);

INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(1, 1);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(2, 1);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(2, 2);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(3, 2);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(4, 2);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(5, 2);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(6, 2);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(6, 3);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(1, 3);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(2, 3);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(3, 3);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(3, 4);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(4, 4);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(5, 4);
INSERT INTO Festival_patri_do_Zaner(zaner_ID, festival_ID)
VALUES(6, 4);

INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(16, 1);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(17, 1);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(18, 1);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(19, 2);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(20, 2);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(21, 3);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(22, 3);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(23, 4);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(24, 4);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(25, 5);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(26, 5);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(27, 5);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(28, 5);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(29, 6);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(30, 6);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(31, 7);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(32, 8);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(16, 9);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(17, 10);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(18, 10);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(19, 10);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(20, 11);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(21, 11);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(22, 12);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(23, 12);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(24, 12);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(25, 12);
INSERT INTO Clen_je_v_Interpret(clen_ID, interpret_ID)
VALUES(26, 12);