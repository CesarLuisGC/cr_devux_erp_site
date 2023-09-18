<?php

namespace App\Http\Controllers\Landlord\Modules\System\Notification\Mail;

use App\Jobs\Landlord\Mail\SendEmailJob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendMailController extends Controller
{

    public function sendmail(Request $request)
    {
        $details = ['email' => 'recipient@example.com'];
        SendEmailJob::dispatch($details);

        return 'Proceso ejecutado correctamente!';
    }

}