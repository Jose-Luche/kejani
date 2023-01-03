<?php

namespace App\Http\Controllers\Backend\accounts;

use App\Http\Controllers\Backend\CompanyDetailsController;
use App\Models\Unit;
use App\Models\Branch;
use App\Models\Ledger;
use App\Models\Receipt;
use App\Models\Projection;
use App\Models\FeeCategory;
use App\Models\allocReceipt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Backend\tenant\TenantController;
use App\Models\CompanyDetail;
use App\Models\Tenant;
use PDF;

class ReceiptController extends Controller
{
    public function viewReceipt()
    {
        $data['allData'] = Receipt::all();
        return view('backend.account.receipts.viewReceipt', $data);
    }

    public function addReceipt()
    {
        $data['branches'] = Branch::all();
        $data['units'] = Unit::all();
        $data['fee_categories'] = FeeCategory::all();
        $data['ledgers'] = Ledger::all();

        return view('backend.account.receipts.addReceipt', $data);
    }

    public function billShow($id)
    {
        $payment = Projection::where('id', $id)->first();
        //$student = Student::where('id', $id)->first();

        $tenant = (new TenantController)->tenDetails($payment->id);

        $accounts = Ledger::all();

        $bills = [];
        if ($tenant->bills != null) {
            $bills = $tenant->bills;
        }



        return view('backend.account.receipts.makePayment', compact('tenant', 'bills', 'accounts', 'id'));
    }

    public function storePayment(Request $request, $id, TenantController $tenantController)
    {
        //Declare the variables
        $payment = Projection::where('id', $id)->first();
        $tenant = $tenantController->tenDetails($payment->tenant_id)->id;
        $totals = $request->totals;
        $regDate = $request->regDate;
        $payMode = $request->payMode;
        $ledgerId = $request->ledgerId;
        $reference = $request->reference;
        $narration = $request->narration;
        $stamp = rand(00000000, 99999999);

        if ($totals > 0) {
            //create an instance to help with data storage
            $data = new Receipt();
            $data->amount = $totals;
            $data->regDate = $regDate;
            $data->payMode = $payMode;
            $data->ledgerId = $ledgerId;
            $data->reference = $reference;
            $data->narration = $narration;
            $data->tenantId = $tenant;
            $data->stamp = $stamp;

            $data->save();

            $recId = $data->id;
        }

        if (!empty(@$data)) {
            //prepare for receipt allocations
            foreach ($request->contId as $key => $value) {

                $projId = $request->contId[$key];
                $amountPaid = $request->paid[$key];

                //create instance of the allocaion model
                $alloc = new allocReceipt;
                if ($amountPaid > 0) {
                    $alloc->recId = $recId;
                    $alloc->projId = $projId;
                    $alloc->amount = $amountPaid;
                    $alloc->allocDate = $regDate;

                    $alloc->save();
                }
            }

            $notification = array(
                'message' => 'Done! Receipt inserted successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('receipt.view')->with($notification);
        } else {
            $notification = array(
                'message' => 'Oops !Enter a value greater than 0',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function ReceiptDts($id)
    {
        $receipt = Receipt::where('id', $id)->first();
        $details = CompanyDetail::first();

        //dd($receipt->receiptAllocations);

        return view('backend.account.receipts.receipt', compact('receipt', 'details'));
    }

    public function invoiceDts($id)
    {
        $invoice = Projection::where('id', $id)->first();
        //$student = (new StudentController)->stdDetails($invoice->student_id);
        $details = CompanyDetail::first();

        //dd($invoice);

        return view('backend.account.receipts.invoice', compact('invoice', 'details'));
    }

    public function statements($id)
    {
        $tenant = Tenant::where('id', $id)->first();
        $details = CompanyDetail::first();

        //dd($student->outstandingBalances($id));
        return view('backend.tenant.statement', compact('tenant', 'details'));
    }

    public function receipt_pdf($id)
    {
        $data = [
            'receipt' => Receipt::where('id', $id)->first(),
            'details' =>  CompanyDetail::first(),
        ];
        $pdf = PDF::loadView('backend.tenant.pdf.receiptPDF', $data);
        return $pdf->stream('receipt.pdf');
    }

    public function invoice_pdf($id)
    {
        $data = [
            'invoice' => Projection::where('id', $id)->first(),
            'details' =>  CompanyDetail::first(),
        ];
        $pdf = PDF::loadView('backend.tenant.pdf.invPDF', $data);
        return $pdf->stream('document.pdf');
    }
}
