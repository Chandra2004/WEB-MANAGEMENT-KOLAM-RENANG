<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomepageController extends Controller
{
    public function homepage()
    {
        $events = [
            [
                'uid' => 'ev-001',
                'slug' => 'kejuaraan-renang-pelajar-2026',
                'nama_event' => 'Kejuaraan Renang Pelajar 2026',
                'banner_event' => 'banner_event_1.jpg',
                'tipe_event' => 'gratis',
                'kategori' => 'Prestasi',
                'status_event' => 'berjalan',
                'tanggal_event' => '2026-06-15',
                'waktu_event' => '08:00',
                'lokasi_event' => 'Kolam Renang Gelora KSC',
            ],
            [
                'uid' => 'ev-002',
                'slug' => 'ksc-summer-sprint-festival',
                'nama_event' => 'KSC Summer Sprint Festival',
                'banner_event' => 'banner_event_2.jpg',
                'tipe_event' => 'bayar',
                'kategori' => 'Umum',
                'status_event' => 'ditunda',
                'tanggal_event' => '2026-07-20',
                'waktu_event' => '09:00',
                'lokasi_event' => 'Tirta Jaya Aquatics Center',
            ]
        ];

        $galleries = [
            ['foto_event' => 'gallery1.jpg', 'nama_foto' => 'Latihan Teknik Gaya Dada'],
            ['foto_event' => 'gallery2.jpg', 'nama_foto' => 'Pemberian Medali KSC Cup'],
            ['foto_event' => 'gallery3.jpg', 'nama_foto' => 'Latihan Intensif Pagi'],
            ['foto_event' => 'gallery4.jpg', 'nama_foto' => 'Keceriaan Kelas Dasar'],
            ['foto_event' => 'gallery5.jpg', 'nama_foto' => 'Start Block Training'],
            ['foto_event' => 'gallery6.jpg', 'nama_foto' => 'Event KSC Championship'],
        ];

        return view('homepage.beranda', [
            'title' => 'Khafid Swimming Club (KSC) - Official Website | Beranda',
            'events' => $events,
            'galleries' => $galleries
        ]);
    }
}







    // return view('homepage.beranda', [
    //     'user' => $this->sessionLogin,
    //     'notification' => Helper::get_flash('notification'),
    //     "title" => "Khafid Swimming Club (KSC) - Official Website | Beranda",
    //     'events' => (function() {
    //         $events = Event::query()
    //             ->select([
    //                 'events.*',
    //                 'data_users.nama_lengkap AS author'
    //             ])
    //             ->with(['eventCategories.category', 'eventCategories.registrations'])
    //             ->join('users', 'users.uid', '=', 'events.uid_author')
    //             ->join('data_users', 'users.uid', '=', 'data_users.uid_user')
    //             ->limit(2)
    //             ->orderBy('events.tanggal_mulai', 'desc')
    //             ->all();

    //         foreach ($events as &$event) {
    //             $count = 0;
    //             if (isset($event['eventCategories'])) {
    //                 foreach ($event['eventCategories'] as $cat) {
    //                     $count += count($cat['registrations'] ?? []);
    //                 }
    //             }
    //             $event['registrations_count'] = $count;
    //         }
    //         return $events;
    //     })(),
    //     'galleries' => Gallery::query()
    //         ->select([
    //             'galleries.*',
    //             'events.nama_event AS nama_foto'
    //         ])
    //         ->join('events', 'events.uid', '=', 'galleries.uid_event')
    //         ->limit(10)
    //         ->orderBy('created_at', 'desc')
    //         ->all()
    // ]);


// public function eventDetail() {
//     $event = Event::query()
//         ->select([
//             'events.*',
//             'data_users.nama_lengkap AS author',
//             'payment_method.bank',
//             'payment_method.rekening',
//             'payment_method.atas_nama',
//             'payment_method.photo',
//         ])
//         ->with(['eventCategories.category', 'eventCategories.registrations'])
//         ->join('users', 'events.uid_author', '=', 'users.uid')
//         ->join('data_users', 'users.uid', '=', 'data_users.uid_user')
//         ->join('payment_method', 'events.uid_payment_method', '=', 'payment_method.uid', 'LEFT')
//         ->where('events.slug', '=', $slug)->where('events.uid', '=', $uid)->first();

//     $profileCompletion = ['complete' => false, 'percentage' => 0];
//     $registeredCategoryUids = [];

//     if ($this->sessionLogin) {
//         $userModel = new User();
//         $profileCompletion = $userModel->getProfileCompletion($this->sessionLogin['uid']);

//         // Dapatkan list UID kategori yang sudah didaftarkan user di event ini
//         $registeredCats = (new \TheFramework\App\QueryBuilder(\TheFramework\App\Database::getInstance()))
//             ->table('registrations')
//             ->select(['registrations.uid_event_category'])
//             ->join('event_categories', 'registrations.uid_event_category', '=', 'event_categories.uid')
//             ->where('registrations.uid_user', '=', $this->sessionLogin['uid'])
//             ->where('event_categories.uid_event', '=', $uid)
//             ->get();

//         if ($registeredCats) {
//             foreach ($registeredCats as $reg) {
//                 $registeredCategoryUids[] = $reg['uid_event_category'];
//             }
//         }
//     }

