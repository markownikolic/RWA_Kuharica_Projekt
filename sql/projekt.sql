-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2017 at 09:17 AM
-- Server version: 5.7.16
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekt`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id_followed` int(11) NOT NULL,
  `id_follower` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `ID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `spol` varchar(10) NOT NULL,
  `permission` varchar(10) NOT NULL DEFAULT 'member',
  `join_date` date NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `slika` varchar(50) NOT NULL DEFAULT 'default-profile.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`ID`, `username`, `password`, `email`, `spol`, `permission`, `join_date`, `last_login`, `slika`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin@admin.com', 'musko', 'admin', '2017-01-08', '2017-01-30 01:59:15', 'default-profile.jpg'),
(2, 'test', '5f4dcc3b5aa765d61d8327deb882cf99', 'test@test.com', 'musko', 'member', '2017-01-09', '2017-01-28 18:04:09', 'default-profile.jpg'),
(3, 'korisnik', '5f4dcc3b5aa765d61d8327deb882cf99', 'korisnik@korisnik.com', 'musko', 'member', '2017-01-11', '2017-01-16 07:28:06', 'default-profile.jpg'),
(4, 'member', '5f4dcc3b5aa765d61d8327deb882cf99', 'member@member.com', 'musko', 'member', '2017-01-12', '2017-01-16 00:00:00', 'default-profile.jpg'),
(5, 'gladan', '5f4dcc3b5aa765d61d8327deb882cf99', 'gladan@gladan.hr', 'musko', 'member', '2017-01-12', '2017-01-30 01:58:59', 'e43817bcb24f7637eb4092de00b72b13.jpg'),
(6, 'josip123', '5f4dcc3b5aa765d61d8327deb882cf99', 'josip123@gmail.com', 'musko', 'member', '2017-01-16', '2017-01-17 00:00:00', 'default-profile.jpg'),
(7, 'marko', 'e10adc3949ba59abbe56e057f20f883e', 'lalalal@riteh.hr', 'musko', 'member', '2017-01-29', '2017-01-29 23:47:10', 'default-profile.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ocjena`
--

