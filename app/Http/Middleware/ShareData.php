<?php

namespace App\Http\Middleware;

use App\Models\user\userModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        // Gắn dữ liệu vào request, đặt key là 'userData'
        $request->attributes->set('userData', $user);

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

        // Nếu cần chia sẻ các biến này cho view:
        View::share([
            'isLogin' => $user,
            'qls'     => $qls,
            'qlbd'    => $qlbd,
            'qlmt'    => $qlmt,
            'home'    => $home,
        ]);

        return $next($request);
    }
}