//     return view ('homepage.event-detail', [
//         'user' => $this->sessionLogin,
//         'notification' => Helper::get_flash('notification'),
//         'title' => "Khafid Swimming Club (KSC) - Official Website | " . $event['nama_event'],
//         'event' => (function($event) {
//             $count = 0;
//             if (isset($event['eventCategories'])) {
//                 foreach ($event['eventCategories'] as $cat) {
//                     $count += count($cat['registrations'] ?? []);
//                 }
//             }
//             $event['registrations_count'] = $count;
//             return $event;
//         })($event),
//         'profileCompletion' => $profileCompletion,
//         'registeredCategoryUids' => $registeredCategoryUids
//     ]);
// }

// public function events() {
//      $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//     $currentKeyword = null;
//     $currentPage = 1;

//     // Logika untuk membedakan rute search vs page biasa
//     if (strpos($currentPath, '/events/search/') !== false) {
//         $currentKeyword = urldecode($keyword);
//         $currentPage = $page;
//     } elseif (strpos($currentPath, '/events/page/') !== false) {
//         $currentKeyword = null;
//         $currentPage = (int)$keyword; // Parameter pertama di rute ini adalah nomor halaman
//     } else {
//         $currentKeyword = $keyword;
//         $currentPage = $page;
//     }

//     $query = Event::query();

//     if ($currentKeyword && $currentKeyword != 'page') {
//         $query->where(function($q) use ($currentKeyword) {
//             $q->where('nama_event', 'like', "%{$currentKeyword}%")
//               ->orWhere('lokasi_event', 'like', "%{$currentKeyword}%");
//         });
//     }

//     $pagination = $query->with(['eventCategories.category', 'eventCategories.registrations', 'author'])
//         ->orderBy("tanggal_mulai", "DESC")
//         ->paginate(9, $currentPage);

//     foreach ($pagination['data'] as &$event) {
//         $count = 0;
//         if (isset($event['eventCategories'])) {
//             foreach ($event['eventCategories'] as $cat) {
//                 $count += count($cat['registrations'] ?? []);
//             }
//         }
//         $event['registrations_count'] = $count;
//     }
//     return view('homepage.event', [
//         'user' => $this->sessionLogin,
//         'notification' => Helper::get_flash('notification'),
//         "title" => "Khafid Swimming Club (KSC) - Official Website | Event",
//         'categories' => Category::query()->all(),
//         'events' => $pagination,
//         'currentKeyword' => $currentKeyword,
//     ]);
// }

// public function facilities() {
//     return view ('homepage.fasilitas', [
//         'user' => $this->sessionLogin,
//         'notification' => Helper::get_flash('notification'),
//         'title' => 'Khafid Swimming Club (KSC) - Official Website | Fasilitas',
//     ]);
// }

// public function gallery() {
//             $eventUid = Helper::request()->get('event');
//     $page = (int)Helper::request()->get('page', 1);

//     $events = Event::query()->select(['uid', 'nama_event'])->all();

//     $query = Gallery::query()
//         ->select(['galleries.*', 'events.nama_event'])
//         ->join('events', 'galleries.uid_event', '=', 'events.uid');

//     if ($eventUid) {
//         $query->where('galleries.uid_event', '=', $eventUid);
//     }

//     $pagination = $query->orderBy('galleries.created_at', 'desc')->paginate(24, $page);
//     return view ('homepage.galeri', [
//         'user' => $this->sessionLogin,
//         'notification' => Helper::get_flash('notification'),
//         'title' => 'Khafid Swimming Club (KSC) - Official Website | Galeri',
//         'events' => $events,
//         'galleries' => $pagination['data'],
//         'pagination' => $pagination,
//         'activeEvent' => $eventUid,
//     ]);
// }
// public function contact() {
//     return view ('homepage.kontak', [
//         'user' => $this->sessionLogin,
//         'notification' => Helper::get_flash('notification'),
//         'title' => 'Khafid Swimming Club (KSC) - Official Website | Kontak',
//     ]);
// }
// public function coaches() {
//     return view ('homepage.pelatih', [
//         'user' => $this->sessionLogin,
//         'notification' => Helper::get_flash('notification'),
//         'title' => 'Khafid Swimming Club (KSC) - Official Website | Pelatih',
//         'mentors' => User::query()
//             ->select(['users.*', 'data_users.*'])
//             ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
//             ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
//             ->join('data_users', 'users.uid', '=', 'data_users.uid_user')
//             ->where('roles.name', '=', 'pelatih')
//             ->all()
//     ]);
// }
// public function aboutUs() {
//     return view ('homepage.tentang-kami', [
//         'user' => $this->sessionLogin,
//         'notification' => Helper::get_flash('notification'),
//         'title' => 'Khafid Swimming Club (KSC) - Official Website | Tentang Kami',
//         'mentors' => User::query()
//             ->select(['users.*', 'data_users.*'])
//             ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
//             ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
//             ->join('data_users', 'users.uid', '=', 'data_users.uid_user')
//             ->where('roles.name', '=', 'pelatih')
//             ->limit(3)
//             ->all()
//     ]);
// }
