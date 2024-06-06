
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `qr_code` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `is_correct` tinyint(1) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `scanned_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `question_id` (`question_id`),
  KEY `idx_logs_qr_code` (`qr_code`),
  CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `logs` (`id`, `user_id`, `question_id`, `qr_code`, `answer`, `is_correct`, `timestamp`, `scanned_order`) VALUES
	(242, 10, 1, '1', 'asertywność', 1, '2024-05-28 11:08:40', NULL),
	(243, 10, 2, '2', 'dopalacze', 1, '2024-05-28 11:13:19', NULL),
	(244, 10, 3, '3', 'papierosy', 1, '2024-05-28 11:17:22', NULL),
	(245, 10, 4, '4', 'guziec', 1, '2024-05-28 11:20:50', NULL),
	(246, 10, 5, '5', 'uzależnienie', 1, '2024-05-28 11:28:07', NULL);


CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `correct_answer` varchar(255) NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `qr_code` varchar(255) NOT NULL,
  `sequence` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `questions` (`id`, `question`, `correct_answer`, `hint`, `qr_code`, `sequence`) VALUES
	(1, 'Umiejętność odmawiania i prezentowania swojego zdania bez ranienia uczuć innych osób?', 'asertywność', '49.994742,19.428726 (Gaz)', '1', 1),
	(2, 'Substancje szkodliwe, które mają działanie podobne do narkotyków?', 'dopalacze', '49.995592,19.427398 (Solary, P.S. Nie rozwalajcie nic, bo będziecie płacić)', '2', 2),
	(3, 'Jaka używka może powodować raka jamy ustnej, gardła, krtani oraz płuc?', 'papierosy', 'Kamiński auto spa', '3', 3),
	(4, 'Jakim gatunkiem zwierzęcia był Pumba z filmu Król Lew?', 'guziec', 'Palarnia WZS (Okolice Policji)', '4', 4),
	(5, 'Nabyty stan zaburzenia zdrowia psychicznego i fizycznego, który charakteryzuje się okresowym lub stałym przymusem wykonywania określonej czynności lub zażywania psychoaktywnej substancji chemicznej?', 'uzależnienie', 'Ośrodek pomocy społecznej', '5', 5),
	(6, 'Alkohol metabolizowany jest w organizmie, głównie w?', 'wątrobie', 'Ośrodek zdrowia (TYŁ OŚRODKA)', '6', 6),
	(7, 'Na tablicy Mendelejewa symbolem P oznaczony jest', 'fosfor', 'Hala ZSO', '7', 7),
	(8, 'Z kim graliśmy słynny mecz na wodzie w półfinale Mistrzostw Świata w Piłce Nożnej 1974? (SKRÓT)', 'rfn', 'Przystanek w okolicach ZSO', '8', 8),
	(9, 'Jaki włoski ser jest niezbędnym składnikiem tiramisu?', 'mascarpone', 'Kiosk między WZS a ZSO', '9', 9),
	(10, 'W którym województwie w Polsce tablice rejestracyjne zaczynają się od litery E?', 'łódzkim', 'Szachownica na którymś z pięter szkoły ZSO', '10', 10),
	(11, 'Zwlekanie, ociąganie się, opóźnianie lub przekładanie czegoś na później to inaczej...?', 'prokrastynacja', 'Serce na terenie ZSO', '11', 11),
	(12, 'Panczeniści do uprawiania swojego sportu potrzebują?', 'łyżew', 'Gdzie bawią się dzieci/młodzież w ZSO (Na terenie ZSO)', '12', 12),
	(13, 'Który palec dłoni jest dwuczłonowy?', 'kciuk', 'Popularne lody zatorskie (Blisko WZS)', '13', 13),
	(14, 'Jak nazywa się kontynent, na którym leżą Malediwy?', 'azja', 'Komisariat', '14', 14),
	(15, 'Interlokutor to inaczej:', 'rozmówca', 'Piekarnia w okolicy WZS obok bloków', '15', 15),
	(16, 'Rozwiąż zadanie: -7 - (5 - 24) = ?', '12', 'Obiadki w ZSO', '16', 16),
	(17, 'W geometrii, nie ma początku oraz nie ma końca?', 'prosta', 'Rok Zator', '17', 17),
	(18, 'Strój w islamie, który zakrywa całkowicie ciało i twarz kobiety, pozostawiając niewielką siatkę na oczach, to?', 'burka', 'Plac zabaw blisko Biedronki, gdzie jeździ się rowerem', '18', 18),
	(19, 'Ilu sąsiadów Polski ma dostęp do morza?', '4', 'Znak STOP, a sklep?', '19', 19),
	(20, 'Kto zastąpił na tronie Władysława Łokietka?', 'kazimierz wielki', '49.996352, 19.432810', '20', 20),
	(21, 'Kto widnieje na banknocie 20 zł?', 'bolesław chrobry', 'Gratulacje!! Ukończyłeś grę, a teraz udaj się bezpiecznie do WZS. Pamiętaj, że czas nadal płynie.', '21', 21);


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_users_username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `users` (`id`, `username`, `password`) VALUES
	(0, 'admin', '$2y$10$YTnNU9xM.vo836CfprX.HuvOGJTyl0e2ghAYLLfvFsQ0uLcdFPYAO'),
	(1, 'grupa1', '$2y$10$YTnNU9xM.vo836CfprX.HuvOGJTyl0e2ghAYLLfvFsQ0uLcdFPYAO'),
	(3, 'grupa2', '$2y$10$YTnNU9xM.vo836CfprX.HuvOGJTyl0e2ghAYLLfvFsQ0uLcdFPYAO'),
	(4, 'grupa3', '$2y$10$YTnNU9xM.vo836CfprX.HuvOGJTyl0e2ghAYLLfvFsQ0uLcdFPYAO'),
	(5, 'grupa4', '$2y$10$YTnNU9xM.vo836CfprX.HuvOGJTyl0e2ghAYLLfvFsQ0uLcdFPYAO'),
	(6, 'grupa5', '$2y$10$YTnNU9xM.vo836CfprX.HuvOGJTyl0e2ghAYLLfvFsQ0uLcdFPYAO'),
	(10, 'grupa6', '$2y$10$YTnNU9xM.vo836CfprX.HuvOGJTyl0e2ghAYLLfvFsQ0uLcdFPYAO');

