# Innowacyjna Gra Terenowa z Kodami QR

## Opis
Innowacyjna gra terenowa z kodami QR pozwala uczestnikom na ekscytujące przygody przy użyciu nowoczesnych technologii. Gracze zaczynają od logowania się na specjalnie przygotowanej stronie, gdzie wprowadzone dane są weryfikowane przez skrypt PHP, który porównuje je z zahashowanymi hasłami w bazie danych MySQL. Po pomyślnym zalogowaniu gracze przechodzą do panelu skanowania.

## Funkcjonalności
- **Logowanie**: Uczestnicy logują się na stronie, gdzie dane są weryfikowane za pomocą skryptu PHP.
- **Panel skanowania**: Używanie smartfonów do skanowania kodów QR za pomocą biblioteki html5-qrcode.
- **Przetwarzanie danych**: JavaScript przesyła zeskanowane dane do skryptu PHP, który przetwarza je i przekierowuje gracza do odpowiedniego pytania.
- **Weryfikacja odpowiedzi**: Skrypt PHP porównuje odpowiedzi uczestników z poprawnymi odpowiedziami przechowywanymi w bazie danych MySQL.
- **Bezpieczeństwo**: Weryfikacja odpowiedzi wykorzystuje prepared statements w PHP, co zabezpiecza aplikację przed atakami typu SQL injection.

## Technologia
Projekt opiera się na komunikacji między front-endem (HTML, CSS, JavaScript) i back-endem (PHP, MySQL). Dane są przesyłane w formacie JSON, co zapewnia elastyczność i efektywność aplikacji. Wykorzystanie bibliotek takich jak html5-qrcode oraz technologii backendowych (PHP, MySQL) sprawia, że projekt jest nowoczesny, bezpieczny i wydajny.

## Użycie
1. **Logowanie**
    Uczestnicy logują się na stronie za pomocą swoich danych logowania.

2. **Skanowanie kodów QR**
    Uczestnicy skanują kody QR za pomocą panelu skanowania.

3. **Rozwiązywanie pytań**
    Po zeskanowaniu kodu QR, uczestnicy otrzymują pytania do rozwiązania. Odpowiedzi są weryfikowane przez skrypt PHP.

4. **Informacja zwrotna**
    Wyniki są zapisywane w logach, a użytkownik otrzymuje informację zwrotną o poprawności odpowiedzi.

## Przykładowe dane logowania
Hasło testowe: `12345`

## Licencja
Projekt jest dostępny na licencji MIT. Zobacz plik `LICENSE` po więcej informacji.
