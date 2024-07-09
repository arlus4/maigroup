<?php

namespace App\Http\Controllers\Admin;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;

class Admin_NotificationController extends Controller
{
    public function index(): View
    {
        return view('master.settings.notifications.index');
    }

    public function getNotifications(): JsonResponse
    {
        $appId = env('ONESIGNAL_APP_ID');
        $apiKey = env('ONESIGNAL_REST_API_KEY');

        try {
            $client = new Client();
            $response = $client->request('GET', 'https://api.onesignal.com/notifications', [
                'headers' => [
                    'accept' => 'application/json',
                    'Authorization' => 'Basic ' . $apiKey,
                ],
                'query' => [
                    'app_id' => $appId,
                ],
            ]);

            return response()->json(json_decode($response->getBody()), $response->getStatusCode());
        } catch (ClientException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'response' => json_decode($e->getResponse()->getBody()->getContents()),
            ], $e->getCode());
        }
    }

    public function createNotifications(): View
    {
        return view('master.settings.notifications.create');
    }

    public function storeNotifications(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);

        $appId = env('ONESIGNAL_APP_ID');
        $apiKey = env('ONESIGNAL_REST_API_KEY');

        $title = $request->input('title');
        $message = $request->input('message');

        // Upload the image to the server
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('public/notif_pembeli');
            $imageUrl = url(Storage::url($path)); // URL absolut yang bisa diakses oleh OneSignal
        } else {
            $imageUrl = null;
        }

        try {
            $client = new Client();
            $response = $client->request('POST', 'https://onesignal.com/api/v1/notifications', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic '. $apiKey,
                ],
                'json' => [
                    'app_id' => $appId,
                    'headings' => ['en' => $title],
                    'contents' => ['en' => $message],
                    'included_segments' => ['All'],
                    // 'big_picture' => 'https://order.tokoseru.com/' . $imageUrl, // Menambahkan gambar untuk Android Push Notifications
                    // 'chrome_web_image' => 'https://order.tokoseru.com/' . $imageUrl, // Menambahkan gambar untuk Chrome Web Push
                    // 'adm_big_picture' => 'https://order.tokoseru.com/' . $imageUrl, // Menambahkan gambar untuk Amazon Device Messaging
                    // 'chrome_big_picture' => 'https://order.tokoseru.com/' . $imageUrl, // Menambahkan gambar untuk Chrome Push Notifications
                    'big_picture' => $imageUrl, // Menambahkan gambar untuk Android Push Notifications
                    'chrome_web_image' => $imageUrl, // Menambahkan gambar untuk Chrome Web Push
                    'adm_big_picture' => $imageUrl, // Menambahkan gambar untuk Amazon Device Messaging
                    'chrome_big_picture' => $imageUrl, // Menambahkan gambar untuk Chrome Push Notifications
                ],
            ]);

            return response()->json(['message' => 'Notifikasi berhasil dikirim'], 200);
        } catch (ClientException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'response' => json_decode($e->getResponse()->getBody()->getContents()),
            ], $e->getCode());
        }
    }

    public function deleteNotifications(Request $request)
    {
        $notificationIds = $request->notification_ids;

        $appId = env('ONESIGNAL_APP_ID');
        $apiKey = env('ONESIGNAL_REST_API_KEY');

        try {
            $client = new Client();
            foreach ($notificationIds as $notificationId) {
                $response = $client->request('DELETE', 'https://api.onesignal.com/notifications/'. $notificationId, [
                    'headers' => [
                        'accept' => 'application/json',
                        'Authorization' => 'Basic '. $apiKey,
                    ],
                    'query' => [
                        'app_id' => $appId,
                    ],
                ]);
            }

            return response()->json(['message' => 'Notifikasi berhasil dihapus'], 200);
        } catch (ClientException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'response' => json_decode($e->getResponse()->getBody()->getContents()),
            ], $e->getCode());
        }
    }

    public function segment(): View
    {
        return view('master.settings.notifications.segment');
    }

    public function getSegments(): JsonResponse
    {
        $appId = env('ONESIGNAL_APP_ID');
        $apiKey = env('ONESIGNAL_REST_API_KEY');

        try {
            $client = new Client();
            $response = $client->request('GET', "https://api.onesignal.com/apps/{$appId}/segments", [
                'headers' => [
                    'accept' => 'application/json',
                    'Authorization' => 'Basic ' . $apiKey,
                ],
                'query' => [
                    'app_id' => $appId,
                ],
            ]);

            return response()->json(json_decode($response->getBody()), $response->getStatusCode());
        } catch (ClientException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'response' => json_decode($e->getResponse()->getBody()->getContents()),
            ], $e->getCode());
        }
    }
}
