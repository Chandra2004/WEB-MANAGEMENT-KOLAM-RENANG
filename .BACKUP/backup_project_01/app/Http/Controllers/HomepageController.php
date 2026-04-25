<?php

namespace TheFramework\Http\Controllers;

use Exception;
use TheFramework\App\Config;
use TheFramework\Http\Controllers\Controller;
use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use TheFramework\Config\EmailHandler;
use TheFramework\Http\Requests\KontakRequest;
use TheFramework\Models\Category;
use TheFramework\Models\Event;
use TheFramework\Models\Gallery;
use TheFramework\Models\Role;
use TheFramework\Models\User;

class HomepageController extends Controller
{
    public $sessionLogin;

    public function __construct()
    {
        $this->sessionLogin = Helper::session_get('user') ?? null;
    }

    public function homepage()
    {
        return View::render('homepage.beranda', [
            'user' => $this->sessionLogin,
            'notification' => Helper::get_flash('notification'),
            "title" => "Khafid Swimming Club (KSC) - Official Website | Beranda",
            'events' => Event::query()
                ->select([
                    'events.*',
                    'categories.nama_kategori AS kategori',
                    'users.nama_lengkap AS author'
                ])
                ->join('categories', 'categories.uid', '=', 'events.uid_kategori')
                ->join('users', 'users.uid', '=', 'events.uid_author')
                ->limit(2, 0)
                ->orderBy('tanggal_event', 'desc')
                ->all(),
            'galleries' => Gallery::query()
                ->select([
                    'galleries.*',
                    'events.nama_event AS nama_foto'
                ])
                ->join('events', 'events.uid', '=', 'galleries.uid_event')
                ->limit(10, 0)
                ->orderBy('created_at', 'desc')
                ->all()
        ]);
    }

    public function aboutUs()
    {
        return View::render('homepage.tentang-kami', [
            'user' => $this->sessionLogin,
            'notification' => Helper::get_flash('notification'),
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Tentang Kami',
            'mentors' => User::where('uid_role', Role::where('nama_role', 'coach')->first()->uid)
                ->limit(3, 0)
                ->all()
        ]);
    }

    public function facilities()
    {
        return View::render('homepage.fasilitas', [
            'user' => $this->sessionLogin,
            'notification' => Helper::get_flash('notification'),
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Fasilitas',
        ]);
    }

    public function coaches()
    {
        return View::render('homepage.pelatih', [
            'user' => $this->sessionLogin,
            'notifikasi' => Helper::get_flash('notification'),
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Pelatih',
            'mentors' => User::where('uid_role', Role::where('nama_role', 'coach')->first()->uid)
                ->all()
        ]);
    }

    public function events($keyword = null, $page = 1)
    {
        $query = Event::query();

        if ($keyword && $keyword != 'page') {
            $query->where('nama_event', 'like', "%{$keyword}%")
                ->orWhere('lokasi_event', 'like', "%{$keyword}%");
        }

        $events = $query->with(['category', 'author'])->withCount(['registrations'])->orderBy("tanggal_event", "DESC")->paginate(9, $page);

        return View::render('homepage.event', [
            'user' => $this->sessionLogin,
            'notification' => Helper::get_flash('notification'),
            "title" => "Khafid Swimming Club (KSC) - Official Website | Event",
            'categories' => Category::query()->all(),
            'events' => $events,
        ]);
    }

    public function eventDetail($slug, $uid)
    {
        $event = Event::query()
            ->select([
                'events.*',
                'categories.nama_kategori AS kategori',
                'users.nama_lengkap AS author',
                'payment_method.bank',
                'payment_method.rekening',
                'payment_method.atas_nama',
                'payment_method.photo',
            ])
            ->withCount(['registrations'])
            ->join('categories', 'events.uid_kategori', '=', 'categories.uid')
            ->join('users', 'events.uid_author', '=', 'users.uid')
            ->join('payment_method', 'events.uid_payment_method', '=', 'payment_method.uid', 'LEFT')
            ->where('events.slug', '=', $slug)->where('events.uid', '=', $uid)->first();

        return View::render('homepage.event-detail', [
            'user' => $this->sessionLogin,
            'notification' => Helper::get_flash('notification'),
            'title' => "Khafid Swimming Club (KSC) - Official Website | " . $event['nama_event'],
            'event' => $event
        ]);
    }

    public function galleries()
    {
        $eventUid = Helper::request()->get('event');
        $page = (int)Helper::request()->get('page', 1);

        $events = Event::query()->select(['uid', 'nama_event'])->all();

        $query = Gallery::query()
            ->select(['galleries.*', 'events.nama_event'])
            ->join('events', 'galleries.uid_event', '=', 'events.uid');

        if ($eventUid) {
            $query->where('galleries.uid_event', '=', $eventUid);
        }

        $pagination = $query->orderBy('galleries.created_at', 'desc')->paginate(24, $page);

        return View::render('homepage.galeri', [
            'user' => $this->sessionLogin,
            'notification' => Helper::get_flash('notification'),
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Galeri',
            'events' => $events,
            'galleries' => $pagination['data'],
            'pagination' => $pagination,
            'activeEvent' => $eventUid,
        ]);
    }

    public function contact()
    {
        return View::render('homepage.kontak', [
            'user' => $this->sessionLogin,
            'notification' => Helper::get_flash('notification'),
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Kontak',
        ]);
    }

    public function contactProcess(KontakRequest $kontak)
    {
        try {
            $data = $kontak->validated();
            $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'N/A';

            $htmlBody = Helper::renderToString('email.contact-notification', [
                'data' => $data,
                'ip_address' => $ip_address
            ]);

            if ($htmlBody === false) {
                $htmlBody = "Pesan baru dari {$data['nama_lengkap']} ({$data['email']}):\n\n{$data['pesan']}";
            }

            $status = EmailHandler::send(Config::get('MAIL_TO'), 'Kontak: ' . $data['subjek'], $htmlBody, []);

            if (!$status) {
                return Helper::redirect('/contact', 'error', 'Terjadi kesalahan saat mengirim email', 10);
            }

            return Helper::redirect('/contact', 'success', 'Pesan anda berhasil terkirim', 10);
        } catch (Exception $e) {
            return Helper::redirect('/contact', 'error', 'Terjadi kesalahan : ' . $e->getMessage(), 10);
        }
    }
}
