<?php

namespace App\Http\Controllers;

use App\Mail\MarketingMail;
use App\Models\Cliente;
use App\Models\EmailUtilizado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MarketingController extends Controller
{
    public function index(Request $request)
    {
        $cliente = Cliente::orderBy('nome', 'asc');
        if (isset($request->email)) {
            if ($request->email) {

                $cliente = $cliente->where(function ($query) {
                    $query->whereRaw('clientes.email NOT IN(SELECT emails_utilizados.email FROM emails_utilizados WHERE deleted_at IS NULL)');
                })->whereNotNull('email');
            } else {
                $cliente = $cliente->whereNull('email');
            }
        } else {
            $cliente = $cliente->where(function ($query) {
                $query->whereRaw('clientes.email NOT IN(SELECT emails_utilizados.email FROM emails_utilizados WHERE deleted_at IS NULL)')->orWhere('email', null);
            });
        }
        if ($request->data) {
            $cliente = $cliente->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . $request->data . '"');
        }
        $cliente = $cliente->simplePaginate(15);
        return view('marketing.index', ['cliente' => $cliente]);
    }

    public function enviar_emails(Request $request)
    {
        $emails = array('alanssantos32@gmail.com');
        $cliente = Cliente::whereRaw('id IN(' . $request->cliente_id . ')');
        foreach ($cliente as $c) {
            if (!is_null($c->email)) {
                array_push($emails, $c->email);
            }
        }
        try {
            Mail::to($emails)->send(new MarketingMail());
            foreach ($emails as $e) {
                EmailUtilizado::create(array(
                    'email' => $e
                ));
            }
        } catch (\Exception $e) {
            foreach ($emails as $e) {
                EmailUtilizado::where('email', $e)->delete();
            }
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed to send emails with message "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->back()
            ->with('header', 'Success')
            ->with('message', 'Successfully deleted')
            ->with('status', 'success');
    }
}