CREATE TABLE `ocjena` (
  `id_korisnika` int(11) NOT NULL,
  `id_recepta` int(11) NOT NULL,
  `ocjena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ocjena`
--

INSERT INTO `ocjena` (`id_korisnika`, `id_recepta`, `ocjena`) VALUES
(2, 2, 5),
(2, 4, 3),
(3, 4, 3),
(5, 1, 3),
(5, 2, 1),
(5, 3, 4),
(5, 4, 3),
(5, 6, 5),
(5, 8, 4),
(5, 9, 4);

-- --------------------------------------------------------

--
-- Table structure for table `priprema`
--

CREATE TABLE `priprema` (
  `ID` int(11) NOT NULL,
  `ID_recepta` int(11) NOT NULL,
  `Priprema` text CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priprema`
--

INSERT INTO `priprema` (`ID`, `ID_recepta`, `Priprema`) VALUES
(1, 1, 'Mandarine cijele, s korom, prokuhajte tako da ih stavite u hladnu vodu, kad uzavru, kuhajte ih oko 2 minute.\r'),
(2, 1, 'Operite ih i ponovite postupak. Kad ste ih opet prokuhali, sameljite ih, da dobijete pulpu.\r'),
(3, 1, 'Tucite jaja i šećer, dodajte im pulpu, omekšani maslac, brašno, kokos i prašak za pecivo.\r'),
(4, 1, 'Pecite u namaštenim kalupima za muffine-kuglofiće. Ja sam ih pekao na 180°C, oko 15 minuta, tj. dok mi zabodena čačkalica nije izašča van čista.\r'),
(5, 1, 'Skuhajte zaljev od soka i šećera s dodatkom narančine korice.\r'),
(6, 1, 'Kade se kolačići malo prohlade, izvadite ih iz kalupa, pa ih vratite u kalupe, polijte ih zaljevom, ohladite, ponovo izvadite iz kalupa i pospite šećerom u prahu.'),
(7, 2, 'Banane isjeći na kolutove. Uvaljati svaki u kokos, čokoladu i mrvice te naizmjenično redati na štapić za ražnjiće.'),
(8, 3, 'Sve sastojke pomiješati u blenderu. Po želji možete staviti u frižider na hlađenje.'),
(9, 4, 'Skuhati puding od ljesnjaka i ostaviti da se ohladi. Umjesati puter sa secerom u prahu pa dodati ohladeni puding.\r'),
(10, 4, 'Samljeti ljesnjake i napolitanku od ljesnjaka skupa. Odvojiti 2 kasike smjese za posuti po vrhu pa onda raspodjeliti na 2 dijela. Dodati nutellu i pola samljevenih napolitanki i ljesnjaka u puding/puter kremu i ujednaciti kremu.Kremu raspodjeliti na 4 djela.\r'),
(11, 4, 'Ganache: Staviti vrhnje da se ugrije pa preliti preko cokolade i ismjesati da se istopi cokolada.  Dodati u ganache drugu polovicu napolitanke/ljesnjak smjesu i izmjesati.\r'),
(12, 4, 'Skuhajte crnu kafu i izlijte  u zdjelu.\r'),
(13, 4, 'Prvu koru premazati s kafom pa staviti prvi dio kreme od pudinga.\r'),
(14, 4, 'Staviti drugu koru pa premazati sa kafom, zatim ganache kremom i onda preko 2 djelom puding kreme i staviti  koru preko. Uraditi isto i sa 3 korom, premazati kafom, ganache kremom, pa kremom od pudinga  i preklopiti 4 korom.\r'),
(15, 4, 'Svu madaricu preci sa ostatkom kremom tj. cetvrtim djelom. Ostaviti u frizider preko noci.\r'),
(16, 4, 'Sutradan istopiti 100 g cokolade s kasikom ulja i preliti preko madarice.Posuti sa one dvije kasike smjese od samljevenih ljesnjaka i napolitanke. Vratite u frizider da se cokolade stegne. Sjeci i posluziti.'),
(17, 5, 'Ogulite i operite krumpir.Naribate ga na ribežu na tanke fetice /kao za čips/.Naribate i oguljeni luk..Pripremite lim za pečenje /uzmite onaj manji.Slažite red krumpira pa malo luka i tako redom dok ne potrošite sve sastojke.Između svakog reda lagano posolite i popaprite /ja stavim malo više papara jer meni to paše uz krumpir vi naravno po želji,koristiti te naravno papar iz mlinca /.Zadnji red neka bude krumpir ,njega isto posolite i popaprite te premažete maslinovim uljem.\r'),
(18, 5, 'Stavite peći na 200C/30min ili dok krumpir ne dobije finu boju i postane hrskav.\r'),
(19, 5, 'Servirati toplo kao prilog .'),
(20, 6, 'Janjetinu izrezanu na komade prvo posolio i stavio u marinadu od crnog vina, nasjeckanog luka i ružmarina. I tako ostavio oko 3 sata.\r'),
(21, 6, 'Stavio u zagrijano ulje i prepržio sa svih strana. Nakon prženja stavio u topli lonac i poklopio.\r'),
(22, 6, 'Na to ulje stavio nasjeckani luk iz marinade, naribani celer korijen, pastrnjak, veliku mrkvu, češnjak nasjeckan na listiće i pirjao dok nije omekšalo. Zatim ulio crno vino iz marinade, pasiranu rajčicu (1/2l), dosta friškog bosiljka, dva komada pilećih jetrica bez srca,  oko 3dcl vode i kuhao 10-tak minuta. Taj šug izmiksao štapnim mikserom i stavio nazad na vatru. Za ljutinu sam nakapao 1/3 čajne žlice  sriracha umaka. Fantastična namirnica tko voli ljuto, a i nije skupa, plus traje jako dugo.\r'),
(23, 6, 'Ubacio nazad meso u taj šug, stavio grančicu ružmarina, tri lovor lista i stavio na laganu vatru oko 2 i pol sata da se lagano krčka.'),
(24, 7, 'Ovu salatu si možete pripremiti i u dane kad ste najlijeniji na svijetu. Najveći napor predstavlja skuhati jaje na tvrdo. I nasjeckati na kockice sve predložene namirnice.\r'),
(25, 7, 'Sve nasjeckano malo posolite i popaprite. Začinite maslinovim uljem i sokom od limuna, promiješajte.\r'),
(26, 7, 'Servirajte na posteljici od rige, kako je to popularno reći.\r'),
(27, 7, 'Dobar tek!\r\n'),
(28, 8, 'Svi sastojci osim brašna izmiješaju se mikserom u zdjeli koja smije na peć, jer se tijesto prvo mora zagrijati. Stavi se na laganu vatru i stalno miješa sve dok se soda ne zapijeni. Tad se makne i umiješa brašno. Zamijesti se glatko tijesto, koje je gumenkasto zbog meda i vrlo se lako razvlaći u kore veličine lima od pećnice.\r'),
(29, 8, 'Tijesto se podijeli u četiri jednaka dijela i odmah se razvlaće kore, jer puno lakše ide kad je tijesto toplo nego dok se ohladi. Ja radim na četiri kore, vi probajte, ali vam savjetujem da za prvi put probate na tri, bit će vam lakše razvaljati na malo deblje kore. Moje su jako tanke.\r'),
(30, 8, 'Svaka kora se razvalja u velićini lima od pećnice i namota na valjak i prenese na preokreniti lim pobrašnjen brašnom. To ide bez problema jer tijesto ne puca, ali ako se vi bojite tako, slobodno razvaljajte na papiru za pećenje pa prenesite sa papirom. Kad je kora na limu ja je malo dotjeram odrežem višak tijesta.\r'),
(31, 8, 'Kore se peku na 180 stupnjeva nekih 5 – 8 min, kad se rubovi poćinju zapecati vade se van. Lagano se prođe nožem za rezanje kruha ispod kore i odvoji od lima i lagano spusti na krpu.\r'),
(32, 8, 'Za kremu se brašno (dvije i pol žlice brašna na vrh, ne ravne), 2 žlice šećera i vanilin šećer skuhaju u mlijeku ko puding. Kad se ohladi umiješa se u margarin izrađen sa mljevenim šećerom i dobro izmiksa da bude lijepa glatka krema.\r'),
(33, 8, 'Krema se podijeli u tri jednaka dijela i mažu se kore. Na zadnju ide čokoladna glazura.\r'),
(34, 8, 'Kore su tvrde kad se premazuju kremom, zato treba nježno pritiskati da se ne polome. Nakon nekoliko sati one već otpuste i režu se bez problema, a u ustima se tope, doslovno. Potrebno je kore premazati isti dan, jer ja jednom nisam, ostavila sam za sutra i tada se nisu otpustile, bile su krckave do zadnje kockice.\r'),
(35, 8, 'Možda izgleda komplicirano, ali kažem vam nije uopće. Kore se razvlaće bez problema, ne pucaju, a kolač poslije otpusti i reže se u oblike kakve želite, a okus je nezaboravan to vam mogu potvrditi moji sinovi i svi moji prijatelji. Kolača ispadne puno, ali brzo i nestane.'),
(36, 9, 'Prvi korak je narezati luk i prodinstati na malo ulja. Na prodinstani luk dodajemo ostalo povrće i pričekamo da omekša. \r'),
(37, 9, 'Dok se povrće kuha, napraviti ćemo umak. U umak od rajčice dodajemo začine po želji; za tortilje su prigodni ljuti začini poput crvene paprike i čilija, a možete koristiti i gotove začine za tortilje, poput (veganske) gotove smjese "Fajita"\r'),
(38, 9, 'Kada je povrće malo omekšalo, dodajte umak od rajčice i kuhajte na laganoj vatri uz povremeno miješanje. Pred kraj, dodajte još malo soli, papra, crvene paprike i šećera (šećer se jako dobro slaže s ljutim). \r'),
(39, 9, 'Kada je punjenje gotovo, pripremiti ćemo i tortilje. Tortilje su brzo gotove, a mogu se pripremiti u mikrovalnoj ili na štednjaku\r'),
(40, 9, 'Ako ih pripremate na tavi, ugrijte tavu, stavite tortilju u tavu i poprskajte s par kapi vode. Isto ponovite i na drugoj strani i tortilja je spremna! \r'),
(41, 9, 'Napunite je s povrćem, zarolajte i presavinite na jednom dijelu kako povrće ne bi ispadalo van. '),
(42, 10, 'Očistiti leću i staviti je u lonac.Mrkvu sitno isjeckati,krumpir isjeći na veće komade i sa svim ostalim satojcima staviti kuhati.\r'),
(43, 10, 'Kada juha provri kuhati još jedno pola sata tj.dok nam svo povrće nije kuhano.\r'),
(44, 10, 'Odvaditi iz lonca papriku,kapulu i selen,a krumpir zgniječiti vilicom o stijenke lonca.Prokuhati još kratko pa, eventualno,doliti još vode kako bi dobili željenu gustoću juhe.\r'),
(45, 10, 'Sitno izrežemo slaninu(samo bijelo),češnjak i peršin.Zatim sve zajedno smiksamo u multipraktiku ili oštrim nožem, na drvenoj dasci, sjeckamo i sjeckamo dok ne dobijemo kao neku vrstu namaza.\r'),
(46, 10, 'Pešt možemo duže vrijeme čuvati u frižideru,a može se  i zamrznuti stoga uvijek napravim veću količinu\r\n'),
(75, 11, 'Na maslinovom ulju popržiti tanko rezani na manje komade pileći file (kao male pločice). Izvaditi iz lonca i u tu masnoću popržiti luk,češnjak i poriluk. Kad omekša vratiti file ,posoliti , popapriti , dodati crvenu papriku i podliti s malo vode te nastaviti pirjati na laganoj temperaturi.\r'),
(76, 11, 'U multipraktiku izmiksati mrkvu ,pastrnjak u grublju teksturu i dodati mesu.Krumpir izrezati manje kockice dodati zajedno s bobom i peršinom. .Dodati još vode i\r'),
(77, 11, 'kuhati na laganoj temperaturi dok sve ne bude kuhano.'),
(78, 12, 'Od jaja i brašna napraviti testo i razviti kore kao za rezance za supu, odnosno malo deblje t.j za lazanje.  Najbolje je da budu tanje kore, ne ni debele moraćete sami da odredite i to veličine posude, najbolje je 4 takve.  Mogu se narezati na trake  (kore sam imala pripremljena dan ranije, malo osušene, bile su mi u frižideru do sutradan i pravila sam od njih ). Dovoljno je da se razviju, malo prosuše i posle pripremaju.Od ostatka testa, posle krojenja prema posudi može se napraviti fida za supu. Ređati ih bez kuvanja!!! Ili kupiti pakovanje kora za lazanje ili pločice. Koliko vam pločica treba,  izračunajte, sve zavisi od posude u kojoj spremate (20 pločica 5 redova) Gotove kore i pločice, ređati bez kuvanja, dovoljno je da se malo razredi bešamel ili da se nalije odozgo (može i vinom, vodom...) važno je da sve bude potopljeno da bi moglo da se skuva.\r'),
(79, 12, 'U većoj posudi, nije dovoljan tiganj, praviti sos bolonjeze. Sitno seckan crni luk ili praziluk izdinstati na ulju (ja sam stavila i jedan i drugi) i dodati malo slaninice seckane na sitne kockice. Fino upržiti pa dodati mleveno meso. Upržiti meso i dodati crno vino. Kuvati meso u vinu dok ne ispari. Dodati šargarepu i celer rendano na sitno rende. Zaliti sokom od paradajza ali postepeno , vodite računa da ne bude previše (ja sam nalivala  tomatinom) i ukuvati. Dodati začine po ukusu, so, biber, bosiljak i origano i seckane masline. Šampinjone propržiti posebno u tiganju . Pomešati ih sa pripremljenom sosom (možete na vrlo malo ulja ili na maslacu, tek da se ne bi lepile)  Savet: ne secite šampinjone suviše tanko jer gube na masi prilikom prženja, bolje je na deblje ploškice. Ako imate kakvu ljutenicu slobodno dodajte jednu kašičicu, da se oseti malo ljutina u ustima, naravno ko voli.\r'),
(80, 12, 'Spremiti bešamel sos. U posudi na maslacu propržiti 2 kašike brašna, kad zapenuša, voditi računa  da ne izgori ,spremati na umerenoj vatri, dodati postepeno 1/2 l mleka stalno mešajući. Mešati stalno dok se ne ukuva, posoliti pobiberiti belim biberom i dodajte sok od pola limuna. Limun malo zgusne sos i daje mu lepu aromu.\r'),
(81, 12, 'Ređati lazanje.   Podmastite posudu. Prekrijte dno posude bešamel sosom. pa rađati, lazanje, bešamel sos , crveni sos. Na zadnji sloj cvenog sosa, poređati mozarelu  sečenu na tanke šnite , pa opet red lazanja i zalijte lepo preko belim sosom. Malo pospite ribani parmezan ako imate, nije obavezno. Pospite preko origano i pecite, jedno pola sata u zagrejanoj rerni na 190 stepeni. Slojeve slažite koliko imate pločica ili testa, sami ćete videti da li može u tri ili četiri reda. Ja sam imala za tri sloja domaćeg testa , vatrostalna posuda 24x35 ali ne visoka. Bila je puna skoro do vrha, tako da sam morala da stavim ispod foliju da ne curi po rerni. Probala sam malo kore i odozgo i odozdo da vidim kako su se ispekle da li treba još. Čim su ukusne, znači pečeno je. Ostavite da odstoji, da smekša gornja kora do služenja.\r'),
(82, 12, 'Još jedan savet: meso je lepše kad je krupno mleveno, jednom samo da se samelje kroz mašinu u prodavnici ili ručno sa krupnom rešetkom. Lepo je kad se oseti dok se jede. Sir kad se stavi preko zadnjeg sloja kora, stvrdne kore i može da pregori, bolje je ispod njih. Dovoljno je samo bešamel sos preko kora i začini.'),
(83, 13, 'Pripremiti pire krumpir i ohladiti gaZa pire skuham krumpir narezan na kockice,ocijedim i dodam maslac ili margarin te malo mlijeka ili vrhnja..Dodati brašno oštro ,jaje,malo praška za pecivo i sol pa zamijesiti tijesto.\r'),
(84, 13, 'Na  podlozi od krušnih mrvica oblikovati valjke ....Neka vas ne buni jako mekano tijesto-takvo mora biti...\r'),
(85, 13, '... i rezati njoke te ih uvaljati malo u mrvice .\r'),
(86, 13, 'Ispeći na ulju ili spremiti u zamrzivač pa koristiti po potrebi.\r'),
(87, 13, 'Mogu i obliku pljeskavica.\r'),
(88, 13, 'Jako su mekani i fini...Ja sam napravila malo prevelike...pa ako ćete ih praviti mislite na to da malo narastu kod prženja...'),
(89, 14, 'Sjediniti svježi sir, umućena jaja, ulje, griz i prašak za pecivo. Dodati jogurt, kiselo vrhnje i so, pa umutiti. Pleh premazati puterom. Parče putera otopiti. Svaki list jufke (koristiti tanje jufke) premazati tanko sa par kašika fila (2/3 lista premazati), pa zarolati. Oblikovati, pa redati u pleh.\r'),
(90, 14, 'Kad se sastojci utroše, premazati pitu otopljenim puterom.\r'),
(91, 14, 'Peći na 200 C oko 20 minuta.\r'),
(92, 14, 'Poslužiti toplo, uz kiselo vrhnje, jogurt, salatu!'),
(93, 15, 'Brašno pomiješajte s praškom za pecivo i dodajte soli po ukusu.žutanjke pjenasto umutite,prelijte s kefirom,i spojite s brašnom,sve dobro izmiješajte,smjesa mora biti malo gušća nego za palačinke.\r'),
(94, 15, 'Na kraju dodajte pripremljene sjemenke,pa još jednom sve umutite drvenom žlicom.\r'),
(95, 15, 'Zagrijte ulje,kuhinjsku veću žlicu umočite u ulje,zagrabite tijesto i lagano ga spustite u zagrijano ulje,kad porumene s jedne strane,okrenite ih na drugu. Složite ih na kuhinjski ubrus da upiju višak masnoće.\r'),
(96, 15, 'Za slatku kombinaciju,dodajte žlicu-dvije šećera i jednu vrećicu vanilin šećera.\r\n'),
(97, 16, 'Veličinu bunceka i količinu krumpira prilagodite broju ljudi za koje kuhate. \r'),
(98, 16, 'Buncek kuhamo dok se meso ne počne lijepo odvajati od kosti.Ja kuham u expres loncu gotovo sat vremena.Kada je skuhano narezati ga na komade,kosti bacimo. \r'),
(99, 16, 'Narezati krumpire,onako kako to i inače radite kada ih pečete u pećnici i staviti ih peći na malo ulja. \r'),
(100, 16, 'Kada su krumpiri otprilike napola gotovi dodamo komade bunceka(ne bacati kožu i ona se peče)i pečemo dok krumpir nije gotov. \r'),
(101, 16, 'Pečem na temperaturi od oko 220 stupnjeva,a pred sam kraj pojačam gornje grijače u peći da mi se i meso i krumpir još zapeku. \r'),
(102, 16, 'Probajte meso i ako nije dovoljno slano malo posolite zajedno sa krumpirom.\r'),
(103, 16, 'Krumpir na drugi način: očistiti ga i prerezati na polovine ili četvrtine.Skuhati u posoljenoj vodi,ocijediti i dodati u vruće ulje u isto vrijeme kada i buncek.Dobro zapeći.'),
(104, 17, 'Gustin i šećer pomiješajte da dobijete smjesu sličnu kao za puding.\r'),
(105, 17, 'Mlijeko zakuhajte i kad zavrije, maknite s vatre, primješajte smjesu šećera i gustina, te skuhajte gustu kremu. Ohladite.\r'),
(106, 17, 'Kad se smjesa ohladila, dodajte joj izrađeni maslac i dobro promiješajte, te dodajte kokos.\r'),
(107, 17, 'Lagano mokrim rukama pravite male kuglice, u sredinu svake stavite prženi oguljeni lješnjak, te uvaljajte ih u kokos .\r'),
(108, 17, 'Poslužite ih u papirnim košaricama, dobro ohlađene.\r'),
(109, 17, 'Kuglice se mogu napraviti unaprijed i samo se smrznu, vrlo brzo se odmzavaju. Lješnjake je najbolje kupiti obične i popržiti ih na tavici, pa ih poslije samo ogulite i utiskujete u kuglice. od ove količine sastojaka isalo mi je 62 male kuglice. Košarice su one najmanje kojih ima..\r'),
(110, 17, 'Što se tiče toga da od ove količine ispadne 62 kuglice, da ispadne ih ako pravite pola doze, a za ove količine u receptu minimalno ispadne 100 nemalih kuglica. Dakle ponovo sam ih radila za gulašijadu i ispalo ih je oko 100 komada.\r\n'),
(111, 18, 'Casa je od 250 ml. Sipajte u vanglu brasno, sol, secer, ulje, ocat, jaje i polako dodajuci vodu mesite. ovaj put je meni trebalo jos dve zlice plus vode, valjda je jaje bilo manje nego uobicajeno... znaci testo treba da je ne mnogo meko... Ostavite ga da se odmori dvadesetak min. te ga podelite na cetiri dela.\r'),
(112, 18, 'Svaki deo rasucite sto tanje mozete i premazite ga sa omeksalim margarinom ( 1/4 od 200 gr,)\r'),
(113, 18, 'Nakon toga, zavijte koru oko "sukala", kao rolat. Ostrim nozem prerezite rolat, te otvorite testo, dobije se forma pravougana, pa je preklopite. zavijte je u najlon foliju i stavite u frizider. tako uradite sa sva cetiri dela. Neka stoje u frizu nekoliko sati.\r'),
(114, 18, 'svaki dio razvijte i oblikujte po zelji, Ovaj put sam koru presekla na 6 dela i filovala mljevenim mesom, pa zavila u male rolatice. Pekla sam ih na 200 C dok su lepo porumenili.'),
(115, 19, 'U toplo mlijeko staviti kvasac i šećer, čekati da se kvasac digne pa dodati brašno, sol i ulje te zamijesiti meko glatko tijesto.\r'),
(116, 19, 'Od tijesta radimo male loptice  veličine oraha i stavljamo na stol. Ostavimo 15-tak minuta da se krenu dizat.\r'),
(117, 19, 'Lopticu stavimo na stol i razvaljamo je prvo prema gore pa prema dolje, par puta da se fino razvuče, tijesto se ne lijepi i fino se razvlači. Zatim na lijevi rub stavimo 2-3 trakice salame te lagano rolamo u desnu stranu. (salamu narezati na takne trakice, 3-5mm)\r'),
(118, 19, 'Stavljamo ih u tepsiju na pek papir, premažemo žumanjcima, posipamo sezam ili kim gore i stavljamo u pečnicu na 180 i pećemo 2o-tak minuta, dok ne porumene, ovisno o pećnici.\r'),
(119, 19, 'Od ovih sastojaka dobijete oko 62 kubanke. :)'),
(120, 20, 'U šalicu stavimo brašno,šećer, kakao i prašak za pecivo i dobro promiješamo da se sve lijepo izjednači.\r'),
(121, 20, 'Dodamo jaje i opet promiješamo.\r'),
(122, 20, 'Dodamo ulje i mlijeko i dobro promiješamo da ne ostanu grumuljice.\r'),
(123, 20, 'Stavimo šolju u mikrovalnu i uključimo da se peče: 4 minuta-850 watt-i ili 3 minuta-1000 watt-i\r'),
(124, 20, 'Kada je gotovo izvadimo iz mikrovalne (pazite vruća je šalica),ostavimo 2-3 minuta da se ohladi, prelijemo nekim filom, sladoledom, topingom, džemom…..ili već po vašoj želji i odmah jedemo :)'),
(125, 21, 'Oslić posoliti , pa pržiti na kokosovom ulju (bez mirisa) sa svih strana da lijepo porumeni\r'),
(126, 21, 'Poslužiti sa maslinama...'),
(127, 22, 'Predhodno očišćene lignje staviti u plitku posudu za pečenje ili teflonsku tavu na dobro zagrijano maslinovo ulje.\r'),
(128, 22, 'Poklopiti i na jakoj temperaturi na naglo ispeći s jedne i druge strane dok lignje poprime laganu crvenkastu boju.\r'),
(129, 22, 'Smanjiti temperaturu na najmanje i pomalo posoliti, popapriti i dodati nasjeckani češnjak i peršin.\r'),
(130, 22, 'Pirjati poklopljeno u vlastitom soku dok ne ispari.\r'),
(131, 22, 'Dodati 2 dl bijelog vina i nastaviti na najmanjoj temperaturi poklopljeno pirjati dok meso lignji sasvim ne omekša.\r'),
(132, 22, 'Kao prilog poslužiti kuhano povrće ili rižu.'),
(133, 24, 'U serpu staviti ulje i mljeveno meso i poprziti  dodati zacine kad je gotovo dodati jednu kasiku brasna izmjesati i naliti vode,kad prokuha dodati crvenu papriku i izmjesati .Lepinu isjecemo na pola i polijemo sa poljevom .\r'),
(134, 24, 'Servirati sa krastavcima'),
(135, 25, 'Nasjeci gljive kapulicu i cesanj bj. luka pa u serpi dosta zagrijanoj kasiku putra //moze i malo ulja da ne gori//staviti da se przi uz stalno mjesanje treba da je malo naglo da gljive ne ispuste svoju tekucinu. Skinuti sa vatre pobiberiti i estragon - iskrenuti na jedan tanjir da se ohladi.\r'),
(136, 25, 'Sameljemo u blenderu badene /da ostanu malo komadici / Sameljemo u blenderu i snjesu sa gljivana /samo malo/, ja sam malo vise jer sam trebala od jednog malog da sakrijem gljive //uspelo je//. Stavimo blizu nas i sve ostale sastojke.\r'),
(137, 25, 'Pripremimo stapic ili prut oblozumo folijom,//sam stapic mislim da je od balona oblozila membranom prozirnom//.Sad rasirimo kore pa premazemo do pola putrom pospemo malo bademima i preklopimo sa duze strane da je dupla.\r'),
(138, 25, 'Pospemo malo gljivama,namrvimo malo feta sira i narendamo malo graviere /mi ovde imamo kritsku/ moze bilo koji tvrdi sir.\r'),
(139, 25, 'Ovde je potrebno da smo skrti //cicije//    // gr. cigunisi// malo sale, ustvari da bi lakse zguzvali piticu.\r'),
(140, 25, 'Stavimo stapic na presavijeni deo /stapic treba da je malo veci od uzeg dela kore/ .\r'),
(141, 25, 'Sada labavo rolamo ti presavijenu koru sa nadjevom.\r'),
(142, 25, 'Urolanu uhvatimo krajeve i stiskamo prema sredini pazljivo da se nabira. Kad se nabralo polako pridrzavamo rukom izvucemo stapic.\r'),
(143, 25, 'Tako ponavljamo svaku koru, uradjene redjamo u tepsiju, premazemo putram /mozemo gore posuti malo bademom ako je ostalo ili suzamom a i nemora nicim/\r'),
(144, 25, 'Treba malo paziti da se kore ne osuse pa dok jednu radimo ostale pokriti malo vlaznom krpom.\r'),
(145, 25, 'Ja sam u paketu imala 11 kora. Dve sam napravila samo sa sirom da mi ne ostaju. Peci na 180* 25-30 min. da fino porumene tu opet svako pozna svoju pec.'),
(146, 26, 'Staviti krumpir kuhati u ljusci prethodno oprati. Meso oprati i osušiti kuhinjskim papirom. Nasoliti soli paprom, crvenom paprikom i vegetom. Zagrijati ulje u dubokoj tavi i prepržiti meso i lagano podliti vodom da bude mekše i sočno. Povremeno okretati meso dok ne porumeni s jedne i druge strane. Krumpir skuhati da bude što kuhaniji probati vilicom, ako vilica lagano ulazi u krumpir onda je gotov. Ocijediti ga i prohladiti da ga možete guliti i narezati na četvtine. Meso izvadite iz tave i stavite u posudu s poklopcem da ostane toplo. Luk narezati na sitno i staviti na masnoću od mesa i pržiti dok ne postane staklast. Dodati narezani krumpir i začiniti po ukusu. Krumpir dinstati nekih 15- 20 minuta dok još ne omekša i upije masnoću u sebe onda je gotov i jelo poslužiti. Možete meso vratiti u tavu da bude toplo i poslužiti. Servirati uz salatu po ukusu.'),
(147, 27, 'Umutiti omekšao puter i šećer. Dodati so i jaje, pa kratko miksati. Dodati ribanu koricu naranče i polovinu prosijanog brašna. Umutiti. Zatim, dodati preostalo brašno, kao i sjeckane, sušene brusnice. Sve sjediniti, pa na pobrašnjenoj radnoj plohi oblikovati valjak. Valjak uviti u prozirnu foliju i staviti u zamrzivač (bar dva sata)!\r'),
(148, 27, 'Razati tijesto na šnite, pa redati u pleh (obložen papirom za pečenje)!\r'),
(149, 27, 'Peći na 170 C oko 20 minuta.\r'),
(150, 27, 'Pečene keksiće ohladiti, pa spremiti u kutiju sa poklopcem!\r'),
(151, 27, 'Poslužiti uz kafu ili čaj!'),
(152, 28, 'Razmutite kvasac u 50 ml mlakog mlijeka i ostavite ga da se digne.\r'),
(153, 28, 'U zdjeli prosijte brašno i pomiješajte ga sa žlicom maslaca. Dodajte 2 žumanjka, šećer i malo soli. Na kraju dodajte dignuti kvasac i mijesite ulijevajući mlako mlijeko. Dodajte mlijeka koliko je potrebno da dobijete glatko tijesto (možda će vam ostati mlijeka). Tijesto ostavite oko 30 minuta da se diže.\r'),
(154, 28, 'Dignuto tijesto premijesite i podijelite na dva jednaka dijela. Svaki dio razvaljajte u pravokutnu koru i premažite najprije preostalim maslacem, a zatim sa džemom. Nadjevene kore namotajte u rolade i stavite ih u protvan obložen papirom za pečenje. Ostavite još oko 30 minuta da se ponovo digne.\r'),
(155, 28, 'Dignute rolade premažite razmučenim žumanjkom i pecite oko 45 minuta na 180°C.'),
(156, 29, 'Meso izrezati na krupnije kocke.Obje vrste luka ocistiti i usitniti na male kockice.\r'),
(157, 29, 'Pripremiti vecu posudu za pecenje, koja je pogodna i za dinstanje u pecnici.\r'),
(158, 29, 'Prvo na ringli, u gore pomenutoj posudi, otopiti 3-4 kasike maslaca i dodati luk. Sve na tihoj vatri dinstati oko pola sata, uz povremeno mijesanje da se luk lijepo izdinsta i postane zlatno-smede boje.Pred kraj dinstanja pridodati i na kolutice izrezanu mrkvu.\r'),
(159, 29, 'U medjuvremenu pripremiti sve ostale sastojke: papriku, temeljac, sirce i koncentrat od paradajza. Papriku, sirce i koncentrat staviti zajedno u jednu posudu i polako nalijevajuci temeljcem mijesati da se sve sjedini u glatku smjesu.\r'),
(160, 29, 'Pripremljenu masu preliti preko izdinstanog luka.Sve dobro promijesati.\r'),
(161, 29, 'Komade mesa poslagati u pripremljenu smjesu , svaki komad okrenuti nekoliko puta,da sa svih strana bude uvaljan u smjesu.Zaciniti solju i biberom, te dodati lovorov list.\r'),
(162, 29, 'Pokriti posudu i staviti u pecnicu zagrijanu na 160*C. Tako pokriveno dinstati 3-3,5 sata na istoj temperaturi. Povremeno preokrenuti komade mesa da se ne isuse i ravnomijerno izdinstaju.\r'),
(163, 29, 'Po zelji, kad je gulas gotov, meso izvaditi, a saft sa stapnim mikserom pirirati (ko ne zeli da se primijete komadici luka). Po ukusu, dodati jos 100ml crnog vina i vratiti meso nazad.'),
(164, 30, 'Dan ranije potopiti grah u hladnu vodu. Koljenicu skuhati,izvaditi na tacnu, a vodu sačuvati.\r'),
(165, 30, 'Grah procijediti,oprati,pa staviti u vodu u kojoj se kuhala koljenica. U vodu sa grahom dodati narezan luk i češnjak ,pa kuhati oko pola sata\r'),
(166, 30, 'Nakon pola sata dodati kiselu repu (ako je repa prekisela,ili preslana ,malo je isperite u cediljki sa hladnom vodom). Kada se sve zajedno skuhalo napravite zapršku.\r'),
(167, 30, 'Na masti popržiti brašno,dodati crvenu mljevenu papriku,pa zapršku dodati grahu i repi. Ostaviti minut-dva da vri i skloniti sa vatre. Servirati sa kuhanom koljenicom.'),
(168, 31, 'Maslac, šećer i jaja izmiksati. Dodati vaniliju i limunovu koricu. Postupno dodavati brašno. Zamijesiti glatko, podatno tijesto. Može se ohladiti pola sata u hladnjaku.\r'),
(169, 31, 'Razvaljati tijesto na pobrašnjenoj podlozi , vaditi kekse pečat-modlicama, redati u tepsiju s papirom za pečenje. Peći ih na 140-160 C u već zagrijanoj pećnici oko 10-15 minuta, da ostanu svijetli.'),
(170, 32, 'Naribajte korice limuna i naranče (samo gornji, žuti odnosno narančasti sloj), a zatim iscijedite sok i filtrirajte ga kroz gusto mrežasto cjedilo. Stavite sok, korice, šećer, malo razmućena jaja i maslac narezan na listiće u posudu koju postavite iznad veće posude s vodom. Zagrijavajte miješajući dok se šećer i maslac ne istopite i smjesa ne ujednači. Neka voda ispod lagano ključa.\r'),
(171, 32, 'Nastavite kuhati oko 20-25 minuta stalno miješujući, smjesa ne treba provreti već se lagano kuhati dok se ne zgusne.\r'),
(172, 32, 'Procijedite gotovu kremu kroz gusto mrežasto cjedilo da odstranite korice.\r'),
(173, 32, 'Uspite curd u staklenku i spremite u hladnjak.\r'),
(174, 32, 'Čuvajte ga oko 2-3 tjedna.\r'),
(175, 32, 'Od ove količine sastojaka dobila sam jednu manju staklenku kreme.'),
(176, 33, 'Umutiti jaje sa šećerom i maslacem, a zatim dodati redom sve ostale sastojke i dobro ih sjediniti. Ne dodavati vodu testu!\r'),
(177, 33, 'Oblikovati kolačiće i ređati ih na pleh obložen pek-papirom.\r'),
(178, 33, 'Peći u zagrejanoj rerni na 200 stepeni 15 minuta.\r'),
(179, 33, 'Služiti ohlađeno. Mogu se dugo čuvati u frižideru.'),
(180, 34, 'Odvojite belanca od žumanca.U jednu posudu stavite belanca i izmiksate ih dok ne postanu kao gusta pena.U drugu žumanca i dodate sve sastojke.\r'),
(181, 34, 'Kada se svi sastojci sjedine sa žumancima,žumanca se dodaju u belanca ili ti (gustu penu).\r'),
(182, 34, 'Uzmete flašicu od vode i probušite čep nožem,sipate koliko može da stane u flašicu.Kada se tiganj zagreje uzmete flašicu i izcedite u obliku kruga,srca ili bilo kog drugog oblika.\r'),
(183, 34, 'Da se ispeklo znaćete jer će se balončići pojaviti.Ja nisam stavljala ulje pa sam svaki okrenula za 15s.'),
(184, 35, 'Umutiti jaja, dodati jogurt, ulje, brašno i prašak za pecivo. Dodati ostale sastojke i napuniti 12 korpica !\r'),
(185, 35, 'Zagrejte pećnicu na 200C! Peći mafine 15-20minuta.'),
(186, 36, 'U posudu sa debljim dnom nasiječemo luk, češnjak, dodamo lignje  i začine, promiješamo, te dodamo ulje i sve ostale sastojke.Na kraju stavimo vode po potrebi, da sve bude pod tekučinom.\r'),
(187, 36, 'Dobro promiješamo zaklopimo i stavimo pirjati na laganu vatru 40-tak minuta.Povremeno pogledamo i promiješamo(ovisi o posudi).\r'),
(188, 36, 'Za to vrijeme napravimo palentu na svoj naćin ili po uputama na pakiranju.\r'),
(189, 36, 'Poslužimo toplo uz zelenu salatu i čašu dobrog vina! Ovo jelo možete radim i od hobotnice i sipe i lignjuna i uvijek mi ispadne mekano, zato ga i volimo! Probajte i vi i uvjerite se!'),
(190, 37, 'Krumpir ogulite i narežite na tanje ploškice pa ih rasporedite  u lagano namaštenu posudu za pečenje(najbolje keramičku).Posolite i popaprite.Maslac narežite na listiće pa ih pospite po krumpiru.Posudu pokrijte aluminijskom folijom i stavite u pećnicu zagrijanu na 200 stupnjeva.Pecite 50-60 minuta,odnosno dok krumpir ne omekša.\r'),
(191, 37, 'Zatim u vrhnje umiješajte zgnječeni ili sitno sjeckani češnjak pa time prelijte krumpir.Pospite naribanim sirom te još 15 do 20 minuta zapecite u pećnici.'),
(192, 38, 'Ogulite krumpir i izrežite ga na kockice, te stavite da se skuha. Kada je kuhan, izdrobite ga gnječilicom u pire, dodajte brašno, jedno jaje i malo soli, te zamijesite tijesto. Napominjem da ne dodajete sve brašno odjednom, nego postepeno, možda vam neće trebati sva količina, mnogo ovisi o krumpiru, a tijesto neka bude mekše.\r'),
(193, 38, 'Razvaljajte ga i režite oblike po želji, ja najčešće režem u obliku kvadrata. Zagrijte ulje i pržite pogačice do zlatno-žute boje. Možete ih osim u tavici ispeći i u rerni...evo ih i u okruglom izdanju.....\r'),
(194, 38, 'Možete ih poslužiti kao prilog uz neko jelo, posuti šećerom, ili namazati pekmezom od šipka ili nekim drugim, već po ukusu i želji...'),
(195, 39, 'Heljdinu kašu oprati i skuhati u vodi. Za kašu za jednu osobu potrebne su 2-3 žlice heljdine kaše i 2 čaše vode. Kaša se kuha otprilike 10-15 min (ova količina - veća količina se kuha oko 20-25min).\r'),
(196, 39, 'Naribati jednu manju jabuku, dodati žlicu kokosovog brašna, malo naribanog đumbira (ali stvarno malo, možda veličine lješnjaka), 1 žlicu meda i 2 žlice mljevenih oraha.\r'),
(197, 39, 'Kad je kaša kuhana, precijedite ju i isperite (ako volite hladnu kašu, ispirite hladnom vodom i kontra). \r'),
(198, 39, 'Opranu kašu dodajte u ostale sastojke pa dobro promiješajte. \r'),
(199, 39, 'Odozgo narežite jedan kivi i uživajte!\r'),
(200, 39, 'Ova kaša je idealna za doručak jer daje energije i ubrzava metabolizam. Umjesto kivija možete koristiti bilo koje drugo voće, a ako koristite bananu ili bilo koje suho voće (grožđice, suhe šljive, datulje, brusnicu), izbacite med i kokos da vam kaša ne postane kalorična bomba. '),
(201, 40, 'Na malo ulja, na tihoj vatri,izdinstati naseckani luk. Kada postane staklast ( nakon 5 min otprilike ) dodati šargarepu naseckanu na kockice. Dinstati još 5 minuta uz povremeno mešanje. Dodati belo pileće meso iseckano na kockice ili trakice. Sve zajedno dinstati još desetak minuta uz povremeno mešanje.\r'),
(202, 40, 'Nakon toga dodati smrznuti grašak ( ili sveži u sezoni ), nastaviti dinstanje uz mešanje još desetak minuta.\r'),
(203, 40, 'Kada je povrće i meso omekšalo, dodati kašiku brašna, kašiku vegete i kašičicu crvene mlevene paprike. Kratko promešati i odmah skloniti sa vatre da se ne zalepi brašno,vegeta i paprika za dno šerpe. \r'),
(204, 40, 'Naliti otprilike 1 l vode,promešati i vratiti na ringlu, te kuvati oko 20 - 30 min.\r'),
(205, 40, 'U zavisnosti da li volite gušće ili ređe varivo, možete dodavati još vode u toku  kuvanja ili ukuvati do željene gustine. U slučaju da želite gušće varivo,obratite pažnju da ne zagori,te češće mešajte ili smanjite temperaturu kuvanja. '),
(206, 41, 'Navedene sastojke umiješati, premazati batake i ostaviti u hladnjaku u pokrivenoj posudi nekoliko sati.\r'),
(207, 41, 'Batake složiti na masni papir, preliti marinadom i peći u pećnici zagrijanoj na 200˚C  20 minuta. Okrenuti meso i peći još 20 minuta, ovisno o pećnici.');

-- --------------------------------------------------------

--
-- Table structure for table `recept`
--

CREATE TABLE `recept` (
  `ID_recepta` int(11) NOT NULL,
  `Ime_recepta` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci NOT NULL,
  `Kratki_opis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci NOT NULL,
  `datum_objave` date NOT NULL,
  `ID_autora` int(11) DEFAULT NULL,
  `Flag` int(11) NOT NULL DEFAULT '0',
  `dozvola` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recept`
--

INSERT INTO `recept` (`ID_recepta`, `Ime_recepta`, `Kratki_opis`, `datum_objave`, `ID_autora`, `Flag`, `dozvola`) VALUES
(1, 'Kuglofići od Mandarina', 'Ovo je pravi osvježavajući kolač za ovo doba, posebno se lijepo osladiti ovim kuglofićima sad zimi, a uživati u njihovoj ljetnoj boji, no okus, okus im je sočno-božićni, a u zimski mrak donosi svježinu ljeta i boju sunca. Upravo ta boja, podsjeća me na drage zimske mandarine moje mame!! uživajte!!', '2017-01-09', 2, 1, 2),
(2, 'Banana Ražnjić', 'Super ideja za djecu. :)', '2017-01-08', 3, 1, 2),
(3, 'Frape od vočnog jogurta i banana', 'Lagano i zdravo osvježenje..', '2017-01-08', 3, 1, 1),
(4, 'Lažna Rocher Mađarica', 'Lazna Madarica jer sam prvi put ikada koristila gotove kore,"Sweet Cake" by Bradic koje sam nasla  ovdje kod nas u nasoj prodavnici. A rocher posto ukusom podsjeca na rocher,bar nama haha. Bila sam veoma skepticna sto se tice ovih kora jer su mi izgledale bas suhe. Bojala sam se reakcije svojih malih degustatora ali na sve cudo svima se dopala.', '2017-01-09', 2, 1, 2),
(5, 'Batlerski krumpir', 'Divan i vrlo jednostavan prilog kojega će svi obožavati ,hrskavi krumpir izvana i mekan  i kremast iznutra /milin/a a najbolje od svega minimalno kalorija i masnoće.Isprobate ovaj jednostavan starinski prilog.Jedino što će vam trebati je mandolin ribež ili ribež za kupus/čips ,glatke oštrice.', '2017-01-07', 2, 1, 2),
(6, 'Janjetina u finom umaku', 'Nisam nikada radio janjetinu u šugu, pa nakon malog istraživanja sam napravio svoju verziju sa crnim vinom. Okus fantastičan, janjetina premekana, ispalo je iznenađujuće dobro... tople preporuke. Idealno jelo za blagdane.', '2017-01-07', 2, 1, 2),
(7, 'Salata od parizera', 'Kod nas od parizera, u spomen na našu dragu tetu Bepu, koja nas je uveseljavala svojim jezičnim biserima. Ne morate koristiti elementaler sir, može i obični! Lagani ručak, večera, za iznenadne goste, za dane kad vam se ne kuha.', '2017-01-08', 3, 1, 2),
(8, 'Praško čudo', 'Ovo je kolač broj 1 u mojoj obitelji. Mojim dečkima najdraži. Recept sam dobila od g-đe Marcele majke najbolje prijateljice iz razreda prije više od 20 godina. Kad sam ga prvi put jela oduševio me i odmah sam zatražila recept. Ljubazna gospođa se potrudila i prevela mi ga sa češkog. Od tada sam ga radila stvarno nebrojeno puta i uvijek svi traže baš taj kolač da donesem na njihove fešte i slavlja. Rado ga dijelim s vama, jer stvarno je izvrstan.', '2017-01-09', 2, 1, 2),
(9, 'Veganske tortilje', 'Jednostavne tortilje s povrćem!', '2017-01-09', 3, 1, 2),
(10, 'Juha od leća', 'Jedna od najdražih zimskih,gustih juha;', '2017-01-24', 5, 1, 2),
(11, 'BOB & PILETINA', 'Moja Emili je rekla bako kakav ti je ovo pljosnati veliki grašak.Kako jako voli grašak i bob je zadovoljio okusom moju malu unučicu.', '2017-01-24', 5, 1, 2),
(12, 'Lazanje', 'Moje novogodišnje. Uz savjete u vezi kora za lazanje i još kojekakvih stvarčica spremila sam ih i evo kako je to izgledalo. Meni su bile vrlo ukusne.', '2017-01-29', 7, 1, 2),
(13, 'Kroketi', 'Probala sam odlične krokete i čula recept...i razliku po čemu se oni razlikuju od njoka...Kroketi se rade s oštrim brašnom a njoki s glatkim....Moj prvi pokušaj završio je neslavno jer sam omjer 3:1 ja pravila u krivom omjeru....i htjela na 70 dag krumpira staviti 3 puta toliko brašna....Kad sam shvatila da nešto nije u redu spasa više nije bilo pa sam napravila tvrde njoke(pojelo se i to...)a mi se još i danas smijemo s tih kroketa jer ja nisam bila jedina koja ih je radila na taj način....', '2017-01-30', 7, 1, 2),
(14, 'Najbrža pita sa sirom', 'Najbrža pita sa sirom', '2017-01-30', 7, 1, 1),
(15, 'Slani hrskavci', 'jednostavni,brzi za pripremu,bez kvasanja,u tijesto se dodaje kefir,što ga čini mekanim ,a sjemenke,hrskavim ...mogu se spremiti u slanoj i slatkoj kombinaciji;)', '2017-01-30', 7, 1, 2),
(16, 'Pečeni buncek', 'ljudi moji što ja ovo vooooliiiim', '2017-01-30', 7, 1, 2),
(17, 'Rafaelo kuglice', 'S najnovijeg puta u Makedoniju, vratila sam se, donoseći recepte za još slatkog blaga moje drage mame Zore Terzieve… ovo je njen recept, koji nas je sve oborio s nogu, a moju kćer posebno, jer ih je tako gutala da mi je bilo neugodno… ovo je jedan od onih kolača, koje nisam voljela zbog mirisa mlijeka u prahu, a ovdje ga nema i kuglice su mi baš super.', '2017-01-30', 7, 1, 2),
(18, 'Brzo i jednostavno lisnato tijesto', 'Sprema se veoma brzo, nema mazanja vise puta, a rezultat je savrsen, topi se u ustima :)', '2017-01-30', 7, 1, 1),
(19, 'Kubanke', 'Fini klipići po receptu moje susjede :)', '2017-01-30', 7, 1, 2),
(20, 'Kolač “za 5 minuta”', 'Koliko puta vam se desilo da vam se jede nešto slatko ali da nemate vremena da ga spremite ili je kasno,pa zbog drugih ukućana odustanete da ne biste "lumpovali" po kuhinji ? Ako vam se desilo više od dva puta, a imate mikrotalasnu kući,onda je ovo pravi kolač za vas :)))', '2017-01-30', 7, 1, 2),
(21, 'Prženi oslić i masline', 'Ovako prženi oslić uz masline servirati kao hrono večeru...', '2017-01-30', 7, 1, 2),
(22, 'Lignje podušene', 'Za nas Dalmatince lignje su prava delicija. Posebno ako su friško ulovljene u zimskom periodu kada je vrhunac njihove sezone, prava su sočna i zdrava namirnica koja se lako i brzo priprema', '2017-01-30', 7, 1, 2),
(23, 'Saft s rižom', 'Rižu jednostavno obožavam i ona je neizostavan dio našeg tjednog jelovnika....', '2017-01-30', 7, 1, 2),
(24, 'Lepinja', 'Lepinja sa poljevom od mljevenog mesa', '2017-01-30', 7, 1, 1),
(25, 'Slani saragli/ zguzvani/ sa gljivama', 'Draga prijateljice Pomoravka SALJEM TI SVE!!! ZNAM DA VOLIS! Recept posvecujem dragoj prijateljici Zorici!', '2017-01-30', 7, 1, 2),
(26, 'Svinjski vrat s restanim krumpirom', 'Ručak po mojoj mjeri a restani krumpir jednostavno obožavam...', '2017-01-30', 7, 1, 2),
(27, 'Aromatični keksići', 'od brusnica i naranče', '2017-01-30', 7, 1, 2),
(28, 'Štrudla s džemom od marelica', 'Odlična štrudla sa džemom. Vjerojatno imate svoj recept, ali ako nemate ovo je odličan recept koji bih preporučila da isprobate. Možete staviti džem koji vam odgovara. Meni je najbolji od marelica ili šljiva, ali može i bilo koji drugi. Isprobajte, nadam se da budete zadovoljni.', '2017-01-30', 7, 1, 2),
(29, 'Juneći gulaš', 'ma vec dosta izuzetnih recepata za gulas i vjerovatno vecina vas "instinktivno" slijedi onaj neki svoj, iz glave :) Ovakav nacin spremanja gulasa me odusevio i zato zelim recept podijeliti s vama. Recept je od J. Lafera iz njegove knjige "Der grosse Lafer".', '2017-01-30', 7, 1, 2),
(30, 'GRAHI SA KISELOM REPOM I SUHOM KOLJENICOM', 'Kiseljenje repe se zasniva na principu mlječnog vrenja kojim bakterije jedući šećer iz repe izlučuju mlječnu kiselinu koja ukiseljuje repu.Sol se stavlja u repu da bi ona pustila sok u kojem se nalazi šećer kojeg trebaju bakterije za proizvodnju mlječne kiseline. U ovisnosti kakva je repa, treba regulirati količinu soli. Najbolje naribajte 100 g repe i posolite je sa 7-8 g soli (1/2 MŽ) i dobro istiskajte, ostavite preko noći u malenoj bočici. Ako repa pusti dovoljno tekućine i nema više nerastopljene soli, imate pravi omjer.', '2017-01-30', 7, 1, 2),
(31, 'Butter cookies (ili pečat keksi)', 'Recept sam našla u ambalaži pečat-modlica, malo dodala, malo oduzela i to je to.', '2017-01-30', 7, 1, 2),
(32, 'Lemon Orange Curd', 'Ako na netu tražite recept za lemon curd, dobit ćete more različitih recepata, koji se razlikuju po sastojcima (omjeru i raznim dodacima, neki samo sa žumanjcima drugi s cijelim jajima) ali i po načinu pripreme (nekad se maslac dodaje odmah, nekad u kuhanu kremu). Nije bilo lako odlučiti kojem se receptu prikloniti, ali odabrala sam i zadovoljna sam. Uz to sam odlučila umjesto samo limuna, napraviti kombinaciju moja dva omiljena agruma, limuna i naranče.', '2017-01-30', 7, 1, 2),
(33, 'Brzi čoko kolačići', 'Keksići koji se jednostavno prave, sa zdravim sastojcima, neodoljivo hrskavi.', '2017-01-30', 7, 1, 2),
(34, 'Američke palačinke', 'Ćao svimaa.Nova sam i imam 12,5 godina.Ovaj recept sam smislila jer su mi dosadile obične palačinke.Nadam se da će vam se svideti... :)', '2017-01-30', 7, 1, 2),
(35, 'PIZZA MAFINI :-)', 'Brzi, ukusni, slani mafini!', '2017-01-30', 7, 1, 2),
(36, 'Gulaš od liganja', 'Recept je iz jednog restorana i mene je oborio s nogu!', '2017-01-30', 7, 1, 2),
(37, 'Seoski krumpir sa sirom', 'Iz Lisine knjižice recepata"Ukusna jela od krumpira"...evo krumpira na jedan nov,malo drugčiji način....S puno vrhnja,malo maslaca i sira eto vam ručka ili večere uz koju niti ne trebate mesa....!!!', '2017-01-30', 7, 1, 2),
(38, 'Uštipci od krumpira', 'Ja ih zovem i pogačice, omiljene su u mojoj obitelji... tijesto je ono kao za knedle, tako da kada pravim knedle obavezno umijesim malo više tijesta da napravim i njih... mogu biti prilog nekom drugom jelu, možete ih pošećeriti štaub-šećerom, ili čak namazati s pekmezom koji volite i odaberete... dobar vam tek!', '2017-01-30', 7, 1, 2),
(39, 'Slatka heljdina kaša', 'Heljda je jedna super namirnica s kojom se može svašta! I dok sam ja donedavno živjela u zabludi kako je ona rezervirana samo kao prilog uz meso, ili kao zasebno slano vegetarijansko jelo, palo mi je na pamet - zašto ne? Probajmo je u slatkoj varijanti, možda je fino! I tako je nastala ova PREFINA kaša! :)', '2017-01-30', 7, 1, 2),
(40, 'Grašak sa piletinom za početnike', 'Jedno od prvih jela koje sam naučila spremati...Vrlo jednostavno i ukusno', '2017-01-30', 7, 1, 2),
(41, 'Bataci u medu i pivu', 'Ništa brže i jednostavnije.... za prste polizati!!!! Naravno, medene...', '2017-01-30', 7, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sastojci`
--

CREATE TABLE `sastojci` (
  `ID` int(11) NOT NULL,
  `ID_recepta` int(11) NOT NULL,
  `Sastojak` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sastojci`
--

INSERT INTO `sastojci` (`ID`, `ID_recepta`, `Sastojak`) VALUES
(1, 1, '5-6 kom (oko 400g) mandarina\r'),
(2, 1, '12,5 dag maslaca\r'),
(3, 1, '25 dag šećera\r'),
(4, 1, '3 kom jaja\r'),
(5, 1, '20 dag brašna\r'),
(6, 1, '5 - 10 dag kokosa\r'),
(7, 1, '1 vrećica praška za pecivo\r'),
(8, 1, '1,5 dl čistog cijeđenog soka mandarine\r'),
(9, 1, '15 dag šećera\r'),
(10, 1, '1 korica naranče\r'),
(11, 1, 'šećer u prahu za posipanje'),
(12, 2, 'banane\r'),
(13, 2, 'kokos\r'),
(14, 2, 'čokolada u prahu ili ribana čokolada\r'),
(15, 2, 'šarene ili čokoladne mrvice'),
(16, 3, '300 ml voćnog jogurta od jagode i vanilije\r'),
(17, 3, '1 banana\r'),
(18, 3, '1 mala žlica meda\r'),
(19, 3, '1 kockica leda'),
(20, 4, '1 pakovanje gotovih kora za mađaricu\r'),
(21, 4, '2 vrećice pudinga od lješnjaka\r'),
(22, 4, '700 ml mlijeka\r'),
(23, 4, '150 g šećera u prahu\r'),
(24, 4, '4 žlice nutelle ili linolade\r'),
(25, 4, '200 g maslaca, sobna temperatura\r'),
(26, 4, '150 g mljevenog lješnjaka\r'),
(27, 4, '300 g čokolade za kuhanje\r'),
(28, 4, '250 ml slatkog vrhnja\r'),
(29, 4, '200 g mljevenih napolitanki ili keksa od lješnjaka\r'),
(30, 4, '50-100 ml crne kave\r'),
(31, 4, 'Glazura:\r'),
(32, 4, '100 g čokolade\r'),
(33, 4, '1 žlica ulja'),
(34, 5, '1,5 kg krumpira\r'),
(35, 5, '2 velika luka\r'),
(36, 5, 'sol\r'),
(37, 5, 'papar\r'),
(38, 5, 'maslinovo ulje'),
(39, 6, '2 kg janjetine\r'),
(40, 6, '2 veća luka\r'),
(41, 6, '3 češnja češnjaka\r'),
(42, 6, '1 veća mrkva\r'),
(43, 6, '1 mali koma celer korijena\r'),
(44, 6, '1 mali komad pastrnjaka\r'),
(45, 6, '1 šačica svježeg bosiljka\r'),
(46, 6, '1 grančica ružmarina\r'),
(47, 6, '3 lovor lista\r'),
(48, 6, '1 čajna žličica vegete\r'),
(49, 6, 'sol po potrebi\r'),
(50, 6, '1/3 čajne žlice sriracha umaka (ako volite ljuto)\r'),
(51, 6, '1/2 l passate podravka\r'),
(52, 6, '2,5 dcl crnog vina\r'),
(53, 6, '2 kom pilećih jetrica'),
(54, 7, 'Nema zadanih mjera,sve ovisi o broju osoba i gladi\r'),
(55, 7, 'tvrdo kuhano jaje\r'),
(56, 7, 'kapula\r'),
(57, 7, 'parizer\r'),
(58, 7, 'sir\r'),
(59, 7, 'paprika\r'),
(60, 7, 'sol\r'),
(61, 7, 'papar\r'),
(62, 7, 'sok limuna\r'),
(63, 7, 'maslinovo ulje\r'),
(64, 7, 'riga'),
(65, 8, 'Tijesto:\r'),
(66, 8, '1 cijelo jaje\r'),
(67, 8, '150 g šećera\r'),
(68, 8, '1 žličica sode bikarbone\r'),
(69, 8, '50 g margarina\r'),
(70, 8, '2 žlice mlijeka\r'),
(71, 8, '2 žlice meda\r'),
(72, 8, '450 g glatkog brašna\r'),
(73, 8, '1 žlica kakao\r'),
(74, 8, 'Krema:\r'),
(75, 8, '4 dl mlijeka\r'),
(76, 8, '2 i 1/2 žlice glatkog brašna\r'),
(77, 8, '2 žlice šećera\r'),
(78, 8, '1 vanilin šećer\r'),
(79, 8, '2 žlice šećera u prahu\r'),
(80, 8, '150 g margarina'),
(81, 9, 'Luk\r'),
(82, 9, 'paprike\r'),
(83, 9, 'grah\r'),
(84, 9, 'češnjak\r'),
(85, 9, 'kukuruz\r'),
(86, 9, 'grašak za punjenje\r'),
(87, 9, 'umak od rajčice\r'),
(88, 9, 'gotove tortilje'),
(89, 10, '200g leće\r'),
(90, 10, 'oko 2l vode\r'),
(91, 10, '1 veća mrkva\r'),
(92, 10, '1 kapula\r'),
(93, 10, '1 paprika\r'),
(94, 10, 'selen\r'),
(95, 10, '4 veća krumpira\r'),
(96, 10, '1žlica vegete\r'),
(97, 10, '1žlica pešta(siječak)*\r'),
(98, 10, '1/2žlice pirea od rajčice\r'),
(99, 10, 'sol\r'),
(100, 10, 'ljuta papričica ili papar\r'),
(101, 10, 'PEŠT:\r'),
(102, 10, 'komad slanine\r'),
(103, 10, 'vezica peršina\r'),
(104, 10, 'češnjak'),
(136, 11, '2-3 kom pilećeg filea\r'),
(137, 11, '500 gr boba\r'),
(138, 11, '500 gr krumoira\r'),
(139, 11, '1 luk , češnjak, poriluk,peršinov list\r'),
(140, 11, 'mrkva i manji pastrnjak\r'),
(141, 11, 'sol, papar, crvana paprikau prahu i maslinovo ulje'),
(142, 12, '3 jaja\r'),
(143, 12, 'brašno\r'),
(144, 12, '1 kore za lazanje\r'),
(145, 12, 'Sos bolonjez:\r'),
(146, 12, '1 glavica crnog luka\r'),
(147, 12, 'malo praziluka\r'),
(148, 12, '100 gr mesnate slanine\r'),
(149, 12, '400 gr mljevenog junećeg mesa\r'),
(150, 12, '1,5 dcl vina\r'),
(151, 12, 'mali celer\r'),
(152, 12, '2 šargarepe\r'),
(153, 12, '6 dcl soka od paradajza\r'),
(154, 12, '2 čena bijelog luka\r'),
(155, 12, '300 gr šampinjona\r'),
(156, 12, '10 maslina\r'),
(157, 12, 'Bešamel sos:\r'),
(158, 12, '1/2 l mlijeka\r'),
(159, 12, 'malo maslaca\r'),
(160, 12, '2 žlice brašna\r'),
(161, 12, '1/2 limuna\r'),
(162, 12, 'i još:\r'),
(163, 12, '100-150 gr mozarele\r'),
(164, 12, 'malo parmezana\r'),
(165, 12, 'ulje\r'),
(166, 12, 'sol\r'),
(167, 12, 'bijeli biber\r'),
(168, 12, 'origano\r'),
(169, 12, 'bosiljak'),
(170, 13, '90 dag pire krumpira\r'),
(171, 13, '30 dag oštrog brašna\r'),
(172, 13, '1 jaje\r'),
(173, 13, 'malo soli\r'),
(174, 13, '1/2 praška za pecivo\r'),
(175, 13, 'krušne mrvice'),
(176, 14, '700g svježeg sira\r'),
(177, 14, '3 jaja\r'),
(178, 14, '4 žlice ulja\r'),
(179, 14, '2 žlice griza\r'),
(180, 14, '2 žlice kiselog vrhnja\r'),
(181, 14, '400 ml jogurta\r'),
(182, 14, 'sol\r'),
(183, 14, 'pola praška za pecivo\r'),
(184, 14, '10-12 gotovih kora za pitu\r'),
(185, 14, 'maslac'),
(186, 15, 'mix sjemenki (suncokret, lan, bundeva, zob, sezam)\r'),
(187, 15, '2 žutanjka\r'),
(188, 15, '1 čaša kefira\r'),
(189, 15, '250g glatkog brašna\r'),
(190, 15, '1/2 praška za pecivo\r'),
(191, 15, 'sol\r'),
(192, 15, 'ulje'),
(193, 16, '1 sušeni buncek\r'),
(194, 16, 'krumpiri\r'),
(195, 16, 'ulje\r'),
(196, 16, 'sol'),
(197, 17, '1/2 l mlijeka\r'),
(198, 17, '15 žlica šećera\r'),
(199, 17, '10 žlica gustina\r'),
(200, 17, '25 dag maslaca\r'),
(201, 17, '20 dag kokosa\r'),
(202, 17, '2 vrećice vanilin šećera\r'),
(203, 17, '3 žlice likera od kokosa\r'),
(204, 17, '20 dag lješnjaka\r'),
(205, 17, '10 dag kokosovog brašna'),
(206, 18, '3 čaše brašna\r'),
(207, 18, '1 jaje\r'),
(208, 18, '1 žlica ulja\r'),
(209, 18, '1 žlica octa\r'),
(210, 18, '1 žličica šećera\r'),
(211, 18, '1 žličica soli\r'),
(212, 18, '1 čaša vode\r'),
(213, 18, '200 g margarina'),
(214, 19, '1 kg glatkog brašna\r'),
(215, 19, '4 dcl ulja\r'),
(216, 19, '5 dcl mlijeka\r'),
(217, 19, '1 kvasac\r'),
(218, 19, '1 žličica šećera\r'),
(219, 19, '2 žlićice soli\r'),
(220, 19, '15 dkg salame\r'),
(221, 19, '2 žumanjka\r'),
(222, 19, 'sezam\r'),
(223, 19, 'kim'),
(224, 20, '4 ravne žlice brašna\r'),
(225, 20, '4 ravne žlice šećera\r'),
(226, 20, '1/2 žličica praška za pecivo\r'),
(227, 20, '2 žlice kakaa\r'),
(228, 20, '1 jaje\r'),
(229, 20, '3 žlice ulja\r'),
(230, 20, '3 žlice mlijeka\r'),
(231, 20, '1 šalica za čaj'),
(232, 21, '2 kom oslića\r'),
(233, 21, 'kokosovo ulje\r'),
(234, 21, 'sol\r'),
(235, 21, 'masline'),
(236, 22, '1 kg očišćenih liganja\r'),
(237, 22, '1 dl maslinovog ulja\r'),
(238, 22, '1 češanj bijelog luka\r'),
(239, 22, '1 nasjeckani peršin\r'),
(240, 22, '2 dc bijelog vina'),
(241, 23, '2 dl riže\r'),
(242, 23, '500 g svinjskog buta\r'),
(243, 23, '1 luk\r'),
(244, 23, 'slatka mljevena crvena paprika\r'),
(245, 23, 'crni papar mljeveni\r'),
(246, 23, 'ajvar blagi\r'),
(247, 23, 'sol\r'),
(248, 23, 'vegeta\r'),
(249, 23, '2 mrkve'),
(250, 24, '500g mljevenog mesa\r'),
(251, 24, 'začini\r'),
(252, 24, 'crvena paprika\r'),
(253, 24, 'po želji glavica luka\r'),
(254, 24, 'žlica brašna'),
(255, 25, '8 kom kora gotovih tankih\r'),
(256, 25, '4 žlice otopljenog maslaca\r'),
(257, 25, '80 gr badema\r'),
(258, 25, '300 gr šampinjona\r'),
(259, 25, '2 luka\r'),
(260, 25, '1 bijeli luk\r'),
(261, 25, '1 žlićica etragona, bibera\r'),
(262, 25, '5 žlica graviere\r'),
(263, 25, '5 žlica feta sira\r'),
(264, 25, '1 crvena pečena paprika'),
(265, 26, '4 kom narezanog svinjskog vrata\r'),
(266, 26, '1 kg krumpira\r'),
(267, 26, 'crni papar\r'),
(268, 26, 'slatka  mljevena crvena paprika\r'),
(269, 26, 'vegeta\r'),
(270, 26, 'sol\r'),
(271, 26, 'ulje/svinjska mast\r'),
(272, 26, '1 luk'),
(273, 27, '60g omekšalog maslaca\r'),
(274, 27, '60g šećera u prahu\r'),
(275, 27, '1 jaje\r'),
(276, 27, '1 žličica ribane korice naranče\r'),
(277, 27, '50g sušenih brusnica\r'),
(278, 27, '160g brašna\r'),
(279, 27, 'sol'),
(280, 28, '1 svježi kvasac\r'),
(281, 28, '1kg oštrog brašna\r'),
(282, 28, '3 žumanjka\r'),
(283, 28, '70g maslaca\r'),
(284, 28, '750 ml mlijeka\r'),
(285, 28, '2 žlice šećera\r'),
(286, 28, 'sol\r'),
(287, 28, '250g džema'),
(288, 29, '1kg junećeg mesa\r'),
(289, 29, '500g luka\r'),
(290, 29, '3 češnja bijelog luka\r'),
(291, 29, '1 mrkva\r'),
(292, 29, '2 žlice koncentrata od paradajza\r'),
(293, 29, '2-3 žlice bijelog vinskog octa\r'),
(294, 29, '50g aleve paprike\r'),
(295, 29, '500ml junećeg temeljca\r'),
(296, 29, '2 lista lovora\r'),
(297, 29, 'sol\r'),
(298, 29, 'biber\r'),
(299, 29, 'peršin'),
(300, 30, '1/2 kg graha\r'),
(301, 30, '1/2 kg kisele repe\r'),
(302, 30, '1-2 glavice luka\r'),
(303, 30, '2 čena češnjaka\r'),
(304, 30, '1 suha koljenica\r'),
(305, 30, '2 žlice brašna\r'),
(306, 30, '1 žlica masti\r'),
(307, 30, 'mljevena crvena paprika\r'),
(308, 30, 'papar, sol'),
(309, 31, '240 g maslaca\r'),
(310, 31, '2 kom. jaja\r'),
(311, 31, '250 g kristal šećera\r'),
(312, 31, '1 vrećica bourbon vanilije\r'),
(313, 31, 'naribana limunova korica\r'),
(314, 31, '650 g brašna, plus za nakuhati i razvaljati'),
(315, 32, '1 limun (neprskani, bio)\r'),
(316, 32, '1 naranča\r'),
(317, 32, '150 g šećera\r'),
(318, 32, '65 g maslaca\r'),
(319, 32, '2 jaja'),
(320, 33, '250 g speltinog brašna\r'),
(321, 33, '110 g fruktoze\r'),
(322, 33, '125 g maslaca\r'),
(323, 33, '20 g kakaa\r'),
(324, 33, '1/2 kesice praška za pecivo\r'),
(325, 33, '1 jaje\r'),
(326, 33, '100 g brusnica (ili komadića crne čokolade)\r'),
(327, 33, 'narendana kora pomorandže'),
(328, 34, '2 jaja\r'),
(329, 34, '3 dc mineralne vode (kisele)\r'),
(330, 34, '2 dc mleka\r'),
(331, 34, '300 g brašna\r'),
(332, 34, '3 kašičice sećera ili više\r'),
(333, 34, 'prstohvat soli(po potrebi)\r'),
(334, 34, '2 kašičice praška za pecivo'),
(335, 35, '3 jaja\r'),
(336, 35, '2 dl jogurta\r'),
(337, 35, '1 dl ulja\r'),
(338, 35, '220 gr brašna\r'),
(339, 35, '1 kesica praška za pecivo\r'),
(340, 35, '50 gr rendanog kačkavalja\r'),
(341, 35, '1 kašičica origana\r'),
(342, 35, '50 gr seckane šunke\r'),
(343, 35, '50 gr slanine\r'),
(344, 35, 'malo soli'),
(345, 36, '500g liganja\r'),
(346, 36, '1 luk\r'),
(347, 36, '2 češnja češnjaka\r'),
(348, 36, 'prstohvat soli, vegete, crvene paprike\r'),
(349, 36, '1žlica sušenih rajčica ili svježa rajčica ili koncentrat rajčice\r'),
(350, 36, '1,0 dcl crnog vina\r'),
(351, 36, 'peršin list i celer list\r'),
(352, 36, '1 žlica maslinovog ulja\r'),
(353, 36, '1 dcl vode'),
(354, 37, '1 kg krumpira\r'),
(355, 37, 'sol,papar po ukusu\r'),
(356, 37, '5 dag maslaca\r'),
(357, 37, '400 ml masnoga kiseloga vrhnja\r'),
(358, 37, '2-3 češnja češnjaka\r'),
(359, 37, '10 dag naribanoga ementalera...'),
(360, 38, '1/2 kg krumpira\r'),
(361, 38, '1 jaje\r'),
(362, 38, '2o-25 dag brašna\r'),
(363, 38, 'malo soli\r'),
(364, 38, 'ulje za prženje'),
(365, 39, '2-3 žlice Heljdine kaše Podravka\r'),
(366, 39, '1 mala jabuka\r'),
(367, 39, '1 žlica Kokosovog brašna Dolcela\r'),
(368, 39, 'malo (veličine lješnjaka) naribanog svježeg đumbira\r'),
(369, 39, '1 žlica meda\r'),
(370, 39, '2 žlice mljevenih oraha\r'),
(371, 39, '1 kivi'),
(372, 40, '300-400 g graška\r'),
(373, 40, '300-400 g belog pilećeg mesa\r'),
(374, 40, '2 kom manje glavice crnog luka\r'),
(375, 40, '2 kom šargarepe\r'),
(376, 40, '1 kašika Vegete\r'),
(377, 40, '1 kašika brašna\r'),
(378, 40, '1 kašičica začinske mlevene paprike\r'),
(379, 40, '1 litar vode'),
(380, 41, '2 žlice meda\r'),
(381, 41, 'naribani đumbir (oko 1 cm)\r'),
(382, 41, '1 žlica senfa\r'),
(383, 41, '1 žličica soli\r'),
(384, 41, '½ žličice papra\r'),
(385, 41, '1 žličica Vegete\r'),
(386, 41, 'chilli paprika po okusu\r'),
(387, 41, '½ žličice mljevene slatke paprike\r'),
(388, 41, '½ dl piva\r'),
(389, 41, '12 pilećih bataka');

-- --------------------------------------------------------

--
-- Table structure for table `slika`
--

CREATE TABLE `slika` (
  `ID_slike` int(11) NOT NULL,
  `ID_recepta` int(11) NOT NULL,
  `Ime_slike` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci NOT NULL DEFAULT 'no-picture.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slika`
--

INSERT INTO `slika` (`ID_slike`, `ID_recepta`, `Ime_slike`) VALUES
(1, 2, 'Banana_raznjic.jpg'),
(2, 1, 'cbfef8c8e644fd592e2afec200c61769_view_l.jpg'),
(3, 3, 'frape-od-vocnog-jogurta-i-banana-d0f82ce59cf2d21d6de6d1c75761f964_view_l.jpg'),
(4, 4, 'd74846e5e54d05a4eb6106433b42e938_view_l.jpg'),
(5, 5, 'batlerski-krumpir-by-mucika-067bc5db0dc13345e12e89bf09ba11d0_view_l.jpg'),
(6, 6, 'janjetina-u-finom-umaku-b132d0114c8caa6a8e335b4bc86d7f42_view_l.jpg'),
(7, 7, 'salata-od-parizera-250fe7bf437839059eff6e66f2dd23fd_view_l.jpg'),
(8, 8, 'prasko-cudo-by-cerica-d761cdc925e4d1c9df233009e9febbbc_view_l.jpg'),
(9, 9, '93bf91b5c5ad6ac1d8b7df5251d32953.jpg'),
(10, 10, 'fc417dae8ccea6acf04a071186d102b8.jpg'),
(11, 11, 'bcd560a0d251d95a2f96261db1f342e3.jpg'),
(12, 12, '9e93d5ae1a6d9dc05f6178d80925242e.jpg'),
(13, 13, 'f67b4fb1b193e6a12a604562bcdefc0a.jpg'),
(14, 14, '0d553d4476b0d732b61b68a53ab3feb6.jpg'),
(15, 15, 'no-picture.jpg'),
(16, 16, '6d5eed4dcbf72e03b098662cde7d84ed.jpg'),
(17, 17, '7d44a08cac06a9e8987b44c603b1637e.jpg'),
(18, 18, '1f11a0fe7905cceb7ab6871f46e3d22c.jpg'),
(19, 19, '5182eb4277565d1af7cc55a231142637.jpg'),
(20, 20, '8d5bb6e6d589cb931e6569392eb4be1c.jpg'),
(21, 21, '767c86d4070680b937e1ee2cd367e283.jpg'),
(22, 22, 'bf050a01993cb9774c9ee7915497fad7.jpg'),
(23, 23, '65945a89467ecfa446ae9a3844e96e23.jpg'),
(24, 24, '886645fe73d7f405294a475a08fe28e1.jpg'),
(25, 25, 'd6865352c5d4015d4d36e0f67f09075a.jpg'),
(26, 26, 'ee51996b949e52b235651659b9fae42c.jpg'),
(27, 27, 'e649007d379043410559b7e49b1782e9.jpg'),
(28, 28, 'bcbb6df93090b99eb45a8b21a4763ba9.jpg'),
(29, 29, 'd7a50a08c3f48b3dec561650bfe20de2.jpg'),
(30, 30, '804d12867ff2a3793637b4a89a5b6924.jpg'),
(31, 31, '563c1eb48191fe08f580c7586c600a00.jpg'),
(32, 32, '34245053ed3310f683e39fca82cadcdc.jpg'),
(33, 33, '2e0b0db633094320f2add9aee79f7921.jpg'),
(34, 34, '4be00b8bbaf1e8f12f419222a1842f1c.jpg'),
(35, 35, '7949ba2e4013232f2e936bd42146cffe.jpg'),
(36, 36, '3a3de2725408ee497a299e0b63e523c1.jpg'),
(37, 37, 'f1301e7345f77ee78eaa5a7721b57e12.jpg'),
(38, 38, '85d9c30d50aef42cc9044d9c36adbbc1.jpg'),
(39, 39, '7fba673936ac49ea92aaec379c48077f.jpg'),
(40, 40, '599c40f054ac83db08c255bee53e2c87.png'),
(41, 41, 'be8a1c173163aae216721875a9d526b1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `spremljenirecepti`
--

CREATE TABLE `spremljenirecepti` (
  `id_korisnika` int(11) NOT NULL,
  `id_recepta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spremljenirecepti`
--

INSERT INTO `spremljenirecepti` (`id_korisnika`, `id_recepta`) VALUES
(4, 8),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ocjena`
--
ALTER TABLE `ocjena`
  ADD PRIMARY KEY (`id_korisnika`,`id_recepta`),
  ADD KEY `ocjena_recept` (`id_recepta`);

--
-- Indexes for table `priprema`
--
ALTER TABLE `priprema`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_recepta` (`ID_recepta`);

--
-- Indexes for table `recept`
--
ALTER TABLE `recept`
  ADD PRIMARY KEY (`ID_recepta`),
  ADD KEY `ID_autora` (`ID_autora`);

--
-- Indexes for table `sastojci`
--
ALTER TABLE `sastojci`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_recepta` (`ID_recepta`);

--
-- Indexes for table `slika`
--
ALTER TABLE `slika`
  ADD PRIMARY KEY (`ID_slike`),
  ADD KEY `ID_recepta` (`ID_recepta`);

--
-- Indexes for table `spremljenirecepti`
--
ALTER TABLE `spremljenirecepti`
  ADD PRIMARY KEY (`id_korisnika`,`id_recepta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `priprema`
--
ALTER TABLE `priprema`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;
--
-- AUTO_INCREMENT for table `recept`
--
ALTER TABLE `recept`
  MODIFY `ID_recepta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `sastojci`
--
ALTER TABLE `sastojci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;
--
-- AUTO_INCREMENT for table `slika`
--
ALTER TABLE `slika`
  MODIFY `ID_slike` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ocjena`
--
ALTER TABLE `ocjena`
  ADD CONSTRAINT `ocjena_korisnik` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`ID`),
  ADD CONSTRAINT `ocjena_recept` FOREIGN KEY (`id_recepta`) REFERENCES `recept` (`ID_recepta`);

--
-- Constraints for table `priprema`
--
ALTER TABLE `priprema`
  ADD CONSTRAINT `priprema_ibfk_1` FOREIGN KEY (`ID_recepta`) REFERENCES `recept` (`ID_recepta`),
  ADD CONSTRAINT `priprema_ibfk_2` FOREIGN KEY (`ID_recepta`) REFERENCES `recept` (`ID_recepta`) ON DELETE CASCADE;

--
-- Constraints for table `recept`
--
ALTER TABLE `recept`
  ADD CONSTRAINT `recept_ibfk_1` FOREIGN KEY (`ID_autora`) REFERENCES `korisnik` (`ID`);

--
-- Constraints for table `sastojci`
--
ALTER TABLE `sastojci`
  ADD CONSTRAINT `sastojci_ibfk_1` FOREIGN KEY (`ID_recepta`) REFERENCES `recept` (`ID_recepta`),
  ADD CONSTRAINT `sastojci_ibfk_2` FOREIGN KEY (`ID_recepta`) REFERENCES `recept` (`ID_recepta`) ON DELETE CASCADE;

--
-- Constraints for table `slika`
--
ALTER TABLE `slika`
  ADD CONSTRAINT `slika_ibfk_1` FOREIGN KEY (`ID_recepta`) REFERENCES `recept` (`ID_recepta`),
  ADD CONSTRAINT `slika_ibfk_2` FOREIGN KEY (`ID_recepta`) REFERENCES `recept` (`ID_recepta`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
