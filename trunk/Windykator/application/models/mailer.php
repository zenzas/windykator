<?php

require_once("./phpmailer/class.phpmailer.php");

class Mailer extends CI_Model
{
    private $mailer;
    
    //utworzenie obiektu phpmailera pozwalajacego na wysylanie wiadomosci systemowych
	public function __construct() {
	    parent::__construct();
		$this->mailer = new PHPMailer();
		$this->mailer->PluginDir = "phpmailer/";
		$this->mailer->From = "first.windykator@gmail.com"; //adres naszego konta
		$this->mailer->FromName = 'Windykator';//nazwa wyswietlana jako nadawca wiadomosci
		$this->mailer->Username = "first.windykator";//nazwa uzytkownika
		$this->mailer->Password = "koryto18";//nasze haslo do konta SMTP
		
		$this->mailer->SetLanguage("pl", "phpmailer/language/");//jezyk
		$this->mailer->CharSet = "utf-8";//kodowanie wiadomosci
		
		$this->mailer->Host = "ssl://smtp.gmail.com";//adres serwera SMTP
		$this->mailer->Port = "465";//port
		$this->mailer->IsSMTP();//laczymy sie przez smtp
		$this->mailer->SMTPAuth = true;//z autoryzacja
		$this->mailer->WordWrap = 75;//dzielenie wyrazow
		$this->mailer->IsHTML(); // wyslanie wiadomosci jako html
		//$this->mailer->SMTPDebug = 2;//debug, pokazywanie wiadomosci o bledach
	}
	
	/*public function __construct() {
        $this->mailer = new PHPMailer();
        $this->mailer->PluginDir = "phpmailer/";
        $this->mailer->From = "ppzgazeta@gmail.com"; //adres naszego konta
        $this->mailer->FromName = 'PPZ Gazeta';//nazwa wyswietlana jako nadawca wiadomosci
        $this->mailer->Username = "ppzgazeta";//nazwa uzytkownika
        $this->mailer->Password = "testtest1";//nasze haslo do konta SMTP
        
        $this->mailer->SetLanguage("pl", "phpmailer/language/");//jezyk
        $this->mailer->CharSet = "utf-8";//kodowanie wiadomosci
        
        $this->mailer->Host = "ssl://smtp.gmail.com";//adres serwera SMTP
        $this->mailer->Port = "465";//port
        $this->mailer->IsSMTP();//laczymy sie przez smtp
        $this->mailer->SMTPAuth = true;//z autoryzacja
        $this->mailer->WordWrap = 75;//dzielenie wyrazow
        $this->mailer->IsHTML(); // wyslanie wiadomosci jako html
        //$mailer->SMTPDebug = 2;//debug, pokazywanie wiadomosci o bledach
    }*/
	
	//utworzenie wiadomosci i wyslanie maila z haslem na podany adres
	public function sendPasswordMail($login, $email, $pass) {
		$adr = 'http://'.$_SERVER['HTTP_HOST'].'/index.php';
		$title = "Zmiana hasła";
		$mess = "Twoje hasło zostało zmienione. <br /><br />
			Nowe hasło: $pass";
		$this->sendMail($email, $mess, $title, $login);
	}

	private function sendMail ($email, $message, $title, $login = null) {
		if ($login == null)//jesli nazwa adresata nie podana to ustawiamy taki jak email
			$login = $email;
		
		$this->mailer->AddAddress($email,$login);//ustawiamy adres
		$this->mailer->Subject = $title;//tytul
		$this->mailer->Body = $message; //tresc wiadomosci jako html
		$this->mailer->AltBody = $message; //tresc wiadomosci jako tekst
									
		$this->mailer->Send();//i wysylamy
	}
}