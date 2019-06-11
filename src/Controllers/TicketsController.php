<?php

namespace Ingvar\Support\Controllers;

use App\User;
use Ingvar\Support\Mail\Ticket;
use Ingvar\Support\Mail\ReplyTicket;
use Illuminate\Support\Facades\Mail;
use Ingvar\Support\Models\Tickets;
use Ingvar\Support\Models\TicketsMessages as Messages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketsController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $tickets = Tickets::orderBy('inbox', 'desc')->paginate(15);
      return view('igs::admin.support.index', ['tickets' => $tickets]);
   }

   /**
    * Display the specified resource.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
      //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $messages = Messages::where('ticket_id', $id)->get();
      $ticket = Tickets::find($id);
      $ticket->update([
         'inbox' => 0
      ]);
      return view('igs::admin.support.edit', [
         'ticket' => $ticket,
         'messages' => $messages,
      ]);
   }
   /*
    * Admin to user
    */
   public function update(Request $request, $id)
   {
      $this->validate($request, [
         'message' => [
            'required',
            'max:2000',
         ]
      ]);
      $ticket = Tickets::find($id);
      $ticket->increment('outbox');
      $body = strip_tags($request->input('message'));
      $user = User::find( $ticket->user_id );
      Messages::create(
         [
            'ticket_id' => $id,
            'user_id' => $request->user()->id,
            'message' => $body,
         ]
      );

      Mail::queue( new ReplyTicket( $user, $body,$id ));
      return redirect()->route('ingvar.support.tickets.edit', ['id' => $id])
          ->with([
              'status' => trans('igs::support.reply_success'),
              'alert'  => 'success',
          ]);
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       Tickets::find($id)->delete();
       return redirect()->route('ingvar.support.tickets.index')->with([
           'status' => trans('igs::support.ticket_deleted'),
           'alert'  => 'success',
       ]);
   }

   /**
    *   user
    */
   public function user_index(Request $request)
   {
      $tickets = Tickets::where('user_id', $request->user()->id)
         ->orderBy('outbox', 'desc')->paginate(15);
      return view('igs::userpanel.support.index', ['tickets' => $tickets]);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function user_create()
   {
      return view('igs::userpanel.support.create');
   }

   /**
    * Юзер создает новый тикет.
    *
    * @param  \Illuminate\Http\Request $request
    * Проверяем все поля
    * Создаем тикет
    * Создаем сообщение
    * Отправляем емейл админу
    * @return  страницу редактирования тикета
    */
   public function user_store(Request $request)
   {
       //dd($request->all());
      $this->validate($request, [
         'message' => [
            'required',
            'max:2000',
         ],
         'subject' => [
            'required',
            'max:191',
         ]
      ]);
      $ticket = Tickets::create([
         'subject' => $request->input('subject'),
         'user_id' => $request->user()->id,
         'inbox' => 1,
          'outbox' => 0,
      ]);

      $body = strip_tags($request->input('message'));
      Messages::create([
         'ticket_id' => $ticket->id,
         'user_id'   => $request->user()->id,
         'message'   => $body,
      ]);

      Mail::queue( new Ticket( $body, $ticket->id ));
      return redirect()->route('ingvar.support.tickets.user_edit', [
         'id' => $ticket->id,
      ])->with([
          'status' => trans('igs::support.ticket_created'),
          'alert'  => 'success',
      ]);
   }

   /**
    * @param Request $request
    * @param $id
    * проверяем чтобы юзер не смотрел чужие тикеты
    * если его , то возвращаем
    * @return mixed
    */
   public function user_edit(Request $request, $id)
   {
      $messages = null;

          $ticket = Tickets::where([
             ['id', $id],
             ['user_id', $request->user()->id]
          ])->first();

          if ($ticket) {
             $messages = Messages::where('ticket_id', $ticket->id)->get();
             $ticket->update([
                'outbox' => 0
             ]);
             return view('igs::userpanel.support.edit', [
                  'ticket' => $ticket,
                  'messages' => $messages,
              ]);
          } else {
             return redirect()->route('ingvar.support.tickets.user_index')->with([
                 'status' => trans('igs::support.no_results'),
                 'alert'  => 'danger',
             ]);
          }

   }

   /**
    * @param Request $request
    * @param $id - id тикета
    * Проверяем сообщение на пустоту и макс символы
    * Добавляем в тикет колличество входящих для админа
    * Убираем теги из сообщения
    * Создаем сообщение
    * Отправляем админу оповещение
    * @return страницу редактирования тикета
    */

   public function user_update(Request $request, $id)
   {
      $this->validate($request, [
         'message' => [
            'required',
            'max:2000',
         ]
      ]);
       $ticket = Tickets::find( $id);
       $ticket ->increment('inbox');
       $body = strip_tags($request->input('message'));
      Messages::create(
         [
            'ticket_id' => $id,
            'user_id' => $request->user()->id,
            'message' => $body,
         ]
      );

       Mail::queue( new Ticket( $body, $ticket->id ));
       return redirect()->route('ingvar.support.tickets.user_edit', [
           'id' => $id,
       ])->with([
           'status' => trans('igs::support.ticket_updated'),
           'alert'  => 'success',
       ]);
   }

}
