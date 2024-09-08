<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Installation;
use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    //
    public function entry()
    {
        $problems = Problem::where('problem_accepted', false)
            ->with('customer')->latest()->paginate(10);
        return view('pages.admin.data.customer.problem.entry', compact('problems'));
    }

    public function entryAcc(Problem $problem)
    {
        $problem->problem_accepted = true;
        $problem->save();
        return view('pages.admin.data.customer.problem.entry')->with('success', 'Gangguan berhasil masuk status proses');
    }

    public function process()
    {
        $problems = Problem::where('problem_accepted', true)->where('problem_status', true)
            ->with('customer')->latest()->paginate(10);

        return view('pages.admin.data.customer.problem.process', compact('problems'));
    }

    public function processDone(Problem $problem)
    {
        $problem->problem_status = false;
        $problem->save();

        return redirect()->route('admin.data.ticket.problem.process')->with('success', 'Gangguan berhasil diselesaikan');
    }

    public function close()
    {
        $problems = Problem::where('problem_accepted', true)->where('problem_status', false)
            ->with('customer')->latest()->paginate(10);

        return view('pages.admin.data.customer.problem.close', compact('problems'));
    }

    public function clear()
    {
        Problem::all()->each(function ($problem) {
            $problem->delete();
        });
        return redirect()->route('admin.data.ticket.problem.close')->with('success', 'Semua gangguan yang selesai berhasil dihapus');
    }

    public function create(Request $request)
    {
        $problem = new Problem();

        $problem->customer_id = $request->customer_id;
        $problem->description = $request->description;

        return redirect()->route('admin.tickets.problem')->with('success', 'Berhasil Membuat Ticket Gangguan');
    }


}
