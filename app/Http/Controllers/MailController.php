<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
    public function basic_email() {
        $data = array('name'=>"Virat Gandhi");

        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('grafica@concreo.eu', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
            $message->from('grafica@concreo.eu','Virat Gandhi');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
    public function html_email() {
        $data = array('name'=>"GiGroup Amministrazione");
        Mail::send('mail', $data, function($message) {
            $message->to('grafica@concreo.eu', 'Concreo')->subject
            ('ATTENZIONE ci sono 30 o più biglietti da visita in attesa');
            $message->from('grafica@concreo.eu','GiGroup Amministrazione');
        });
        $pag = Session::get('nazione');
        ($pag == 11 )? $pag = 'italia':$pag = 'world';
        return redirect($pag);
    }
    public function attachment_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
            $message->to('grafica@concreo.eu', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('grafica@concreo.eu','Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
    }
	public function test_email() {
        $data = array('name'=>"GiGroup Amministrazione");
        Mail::send('mail', $data, function($message) {
            $message->to('supporto2@itmedianet.it', 'Supporto2')->subject
            ('Creato nuovo ordine biglietti da visita nel portale GiGROUP');
            $message->from(['noreply@makemesign.net'=>'GiGroup Amministrazione']);
        });
        $pag = Session::get('nazione');
        ($pag == 11 )? $pag = 'italia':$pag = 'world';
        return redirect($pag);
    }
}
