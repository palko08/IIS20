USE IIS2020;

INSERT INTO Festival(nazov, kapacita, datum_Od, datum_Do, cena, adresa, hodnotenie)
VALUES("festival1", 100, '2020-11-05 18:00:00', '2020-11-06 02:00:00', 15.00, "Niekde26", 3.8);
INSERT INTO Festival(nazov, kapacita, datum_Od, datum_Do, cena, adresa)
VALUES("festival2", 500, '2020-10-25 20:00:00', '2020-10-26 10:00:00', 12.55, "Dakde44");
INSERT INTO Festival(nazov, kapacita, datum_Od, datum_Do, cena, adresa)
VALUES("festival3", 2500, '2020-11-02 20:30:00', '2020-11-03 16:30:00', 20.00, "Tuto17");
INSERT INTO Festival(nazov, kapacita, datum_Od, datum_Do, cena, adresa, hodnotenie)
VALUES("festival4", 5000, '2020-11-14 22:00:00', '2020-11-16 02:00:00', 25.80, "Ulica7", 4.1);

INSERT INTO Podium(festival_ID, nazov)
VALUES(1, "podium1");
INSERT INTO Podium(festival_ID, nazov)
VALUES(2, "podium2");
INSERT INTO Podium(festival_ID, nazov)
VALUES(2, "podium3");
INSERT INTO Podium(festival_ID, nazov)
VALUES(3, "podium4");
INSERT INTO Podium(festival_ID, nazov)
VALUES(3, "podium5");
INSERT INTO Podium(festival_ID, nazov)
VALUES(4, "podium6");
INSERT INTO Podium(festival_ID, nazov)
VALUES(4, "podium7");
INSERT INTO Podium(festival_ID, nazov)
VALUES(4, "podium8");
INSERT INTO Podium(festival_ID, nazov)
VALUES(4, "podium9");
INSERT INTO Podium(festival_ID, nazov)
VALUES(4, "podium10");

INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret1", 3.5);
INSERT INTO Interpret(nazov)
VALUES("interpret2");
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret3", 3.7);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret4", 3.2);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret5", 4.5);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret6", 4.1);
INSERT INTO Interpret(nazov)
VALUES("interpret7");
INSERT INTO Interpret(nazov)
VALUES("interpret8");
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret9", 3.7);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret10", 3.3);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret11", 4.4);
INSERT INTO Interpret(nazov, hodnotenie)
VALUES("interpret12", 2.9);

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
VALUES("meno1");
INSERT INTO Clovek(meno)
VALUES("meno2");
INSERT INTO Clovek(meno)
VALUES("meno3");
INSERT INTO Clovek(meno)
VALUES("meno4");
INSERT INTO Clovek(meno)
VALUES("meno5");
INSERT INTO Clovek(meno)
VALUES("meno6");
INSERT INTO Clovek(meno)
VALUES("meno7");
INSERT INTO Clovek(meno)
VALUES("meno8");
INSERT INTO Clovek(meno)
VALUES("meno9");
INSERT INTO Clovek(meno)
VALUES("meno10");
INSERT INTO Clovek(meno)
VALUES("meno11");
INSERT INTO Clovek(meno)
VALUES("meno12");
INSERT INTO Clovek(meno)
VALUES("meno13");
INSERT INTO Clovek(meno)
VALUES("meno14");
INSERT INTO Clovek(meno)
VALUES("meno15");
INSERT INTO Clovek(meno)
VALUES("meno16");
INSERT INTO Clovek(meno)
VALUES("meno17");
INSERT INTO Clovek(meno)
VALUES("meno18");
INSERT INTO Clovek(meno)
VALUES("meno19");
INSERT INTO Clovek(meno)
VALUES("meno20");
INSERT INTO Clovek(meno)
VALUES("meno21");
INSERT INTO Clovek(meno)
VALUES("meno22");
INSERT INTO Clovek(meno)
VALUES("meno23");
INSERT INTO Clovek(meno)
VALUES("meno24");
INSERT INTO Clovek(meno)
VALUES("meno25");
INSERT INTO Clovek(meno)
VALUES("meno26");
INSERT INTO Clovek(meno)
VALUES("meno27");
INSERT INTO Clovek(meno)
VALUES("meno28");
INSERT INTO Clovek(meno)
VALUES("meno29");
INSERT INTO Clovek(meno)
VALUES("meno30");
INSERT INTO Clovek(meno)
VALUES("meno31");
INSERT INTO Clovek(meno)
VALUES("meno32");

INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(1, "admin", "admin", "admin", 'admin');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(2, "email2", "login2", "heslo2", 'poradatel');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(3, "email3", "login3", "heslo3", 'poradatel');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(4, "email4", "login4", "heslo4", 'pokladni');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(5, "email5", "login5", "heslo5", 'pokladni');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(6, "email6", "login6", "heslo6", 'pokladni');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(7, "email7", "login7", "heslo7", 'divak');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(8, "email8", "login8", "heslo8", 'divak');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(9, "email9", "login9", "heslo9", 'divak');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(10, "email10", "login10", "heslo10", 'divak');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(11, "email11", "login11", "heslo11", 'divak');
INSERT INTO Registrovany(registrovany_ID, email, login, heslo, level_opravnenia)
VALUES(12, "email12", "login12", "heslo12", 'divak');

INSERT INTO Neregistrovany(neregistrovany_ID, email)
VALUES(13, "email13");
INSERT INTO Neregistrovany(neregistrovany_ID, email)
VALUES(14, "email14");
INSERT INTO Neregistrovany(neregistrovany_ID, email)
VALUES(15, "email15");

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
VALUES("zaner1");
INSERT INTO Zaner(zaner_nazov)
VALUES("zaner2");
INSERT INTO Zaner(zaner_nazov)
VALUES("zaner3");
INSERT INTO Zaner(zaner_nazov)
VALUES("zaner4");
INSERT INTO Zaner(zaner_nazov)
VALUES("zaner5");
INSERT INTO Zaner(zaner_nazov)
VALUES("zaner6");

INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(1, 7);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(1, 8);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(1, 9);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(1, 10);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(2, 11);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(2, 12);
INSERT INTO Vstupenka(festival_ID, neregistrovany_ID)
VALUES(2, 13);
INSERT INTO Vstupenka(festival_ID, neregistrovany_ID)
VALUES(2, 14);
INSERT INTO Vstupenka(festival_ID, neregistrovany_ID)
VALUES(3, 15);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(3, 7);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(3, 8);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(3, 9);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(3, 10);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(4, 11);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(4, 12);
INSERT INTO Vstupenka(festival_ID, neregistrovany_ID)
VALUES(4, 13);
INSERT INTO Vstupenka(festival_ID, neregistrovany_ID)
VALUES(4, 14);
INSERT INTO Vstupenka(festival_ID, neregistrovany_ID)
VALUES(4, 15);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(4, 7);
INSERT INTO Vstupenka(festival_ID, registrovany_ID)
VALUES(4, 8);

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