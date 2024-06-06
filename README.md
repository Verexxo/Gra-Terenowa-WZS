Innowacyjna gra terenowa z kodami QR pozwala uczestnikom na ekscytujące przygody przy użyciu nowoczesnych technologii. Gracze zaczynają od logowania się na specjalnie przygotowanej stronie, gdzie wprowadzone dane są weryfikowane przez skrypt PHP, który porównuje je z zahashowanymi hasłami w bazie danych MySQL. Po pomyślnym zalogowaniu gracze przechodzą do panelu skanowania.

W panelu skanowania uczestnicy używają swoich smartfonów do skanowania kodów QR za pomocą biblioteki html5-qrcode. Po zeskanowaniu kodu, JavaScript przesyła dane do skryptu PHP, który przetwarza je i przekierowuje gracza do odpowiedniego pytania. 

Po zeskanowaniu kodu QR, uczestnicy otrzymują pytania do rozwiązania. Skrypt PHP porównuje odpowiedzi użytkowników z poprawnymi odpowiedziami przechowywanymi w bazie danych MySQL, zapisuje wyniki w logach i przekazuje informację zwrotną użytkownikowi. Proces weryfikacji odpowiedzi wykorzystuje przygotowane zapytania (prepared statements) w PHP, co zabezpiecza aplikację przed atakami typu SQL injection.

Technicznie, projekt opiera się na komunikacji między front-endem (HTML, CSS, JavaScript) i back-endem (PHP, MySQL). Dane są przesyłane w formacie JSON, co zapewnia elastyczność i efektywność aplikacji. Wykorzystanie bibliotek takich jak html5-qrcode oraz technologii backendowych (PHP, MySQL) sprawia, że projekt jest nowoczesny, bezpieczny i wydajny.
Gra terenowa z kodami QR łączy zabawę z technologią, oferując dynamiczne i angażujące doświadczenie. 
