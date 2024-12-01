<?php
namespace App\Http\Controllers;

use App\Models\Payment;


use App\Models\Income;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class IncomeExpenseController extends Controller
{
    public function create()
    {
        return view('welcome');
    }


    
    
    public function save(Request $request)
    {
        if ($request->isMethod('post')) {
            // รับข้อมูลจากฟอร์ม
            $data = $request->all();
    
            // สร้างข้อมูลใหม่ในตาราง payment
            Payment::create([
                'type' => $data['type'],
                'amount' => $data['amount'],
                'pay_date' => $data['pay_date'],
                'rec_date' => $data['rec_date'],
                'update_date' => $data['update_date'],
                'name_pay' => $data['name_pay'],
            ]);
    
            // Redirect กลับไปที่หน้าฟอร์มและแสดงข้อความสำเร็จ
            return redirect()->back()->with('success', 'บันทึกข้อมูลสำเร็จ');
        }
    
        // หากไม่ใช่ POST ให้ redirect กลับไปที่หน้าเดิมพร้อมข้อความผิดพลาด
        return redirect()->back()->with('error', 'ไม่สามารถบันทึกข้อมูลได้');
    }
    
}
