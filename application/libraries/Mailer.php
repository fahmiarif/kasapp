<?php
class Mailer 
{
	function __construct()
	{
		$this->CI =& get_instance();
	}
	//=============================================================
	function registration_email($username, $email_verification_link)
	{
    $login_link = base_url('auth/login');  

		$tpl = '<h3>Hi ' .strtoupper($username).'</h3>
            <p>Selamat Datang di APB</p>
            <p>Aktifkan akun Anda dengan tautan di dibawah ini :</p>  
            <p>'.$email_verification_link.'</p>

            <br>
            <br>

            <p>Regards, <br> 
               APB <br> 
            </p>
    ';
		return $tpl;		
	}

	//=============================================================
	function pwd_reset_link($username, $reset_link)
	{
		$tpl = '<h3>Hi ' .strtoupper($username).'</h3>
            <p>Selamat Datang di APB</p>
            <p>Kami telah menerima permintaan untuk mereset kata sandi Anda. Jika Anda tidak melakukan permintaan ini, Anda dapat mengabaikan pesan ini dan tidak ada tindakan yang akan diambil.</p> 
            <p>Untuk mengatur ulang kata sandi Anda, silakan klik tautan di bawah ini:</p> 
            <p>'.$reset_link.'</p>

            <br>
            <br>

            <p>Regards, <br> 
               APB <br> 
            </p>
    ';
		return $tpl;		
	}

	

}
?>