<?php

namespace TheFramework\Http\Controllers;

use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use Exception;
use TheFramework\Config\UploadHandler;
use TheFramework\Http\Controllers\Services\ErrorController;
use TheFramework\Http\Requests\PaymentMethodRequest;
use TheFramework\Models\PaymentMethod;
use TheFramework\Models\User;

class PaymentMethodController extends DashboardController
{
    protected PaymentMethod $paymentMethod;

    public function __construct()
    {
        parent::__construct();
        $this->paymentMethod = new PaymentMethod();
    }

    public function paymentMethod()
    {
        $notification = Helper::get_flash('notification');

        return View::render('dashboard.admin.payment-method', array_merge($this->dataTetap, [
            'title' => 'Manajemen Keuangan ' . Helper::session_get("user")['nama_role'] . ' | Khafid Swimming Club (KSC) - Official Website',
            'paymentMethods' => PaymentMethod::query()->orderBy('created_at', 'DESC')->all()
        ]));
    }

    public function paymentMethodCreateProcess($role, $uidUser, PaymentMethodRequest $request)
    {
        try {
            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            }

            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = UploadHandler::handleUploadToWebP($request->file('photo'), '/kode-bank', 'bank_');
                if (UploadHandler::isError($photo)) {
                    throw new Exception(UploadHandler::getErrorMessage($photo));
                }
            }

            $data = $request->validated();
            $data['uid'] = Helper::uuid();
            $data['photo'] = $photo;

            $this->paymentMethod->addPaymentMethod($data);

            return Helper::redirect("/{$role}/dashboard/management-payment", 'success', "Metode pembayaran {$data['bank']} berhasil ditambahkan", 10);
        } catch (Exception $e) {
            if ($photo) {
                UploadHandler::delete($photo, '/kode-bank');
            }
            return Helper::redirect("/{$role}/dashboard/management-payment", 'error', 'Terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }

    public function paymentMethodEditProcess($role, $uidUser, $uidPaymentMethod, PaymentMethodRequest $request)
    {
        $newPhoto = null;
        try {
            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            }

            $paymentMethod = $this->paymentMethod->where('uid', '=', $uidPaymentMethod)->first();
            if (!$paymentMethod) {
                return Helper::redirect("/{$role}/dashboard/management-payment", 'error', 'Metode pembayaran tidak ditemukan', 10);
            }

            $oldPhoto = $paymentMethod['photo'];
            $photo = $oldPhoto;

            if ($request->hasFile('photo')) {
                $newPhoto = UploadHandler::handleUploadToWebP($request->file('photo'), '/kode-bank', 'bank_');
                if (UploadHandler::isError($newPhoto)) {
                    throw new Exception(UploadHandler::getErrorMessage($newPhoto));
                }
                $photo = $newPhoto;
            }

            $data = $request->validated();
            $data['photo'] = $photo;

            $this->paymentMethod->updatePaymentMethod($data, $uidPaymentMethod);

            if ($newPhoto && $oldPhoto) {
                UploadHandler::delete($oldPhoto, '/kode-bank');
            }

            return Helper::redirect("/{$role}/dashboard/management-payment", 'success', "Metode pembayaran {$data['bank']} berhasil diupdate", 10);
        } catch (Exception $e) {
            if ($newPhoto) {
                UploadHandler::delete($newPhoto, '/kode-bank');
            }
            return Helper::redirect("/{$role}/dashboard/management-payment", 'error', 'Terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }

    public function paymentMethodDeleteProcess($role, $uidUser, $uidPaymentMethod)
    {
        try {
            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            }

            $paymentMethod = $this->paymentMethod->where('uid', '=', $uidPaymentMethod)->first();
            if (!$paymentMethod) {
                return Helper::redirect("/{$role}/dashboard/management-payment", 'error', 'Metode pembayaran tidak ditemukan', 10);
            }

            $this->paymentMethod->deletePaymentMethod($uidPaymentMethod);

            if ($paymentMethod['photo']) {
                UploadHandler::delete($paymentMethod['photo'], '/kode-bank');
            }

            return Helper::redirect("/{$role}/dashboard/management-payment", 'success', "Metode pembayaran {$paymentMethod['bank']} berhasil dihapus", 10);
        } catch (Exception $e) {
            return Helper::redirect("/{$role}/dashboard/management-payment", 'error', 'Terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }
}