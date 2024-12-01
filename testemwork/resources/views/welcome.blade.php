<!-- resources/views/transaction/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>เพิ่มรายการ</h1>

    <form action="{{ url('/save') }}" method="POST">
        @csrf
        <!-- เลือกประเภทของรายการ -->
        <label for="type">ประเภท:</label>
        <select name="type" id="type" required>
            <option value="income">รายรับ</option>
            <option value="expense">รายจ่าย</option>
        </select>

        <br><br>

        <label for="amount">จำนวนเงิน:</label>
        <input type="number" name="amount" id="amount" step="0.01" required>


        <label for="pay_date">วันที่จ่าย:</label>
        <input type="date" name="pay_date" id="pay_date" required>

        <label for="rec_date">วันที่บันทึกข้อมูล :</label>
        <input type="date" name="rec_date" id="rec_date" required>

        <label for="update_date">วันที่ปรับปรุงข้อมูล :</label>
        <input type="date" name="update_date" id="update_date" required>

        <!-- ฟิลด์สำหรับกรอกรายละเอียด -->
        <label for="name_pay">รายการใช้จ่าย :</label>
        <input type="text" name="name_pay" id="name_pay" required>

        <button type="submit">บันทึก</button>
    </form>
@endsection
