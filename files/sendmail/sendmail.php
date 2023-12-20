<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	/*
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'user@example.com';                     //SMTP username
	$mail->Password   = 'secret';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	*/

	//От кого будет письмо
	$mail->setFrom('koliezvid1@gmail.com', 'Кто-то написал'); 
	//Кому отправляем
	$mail->addAddress('koliezvid1@mail.ru'); 
	//Тема листа
	$mail->Subject = 'Привет, это Виталий';

	$sex = 'Мужской'
	if ($_POST['sex'] == 'woman'){
		$sex = 'Женский'
	}

	//Тело письма
	$body = '<h1>Встречайте письмо!</h1>';

	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
	}	
	
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>E-mail:</strong> '.$_POST['email'].'</p>';
	}	
	if(trim(!empty($_POST['sex']))){
		$body.='<p><strong>Sex:</strong> '.$sex['name'].'</p>';
	}	
	if(trim(!empty($_POST['age']))){
		$body.='<p><strong>Sex:</strong> '.$_POST['age'].'</p>';
	}	
	if(trim(!empty($_POST['message']))){
		$body.='<p><strong>Письмо:</strong> '.$_POST['message'].'</p>';
	}
	
	//Прикрепить файл
	// if (!empty($_FILES['image']['tmp_name'])) {
	// 	//путь загрузки файла
	// 	$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
	// 	//грузим файл
	// 	if (copy($_FILES['image']['tmp_name'], $filePath)){
	// 		$fileAttach = $filePath;
	// 		$body.='<p><strong>Фото в приложении</strong>';
	// 		$mail->addAttachment($fileAttach);
	// 	}
	// }
	
	//присваиваем в плагин
	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Данные отправлены';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>