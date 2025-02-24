<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ShareDataServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Chỉ cần một View::composer là đủ
        View::composer(['layout.main', 'layout.sideBar', 'block.header', 'login.login'], function ($view) {
            $user = null;
            try {

                $user = Auth::user();
                $currentUrl = request()->segment(1);

                // Khởi tạo các biến mặc định
                $qls = $qlbd = $qlmt = $home = false;

                switch ($currentUrl) {
                    case 'quan-ly-sach':
                        $qls = true;
                        break;
                    case 'quan-ly-ban-doc':
                        $qlbd = true;
                        break;
                    case 'quan-ly-muon-tra':
                        $qlmt = true;
                        break;
                    default:
                        $home = true;
                        break;
                }

                // Sử dụng with() để share data
                $view->with([
                    'isLogin' => $user,
                    'qls' => $qls,
                    'qlbd' => $qlbd,
                    'qlmt' => $qlmt,
                    'home' => $home,
                ]);
            } catch (\Exception $e) {
                // Log lỗi nếu cần
                report($e);

                // Set giá trị mặc định nếu có lỗi
                $view->with([
                    'isLogin' => null,
                    'qls' => false,
                    'qlbd' => false,
                    'qlmt' => false,
                    'home' => true,
                ]);
            }
        });
    }
}
