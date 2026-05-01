<?php

namespace TheFramework\Http\Controllers;

use TheFramework\App\View;
use TheFramework\Helpers\Helper;
use Exception;
use TheFramework\Http\Controllers\Services\ErrorController;
use TheFramework\Http\Requests\CategoryRequest;
use TheFramework\Models\Category;
use TheFramework\Models\User;

class CategoryController extends DashboardController
{
    protected Category $category;

    public function __construct()
    {
        parent::__construct();
        $this->category = new category();
    }

    public function category($role, $page = 1)
    {

        return View::render('dashboard.general.category', array_merge($this->dataTetap, [
            'title' => 'Manajemen Kategori ' . Helper::session_get("user")['nama_role'] . ' | Khafid Swimming Club (KSC) - Official Website',
            'categories' => Category::query()->orderBy('created_at', 'DESC')->paginate(10, $page)
        ]));
    }

    public function categoryCreateProcess($role, $uidUser, CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $data['uid'] = Helper::uuid();
            $data['slug_kategori'] = Helper::slugify($data['nama_kategori']);

            $category = Category::query()->where('slug_kategori', '=', $data['slug_kategori'])->first();

            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            } else if ($category) {
                return Helper::redirect("/{$role}/dashboard/management-category", 'error', 'nama kategori sudah ada', 10);
            } else {
                $status = $this->category->createCategory($data) ? true : false;
                if ($status === false) {
                    return Helper::redirect("/{$role}/dashboard/management-category", 'error', 'kategori gagal ditambahkan', 10);
                } else {
                    return Helper::redirect("/{$role}/dashboard/management-category", 'success', 'kategori berhasil ditambahkan', 10);
                }
            }
        } catch (Exception $e) {
            return Helper::redirect("/{$role}/dashboard/management-category", 'error', 'terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }

    public function categoryEditProcess($role, $uidUser, $uidCategory, CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $slug = Helper::slugify($data['nama_kategori']);

            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            }
            $findCategory = Category::query()
                ->where('uid', '=', $uidCategory)
                ->first();
            if (!$findCategory) {
                return Helper::redirect("/{$role}/dashboard/management-category", 'error', 'kategori tidak ditemukan', 10);
            }

            $duplicateSlug = Category::query()
                ->where('slug_kategori', '=', $slug)
                ->where('uid', '!=', $uidCategory)
                ->first();
            if ($duplicateSlug) {
                return Helper::redirect("/{$role}/dashboard/management-category", 'error', 'nama kategori sudah digunakan', 10);
            }

            $status = $this->category->updateCategory([
                'uid' => $uidCategory,
                'nama_kategori' => $data['nama_kategori'],
                'slug_kategori' => $slug
            ]);
            return Helper::redirect(
                "/{$role}/dashboard/management-category",
                $status ? 'success' : 'error',
                $status ? 'kategori berhasil diperbarui' : 'kategori gagal diperbarui',
                10
            );
        } catch (Exception $e) {
            return Helper::redirect("/{$role}/dashboard/management-category", 'error', $e->getMessage(), 10);
        }
    }

    public function categoryDeleteProcess($role, $uidUser, $uidCategory)
    {
        try {
            $data['uid'] = $uidCategory;

            if (User::authorizeAction($role, $uidUser) === false) {
                ErrorController::error403();
            } else {
                $findCategory = Category::query()->where('uid', '=', $uidCategory)->first();
                if ($findCategory === null) {
                    return Helper::redirect("/{$role}/dashboard/management-category", 'error', 'kategori tidak ditemukan', 10);
                } else {
                    $status = $this->category->deleteCategory($data) ? true : false;
                    if ($status === false) {
                        return Helper::redirect("/{$role}/dashboard/management-category", 'error', 'kategori gagal dihapus', 10);
                    } else {
                        return Helper::redirect("/{$role}/dashboard/management-category", 'success', 'kategori berhasil dihapus', 10);
                    }
                }
            }
        } catch (Exception $e) {
            return Helper::redirect("/{$role}/dashboard/management-category", 'error', 'terjadi kesalahan: ' . $e->getMessage(), 10);
        }
    }
}
