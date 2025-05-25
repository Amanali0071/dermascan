<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\PatientDoctorChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PDChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = PatientDoctorChat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('messagesImgs', $imageName);
            $message->image = $imageName;
            $message->save();
            broadcast(new MessageSent($message, $request->receiver_id, Auth::id(), $message->image))->toOthers();
        }else{
            broadcast(new MessageSent($message, $request->receiver_id, Auth::id()))->toOthers();
        }
        // dd($message,$request->all());
        $sender_name = User::where('id', Auth::id())->first();
        return response()->json(['message' => $message, 'sender_name' => $sender_name->first_name]);
    }
    public function doctorchatindex()
    {
        $userId = Auth::id();

        $messages = PatientDoctorChat::with('doctor', 'patient')
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($item) use ($userId) {
                return $item->sender_id == $userId ? $item->receiver_id : $item->sender_id;
            });

        return view('doctordash.doctorchatindex', compact('messages'));
    }
    public function getMessageHistory($id)
    {
        $userId = Auth::id();

        $messages = PatientDoctorChat::where(function ($query) use ($userId, $id) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($userId, $id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', $userId);
        })->orderBy('created_at', 'asc')->get();
        //sendername and receiver name

        return response()->json($messages);
    }

}
