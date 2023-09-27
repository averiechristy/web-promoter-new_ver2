<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use App\Models\LeaderBoard;
use Illuminate\Http\Request;

class MyIncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Mengambil data pendapatan dan poin untuk pengguna yang login
    $userId = auth()->user()->id;

    // Mengambil data tanggal awal dan akhir dari request
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Jika tidak ada tanggal yang dipilih, tampilkan pesan
    if (!$startDate || !$endDate) {
        return view('user.myincome');
    }

    if ($startDate && $endDate) {
        if ($startDate > $endDate) {
            return redirect()->route('user.myincome')->with('error', 'Tanggal Mulai harus sebelum Tanggal Akhir.');
        }
        if ($endDate > now()->format('Y-m-d')) {
            return redirect()->route('user.myincome')->with('error', 'Tanggal Belum Berjalan');
        }
    }

    // Query untuk mengambil data pendapatan dan poin berdasarkan range tanggal
    $incomePoints = Leaderboard::selectRaw('SUM(income) as total_pendapatan, SUM(total) as total_poin')
        ->where('user_id', $userId)
        ->when($startDate, function ($query) use ($startDate) {
            return $query->whereDate('created_at', '>=', $startDate);
        })
        ->when($endDate, function ($query) use ($endDate) {
            return $query->whereDate('created_at', '<=', $endDate);
        })
        ->groupBy('user_id')
        ->first(); // Mengambil hanya satu baris hasil

    return view('user.myincome', [
        'incomePoints' => $incomePoints,
    ]);
}

    

    /**
     * Show the form for creating a new resource.
     */

 public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
